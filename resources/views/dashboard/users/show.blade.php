@extends('dashboard.master')

@section('content')
    
        
    <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" readonly class="form-control" id="name" name="name" value="{{ $user->name }}">        
    </div>

    <div class="form-group">
        <label for="email">email</label>
        <input type="text" readonly class="form-control" id="email" name="email" value="{{ $user->email }}">        
    </div>

    <div class="form-group">
        <label for="rol">Rol</label>
        <input type="text" readonly class="form-control" id="rol" name="rol" 
            value="{{ $user->rol->key }}">
    </div>
        
@endsection