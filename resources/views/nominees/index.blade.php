@extends('adminlte::page')

@section('title', 'Nominados')

@section('content_header')
    <h1>Listado de nominados<a style="margin: 19px;" href="{{ route('nominees.create')}}" class="btn btn-primary">Nuevo nominado</a> </h1>
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
          @if(session()->get('success'))
            <div class="alert alert-success">
              {{ session()->get('success') }}  
            </div>
          @endif
        </div>
        <div class="row">
        <div class="col-sm-12"> 
          <table class="table">
            <thead>
                <tr>
                  <td>ID</td>
                  <td>Nombre</td>
                  <td>Código</td>
                  <td>Descripción</td>
                  <td>Área</td>
                  <td>Posición</td>
                  <td colspan = 2>Acciones</td>
                </tr>
            </thead>
            <tbody>
                @foreach($nominees as $nominee)
                <tr>
                    <td>{{$nominee->id}}</td>
                    <td>{{$nominee->name}}</td>
                    <td>{{$nominee->code}}</td>
                    <td>{{$nominee->description}}</td>
                    <td>{{$nominee->area->name}}</td>
                    <td>{{$nominee->position->name}}</td>
                    <td>
                        <a href="{{ route('nominees.edit',$nominee->id)}}" class="btn btn-primary">Editar</a>
                    </td>
                    <td>
                        <form action="{{ route('nominees.destroy', $nominee->id)}}" method="post">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-danger" type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
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