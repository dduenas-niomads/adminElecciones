@extends('base') 
@extends('layouts.app')
@section('main')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Actualizar admin</h1>
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
        <form method="post" action="{{ route('admins.update', $admins->id) }}">
            @method('PATCH') 
            @csrf
            <div class="form-group">
                <label for="first_name">Nombre:</label>
                <input type="text" class="form-control" name="first_name" value={{ $admins->name }} />
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control" name="email" value={{ $admins->email }} />
            </div>
            <div class="form-group">
                <label for="role_id">Rol:</label>
                <input type="text" class="form-control" name="role_id" value={{ $admins->role_id }} />
            </div>
            <div class="form-group">
                <label for="status">Estado:</label>
                <input type="text" class="form-control" name="status" value={{ $admins->status }} />
            </div>            
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</div>
@endsection