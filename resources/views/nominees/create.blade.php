@extends('adminlte::page')

@section('title', 'Nominados')

@section('content_header')
    <h1>Crear nominado</h1>
@stop

@section('nav-nominees')
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
          <form method="post" action="{{ route('nominees.store') }}">
              @csrf
              <div class="form-group">    
                  <label for="name">Nombre:</label>
                  <input type="text" class="form-control" name="name"/>
              </div>     
              <div class="form-group">    
                  <label for="code">Código:</label>
                  <input type="text" class="form-control" name="code"/>
              </div>   
              <div class="form-group">    
                  <label for="email">Email:</label>
                  <input type="text" class="form-control" name="email"/>
              </div>   
              <div class="form-group">   
                <label for="document_type">Tipo de Documento:</label> 
                <select name="document_type" class="form-control">
                  <option value="01">DNI</option>
                  <option value="04">C.E</option>
                  <option value="07">Pasaporte</option>
                </select>
              </div>  
              <div class="form-group">    
                  <label for="document_number">Número de Documento:</label>
                  <input type="text" class="form-control" name="document_number"/>
              </div>
              <button type="submit" class="btn btn-primary">Crear Nominado</button>
              <a href="/nominees" class="btn btn-default active">Atrás</a>
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