@extends('adminlte::page')

@section('title', 'Posiciones')

@section('content_header')
    <h1>Listado de posiciones<a style="margin: 19px;" href="{{ route('positions.create')}}" class="btn btn-primary">Nueva posición</a> </h1>
@stop

@section('nav-positions')
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
                  <td colspan = 2>Acciones</td>
                </tr>
            </thead>
            <tbody>
                @foreach($positions as $position)
                <tr>
                    <td>{{$position->id}}</td>
                    <td>{{$position->name}}</td>
                    <td>
                        <a href="{{ route('positions.edit',$position->id)}}" class="btn btn-primary">Editar</a>
                    </td>
                    <td>
                        <form action="{{ route('positions.destroy', $position->id)}}" method="post">
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