@extends('dashboard.master')

@section('content')
    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @method('PUT')
        @include('dashboard.categories._form')
    </form>    

@endsection