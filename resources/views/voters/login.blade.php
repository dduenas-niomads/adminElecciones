@extends('layouts.vote')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <img src="/img/voto2021.jpg" alt="EMPHOST">
            </div>
        </div>
        <div class="col-md-6">
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
                <!-- <div class="card-body">
                    <form method="POST" action="{{ route('voter-login-post') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="code" class="col-md-4 col-form-label text-md-right">Ingrese su DNI: </label>

                            <div class="col-md-4">
                                <input id="code" type="text" class="form-control" name="code">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div> -->
                <div class="card-body">
                    <h2>El proceso de elección 2021 acaba de terminar. Cooperativa de ahorro y crédito agradece tu participación.</h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@if (isset($error) && $error)
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function (e) {
        $('#modal-info').modal({ backdrop: 'static', keyboard: false });                  
    });
</script>
@endif