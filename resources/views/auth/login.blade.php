<x-layout>
    
    <!-- Rimosso heightCustom, ora il container occupa solo lo spazio del testo -->
    <div class="container-fluid my-5">
        <div class="row justify-content-center text-center">
            <div class="col-12">
                <h1 class="display-4 mb-0">Accedi</h1>
            </div>
        </div>
    </div>
    
    <!-- Il form ora sale verso l'alto, distanziato solo da mt-3 (margin-top) -->
    <div class="container bg-secondary-subtle rounded-4 p-5 mt-3">
        <div class="row justify-content-center">
            <div class="col-12 col-md-9">
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    
                    <!-- Campo Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email utente</label>
                        <input name="email" type="email" class="form-control" id="email">
                    </div>
                    
                    <!-- Campo Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input name="password" type="password" class="form-control" id="password">
                    </div>
                    
                    <!-- Pulsanti di azione -->
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <button type="submit" class="btn btn-primary">Accedi</button>
                        <p class="mb-0">Non hai un account? 
                            <a class="btn btn-outline-primary ms-2" href="{{route('register')}}">Registrati</a>
                        </p>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>

</x-layout>
