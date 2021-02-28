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
                        <tbody>
                            @foreach ($results as $result)
                                <tr>
                                    <td>{{ $result->voter->name }}</td>
                                    <td>{{ $result->voter->document_number }}</td>
                                    <td>{{ $result->nominee->name }}</td>
                                    <td>{{ $result->nominee->code }}</td>
                                    <td>{{ $result->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
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
            });
        });
    </script>
@stop