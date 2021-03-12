@extends('dashboard.master')

@section('content')
    
        
    <div class="form-group">
        <label for="title">Nombre</label>
        <input type="text" readonly class="form-control" id="name" name="name" value="{{ $contact->name }}">        
    </div>

    <div class="form-group">
        <label for="url_clean">Apellido</label>
        <input type="text" readonly class="form-control" id="lastname" name="lastname" 
            value="{{ $contact->last_name }}">
    </div>

    <div class="form-group">
        <label for="url_clean">email</label>
        <input type="text" readonly class="form-control" id="email" name="email" 
            value="{{ $contact->email }}">
    </div>

    <div class="form-group">
        <label for="content">Contenido</label>
        <textarea class="form-control" readonly rows="3">{{ $contact->comments }}
        </textarea>
    </div>
        
@endsection