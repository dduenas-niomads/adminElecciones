@extends('adminlte::page')

@section('title', 'Electores')

@section('content_header')
    <h1>Crear elector</h1>
@stop

@section('nav-voters')
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
          <form method="post" action="{{ route('voters.store') }}">
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
                  <label for="phone">Teléfono:</label>
                  <input type="text" class="form-control" name="phone"/>
              </div> 
              <div class="form-group">   
                <label for="type_document">Tipo de Documento:</label> 
                <select name="type_document" class="form-control">
                  <option value="01">DNI</option>
                  <option value="04">C.E</option>
                  <option value="07">Pasaporte</option>
                </select>
              </div>  
              <div class="form-group">    
                  <label for="document_number">Número de Documento:</label>
                  <input type="text" class="form-control" name="document_number"/>
              </div>   
              <div class="form-group">   
                <label for="areas_id">Área:</label> 
                <select name="areas_id" class="form-control">
                    @foreach($areas as $area)
                    <option name="areas_id" value="{{ $area->id }}">{{ $area->name }}</option>
                    @endforeach
                </select>
              </div>     
              <button type="submit" class="btn btn-primary">Crear elector</button>
              <a href="/voters" class="btn btn-default active">Atrás</a>
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