<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/correos.css" rel="stylesheet"/>
    <title>Recuperar Contraseña</title>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-card">
            <div class="email-header">
                <h1>Hola</h1>
            </div>
            <div class="email-body">
                <p>Usted ha solicitado recuperar su contraseña de acceso al sistema del servicio médico de la UNETRANS.</p>
                <p>Para confirmar, haz clic en el siguiente enlace:</p>
                <h1>{{ $codigo }}</h1>
                <p>Si no solicitaste esta cita, ignora este mensaje.</p>
            </div>
        </div>
    </div>
</body>
</html>