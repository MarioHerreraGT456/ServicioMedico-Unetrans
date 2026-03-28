@extends('layouts.app')

@section('content')
 @if ($errors->any())
        <div class="auth-alert">
          <ul style="margin:0; padding-left:18px;">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="auth-page">
  <div class="auth-card">
    <aside class="auth-side">
      <h2>Recuperación</h2>
      <p>Solicita un código para recuperar tu contraseña.</p>
    </aside>

    <section class="auth-main">
      <h1 class="auth-title">Recuperar contraseña</h1>
    

      <div class="auth-success oai-hidden" id="msgRecuperarOk"></div>
      <div class="auth-alert oai-hidden" id="msgRecuperarErr"></div>

      <form id="formRecuperarEmail" class="auth-form" method="POST" action="{{ route('passwordRequest.store') }}">
        @csrf

        <div class="auth-field">
          <!--<label for="recEmail">Correo electrónico</label>-->
          <input type="hidden" id="correo" name="correo" value="{{ $correo }}" required>
          <input type="hidden" id="cedula" name="cedula" value="{{ $cedula }}" required>
        </div>

        <div class="campo ">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            @error('password')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>

        <div class="campo ">
            <label for="password_confirmation">Confirme contraseña:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
            @error('password_confirmation')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>
        <div class="campo">
        <button type="submit" id="btnRegistroContinuar">Confirmar</button>

      </div>
      </form>
    </section>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <script src="{{ asset('js/password-recovery.js') }}"></script> --}}
  </div>
</div>
@endsection
