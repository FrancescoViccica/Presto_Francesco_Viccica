{{-- <x-layout>
    <div class="container-fluid pt-5">
        
        @if (session()->has('message'))
        <div class="row justify-content-center mb-4">
            <div class="col-12 col-md-6">
                <div class="alert alert-success text-center shadow rounded fw-bold">
                    {{ session('message') }}
                </div>
            </div>
        </div>
        @endif
        
        <div class="row mb-4">
            <div class="col-12 col-md-3">
                <div class="rounded shadow bg-body-secondary p-2">
                    <h1 class="display-6 text-center m-0 fw-bold">Dashboard Revisore</h1>
                </div>
            </div>
        </div>
        
        @if($article_to_check)
        <!-- MOSTRA SEMPRE IL BOX SCURO ALL'ACCESSO -->
        <div class="row justify-content-center align-items-center text-center py-5">
            <div class="col-12 col-md-6 bg-dark text-white p-5 rounded shadow-lg">
                <h2 class="display-6 fw-bold mb-4 text-warning">⚠️ Hai degli annunci da verificare!</h2>
                <p class="lead text-light mb-4">Ci sono articoli in attesa nella coda di revisione. Clicca sul pulsante per iniziare il controllo.</p>
                <!-- Il link ora punta alla nuova pagina di verifica reale -->
                <a href="{{ route('revisor.verify') }}" class="btn btn-warning btn-lg shadow fw-bold px-5">
                    Inizia la verifica
                </a>
            </div>
        </div>
        @else
        <div class="row justify-content-center align-items-center text-center py-5">
            <div class="col-12">
                <h1 class="fst-italic display-4">Nessun articolo da revisionare</h1>
                <a href="{{ route('homepage') }}" class="mt-5 btn btn-outline-primary">Torna alla homepage </a>
            </div>
        </div>
        @endif
    </div>
</x-layout> --}}

<x-layout>
    <div class="container-fluid pt-5">
        
        @if (session()->has('message'))
        <div class="row justify-content-center mb-4">
            <div class="col-12 col-md-6">
                <div class="alert alert-success text-center shadow rounded fw-bold">
                    {{ session('message') }}
                </div>
            </div>
        </div>
        @endif
        
        <div class="row mb-4">
            <div class="col-12 col-md-3">
                <div class="rounded shadow bg-body-secondary p-2">
                    <h1 class="display-6 text-center m-0 fw-bold">
                        Dashboard Revisore
                    </h1>
                </div>
            </div>
        </div>
        
        @if($article_to_check)
        <div class="row justify-content-center align-items-center text-center py-5">
            <div class="col-12 col-md-5 col-lg-4 bg-dark text-white p-4 rounded shadow-lg">
                
                <h3 class="fw-bold mb-3 text-warning">
                    ⚠️ Hai degli annunci da verificare!
                </h3>
                
                <p class="mb-4">
                    Ci sono articoli in attesa nella coda di revisione.
                    Clicca sul pulsante qui sotto per iniziare il controllo.
                </p>
                
                <a href="{{ route('revisor.verify') }}"
                class="btn btn-warning fw-bold px-3 py-2">
                Verifica
            </a>
            
        </div>
    </div>
    @else
    <div class="row justify-content-center align-items-center text-center py-5">
        <div class="col-12">
            <h1 class="fst-italic display-4">
                Nessun articolo da revisionare
            </h1>
            
            <a href="{{ route('homepage') }}"
            class="mt-5 btn btn-outline-primary">
            Torna alla homepage
        </a>
    </div>
</div>
@endif

</div>
</x-layout>