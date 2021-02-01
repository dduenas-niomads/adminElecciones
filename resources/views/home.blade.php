@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Bienvenido al Sistema de Elecciones!</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a target="_self" href="#">
                        <img src="img/logo.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
