@extends('adminlte::page')

@section('title', 'Áreas')

@section('content_header')
    <h1>Crear áreas</h1>
@stop

@section('nav-areas')
    active
@stop

@section('content')

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
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
  </div>  
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop