@extends('dashboard.master')

@section('content')
    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @method('PUT')
        @include('dashboard.posts._form')
    </form>  

    <hr>

    <form action="{{ route('posts.image', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mt-3 mb-5">
            <div class="col">
                <input type="file" class="form-control" name="image">
                @error('image')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="col">
                <input type="submit" class="btn btn-success" value="Subir">
            </div>
        </div>
    </form> 

    <div class="row">
    @foreach ($post->images as $image)
        <div class="col-3">
            <img class="w-100 mb-3" src="{{ '/posts-images/'.$image->name }}">
            <form action="{{ route('post.image-delete', $image->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
        </div>
    @endforeach
    </div>

@endsection