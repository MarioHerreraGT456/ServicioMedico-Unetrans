<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/correos.css" rel="stylesheet"/>
    <title>Agregar Contraseña</title>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-card">
            <div class="email-header">
                <h1>Hola {{ $data['nombre'] }} </h1>
                <span>{{ $data['apellido'] }}</span>
            </div>
            <div class="email-body">
                <p>Te has registrado en Unetrans.</p>
                <p>Para confirmar, haz clic en el siguiente enlace:</p>
                <a href="{{ $url }}" class="email-button">Completar registro</a>
                <p>Si no solicitaste esta cita, ignora este mensaje.</p>
            </div>
        </div>
    </div>
</body>
</html>