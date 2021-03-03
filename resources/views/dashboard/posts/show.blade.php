@extends('dashboard.master')

@section('content')
    
        
    <div class="form-group">
        <label for="title">Título</label>
        <input type="text" readonly class="form-control" id="title" name="title" value="{{ $post->title }}">        
    </div>

    <div class="form-group">
        <label for="url_clean">Url limpia</label>
        <input type="text" readonly class="form-control" id="url_clean" name="url_clean" 
            value="{{ $post->url_clean }}">
    </div>

    <div class="form-group">
        <label for="content">Contenido</label>
        <textarea class="form-control" readonly id="content" name="content" rows="3">{{ $post->content }}
        </textarea>
    </div>
        
@endsection