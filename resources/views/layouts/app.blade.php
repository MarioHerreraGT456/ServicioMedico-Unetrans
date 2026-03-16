<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <title>Inicio Paciente</title>

    <link href="css/style.css" rel="stylesheet"/>
    <link href="css/overlays.css" rel="stylesheet"/>
    <link href="css/auth.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
            rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="js/menu-header.js" defer></script>

</head>
<body>
    
<x-header />

    <main>
        @yield('content')
    </main>

<x-footer />
</body>
</html>