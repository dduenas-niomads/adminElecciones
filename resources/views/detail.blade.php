@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>DETALLE DE ELECCIONES DE DELEGADOS 2021</h1>
@stop

@section('nav-dashboard-menu')
    active menu-open
@stop

@section('nav-dashboard')
    active
@stop

@section('nav-detail')
    active
@stop

@section('content')
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table" id="example1">
                        <thead>
                            <th>NOMBRE DE ELECTOR</th>
                            <th>NÚMERO DE DOCUMENTO</th>
                            <th>DELEGADO ELEGIDO</th>
                            <th>CÓDIGO DE DELEGADO</th>
                            <th>FECHA Y HORA</th>
                        </thead>
                    </table>
                </div>
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
        var arrayResults = [];
        $(document).ready(function (e) {
            $("#example1").DataTable({
                "info": true,
                "scrollX": false,
                "ordering": false,
                "searching": false,
                "processing": true,
                "serverSide": false,
                "lengthChange": false,
                "bPaginate": true,
                "responsive": false,
                "language": {
                    "url": "/js/languages/datatables/es.json"
                },
                "order": [[ 4, "desc" ]],
                "ajax": function(data, callback, settings) {
                    $.get('/api/details', {
                        limit: data.length,
                        offset: data.start,
                        search: data.search,
                        page: data.start/10 + 1
                    }, function(res) {
                        arrayResults = [];
                        res.data.forEach(element => {
                          arrayResults[element.id] = element;
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
                      return data.voter.name
                    }},                
                    {'data':   function (data) {
                      return data.voter.document_number; 
                    }},
                    {'data':   function (data) {
                      return data.nominee.name;
                    }},
                    {'data':   function (data) {
                      return data.nominee.code;
                    }},
                    {'data':   function (data) {
                      return data.created_at;
                    }},
                ],
            });
        });
    </script>
@stop