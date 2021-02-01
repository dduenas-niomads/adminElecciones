@extends('base')
@extends('layouts.app')
@section('main')
<div class="row">
 <div class="col-sm-8 offset-sm-2">
    <h1 class="display-3">Crear Nominado</h1>
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
      <form method="post" action="{{ route('nominees.store') }}">
          @csrf
          <div class="form-group">    
              <label for="name">Nombre:</label>
              <input type="text" class="form-control" name="name"/>
          </div>     
          <div class="form-group">    
              <label for="code">Código:</label>
              <input type="text" class="form-control" name="code"/>
          </div> 
          <div class="form-group">    
              <label for="description">Descripción:</label>
              <input type="text" class="form-control" name="description"/>
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
          <button type="submit" class="btn btn-primary">Crear Posición</button>
      </form>
  </div>
</div>
</div>
@endsection