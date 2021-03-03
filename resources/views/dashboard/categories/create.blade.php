@extends('dashboard.master')

@section('content')
    <form action="{{ route('categories.store') }}" method="POST">
        @include('dashboard.categories._form')    
    </form>

@endsection