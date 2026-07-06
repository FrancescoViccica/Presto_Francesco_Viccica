<x-layout>
    
    <div class="container pt-5">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <h1 class="display-4 pt-5 fw-bold">
                    {{ __('ui.allArticles') }}
                </h1>
            </div>
        </div>
        
        <div class="row justify-content-center align-items-center py-5 g-4">
            @forelse ($articles as $article)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <x-card :article="$article" />
            </div>        
            @empty
            <div class="col-12">
                <h3 class="text-center">{{ __('ui.No_ads') }}</h3>
            </div>
            @endforelse
        </div>
    </div>

    <div class="d-flex justify-content-center w-100 px-3 mb-5">
        <div class="table-responsive text-center w-100 d-flex justify-content-center" style="max-width: 100%; overflow-x: auto;">
            {{ $articles->links() }}
        </div>
    </div>
    
</x-layout>
