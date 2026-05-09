<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KveldVind - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/css/layouts/main/navbar.css'])
    @stack('styles')
</head>
<body>
    <div class="navbar">
        <div class="navbar-left">
            <img src="" alt="Placeholder" class="logo">
            <a href="{{ route('home') }}" class="location">Home</a>
        </div>

        <div class="navbar-right">
            @if(auth()->check())
                <a href="{{ route('dashboard') }}" class="location-button">Dashboard</a>
                <a href="{{ route('workout.exercises.blocks.index') }}" class="location-button">My exercise blocks</a>
                <a href="{{ route('workout.exercises.index') }}" class="location-button">My exercises</a>
            @else
                <a href="{{ route('login') }}" class="location-button">Login</a>
                <a href="{{ route('register') }}" class="location-button">Register</a>
            @endif
        </div>
    </div>


    @yield('content')

    @stack('scripts')
</body>
</html>
