<x-layout>

<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-12 col-md-8">
<form method="POST" action="">
    @csrf
  
    <div class="mb-3">
  
        <label for="loginEmail" class="form-label">Indirizzo email</label>
    <input type="email" class="form-control" id="loginEmail" name="email">
  
  </div>
  
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  
  <button type="submit" class="btn btn-primary">Accedi</button>

</form>
        </div>
    </div>
</div>






</x-layout>