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
    <h1 class="display-3">Nominados</h1>  
    <div>
    <a style="margin: 19px;" href="{{ route('nominees.create')}}" class="btn btn-primary">Nuevo Nominado</a>
    </div>  
  <table class="table table-striped">
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
@endsection