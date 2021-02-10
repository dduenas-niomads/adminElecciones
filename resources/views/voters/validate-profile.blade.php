@extends('layouts.vote')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Validar perfil de votante - CI/DNI: {{ $voter->document_number }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('voter-validate-info') }}">
                        @csrf
                            <input type="hidden" name="id" value="{{ $voter->id }}">
                            <input type="hidden" name="code" value="{{ $voter->code }}">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">NOMBRES Y APELLIDOS: </label>
                                <div class="col-md-8">
                                    <input id="name" maxlength="100" type="text" class="form-control" name="name" value="{{ $voter->name }}" required>
                                </div>
                            </div>
                            <!-- <div class="form-group row">
                                <label for="lastname" class="col-md-4 col-form-label text-md-right">APELLIDOS: </label>
                                <div class="col-md-8">
                                    <input id="lastname" maxlength="100" type="text" class="form-control" name="lastname" value="{{ $voter->lastname }}" required>
                                </div>
                            </div> -->
                            <div class="form-group row">
                                <label for="document_number" class="col-md-4 col-form-label text-md-right">CI/DNI: </label>
                                <div class="col-md-8">
                                    <input id="document_number" maxlength="15" type="text" class="form-control" name="document_number" value="{{ $voter->document_number }}" required>
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

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    Validar datos
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
