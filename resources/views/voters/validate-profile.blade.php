@extends('layouts.vote')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if (isset($thanksForVote) && $thanksForVote)
                    <div class="card-header">Por favor, confirma tu información</div>
                @else
                    <div class="card-header">Bienvenido votante - CI/DNI: {{ $voter->document_number }}</div>
                @endif
                <div class="card-body">
                    @if (isset($thanksForVote) && $thanksForVote)
                        <form method="POST" action="{{ route('voter-thanks-for-vote') }}">
                    @else
                        <form method="POST" action="{{ route('voter-validate-info') }}">
                    @endif
                        @csrf
                            <input type="hidden" name="id" value="{{ $voter->id }}">
                            <input type="hidden" name="code" value="{{ $voter->code }}">
                            @if (!isset($firstTime))
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">APELLIDOS Y NOMBRES: </label>
                                    <div class="col-md-8">
                                        <input id="name" maxlength="100" type="text" class="form-control" name="name" value="{{ $voter->name }}" disabled>
                                    </div>
                                </div>
                                <!-- <div class="form-group row">
                                    <label for="lastname" class="col-md-4 col-form-label text-md-right">APELLIDOS: </label>
                                    <div class="col-md-8">
                                        <input id="lastname" maxlength="100" type="text" class="form-control" name="lastname" value="{{ $voter->lastname }}" disabled>
                                    </div>
                                </div> -->
                                <div class="form-group row">
                                    <label for="document_number" class="col-md-4 col-form-label text-md-right">CI/DNI: </label>
                                    <div class="col-md-8">
                                        <input id="document_number" maxlength="15" type="text" class="form-control" name="document_number" value="{{ $voter->document_number }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">CORREO ELECTRÓNICO: </label>
                                    <div class="col-md-8">
                                        <input id="email" maxlength="100" type="text" class="form-control" name="email" value="{{ $voter->email }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="phone" class="col-md-4 col-form-label text-md-right">TELÉFONO: </label>
                                    <div class="col-md-8">
                                        <input id="phone" maxlength="25" type="text" class="form-control" name="phone" value="{{ $voter->phone }}">
                                    </div>
                                </div>
                            @else
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">APELLIDOS Y NOMBRES: </label>
                                    <div class="col-md-8">
                                        <input id="name" maxlength="100" type="text" class="form-control" value="{{ $voter->name }}" disabled>
                                    </div>
                                </div>
                                <!-- <div class="form-group row">
                                    <label for="lastname" class="col-md-4 col-form-label text-md-right">APELLIDOS: </label>
                                    <div class="col-md-8">
                                        <input id="lastname" maxlength="100" type="text" class="form-control" name="lastname" value="{{ $voter->lastname }}" disabled>
                                    </div>
                                </div> -->
                                <div class="form-group row">
                                    <label for="document_number" class="col-md-4 col-form-label text-md-right">CI/DNI: </label>
                                    <div class="col-md-8">
                                        <input id="document_number" maxlength="15" type="text" class="form-control" value="{{ $voter->document_number }}" disabled>
                                    </div>
                                </div>
                            @endif

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    @if (isset($thanksForVote) && $thanksForVote)
                                        Validar mi información
                                    @else
                                        Ir a votar
                                    @endif
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
