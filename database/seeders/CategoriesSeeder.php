<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    public $categories = [
        'Elettronica',
        'Abbigliamento',
        'Casa e Giardinaggio',
        'Sports',
        'Salute e Bellezza',
        'Giochi',
        'Motori',
        'Libri e Musica',
        'Cibo e Bevande',
        'Viaggi e Turismo'
    ];
    
    public function run(): void
    {
        foreach ($this->categories as $category) {
            Category::create([
                'name' => $category
            ]);
        }
    }
}
