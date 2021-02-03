@extends('base') 
@extends('layouts.app')
@section('main')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Detalles de votación</h1>
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
        @if(session()->get('success'))
            <div class="alert alert-success">
            {{ session()->get('success') }}  
            </div>
        @endif
        <div class="row">
                <div class="col-sm-12">
                <div class="form-group">
                    <label for="name">Nombre de votación:</label>
                    <input type="text" class="form-control" name="name" value="{{ $election->name }}" disabled />
                </div> <br>
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <td>ID</td>
                        <td>Nominado</td>
                        <td>Área</td>
                        <td>Posición</td>
                        <td colspan = 1>Acciones</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($details as $detail)
                        <tr>
                            <td>{{$detail->id}}</td>
                            <td>{{$detail->nominee->name}}</td>
                            <td>{{$detail->area->name}}</td>
                            <td>{{$detail->position->name}}</td>
                            <td>
                                <form action="{{ route('elections.destroy', $detail->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        <form method="post" action="{{ route('elections.update', $election->id) }}">
            @method('PATCH') 
            @csrf
            <h3>Agregar nominado a la Elección</h3>
            <div class="form-group">   
            <label for="nominees_id">Nominado:</label> 
            <select name="nominees_id" class="form-control">
                @foreach($nominees as $nominee)
                <option name="nominees_id" value="{{ $nominee->id }}">{{ $nominee->name }}</option>
                @endforeach
            </select>
            </div>
            <div class="form-group">   
                <label for="areas_id">Área:</label> 
                <select name="areas_id" class="form-control">
                    @foreach($areas as $area)
                    <option name="areas_id" value="{{ $area->id }}">{{ $area->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">   
                <label for="positions_id">Posición:</label> 
                <select name="positions_id" class="form-control">
                    @foreach($positions as $position)
                    <option name="positions_id" value="{{ $position->id }}">{{ $position->name }}</option>
                    @endforeach
                </select>
            </div>   
            <button type="submit" class="btn btn-primary">Añadir nominado</button>
            <a href="/elections" class="btn btn-default active">Atrás</a>
        </form>
    </div>
</div>
@endsection