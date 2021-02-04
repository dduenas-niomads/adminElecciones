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
                  <td><b>ID</b></td>
                  <td><b>Nombre</b></td>
                  <td><b>Código</b></td>
                  <td><b>Correo</b></td>
                  <td><b>Tipo Doc.</b></td>
                  <td><b>Núm Doc.</b></td>
                  <td colspan = 2><b>Opciones</b></td>
                </tr>
            </thead>
            <tbody>
                @foreach($nominees as $nominee)
                <tr>
                    <td>{{ str_pad($nominee->id, 4, "0", STR_PAD_LEFT) }}</td>
                    <td>{{$nominee->name}}</td>
                    <td>{{$nominee->code}}</td>
                    <td>{{$nominee->email}}</td>
                    <td>{{$nominee->document_type}}</td>
                    <td>{{$nominee->document_number}}</td>
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