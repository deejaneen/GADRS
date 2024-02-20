<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
     
    {{-- Stylesheet for icons--}}
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet"/>

    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    
    {{-- Stylesheet for font from google fonts--}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@700&display=swap" rel="stylesheet">

</head>
<body>

    <header>
        {{-- Navbar--}}
        @include('layout.nav')          
    </header>

    {{-- Stylesheet for font from google fonts--}}
    <script type="text/javascript" src="{{ asset('js/app.js')}}"></script>
</body>
</html>