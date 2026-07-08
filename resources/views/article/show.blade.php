<x-layout>
    <div class="container mt-3"> 
        <div class="row justify-content-center align-items-center text-center">
            <div class="col-12">
                <h1 class="display-4 text-center">Dettaglio dell'articolo: {{ $article->title }}</h1>
            </div>
        </div>
        
        <div class="row justify-content-center py-5">
            <!-- Colonna Carosello Immagini -->
            
            <div class="col-12 col-md-6 mb-3">
                @if ($article->images->count() > 0)
                <div id="carouselExample" class="carousel slide">
                    <div class="carousel-inner">
                        @foreach ($article->images as $key=> $image )
                        <div class="carousel-item @if ($loop->first) active @endif">
                            <img src="{{ $image->getUrl(300,300) }}" class="d-block rounded shadow w-100" alt="Immagine {{ $key + 1 }} articolo {{ $article->title }}">
                        </div>
                        @endforeach
                    </div>
                    @if ($article->images->count() > 1)
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                    @endif
                </div>
                @else
                <img src="/media/default.png" alt="Nessuna foto inserita dall'utente">                
                @endif
            </div>
            
            
            <!-- Colonna Dettagli Testo -->
            <div class="col-12 col-md-6 mb-3 text-center">
                <h2 class="display-5"> <span class="fw-bold">Titolo:</span> {{ $article->title }} </h2>
                <div class="d-flex flex-column justify-content-center h-75">
                    <h4 class="fw-bold">Prezzo: € {{ $article->price }}</h4>
                    <h5>Descrizione</h5>
                    <p>{{ $article->description }}</p>
                    
                    <!-- BOTTONE AGGIUNGI AL CARRELLO -->
                    <div class="d-grid gap-2 mt-4">
                        <button class="btn btn-outline-success btn-lg d-flex align-items-center justify-content-center fw-bold" type="button">
                            <i class="bi bi-cart-plus me-2 fs-5"></i>
                            Aggiungi al carrello
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
</x-layout>
