<!DOCTYPE html>
<html>

<head>
    <title>My Application</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: sans-serif;
            padding: 20px;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/auth.js'])
</head>

<body>
    {{-- <nav>
        <a href="/dashboard">Home</a>
    </nav> --}}

    <hr>

    <div class="container">
        @yield('content')
    </div>

    
</body>

</html>
