@extends('base') 
@extends('layouts.app')
@section('main')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Actualizar Nominado</h1>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <br /> 
        @endif
        <form method="post" action="{{ route('nominees.update', $nominee->id) }}">
            @method('PATCH') 
            @csrf
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" class="form-control" name="name" value="{{ $nominee->name }}" />
            </div>         
            <div class="form-group">
                <label for="code">Código:</label>
                <input type="text" class="form-control" name="code" value="{{ $nominee->code }}" />
            </div>   
            <div class="form-group">
                <label for="description">Descripción:</label>
                <input type="text" class="form-control" name="description" value="{{ $nominee->description }}" />
            </div> 
            <div class="form-group">
                <label for="areas_id">Área:</label>
                <select name="areas_id" class="form-control">
                    @foreach($areas as $area)
                    <option name="areas_id" value="{{ $area->id }}" {{ $area->id == $nominee->areas_id ? 'selected' : '' }}>{{ $area->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="positions_id">Posición:</label>
                <select name="positions_id" class="form-control">
                    @foreach($positions as $position)
                    <option name="positions_id" value="{{ $position->id }}" {{ $position->id == $nominee->positions_id ? 'selected' : '' }}>{{ $position->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="/nominees" class="btn btn-default active">Atrás</a>
        </form>
    </div>
</div>
@endsection