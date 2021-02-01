@extends('base')
@extends('layouts.app')
@section('main')
<div class="row">
 <div class="col-sm-8 offset-sm-2">
    <h1 class="display-3">Crear Posición</h1>
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
      <form method="post" action="{{ route('positions.store') }}">
          @csrf
          <div class="form-group">    
              <label for="name">Nombre:</label>
              <input type="text" class="form-control" name="name"/>
          </div>           
          <button type="submit" class="btn btn-primary">Crear posición</button>
      </form>
  </div>
</div>
</div>
@endsection