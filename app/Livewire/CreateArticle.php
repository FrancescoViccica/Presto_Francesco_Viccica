<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use App\Models\Category;
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
public $category='';
public $article;

public $images = [];
public $temporary_images = [];


public function store()
    {
        // validazione dei dati inseriti
        $this->validate();

        //  Salva l'articolo direttamente nel database tramite il Modello
       $this->article = Article::create([
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->category,
            'user_id' => Auth::id(), 
        ]);

        if(count($this->images) > 0){
            foreach($this->images as $image){
                $this->article->images()->create(['path'=>$image->store('image', 'public')]); 
            }
        }

        // messaggio di successo alla vista
        session()->flash('message', 'Articolo creato con successo!');

        //  Svuota automaticamente tutti i campi del form
        $this->reset(['title', 'description', 'price', 'category', 'images', 'temporary_images']);
    }

    public function updatedTemporaryImages(){
        if($this->validate([
            'temporary_images.*' => 'Image|max:1024',
            'temporary_images' => 'max:6'
        ])){
            foreach($this->temporary_images as $image){
                $this->images[] = $image;
            }
        }
    }

    public function removeImages($key){

       if(in_array($key, array_keys($this->images))){
        unset($this->images[$key]);
       }

    }




public function render()
{
    // Recuperiamo tutte le categorie dal database e le passiamo alla vista
    return view('livewire.create-article', [
        'categories' => Category::all()
    ]);
}
}
