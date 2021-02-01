@extends('base')
@extends('layouts.app')
@section('main')
<div class="row">
 <div class="col-sm-8 offset-sm-2">
    <h1 class="display-3">Crear admin</h1>
  <div>
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('admins.store') }}">
          @csrf
          <div class="form-group">    
              <label for="name">Nombre:</label>
              <input type="text" class="form-control" name="name"/>
          </div>
          <div class="form-group">
              <label for="email">Email:</label>
              <input type="text" class="form-control" name="email"/>
          </div>
          <div class="form-group">
              <label for="role_id">Rol:</label>
              <input type="text" class="form-control" name="role_id"/>
          </div>
          <div class="form-group">
              <label for="password">Contraseña:</label>
              <input type="password" class="form-control" name="password"/>
          </div>                        
          <button type="submit" class="btn btn-primary">Crear admin</button>
      </form>
  </div>
</div>
</div>
@endsection