<x-layout>
    
    
    <div class="container-pt-5">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <h1 class="display-4 pt-5 fw-bold">
                    Tutti gli  articoli
                </h1>
            </div>
        </div>
        
        <div class="row justify-content-center align-items-center py-5 g-4">
            
            @forelse ($articles as $article )
            <div class="col-12 col-md-3">
                <x-card :article="$article" />
                
            </div>        
            @empty
            
            <div class="col-12">
                <h3 class="text-center">Non sono stati ancora creati annunci</h3>
            </div>
            @endforelse
        </div>
    </div>
    {{-- per poter andare a sfogliare tra le pagine degli articoli --}}
    <div class="d-flex justify-content-center">
        <div>
            {{ $articles->links() }}
        </div>
    </div>
    
    
</x-layout>