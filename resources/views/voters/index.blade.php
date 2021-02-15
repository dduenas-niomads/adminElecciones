
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
                  <th><b>Dependencia</b></th>
                  <th><b>Opciones</b></th>
                </tr>
            </thead>
            <tbody></tbody>
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
   <!-- scripts -->
    <script src="{{ asset('scripts/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('scripts/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('scripts/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('scripts/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script>
        var arrayVoters = [];
        $(document).ready(function (e) {
            
            $("#example1").DataTable({
                "info": true,
                "scrollX": false,
                "ordering": false,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                "bPaginate": true,
                "responsive": false,
                "language": {
                    "url": "/js/languages/datatables/es.json"
                },
                "order": [[ 1, "asc" ]],
                "ajax": function(data, callback, settings) {
                    $.get('/api/voters', {
                        limit: data.length,
                        offset: data.start,
                        search: data.search,
                        page: data.start/10 + 1
                    }, function(res) {
                        arrayVoters = [];
                        res.data.forEach(element => {
                          arrayVoters[element.id] = element;
                        });
                        callback({
                            recordsTotal: res.total,
                            recordsFiltered: res.total,
                            data: res.data
                        });
                    });
                },
                "columns" : [
                    {'data':   function (data) {
                      return data.id;
                    }},
                    {'data':   function (data) {
                      return data.name
                    }},                
                    {'data':   function (data) {
                      return data.code; 
                    }},
                    {'data':   function (data) {
                      return "DNI";
                    }},
                    {'data':   function (data) {
                      return data.document_number;
                    }},
                    {'data':   function (data) {
                      return data.dependency;
                    }},
                    {'data':   function (data) {
                        return '<div class="col-md-12 row">' + 
                        '<button type="button" onClick="openEditView(' + data.id + ');" class="btn btn-block btn-outline-warning"><i class="fas fa-edit"></i></button><br>' +
                        '</div>';
                    }},
                ],
                // "rowCallback": function( row, data, index ) {
                //     var $node = this.api().row(row).nodes().to$();
                //     var freeDemand = parseFloat(data.on_demand) - parseFloat(data.on_demand_now);
                //     console.log(freeDemand, freeDemand >= 10);
                //     if (freeDemand >= 10) {
                //         $node.addClass('table-success');
                //     } else if (freeDemand >= 5) {
                //         $node.addClass('table-warning');
                //     } else {
                //         $node.addClass('table-danger');
                //     }
                // },
            });

            openEditView = function (id) {
              location.href = 'voters/' + id + '/edit';
            }
        });
    </script>
@stop