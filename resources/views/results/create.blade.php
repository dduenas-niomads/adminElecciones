@extends('base')
@extends('layouts.app')
@section('main')
<div class="row">
 <div class="col-sm-8 offset-sm-2">
    <h1 class="display-3">Añadir voto</h1>
  <div>
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('results.store') }}">
          @csrf
          <div class="form-group">   
            <label for="elections_id">Elegir elección:</label> 
            <select name="elections_id" class="form-control">
                @foreach($elections as $election)
                <option name="elections_id" value="{{ $election->id }}">{{ $election->name }}</option>
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
          <div class="form-group">   
            <label for="nominees_id">Nominado:</label> 
            <select name="nominees_id" class="form-control">
                @foreach($nominees as $nominee)
                <option name="nominees_id" value="{{ $nominee->id }}">{{ $nominee->name }}</option>
                @endforeach
            </select>
          </div>            
          <button type="submit" class="btn btn-primary">Crear voto</button>
          <a href="/elections" class="btn btn-default active">Atrás</a>
      </form>
  </div>
</div>
</div>
@endsection