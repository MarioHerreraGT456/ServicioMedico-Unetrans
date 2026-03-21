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
      @if (session('success'))
    <div class="auth-alert" style="background-color: #d4edda; color: #155724; border-color: #c3e6cb;">
        {{ session('success') }}
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


          
        </div>
      </form>
      <form method="POST" id="formCambiarClave">
    @csrf
    {{-- <input type="hidden" name="cedula" id="cedula_oculta" value=""> --}}
    
    <div class="auth-inline-links">
        <button type="submit" class="password-recovery">¿Olvidaste tu contraseña?</button>
    </div>
</form>
          <div class="auth-switch">
            <p>¿No tienes cuenta?</p>
            <a href="{{ route('register') }}">Registrarse</a>
          </div>
    </section>
  </div>
</div>
<script>
    window.perfilUpdateClaveUrl = "{{ route('login.recoveryClave') }}";
    window.csrfToken = "{{ csrf_token() }}";
  </script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  <script>
    (function() {
        const formRecuperar = document.getElementById('formCambiarClave');
        if (!formRecuperar) return;

        // Guardamos la URL base original (la que definió el backend)
        const originalUrl = window.perfilUpdateClaveUrl;

        formRecuperar.addEventListener('submit', function(e) {
            const inputCedula = document.getElementById('cedula');
            const cedula = inputCedula ? inputCedula.value.trim() : '';
            if (cedula) {
                // Añadimos la cédula como parámetro GET
                window.perfilUpdateClaveUrl = originalUrl + '?cedula=' + encodeURIComponent(cedula);
            }
            // No cancelamos el evento; el JS de correo.js lo hará después
        });
    })();
</script>


<script src="{{ asset('js/correo.js') }}"></script>
@endsection