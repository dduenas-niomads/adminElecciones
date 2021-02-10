@extends('layouts.vote')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Inicio de sesión de votante</div>

                @if (isset($error) && $error)
                    <div class="modal" tabindex="-1" role="dialog" id="modal-info">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content" >
                            <div class="modal-body ">
                                <p>{{ isset($message) ? $message : "Mensaje importante" }}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Volver a intentar</button>
                            </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="card-body">
                    <form method="GET" action="{{ route('voter-login') }}">
                        @csrf

                        <div class="form-group row">
                            <h1 for="code" class="col-md-12 col-form-label text-md-right">Estimado/a {{ !is_null($voter) ? $voter->name : "" }}, muchas gracias por tu participación en el sistema de elecciones.</h1>
                            <h1> Pronto recibirás novedades sobre tu voto.</h1>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    Salir del sistema
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection