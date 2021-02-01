@extends('base') 
@extends('layouts.app')
@section('main')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Actualizar votante</h1>
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
        <form method="post" action="{{ route('voters.update', $voter->id) }}">
            @method('PATCH') 
            @csrf
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" class="form-control" name="name" value="{{ $voter->name }}" />
            </div>         
            <div class="form-group">
                <label for="code">Código:</label>
                <input type="text" class="form-control" name="code" value="{{ $voter->code }}" />
            </div>    
            <div class="form-group">
                <label for="areas_id">Área:</label>
                <select name="areas_id" class="form-control">
                    @foreach($areas as $area)
                    <option name="areas_id" value="{{ $area->id }}" {{ $area->id == $voter->areas_id ? 'selected' : '' }}>{{ $area->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="/voters" class="btn btn-default active">Atrás</a>
        </form>
    </div>
</div>
@endsection