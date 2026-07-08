<div class="card mx-auto shadow text-center card-w h-100 d-flex flex-column justify-content-between">
  
  <!-- 👇 SOLUZIONE DEFINITIVA: Sfondo scuro e inquadratura adatta a mostrare il crop intero senza tagli 👇 -->
  <div class="bg-dark d-flex align-items-center justify-content-center rounded-top" style="width: 100%; height: 200px; overflow: hidden;">
      <img src="{{ $article->images->isNotEmpty() ? $article->images->first()->getUrl(300, 300) : '/media/default.png' }}" 
           class="img-fluid d-block mx-auto" 
           alt="Immagine articolo {{ $article->title }}"
           style="max-height: 100%; max-width: 100%; object-fit: contain;">
  </div>
  
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
