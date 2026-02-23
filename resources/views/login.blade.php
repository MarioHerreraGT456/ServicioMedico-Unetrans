@extends('layouts.app')

@section('content')
  
  
  
  
  <button type="button" id="btnCerrarLogin" class="btn-cerrar-overlay">
    ✕
  </button>

    <h2>Inicia Sesión</h2>

    <form id="loginForm" method="POST" action="{{ route('login') }}">
      @csrf
      <label for="cedula">Cédula:</label>
      <input id="cedula" name="cedula" type="text" placeholder="V12345678" required>

      <label for="password">Contraseña:</label>
      <input id="password" name="password" type="password" required>

      <button type="submit">Iniciar sesión</button>
    </form>

    <!-- ESTE TEXTO SE MUESTRA SOLO SI HAY ERROR -->
    <div id="loginError" class="error-text oai-hidden">
      Cédula o contraseña incorrecta
    </div>

    <div class="auth-links">
      <a href="{{ route('register') }}" id="goRegistro">Registrarme</a>
      <a href="{{ route('passwordRequest') }}" id="goRecuperar">¿Olvidaste tu contraseña?</a>
    </div>
     
@endsection