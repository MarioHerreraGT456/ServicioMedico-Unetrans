@extends('layouts.app')

@section('content')
{{-- ejemplo de como hacer el formulario solo debes precuparte por poner el nombre bien de la ruta para que guarde y el method siempre debe ser post --}}
<form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
        <label for="cedula">Cédula:</label>
        <input type="text" id="cedula" name="cedula" required>
    </div>

    <br>

    <div>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
    </div>

    <br>

    <button type="submit">Enviar</button>
        </form>
@endsection