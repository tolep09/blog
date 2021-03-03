@extends('dashboard.master')

@section('content')
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @method('PUT')
        @include('dashboard.users._form', ['pass' => false])
    </form>    

@endsection