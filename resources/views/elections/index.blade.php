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
                  <td><b>ID</b></td>
                  <td><b>Nombre</b></td>
                  <td><b>Fecha de Inicio</b></td>
                  <td><b>Fecha de Fin</b></td>
                  <td colspan = 2><b>Opciones</b></td>
                </tr>
            </thead>
            <tbody>
                @foreach($elections as $election)
                <tr>
                    <td>{{ str_pad($election->id, 4, "0", STR_PAD_LEFT) }}</td>
                    <td>{{$election->name}}</td>
                    <td>{{$election->date_start}}</td>
                    <td>{{$election->date_end}}</td>
                    <td>
                        <a href="{{ route('elections.edit',$election->id)}}" class="btn btn-primary">Detalles</a>
                    </td>
                    <td>
                        <!-- <form action="{{ route('elections.destroy', $election->id)}}" method="post">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-danger" type="submit">Eliminar</button>
                        </form> -->
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