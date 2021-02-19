@extends('adminlte::page')

@section('title', 'Candidatos')

@section('content_header')
    <h1>Listado de candidatos<a style="margin: 19px;" href="{{ route('nominees.create')}}" class="btn btn-primary">Nuevo canditato</a> </h1>
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
        <div class="col-sm-12"> 
          <table class="table" id="example1">
            <thead>
                <tr>
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Código</th>
                  <th>Correo</th>
                  <th>Tipo Doc.</th>
                  <th>Núm Doc.</th>
                  <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($nominees as $nominee)
                @php
                  $typeDocumentText = "SIN ESPECIFICAR";
                  switch ($nominee->document_type) {
                      case "01":
                          $typeDocumentText = "CI/DNI";
                          break;
                      case "04":
                          $typeDocumentText = "Carné extranjería";
                          break;
                      case "07":
                          $typeDocumentText = "Pasaporte";
                          break;
                  }
                @endphp
                <tr>
                    <td>{{ str_pad($nominee->id, 4, "0", STR_PAD_LEFT) }}</td>
                    <td>{{$nominee->name}}</td>
                    <td>{{$nominee->code}}</td>
                    <td>{{$nominee->email}}</td>
                    <td>{{$typeDocumentText}}</td>
                    <td>{{$nominee->document_number}}</td>
                    <td>
                      <div class="row">
                        <a href="{{ route('nominees.edit',$nominee->id)}}" class="btn btn-primary">Editar</a>
                        <span>&#8287;</span>
                        <form action="{{ route('nominees.destroy', $nominee->id)}}" method="post">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-danger" type="submit">Eliminar</button>
                        </form>
                      
                      </div>
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