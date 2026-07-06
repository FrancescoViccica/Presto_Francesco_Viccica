<div class="card mx-auto shadow text-center card-w h-100 d-flex flex-column justify-content-between">
  <img src="{{ $article->images->isNotEmpty() ? $article->images->first()->getUrl(300, 300) : '/media/default.png' }}" class="card-img-top" alt="Immagine articolo {{ $article->title }}">
  
  <div class="card-body d-flex flex-column justify-content-between p-3">
    <div>
        <h4 class="card-title fw-bold text-truncate">{{ $article->title }}</h4>
        <h6 class="card-subtitle text-body-secondary mb-3"> € {{ $article->price }}</h6>
    </div>

    
    <div class="d-flex flex-column flex-sm-row justify-content-center align-items-stretch gap-2 mt-auto">
        <a href="{{ route('article.show', compact('article')) }}" class="btn btn-primary w-100">Dettaglio</a>
        <a href="{{ route('byCategory', ['category' => $article->category]) }}" class="btn btn-outline-info text-truncate w-100">
            {{ __("ui." . $article->category->name) }}
        </a>
    </div>
  </div>
</div>
