@extends('dashboard.master')

@section('content')
    
        
    <div class="form-group">
        <label for="title">Título</label>
        <input type="text" readonly class="form-control" id="name" name="name" value="{{ $postComment->title }}">        
    </div>

    <div class="form-group">
        <label for="url_clean">Usuarop</label>
        <input type="text" readonly class="form-control" id="lastname" name="lastname" 
            value="{{ $postComment->user->name }}">
    </div>

    <div class="form-group">
        <label for="url_clean">Aprovado</label>
        <input type="text" readonly class="form-control" id="email" name="email" 
            value="{{ $postComment->approved }}">
    </div>

    <div class="form-group">
        <label for="content">Contenido</label>
        <textarea class="form-control"  rows="3">{{ $postComment->comments }}
        </textarea>
    </div>
        
@endsection