@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>RESULTADOS DE DELEGADOS GANADORES</h1>
@stop

@section('nav-dashboard-menu')
    active menu-open
@stop

@section('nav-dashboard')
    active
@stop

@section('nav-overview')
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
                            <th>DELEGADOS GANADORES</th>
                            <th>CÓDIGO</th>
                            <th>CANTIDAD DE VOTOS</th>
                        </thead>
                        <tbody>
                            @foreach ($results as $result)
                                <tr>
                                    <td>{{ $result->nominee->name }}</td>
                                    <td>{{ $result->nominee->code }}</td>
                                    <td>{{ $result->suma }}</td>
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
                "info": false,
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
                "order": [[ 2, "desc" ]],
            });
        });
    </script>
@stop
@stop