<!DOCTYPE html>
<html>

<head>
    <title>{{ $title }}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> --}}
 
    @vite(['resources/css/style.css', 'resources/js/app.js'])
</head>

<body>
    <nav class="navbar">
    <a href="#" class="navbar-brand">
        🔧 GarageMitra
    </a>
    
    <button class="navbar-toggle" onclick="toggleNav()">
        <span></span>
        <span></span>
        <span></span>
    </button>
    
    <ul class="navbar-nav" id="navbarNav">
        <li class="nav-item">
            <a href="{{ route('jobcards.index') }}" class="nav-link active">JobCards</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('vehicles.index') }}" class="nav-link">Vehicles</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('mechanics.index') }}" class="nav-link">Mechanics</a>
        </li>
        <li class="nav-item">
            <a href="#forms" class="nav-link">Forms</a>
        </li>
    </ul>
    
    <div class="navbar-actions">
        <button class="btn btn-ghost btn-icon">🔔</button>
        <button class="btn btn-primary">Dashboard</button>
    </div>
</nav>

<div class="container" style="padding: 2rem 1rem;">
        @yield('content')
    </div>



</body>

</html>
