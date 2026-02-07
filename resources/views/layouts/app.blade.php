<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <title>Inicio Paciente</title>

  <link href="css/style.css" rel="stylesheet"/>
  <link href="css/overlays.css" rel="stylesheet"/>

  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
        rel="stylesheet">
</head>
<body>
    
<x-header />

    <main>
        @yield('content')
    </main>

    <x-footer />
</body>
</html>