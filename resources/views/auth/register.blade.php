<x-layout>
<x-navbar/>

<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-12 col-md-8">
<form method="POST" action="">
    @csrf
  
    <div class="mb-3">
        <label for="registerEmail" class="form-label">Indirizzo email</label>
    <input type="email" class="form-control" id="registerEmail" name="email">
  </div>

    <div class="mb-3">
        <label for="registerName" class="form-label">Nome utente</label>
    <input type="name" class="form-control" id="registerName" name="name">
  </div>
  
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>

  <div class="mb-3">
    <label for="password_confirmation" class="form-label">Password</label>
    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
  </div>
  
  <button type="submit" class="btn btn-primary">Registrati</button>

</form>
        </div>
    </div>
</div>






<x-footer/>
</x-layout>