@extends('adminlte::page')

@section('title', 'Áreas')

@section('content_header')
    <h1>Listado de áreas     <a style="margin: 19px;" href="{{ route('areas.create')}}" class="btn btn-primary">Nueva área</a> </h1>
@stop

@section('nav-areas')
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
                    <td colspan = 2><b>Opciones</b></td>
                  </tr>
              </thead>
              <tbody>
                  @foreach($areas as $area)
                  <tr>
                      <td>{{ str_pad($area->id, 4, "0", STR_PAD_LEFT) }}</td>
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


