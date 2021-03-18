@extends('dashboard.master')

@section('content')

    <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title">
                Editar Post {{ $post->id}}
            </h4>
        </div>
        <div class="card-body">
            <form action="{{ route('posts.update', $post->id) }}" method="POST">
                @method('PUT')
                @include('dashboard.posts._form')
            </form> 
        </div>
    </div> 

    <hr>

    <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title">
                Subir Imagen para el Post
            </h4>
        </div>
        <div class="card-body">

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
        </div>
    </div>

    <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title">
                Imagenes actuales
            </h4>
        </div>
        <div class="card-body">
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
        </div>
    </div>

@endsection