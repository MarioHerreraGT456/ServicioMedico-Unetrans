@extends('layouts.app')

@section('content')
<div class="auth-page">
  <div class="auth-card">
    <aside class="auth-side">
      <h2>Recuperación</h2>
      <p>Solicita un código para recuperar tu contraseña.</p>
    </aside>

    <section class="auth-main">
      <h1 class="auth-title">Recuperar contraseña</h1>
      <p class="auth-sub">Puedes reenviar el correo después de <span class="countdown" id="reenvioCountdown">120</span>s.</p>

      <div class="auth-success oai-hidden" id="msgRecuperarOk"></div>
      <div class="auth-alert oai-hidden" id="msgRecuperarErr"></div>

      <form id="formRecuperarEmail" class="auth-form" method="POST" action="{{ route('passwordRequest.recoveryClave') }}">
        @csrf

        <div class="auth-field">
          <label for="recEmail">Correo electrónico</label>
          <input type="email" id="recEmail" name="email" required>
        </div>

        <div class="auth-actions">
          <button type="submit" class="auth-btn">Enviar código</button>

          <button type="button" class="auth-btn" id="btnReenviar" disabled style="background:#0f172a;">
            Reenviar correo (<span id="reenvioCountdownBtn">120</span>s)
          </button>

          <div class="auth-switch">
            <p>¿Recordaste tu contraseña?</p>
            <a href="{{ route('login') }}">Volver a iniciar sesión</a>
          </div>
        </div>
      </form>
    </section>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/password-recovery.js') }}"></script>
  </div>
</div>
@endsection
