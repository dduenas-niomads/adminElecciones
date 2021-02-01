@extends('base') 
@extends('layouts.app')
@section('main')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Actualizar cliente</h1>
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
        <form method="post" action="{{ route('customers.update', $customers->id) }}">
            @method('PATCH') 
            @csrf
            <div class="form-group">
                <label for="first_name">Nombre:</label>
                <input type="text" class="form-control" name="first_name" value={{ $customers->first_name }} />
            </div>
            <div class="form-group">
                <label for="last_name">Apellido:</label>
                <input type="text" class="form-control" name="last_name" value={{ $customers->last_name }} />
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control" name="email" value={{ $customers->email }} />
            </div>
            <div class="form-group">
                <label for="status">Estado:</label>
                <input type="text" class="form-control" name="status" value={{ $customers->status }} />
            </div>            
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</div>
@endsection