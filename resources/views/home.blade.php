@extends('layouts.main')

@section('title', 'Home')

@section('content')
    @auth
        <p>Welcome back, {{ auth()->user()->name }}. Go to <a href="{{ route('dashboard') }}">dashboard</a></p>
    @endauth
    @guest
        <p>Welcome to kveldvind!</p>
    @endguest
@endsection
