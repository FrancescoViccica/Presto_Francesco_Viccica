<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Bus;
use App\Jobs\RemoveFaces;
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
                
                Bus::chain([
                  new ResizeImage($newImage->path, 300, 300),
                  new GoogleVisionSafeSearch($newImage->id),
                  new GoogleVisionLabelImage($newImage->id),
                  new RemoveFaces($newImage->id),
                  ])->dispatch();
            }
            
            // Svuota la cartella temporanea (Scommentato come da pag. 102 della guida per non intasare lo storage)
            File::deleteDirectory(storage_path('app/livewire-tmp'));
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
        // 1. Elimina dalla lista delle immagini confermate e riordina
        if (isset($this->images[$key])) {
            unset($this->images[$key]);
            $this->images = array_values($this->images);
        }

        // 2. Elimina dalla lista temporanea (così sparisce l'anteprima a schermo) e riordina
        if (isset($this->temporary_images[$key])) {
            unset($this->temporary_images[$key]);
            $this->temporary_images = array_values($this->temporary_images);
        }
    }


    public function render()
    {
        return view('livewire.create-article', [
            'categories' => Category::all()
        ]);
    }
}
