<div>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                
                <!-- Messaggio di successo -->
                @if (session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
                </div>
                @endif
                
                <form class="shadow p-5 rounded-5 bg-secondary-subtle" wire:submit="store">
                    @csrf
                    <!-- Campo Titolo -->
                    <div class="mb-3">
                        <label for="title" class="form-label">Titolo</label>
                        <input wire:model.blur="title" type="text" class="form-control" id="title">
                        <div class="text-danger fw-bold"> @error('title') {{ $message }} @enderror</div>
                    </div>
                    
                    <!-- Campo Descrizione -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Descrizione</label>
                        <textarea wire:model.blur="description" id="description" class="form-control" cols="30" rows="10"></textarea>
                        <div class="text-danger fw-bold"> @error('description') {{ $message }} @enderror</div>
                    </div>
                    
                    <!-- Campo Prezzo -->
                    <div class="mb-3">
                        <label for="price" class="form-label">Prezzo</label>
                        <input wire:model.blur="price" type="text" class="form-control" id="price">
                        <div class="text-danger fw-bold"> @error('price') {{ $message }} @enderror</div>
                    </div>
                    
                    <!-- Campo Categoria -->
                    <div class="mb-3">
                        <label for="category" class="form-label">Categoria</label>
                        <select wire:model="category" id="category" class="form-control">
                            <option value="" >Seleziona una categoria</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        
                        <div class="text-danger fw-bold"> @error('category') La categoria è obbligatoria @enderror</div>
                    </div>
                    
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary w-100">Crea Articolo</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
