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
    <h1 class="display-3">Posiciones</h1>  
    <div>
    <a style="margin: 19px;" href="{{ route('positions.create')}}" class="btn btn-primary">Nueva Posición</a>
    </div>  
  <table class="table table-striped">
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
@endsection