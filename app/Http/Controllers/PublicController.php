<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class PublicController extends Controller
{
            public function homepage(){
        // Recupera gli ultimi 6 articoli ordinati dal più recente
        $articles = Article::take(6)->orderBy('created_at', 'desc')->get();

        return view('welcome', compact('articles'));
    }
}
