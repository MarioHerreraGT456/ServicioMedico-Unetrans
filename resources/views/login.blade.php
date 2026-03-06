@extends('layouts.app')

@section('content')



  
  <div class="auth-page">
  <div class="auth-card">
    <aside class="auth-side">
      <h2>UNETRANS</h2>
      <p>Accede al sistema para gestionar tu perfil y los servicios del centro médico.</p>
    </aside>

    <section class="auth-main">
      <h1 class="auth-title">Iniciar sesión</h1>
      <p class="auth-sub">Ingresa con tu <b>cédula</b> y contraseña.</p>

      @if ($errors->any())
        <div class="auth-alert">
          <ul style="margin:0; padding-left:18px;">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form id="loginForm" class="auth-form" method="POST" action="{{ route('login') }}">
        @csrf

        <div class="auth-field">
          <label for="cedula">Cédula</label>
          <input type="text" id="cedula" name="cedula" value="{{ old('cedula') }}"
                       title="Formato válido: V12345678, E12345678" placeholder="12345678" required>
                         @error('cedula')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>

        <div class="auth-field" style="margin-top:14px;">
          <label for="password">Contraseña</label>
           <input type="password" id="password" name="password" required>
            @error('password')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>

        <div class="auth-actions">
          <button class="auth-btn" type="submit">Iniciar sesión</button>

          <div class="auth-inline-links">
            <a href="{{ route('passwordRequest') }}">¿Olvidaste tu contraseña?</a>
          </div>

          <div class="auth-switch">
            <p>¿No tienes cuenta?</p>
            <a href="{{ route('register') }}">Registrarse</a>
          </div>
        </div>
      </form>
    </section>
  </div>
</div>
     
@endsection