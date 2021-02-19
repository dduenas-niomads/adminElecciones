@extends('layouts.vote')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="GET" action="{{ route('voter-login') }}">
                    <div class="img-container" style="text-align: center;">
                        <img src="/img/voto.jpg" alt="voto" width="120" height="120">
                    </div>
                    <h1 style="text-align: center;">Voto Registrado!</h1><br>
                        <div class="form-group row">
                            <h3>Estimad@ soci@ {{ !is_null($voter) ? $voter->name : "" }}, muchas gracias por participar del proceso de elección de delegados 2021.</h2><br>
                            <span> * En breve recibirá un email con la confirmación de su voto.</span>
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