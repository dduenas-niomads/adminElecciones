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
    <h1 class="display-3">Áreas</h1>  
    <div>
    <a style="margin: 19px;" href="{{ route('areas.create')}}" class="btn btn-primary">Nuevo Área</a>
    </div>  
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Nombre</td>
          <td>Código</td>
          <td colspan = 2>Acciones</td>
        </tr>
    </thead>
    <tbody>
        @foreach($areas as $area)
        <tr>
            <td>{{$area->id}}</td>
            <td>{{$area->name}}</td>
            <td>{{$area->code}}</td>
            <td>
                <a href="{{ route('areas.edit',$area->id)}}" class="btn btn-primary">Editar</a>
            </td>
            <td>
                <form action="{{ route('areas.destroy', $area->id)}}" method="post">
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