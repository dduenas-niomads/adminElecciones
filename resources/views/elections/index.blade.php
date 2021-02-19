@extends('adminlte::page')

@section('title', 'Elecciones')

@section('content_header')
    <h1>Listado de Elecciones<a style="margin: 19px;" href="{{ route('elections.create')}}" class="btn btn-primary">Nueva elección</a> </h1>
@stop

@section('nav-elections')
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
          <table class="table" id="example1">
            <thead>
                <tr>
                  <td>ID</td>
                  <td>Nombre</td>
                  <td>Fecha de Inicio</td>
                  <td>Fecha de Fin</td>
                  <td>Opciones</td>
                </tr>
            </thead>
            <tbody>
                @foreach($elections as $election)
                <tr>
                    <td>{{ str_pad($election->id, 4, "0", STR_PAD_LEFT) }}</td>
                    <td>{{$election->name}}</td>
                    <td>{{$election->date_start}}</td>
                    <td>{{$election->date_end}}</td>
                    <td>
                        <a href="{{ route('elections.edit',$election->id)}}" class="btn btn-primary">Detalles</a>
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

@section('css')
    <link rel="stylesheet" href="{{ asset('css/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatables/responsive.bootstrap4.min.css') }}">
@stop

@section('js')
   <!-- scripts -->
    <script src="{{ asset('scripts/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('scripts/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('scripts/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('scripts/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function (e) {
            
            $("#example1").DataTable({
                "info": true,
                "scrollX": false,
                "ordering": false,
                "searching": true,
                "processing": false,
                "serverSide": false,
                "lengthChange": false,
                "bPaginate": true,
                "responsive": false,
                "language": {
                    "url": "/js/languages/datatables/es.json"
                },
                "order": [[ 1, "asc" ]]
            });

            openEditView = function (id) {
              location.href = 'nominees/' + id + '/edit';
            }
        });
    </script>
@stop