@extends('dashboard.master')

@section('content')
    <form action="{{ route('posts.store') }}" method="POST">
        @include('dashboard.posts._form')    
    </form>

@endsection