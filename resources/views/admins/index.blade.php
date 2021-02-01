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
    <h1 class="display-3">Admins</h1>  
    <div>
    <a style="margin: 19px;" href="{{ route('admins.create')}}" class="btn btn-primary">Nuevo Admin</a>
    </div>  
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Nombre</td>
          <td>Email</td>
          <td>Rol</td>
          <td>Estado</td>
          <td colspan = 2>Acciones</td>
        </tr>
    </thead>
    <tbody>
        @foreach($admins as $admin)
        <tr>
            <td>{{$admin->id}}</td>
            <td>{{$admin->name}}</td>
            <td>{{$admin->email}}</td>
            <td>{{$admin->role_id}}</td>
            <td>{{$admin->status}}</td>
            <td>
                <a href="{{ route('admins.edit',$admin->id)}}" class="btn btn-primary">Editar</a>
            </td>
            <td>
                <form action="{{ route('admins.destroy', $admin->id)}}" method="post">
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