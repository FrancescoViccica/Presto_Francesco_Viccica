<x-layout>
    <div class="container mt-3"> 
        <div class="row justify-content-center align-items-center text-center py-5">
            <div class="col-12 pt-5">
                <h1 class="display-4 text-center">Articoli della categoria: 
                    <span class="fst-italic fw-bold">
                        {{ $category->name }}
                    </span>
                </h1>
            </div>
        </div>
        
        <div class="row justify-content-center align-items-center py-5">
            @forelse ($articles as $article)
            <div class="col-12 col-md-3 mb-4">
                <x-card :article="$article" />
            </div>
            @empty
            <div class="col-12 text-center">
                <h3 class="mb-3">
                    Non sono ancora stati creati articoli per questa categoria    
                </h3>    
                
                @auth
                <a class="btn btn-outline-primary" href="{{ route('article.create') }}">Crea Articolo</a>
                @endauth
            </div>    
            @endforelse
        </div>
    </div> 
</x-layout>
