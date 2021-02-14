@extends('adminlte::page')

@section('title', 'Electores')

@section('content_header')
    <h1>Editar elector</h1>
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
            </div>
            <br /> 
            @endif
            <form method="post" action="{{ route('voters.update', $voter->id) }}">
                @method('PATCH') 
                @csrf
                <div class="form-group">
                    <label for="name">Nombre:</label>
                    <input type="text" class="form-control" name="name" value="{{ $voter->name }}" />
                </div>         
                <div class="form-group">
                    <label for="code">Código:</label>
                    <input type="text" class="form-control" name="code" value="{{ $voter->code }}" />
                </div>  
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="text" class="form-control" name="phone" value="{{ $voter->phone }}" />
                </div>   
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" name="email" value="{{ $voter->email }}" />
                </div>
                <div class="form-group">
                    <label for="document_type">Tipo de Documento:</label>
                    <select class="form-control" name="document_type">
                        <option value="1" {{ $voter->document_type == 01 ? 'selected' : '' }}>DNI</option>
                        <option value="2" {{ $voter->document_type == 04 ? 'selected' : '' }}>C.E</option>
                        <option value="3" {{ $voter->document_type == 07 ? 'selected' : '' }}>PASAPORTE</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="document_number">Número de Documento:</label>
                    <input type="text" class="form-control" name="document_number" value="{{ $voter->document_number }}" />
                </div>
                <div class="form-group">
                    <label for="areas_id">Área:</label>
                    <select name="areas_id" class="form-control">
                        @foreach($areas as $area)
                        <option name="areas_id" value="{{ $area->id }}" {{ $area->id == $voter->areas_id ? 'selected' : '' }}>{{ $area->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Actualizar</button>
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