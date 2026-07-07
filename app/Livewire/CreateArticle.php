<?php

namespace App\Livewire;

use App\Jobs\GoogleVisionLabelImage;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Article;
use App\Models\Category;
use App\Jobs\ResizeImage;
use App\Jobs\GoogleVisionSafeSearch;
use Livewire\WithFileUploads;

class CreateArticle extends Component
{
    use WithFileUploads;

    #[Validate('required', message: 'Il titolo è obbligatorio')]
    public $title;

    #[Validate('required', message: 'La descrizione è obbligatoria')]
    public $description;

    #[Validate('required', message: 'Il prezzo è obbligatorio')]
    #[Validate('numeric', message: 'Deve essere un numero')]
    public $price;

    #[Validate('required')]
    public $category = '';
    
    public $article;

    public $images = [];
    public $temporary_images = [];

    // Metodo mount per caricare i dati in caso di modifica
    public function mount(Article $article = null)
    {
        if ($article && $article->exists) {
            $this->article = $article;
            $this->title = $article->title;
            $this->description = $article->description;
            $this->price = $article->price;
            $this->category = $article->category_id;
        }
    }

    public function store()
    {
        $this->validate();

        // Se l'articolo esiste esegue la modifica, altrimenti lo crea
        if ($this->article && $this->article->exists) {
            $this->article->update([
                'title' => $this->title,
                'description' => $this->description,
                'price' => $this->price,
                'category_id' => $this->category,
                'user_id' => Auth::id(), 
            ]);
            $flashMessage = 'Articolo modificato con successo!';
        } else {
            $this->article = Article::create([
                'title' => $this->title,
                'description' => $this->description,
                'price' => $this->price,
                'category_id' => $this->category,
                'user_id' => Auth::id(), 
            ]);
            $flashMessage = 'Articolo creato con successo!';
        }

        if (count($this->images) > 0) {
            // Se siamo in modifica, eliminiamo le vecchie immagini prima di inserire le nuove
            if ($this->article->wasRecentlyCreated === false) {
                foreach ($this->article->images as $oldImage) {
                    Storage::disk('public')->delete($oldImage->path);
                    
                    // Elimina anche il file fisicamente croppato se presente
                    $oldCrop = dirname($oldImage->path) . '/crop_300x300_' . basename($oldImage->path);
                    Storage::disk('public')->delete($oldCrop);

                    $oldImage->delete();
                }
            }

            foreach ($this->images as $image) {
                $newFileName = "articles/{$this->article->id}";
                
                
                $newImage = $this->article->images()->create([
                    'path' => $image->store($newFileName, 'public')
                ]);
                
                // 👇 NUOVA LOGICA: Lancio di entrambi i Job in coda in sicurezza dopo l'invio della risposta
                ResizeImage::dispatch($newImage->path, 300, 300);
                GoogleVisionSafeSearch::dispatch($newImage->id);
                GoogleVisionLabelImage::dispatch($newImage->id);
            }
            // File::deleteDirectory(storage_path('app/livewire-tmp'));
        }

        session()->flash('message', $flashMessage);

        if ($this->article->wasRecentlyCreated === false) {
            return redirect()->route('article.index');
        }

        $this->reset(['title', 'description', 'price', 'category', 'images', 'temporary_images']);
    }

    public function updatedTemporaryImages() {
        if ($this->validate([
            'temporary_images.*' => 'Image|max:1024',
            'temporary_images' => 'max:6'
        ])) {
            foreach ($this->temporary_images as $image) {
                $this->images[] = $image;
            }
        }
    }

    public function removeImages($key) {
        if (in_array($key, array_keys($this->images))) {
            unset($this->images[$key]);
        }
    }

    public function render()
    {
        return view('livewire.create-article', [
            'categories' => Category::all()
        ]);
    }
}
