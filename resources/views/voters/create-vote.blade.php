@extends('layouts.vote-datatable')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10" style="margin: 20px 0 20px 0px;">
            <div class="card">
                <div class="card-header"><b>VOTANTE: {{ $voter->name }} - CI/DNI {{ $voter->document_number }}</b></div>
                <div class="card-body">
                    <table class="table" id="example1">
                        <thead>
                            <th>NOMBRES Y APELLIDOS</th>
                            <th>CÓDIGO</th>
                            <th>ACCIÓN</th>
                        </thead>
                        <tbody>
                            @foreach ($nominees as $nominee)
                                <tr>
                                    <td>{{ $nominee->name }}</td>
                                    <td>{{ $nominee->code }}</td>
                                    @if ($nominee->flag_active)
                                        <td><button type="button" class="btn btn-info btn-lg" data-toggle="modal" onClick="openModal( {{ json_encode($nominee) }} );">VOTAR</button></td>
                                    @else
                                        <td>{{ $nominee->description }}</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                          <div class="modal fade" id="modal-info" role="dialog">
                            <div class="modal-dialog">
                            
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="nomineeName">CANDIDATO</h4>
                                    </div>
                                    <div class="modal-body" id="nomineeDetail">
                                        <p>Detalle de candidato</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form method="POST" action="{{ route('voter-submit-vote') }}">
                                            @csrf
                                            <button type="button" class="btn btn-default" data-dismiss="modal">REGRESAR</button>
                                            <input type="hidden" name="nomineeId" id="nomineeId" value="0">
                                            <input type="hidden" name="voterCode" id="voterCode" value="{{ $voter->code }}">
                                            <button type="submit" class="btn btn-success">VOTAR POR ESTE CANDIDATO</button>
                                        </form>
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
        var nominee = null;
        $(document).ready(function (e) {
        
            submitVote = function()  {
                var voterCode = document.getElementById("voterCode");
                if (voterCode != null) {
                    voterCode = voterCode.value;
                } else {
                    voterCode = 0;
                }
                window.location.replace("/voter-submit-vote?code=" + voterCode + "&nomineeId=" + nominee.id );
            }

            openModal = function(params) {
                nominee = params;
                console.log(nominee);
                var nomineeName = document.getElementById("nomineeName");
                if (nomineeName != null) {
                    nomineeName.innerHTML = "ELEGIR AL CANDIDATO: ";
                }
                var nomineeDetail = document.getElementById("nomineeDetail");
                if (nomineeDetail != null) {
                    nomineeDetail.innerHTML = '<p><b>Apellidos y Nombres: </b>' + nominee.name + '</p>' +
                    '<p><b>Código: </b>' + nominee.code + '</p>';
                }
                var nomineeId = document.getElementById("nomineeId");
                if (nomineeId != null) {
                    nomineeId.value = nominee.id;
                }
                $('#modal-info').modal({ backdrop: 'static', keyboard: false });
            }
            
            $("#example1").DataTable({
                "info": true,
                "scrollX": false,            
                "initComplete": function (settings, json) {  
                    $("#example1").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
                },
                "ordering": false,
                "searching": true,
                "processing": true,
                "serverSide": false,
                "lengthChange": false,
                "bPaginate": true,
                "responsive": false,
                "pageLength": 22,
                "language": {
                    "url": "/js/languages/datatables/es_vote.json"
                },
                "order": [[ 1, "asc" ]],
            });
        });
    </script>
@stop