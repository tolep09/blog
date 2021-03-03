@extends('dashboard.master')

@section('content')
    
        
    <div class="form-group">
        <label for="title">Título</label>
        <input type="text" readonly class="form-control" id="title" name="title" value="{{ $category->title }}">        
    </div>

    <div class="form-group">
        <label for="url_clean">Url limpia</label>
        <input type="text" readonly class="form-control" id="url_clean" name="url_clean" 
            value="{{ $category->url_clean }}">
    </div>
        
@endsection