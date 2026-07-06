<div>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-11 col-md-10 col-lg-8">
                
                <!-- Messaggio di successo -->
                @if (session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                </div>
                @endif
                
                <form class="shadow p-4 p-md-5 rounded-5 bg-secondary-subtle" wire:submit="store">
                    @csrf
                    
                    <!-- Campo Caricamento Immagini -->
                    <div class="mb-3">
                        <label for="temporary_images" class="form-label fw-bold">Immagini dell'articolo</label>
                        <input type="file" wire:model.live="temporary_images" id="temporary_images" multiple class="form-control shadow @error('temporary_images.*') is-invalid @enderror">
                        @error('temporary_images.*')
                        <p class="fst-italic text-danger small mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    
                    @if (!empty($images))
                    <div class="row mb-4">
                        <div class="col-12">
                            <p class="fw-bold mb-2">Anteprima foto caricate:</p>
                            
                            <div class="d-flex flex-wrap justify-content-center align-items-center gap-3 border border-4 border-success rounded shadow p-3 bg-white w-100">
                                @foreach ($images as $key => $image)
                                <div class="d-flex flex-column align-items-center text-center p-2 border rounded shadow-sm bg-light" style="min-width: 140px;">
                                    <div class="img-preview shadow rounded mb-2" style="background-image: url({{ $image->temporaryUrl() }});"></div>
                                    <button type="button" class="btn btn-danger btn-sm w-100 fw-bold" wire:click="removeImages({{ $key }})">X</button>
                                </div>
                                @endforeach
                            </div>
                            
                        </div>
                    </div>
                    @endif
                    
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
                            <option value="">Seleziona una categoria</option>
                            @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        <div class="text-danger fw-bold"> @error('category') La categoria è obbligatoria @enderror</div>
                    </div>
                    
                    <div class="d-flex justify-content-center mt-4">
                        <button type="submit" class="btn btn-primary w-100 py-2">Crea Articolo</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
