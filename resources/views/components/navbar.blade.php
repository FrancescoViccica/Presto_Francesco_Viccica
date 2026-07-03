<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
     
        <!-- Link principali a sinistra -->
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="{{ route('homepage') }}">Home</a>
        <a class="nav-link" href="#">Features</a>
        <a class="nav-link" href="#">Pricing</a>
        <a class="nav-link disabled" aria-disabled="true">Disabled</a>
      </div>

      <!--  LINK A DESTRA  -->
    @guest
        
    <div class="navbar-nav ms-auto">
        <a class="nav-link" href="{{ route('login') }}">Accedi</a>
        <a class="nav-link" href="{{ route('register') }}">Registrati</a>
    </div>
    @endguest 
    
    </div>
  </div>
</nav>
