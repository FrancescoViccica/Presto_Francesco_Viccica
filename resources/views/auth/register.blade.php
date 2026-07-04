<x-layout>
    
    <!-- Rimosso heightCustom per avvicinare il titolo al form -->
    <div class="container-fluid mt-5">
        <div class="row justify-content-center text-center">
            <div class="col-12">
                <h1 class="display-4 mb-0">Registrati</h1>
            </div>
        </div>
    </div>
    
    <div class="container bg-secondary-subtle rounded-4 p-5 mt-3">
        <div class="row justify-content-center">
            <div class="col-12 col-md-9">
                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    <!-- Campo Nome utente -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome utente</label>
                        <input name="name" type="text" class="form-control" id="name" required>
                    </div>
                    
                    <!-- Campo Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email utente</label>
                        <input name="email" type="email" class="form-control" id="email" required>
                    </div>

                    <!-- Campo Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input name="password" type="password" class="form-control" id="password" required>
                    </div>

                    <!-- Campo Conferma Password -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Conferma Password</label>
                        <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" required>
                    </div>

                    <!-- Pulsanti di azione allineati -->
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <button type="submit" class="btn btn-primary">Registrati</button>
                        <p class="mb-0">Sei già registrato? 
                            <a class="btn btn-outline-primary ms-2" href="{{route('login')}}">Accedi</a>
                        </p>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
    
</x-layout>
