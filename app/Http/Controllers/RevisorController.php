<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Mail\BecomeRevisor;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;

class RevisorController extends Controller
{
    public function index()
    {
        // Usiamo il metodo corretto whereNull per verificare i campi nulli nel database
        $article_to_check = Article::whereNull('is_accepted')->first();
        
        return view('revisor.index', compact('article_to_check')); 
    }

      public function verify()
    {
        $article_to_check = Article::whereNull('is_accepted')->first();

        // Controllo di sicurezza: se nel frattempo la coda si è svuotata, torna all'index
        if (!$article_to_check) {
            return redirect()->route('revisor.index');
        }

        return view('revisor.verify', compact('article_to_check')); 
    }

    public function accept(Article $article){
        $article->setAccepted(true);
        return redirect()->back()->with('message', "Hai accettato l'articolo $article->title");
    }

    public function reject(Article $article){
        $article->setAccepted(false);
        return redirect()->back()->with('message', "Hai rifiutato l'articolo $article->title");
    }

    public function becomeRevisor(){
        Mail::to('admin@presto.it')->send(new BecomeRevisor(Auth::user()));
        return redirect()->route('homepage')->with('message', 'Complimenti, hai richiesto di diventare un revisore!');
    }

    public function makeRevisor(User $user){
        Artisan::call('app:make-user-revisor', ['email' => $user->email]);
        return redirect()->back();
    }
}
