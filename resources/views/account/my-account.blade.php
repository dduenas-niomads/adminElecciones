@extends('adminlte::page')

@section('title', env('APP_NAME'))

@section('nav-dashboard-menu')
    menu-open
@stop

@section('nav-dashboard')
    active
@stop

@section('nav-account')
    active
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Mi cuenta</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="/img/logo.png" alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center">{{ $account['name'] }} {{ $account['lastname'] }}</h3>
                            <p class="text-muted text-center">Administrador</p>
                            <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Documento</b> <a class="float-right">{{ $account['document_number'] }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Fecha de creación</b> <a class="float-right">{{ $account['created_at'] }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Última edición</b> <a class="float-right">{{ $account['updated_at'] }}</a>
                            </li>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                            <!-- /.tab-pane -->
                            <div class="active tab-pane" id="settings">
                                {{ Form::open(array('url' => '/my-account', 'method' => 'PUT', 'class'=>'form-horizontal')) }}
                                    {{ csrf_field() }}
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-3 col-form-label">Nombres</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" maxlength="150" name="inputName" id="inputName" placeholder="Ingrese sus nombres" value="{{ $account['name'] }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputLastname" class="col-sm-3 col-form-label">Apellidos</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" maxlength="150" name="inputLastname" id="inputLastname" placeholder="Ingrese sus apellidos" value="{{ $account['lastname'] }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputDocumentNumber" class="col-sm-3 col-form-label">Número de documento</label>
                                        <div class="col-sm-9 row">
                                            <div class="col-sm-4">
                                                <select name="inputTypeDocument" id="inputTypeDocument" class="form-control">
                                                @if ( $account['type_document'] === '01')
                                                    <option selected value="01">CI/DNI</option>
                                                    <option value="04">CARNÉ EXTRANJERÍA</option>
                                                    <option value="07">PASAPORTE</option>
                                                @elseif ( $account['type_document'] === '04')
                                                    <option value="01">CI/DNI</option>
                                                    <option selected value="04">CARNÉ EXTRANJERÍA</option>
                                                    <option value="07">PASAPORTE</option>
                                                @else
                                                    <option value="01">CI/DNI</option>
                                                    <option value="04">CARNÉ EXTRANJERÍA</option>
                                                    <option selected value="07">PASAPORTE</option>
                                                @endif
                                                </select>
                                            </div>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" maxlength="150" name="inputDocumentNumber" id="inputDocumentNumber" placeholder="Ingrese su número de documento" value="{{ $account['document_number'] }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-3 col-form-label">Correo electrónico</label>
                                        <div class="col-sm-9">
                                        <input type="email" class="form-control" maxlength="150" name="inputEmail" id="inputEmail" placeholder="Ingrese su nuevo correo electrónico" value="{{ $account['email'] }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-3 col-form-label">Contraseña</label>
                                        <div class="col-sm-9">
                                        <input type="password" class="form-control" maxlength="50" name="inputPassword" id="inputPassword" placeholder="Ingrese su nueva contraseña">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <button type="submit" class="btn btn-outline-primary btn-block btn-lg">Guardar cambios de mi cuenta</button>
                                    </div>
                                {{ Form::close() }}
                            </div>
                            <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                        </div>
                        <!-- /.nav-tabs-custom -->
                    </div>
                    <!-- /.col -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
