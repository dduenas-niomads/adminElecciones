@extends('base')
@extends('layouts.app')
@section('main')
<div class="row">
 <div class="col-sm-8 offset-sm-2">
    <h1 class="display-3">Crear Área</h1>
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
      <form method="post" action="{{ route('areas.store') }}">
          @csrf
          <div class="form-group">    
              <label for="name">Nombre:</label>
              <input type="text" class="form-control" name="name"/>
          </div>     
          <div class="form-group">    
              <label for="code">Código:</label>
              <input type="text" class="form-control" name="code"/>
          </div>         
          <button type="submit" class="btn btn-primary">Crear área</button>
          <a href="/areas" class="btn btn-default active">Atrás</a>
      </form>
  </div>
</div>
</div>
@endsection