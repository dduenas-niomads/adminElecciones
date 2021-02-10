@extends('layouts.vote-datatable')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Crear voto - {{ $voter->code }}</div>
                <div class="card-body">
                    <table class="table" id="example1">
                        <thead>
                            <th>NOMBRE</th>
                            <th>CÓDIGO</th>
                            <th>SELECCIONAR</th>
                        </thead>
                        <tbody>
                            @foreach ($nominees as $nominee)
                                <tr>
                                    <td>{{ $nominee->name }}</td>
                                    <td>{{ $nominee->code }}</td>
                                    <td><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">SELECCIONAR</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                          <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog">
                            
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Modal Header</h4>
                                </div>
                                <div class="modal-body">
                                <p>Some text in the modal.</p>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                            
                            </div>
                        </div>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

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