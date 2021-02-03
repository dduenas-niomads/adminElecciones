@extends('base')
@extends('layouts.app')
@section('main')
<div class="col-sm-12">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div>
  @endif
</div>
<div class="row">
<div class="col-sm-12">
    <h1 class="display-3">Votaciones</h1>  
    <div>
    <a style="margin: 19px;" href="{{ route('elections.create')}}" class="btn btn-primary">Nueva Elección</a>
    </div>  
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Nombre</td>
          <td>Fecha de Inicio</td>
          <td>Fecha de Fin</td>
          <td colspan = 2>Acciones</td>
        </tr>
    </thead>
    <tbody>
        @foreach($elections as $election)
        <tr>
            <td>{{$election->id}}</td>
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
@endsection