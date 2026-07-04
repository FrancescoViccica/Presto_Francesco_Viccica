<x-layout>

<div class="container-fluid text-center bg-body-tertiary">
    <div class="row vh-100 justify-contentcenter align-items-center">
        <div class="col-12">
            <h1 class="displa-4">Presto.it</h1>
            <div class="my-5">
                @auth
                <a class="btn btn-outline-primary" href="{{ route('article.create') }}">Crea Annuncio</a>
            @endauth

            </div>
        
        </div>

    </div>
</div>


</x-layout>