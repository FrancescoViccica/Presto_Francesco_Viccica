<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class PublicController extends Controller
{
            public function homepage(){
        // Recupera gli ultimi 6 articoli ordinati dal più recente
        $articles = Article::where('is_accepted', true)->orderBy('created_at', 'desc')->take(6)->get();

        return view('welcome', compact('articles'));
    }
}
