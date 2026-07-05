<x-layout>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1 class="display-4 text-center mt-3">Risultati della ricerca <span class="fst-italic"> {{ $query }} </span></h1>
        </div>
    </div>
</div>
<div class="row justify-content-center align-items-center py-5">
    @forelse ($articles as $article)
    <div class="col-12 col-md-3">
        <x-card :article="$article" />
    </div>
    @empty
    <div class="col-12">
        <h3 class="text-center">
            Nessun annuncio trovato 
        </h3>
    </div>
    @endforelse
</div>

<div class="d-flex justify-content-center">
    <div>
        {{ $articles->links() }}
    </div>
</div>

</x-layout>
