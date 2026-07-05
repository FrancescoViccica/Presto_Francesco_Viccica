<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class PublicController extends Controller
{
    public function homepage()
    {
        // Recupera gli ultimi 6 articoli ordinati dal più recente
        $articles = Article::where('is_accepted', true)->orderBy('created_at', 'desc')->take(6)->get();

        return view('welcome', compact('articles'));
    }

    public function searchArticles(Request $request)
    {
        $query = $request->input('query');
        
        // Specifichiamo esplicitamente 'articles.is_accepted' per evitare conflitti SQL con TNTSearch
        $articles = Article::search($query)
            ->query(function ($builder) {
                $builder->where('articles.is_accepted', true);
            })
            ->paginate(10);

        return view('article.searched', [
            'articles' => $articles, 
            'query' => $query
        ]);
    }
}
