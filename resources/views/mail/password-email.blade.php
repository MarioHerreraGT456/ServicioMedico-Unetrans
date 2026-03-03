<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agregar Contraseña</title>
</head>
<body>
    <h1>Hola {{ $data['nombre'] }} </h1>
    <span>{{ $data['apellido'] }}</span>
    <p>Te has registrado en Unetrans.</p>
    <p>Para confirmar, haz clic en el siguiente enlace:</p>
    <a href="{{ $url }}">Completar registro</a>
    <p>Si no solicitaste esta cita, ignora este mensaje.</p>
</body>
</html>