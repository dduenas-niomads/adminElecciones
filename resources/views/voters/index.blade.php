
@extends('adminlte::page')
@section('title', 'Electores')

@section('content_header')
    <h1>Listado de Electores<a style="margin: 19px;" href="{{ route('voters.create')}}" class="btn btn-primary">Nuevo elector</a> </h1>
@stop

@section('nav-voters')
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
                  <th><b>ID</b></th>
                  <th><b>Nombre</b></th>
                  <th><b>Código</b></th>
                  <th><b>Tipo de Documento</b></th>
                  <th><b>Número de Documento</b></th>
                  <th><b>Área</b></th>
                  <th></th>
                  <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($voters as $voter)
                @php
                  $typeDocumentText = "SIN ESPECIFICAR";
                  switch ($voter->type_document) {
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
                    <td>{{ str_pad($voter->id, 4, "0", STR_PAD_LEFT) }}</td>
                    <td>{{$voter->name}}</td>
                    <td>{{$voter->code}}</td>
                    <td>{{$typeDocumentText}}</td>
                    <td>{{$voter->document_number}}</td>
                    <td>{{ !is_null($voter->area) ? $voter->area->name: "Sin área" }}</td>
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
    </div>
  </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatables/responsive.bootstrap4.min.css') }}">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
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
                "processing": true,
                "serverSide": false,
                "lengthChange": false,
                "bPaginate": true,
                "responsive": false,
                "language": {
                    "url": "/js/languages/datatables/es.json"
                },
                "order": [[ 1, "asc" ]],
            });
        });
    </script>
@stop
@stop