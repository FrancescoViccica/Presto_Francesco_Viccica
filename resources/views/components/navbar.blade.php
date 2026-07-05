<nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom shadow-sm">
  <div class="container-fluid">
    <!-- La riga del brand con la scritta "Navbar" è stata rimossa da qui -->
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      
      <!-- Link principali e Categorie a sinistra -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{route('homepage')}}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('article.create')}}">Crea Articolo</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('article.index')}}">Tutti gli articoli</a>
        </li>
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categorie
          </a>
          <ul class="dropdown-menu">
            @foreach ($categories as $category)
            <li>
              <a class="dropdown-item" href="{{ route('byCategory', ['category' => $category]) }}">
                {{ $category->name }}
              </a>
            </li>
            @if (!$loop->last)
            <li><hr class="dropdown-divider"></li>
            @endif
            @endforeach
          </ul>
        </li>
      </ul>

<!-- Sezione destra: unisce la Barra di Ricerca e l'Autenticazione Utente -->
      <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center ms-auto">
        
        <form action="{{route('search.article')}}" method="GET" role="search" class="d-flex my-2 my-lg-0 me-lg-3" style="min-width: 250px;">
          <div class="input-group w-100">
            <input 
              type="search" 
              name="query" 
              class="form-control" 
              placeholder="Cerca un articolo..." 
              aria-label="search"
              value="{{ request()->get('query') }}"
            >
            <button type="submit" class="input-group-text btn btn-outline-success" id="basic-addon2" >
              Cerca
            </button>
          </div>
        </form>

        <!-- Link Accedi / Registrati / Ciao Utente -->
        <ul class="navbar-nav mb-2 mb-lg-0" style="white-space: nowrap;">
          @guest
          <li class="nav-item">
            <a class="nav-link" href="{{route('login')}}">Accedi</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('register')}}">Registrati</a>
          </li>
          @endguest
          
          @auth
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Ciao {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              @if (Auth::user()->is_revisor)
              <li>
                <a href="{{ route('revisor.index') }}" class="dropdown-item py-1 text-decoration-none">
                  Zona revisore <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ \App\Models\Article::toBerevisionedCount() }}
                  </span>
                </a>
              </li>
              <li><hr class="dropdown-divider"></li>
              @endif
              <li>
                <form action="{{route('logout')}}" method="POST" class="px-3 py-1">
                  @csrf
                  <button class="dropdown-item p-0 btn btn-link text-decoration-none text-start w-100" type="submit">
                    Logout
                  </button>
                </form>
              </li>
            </ul>
          </li>
          @endauth
        </ul>

      </div>
      
    </div>
  </div>
</nav>
