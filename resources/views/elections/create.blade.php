@extends('adminlte::page')

@section('title', 'Elecciones')

@section('content_header')
    <h1>Listado de Elecciones<a style="margin: 19px;" href="{{ route('elections.create')}}" class="btn btn-primary">Nueva elección</a> </h1>
@stop

@section('nav-elections')
    active
@stop

@section('content')

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="col-sm-12">
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
        <div>
      </div>
    </div>
  </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop