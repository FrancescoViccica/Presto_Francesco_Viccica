<form action="{{ route('setLocale', $lang)}}" method="POST">
    @csrf
    <button type="submit" class="btn">
        <img src="{{ asset("vendor/blade-flags/country-$lang.svg") }}" alt="Flag {{ $lang }}" width="20" height="20">
    </button>
</form>
