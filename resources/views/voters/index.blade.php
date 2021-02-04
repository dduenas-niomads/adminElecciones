@extends('adminlte::page')

@section('title', 'Electores')

@section('content_header')
    <h1>Listado de Electores<a style="margin: 19px;" href="{{ route('voters.create')}}" class="btn btn-primary">Nuevo elector</a> </h1>
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
                  <td><b>Código</b></td>
                  <td><b>Área</b></td>
                  <td colspan = 2><b>Opciones</b></td>
                </tr>
            </thead>
            <tbody>
                @foreach($voters as $voter)
                <tr>
                    <td>{{ str_pad($voter->id, 4, "0", STR_PAD_LEFT) }}</td>
                    <td>{{$voter->name}}</td>
                    <td>{{$voter->code}}</td>
                    <td>{{$voter->area->name}}</td>
                    <td>
                        <a href="{{ route('voters.edit',$voter->id)}}" class="btn btn-primary">Editar</a>
                    </td>
                    <td>
                        <form action="{{ route('voters.destroy', $voter->id)}}" method="post">
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