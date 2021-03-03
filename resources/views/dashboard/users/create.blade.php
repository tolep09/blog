@extends('dashboard.master')

@section('content')
    <form action="{{ route('users.store') }}" method="POST">
        @include('dashboard.users._form', ['pass' => true])    
    </form>

@endsection