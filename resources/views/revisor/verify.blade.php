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
                @if ($article_to_check->images->count())
                    @foreach ($article_to_check->images as $key => $image )
                        <div class="col-6 col-md-4 mb-4 text-center">
                            <img src="{{ $image->getUrl(300, 300) }}" alt="Immagine {{ $key + 1 }} dell'annuncio {{ $article_to_check->title }}" class="img-fluid rounded shadow" style="width: 100%;">
                        </div>
                    @endforeach
                @else
                    @for ($i = 0; $i < 6; $i++)
                        <div class="col-6 col-md-4 mb-4 text-center">
                            <img src="https://picsum.photos/200" alt="Immagine segnaposto" class="img-fluid rounded shadow">
                        </div>
                    @endfor
                @endif
            </div>
        </div>
        
        <div class="col-md-4 ps-4 d-flex flex-column justify-content-between">
            <div>
                <h1 class="fw-bold">{{$article_to_check->title}}</h1>
                <h3 class="h5 text-secondary">Autore: {{$article_to_check->user->name}}</h3>
                <h4 class="text-success fw-bold"> € {{$article_to_check->price}} </h4>
                <h4 class="fst-italic text-muted h6 mb-3"># {{ $article_to_check->category->name }} </h4>
                <p class="h6 border-top pt-3"> {{ $article_to_check->description }} </p>
            </div>
            
            <div class="d-flex pb-4 justify-content-around">
                <form action="{{ route('reject', ['article' => $article_to_check]) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-danger py-2 px-4 fw-bold shadow-sm">Rifiuta</button>
                </form>
                <form action="{{ route('accept', ['article' => $article_to_check]) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-success py-2 px-4 fw-bold shadow-sm">Accetta</button>
                </form>
            </div>
        </div>
    </div>
</div>
</x-layout>

