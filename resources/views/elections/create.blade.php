@extends('base')
@extends('layouts.app')
@section('main')
<div class="row">
 <div class="col-sm-8 offset-sm-2">
    <h1 class="display-3">Iniciar Votación</h1>
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
      <form method="post" action="{{ route('elections.store') }}">
          @csrf
          <div class="form-group">    
              <label for="name">Nombre (opcional) </label>
              <input type="text" class="form-control" name="name"/>
          </div>         
          <button type="submit" class="btn btn-primary">Iniciar Elección</button>
          <a href="/elections" class="btn btn-default active">Atrás</a>
      </form>
  </div>
</div>
</div>
@endsection