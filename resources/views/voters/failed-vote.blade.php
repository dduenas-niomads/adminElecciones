@extends('layouts.vote')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="GET" action="{{ route('voter-login') }}">
                        @csrf

                        <div class="form-group row">
                            <h1>Estimado/a {{ !is_null($voter) ? $voter->name : "" }}, no se pudo crear su voto.</h1>
                            <h1> Por favor, intente nuevamente...</h1>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    Regresar al sistema
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