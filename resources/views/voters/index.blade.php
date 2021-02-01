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
    <h1 class="display-3">Votantes</h1>  
    <div>
    <a style="margin: 19px;" href="{{ route('voters.create')}}" class="btn btn-primary">Nuevo Votante</a>
    </div>  
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Nombre</td>
          <td>Código</td>
          <td>Área</td>
          <td colspan = 2>Acciones</td>
        </tr>
    </thead>
    <tbody>
        @foreach($voters as $voter)
        <tr>
            <td>{{$voter->id}}</td>
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
@endsection