<x-layout>

    
    <!-- ⬇️ BLOCCO MESSAGGIO: Mostra le conferme di accettazione/rifiuto articoli ⬇️ -->
    @if (session()->has('message'))
    <div class="row justify-content-center mb-4">
        <div class="col-12 col-md-6">
            <div class="alert alert-success text-center shadow rounded fw-bold">
                {{ session('message') }}
            </div>
        </div>
    @endif


<div class="container-fluid text-center bg-body-tertiary">
      @if (session()->has('errorMessage'))
    <div class="row justify-content-center pt-4">
        <div class="col-12 col-md-6">
            <div class="alert alert-danger text-center shadow rounded fw-bold">
                {{ session('errorMessage') }}
            </div>
        </div>
    </div>
    @endif
    <div class="row vh-100 justify-content-center align-items-center">
        <div class="col-12">
            <h1 class="displa-4">Presto.it</h1>
            <div class="my-5">
                @auth
                <a class="btn btn-outline-primary" href="{{ route('article.create') }}">Crea Annuncio</a>
            @endauth

            </div>
        
        </div>
    </div>


    {{-- Ultimi annunci --}}

<div class="row justify-content-center align-items-center py-5 g-4">
    <div class="col-12 col-md-10 mb-5">
        <h2 class="text-center display-6 fw-bold">Ultimi annunci</h2>
    </div>
    @forelse ($articles as $article )
    <div class="col-12 col-md-3">
    <x-card :article="$article" />

    </div>        
    @empty
        
    <div class="col-12">
        <h3 class="text-center">Non sono stati ancora creati annunci</h3>
    </div>
    @endforelse
</div>

</div>




</x-layout>