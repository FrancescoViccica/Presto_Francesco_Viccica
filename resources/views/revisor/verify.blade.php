<x-layout>
<div class="container-fluid pt-5">
    
    <div class="row mb-4">
        <div class="col-12 col-md-3">
            <div class="rounded shadow bg-body-secondary p-2">
                <h1 class="display-6 text-center m-0 fw-bold">Verifica Annuncio</h1>
            </div>
        </div>
    </div>

    <div class="row justify-content-center pt-5">
        <div class="col-md-8">
            <div class="row justify-content-center">
                @for ($i = 0; $i < 6; $i++)
                    <div class="col-6 col-md-4 mb-4 text-center">
                        <img src="https://picsum.photos/200" alt="Immagine segnaposto" class="img-fluid rounded shadow">
                    </div>
                @endfor
            </div>
        </div>
        <div class="col-md-4 ps-4 d-flex flex-column justify-content-between">
            <div>
                <h1>{{$article_to_check->title}}</h1>
                <h3>Autore: {{$article_to_check->user->name}}</h3>
                <h4> €{{$article_to_check->price}} </h4>
                <h4 class="fst-italic text-muted"># {{ $article_to_check->category->name }} </h4>
                <p class="h6"> {{ $article_to_check->description }} </p>
            </div>
            <div class="d-flex pb-4 justify-content-around">
                <form action="{{ route('reject', ['article' => $article_to_check]) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-danger py-2 px-5 fw-bold">Rifiuta</button>
                </form>
                <form action="{{ route('accept', ['article' => $article_to_check]) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-success py-2 px-5 fw-bold">Accetta</button>
                </form>
            </div>
        </div>
    </div>
</div>
</x-layout>
