  <button type="button" id="btnCerrarLogin" class="btn-cerrar-overlay">
    ✕
  </button>

    <h2>Inicia Sesión</h2>

    <form id="loginForm" method="POST" action="{{ route('login') }}">
      @csrf
      <label for="loginCedula">Cédula:</label>
      <input id="loginCedula" name="cedula" type="text" placeholder="V12345678" required>

      <label for="loginClave">Contraseña:</label>
      <input id="loginClave" name="clave" type="password" required>

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
     <script src="js/app.js" defer></script>
