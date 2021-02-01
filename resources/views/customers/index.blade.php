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
    <h1 class="display-3">Clientes</h1>  
    <div>
    <a style="margin: 19px;" href="{{ route('customers.create')}}" class="btn btn-primary">Nuevo Cliente</a>
    </div>  
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Nombre</td>
          <td>Email</td>
          <td>Estado</td>
          <td colspan = 2>Acciones</td>
        </tr>
    </thead>
    <tbody>
        @foreach($customers as $customer)
        <tr>
            <td>{{$customer->id}}</td>
            <td>{{$customer->first_name}} {{$customer->last_name}}</td>
            <td>{{$customer->email}}</td>
            <td>{{$customer->status}}</td>
            <td>
                <a href="{{ route('customers.edit',$customer->id)}}" class="btn btn-primary">Editar</a>
            </td>
            <td>
                <form action="{{ route('customers.destroy', $customer->id)}}" method="post">
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