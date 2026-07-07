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
                        <div class="col-12 col-xl-6 mb-4">
                            <div class="card shadow-sm h-100" style="overflow: hidden;">
                              
                                <div class="row g-0 h-100 align-items-start py-3">
                                    
                                    <!-- 1. Colonna Foto (Sinistra) -->
                                    <div class="col-md-4 px-2">
                                        <img src="{{ $image->getUrl(300, 300) }}" 
                                             class="img-fluid rounded shadow-sm" 
                                             alt="Immagine {{ $key + 1 }} dell'annuncio {{ $article_to_check->title }}"
                                             style="width: 100%; height: 200px; object-fit: cover; object-position: center;">
                                    </div>
                                    
                                    <!-- 2. Colonna Labels (Centro) -->
                                    <div class="col-md-5 ps-3 border-end h-100">
                                        <div class="card-body p-0">
                                            <h5 class="fw-bold border-bottom pb-1 mb-2 h6 text-secondary">Labels</h5>
                                            <div class="d-flex flex-wrap gap-1">
                                                @if ($image->labels)
                                                    @foreach ($image->labels as $label)
                                                        <span class="badge bg-secondary-subtle text-secondary-emphasis border">#{{ $label }}</span>
                                                    @endforeach
                                                @else
                                                    <p class="fst-italic small text-muted m-0">No labels</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- 3. Colonna Ratings (Destra) -->
                                    <div class="col-md-3 ps-3 h-100">
                                        <div class="card-body p-0">
                                            <h5 class="fw-bold border-bottom pb-1 mb-2 h6 text-secondary">Ratings</h5>
                                            
                                            <!-- Adult -->
                                            <div class="row align-items-center mb-2">
                                                <div class="col-3 text-center">
                                                    <div class="mx-auto {{ $image->adult }}"></div>
                                                </div>
                                                <div class="col-9 small text-muted text-truncate">adult</div>
                                            </div>
                                            
                                            <!-- Violence -->
                                            <div class="row align-items-center mb-2">
                                                <div class="col-3 text-center">
                                                    <div class="mx-auto {{ $image->violence }}"></div>
                                                </div>
                                                <div class="col-9 small text-muted text-truncate">violence</div>
                                            </div>
                                            
                                            <!-- Spoof -->
                                            <div class="row align-items-center mb-2">
                                                <div class="col-3 text-center">
                                                    <div class="mx-auto {{ $image->spoof }}"></div>
                                                </div>
                                                <div class="col-9 small text-muted text-truncate">spoof</div>
                                            </div>
                                            
                                            <!-- Racy -->
                                            <div class="row align-items-center mb-2">
                                                <div class="col-3 text-center">
                                                    <div class="mx-auto {{ $image->racy }}"></div>
                                                </div>
                                                <div class="col-9 small text-muted text-truncate">racy</div>
                                            </div>
                                            
                                            <!-- Medical -->
                                            <div class="row align-items-center mb-2">
                                                <div class="col-3 text-center">
                                                    <div class="mx-auto {{ $image->medical }}"></div>
                                                </div>
                                                <div class="col-9 small text-muted text-truncate">medical</div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    @for ($i = 0; $i < 6; $i++)
                        <div class="col-6 col-md-4 mb-4 text-center">
                            <img src="https://picsum.photos" alt="Immagine segnaposto" class="img-fluid rounded shadow">
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
