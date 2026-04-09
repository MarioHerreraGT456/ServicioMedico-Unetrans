<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Inicio Paciente</title>

    <link href="{{ asset('css/style.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/overlays.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/reportes.css') }}" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
            rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <script src="{{ asset('js/menu-header.js') }}" defer></script>

</head>
<body>
    
<x-header />

    <main>
        @yield('content')
    </main>

<x-footer />
</body>
</html>