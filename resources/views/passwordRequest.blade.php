<div class="oai-frame-drawer auth-box">

  <h2>Recuperar contraseña</h2>

  <!-- PASO 1 -->
  <div id="recuperarPaso1">
    <form id="formRecuperarEmail" method="POST" action="{{ route('passwordRequest') }}">
      @csrf
      <div class="campo">
        <label for="recEmail">Correo electrónico</label>
        <input type="email" id="recEmail" name="email" required>
      </div>

      <div class="form-msg oai-hidden" id="msgRecuperar1"></div>

      <button type="submit" class="btn-principal">
        Enviar código
      </button>
    </form>
  </div>

  <!-- PASO 2 -->
  <div id="recuperarPaso2" class="oai-hidden">
    <form id="formRecuperarCodigo" method="POST" action="{{ route('passwordRequest') }}">
      @csrf

      <div class="campo">
        <label for="recCodigo">Código de verificación</label>
        <input type="text" id="recCodigo" name="codigo" maxlength="6" required>
      </div>

      <div class="campo">
        <label for="recNuevaClave">Nueva contraseña</label>
        <input type="password" id="recNuevaClave" required>
      </div>

      <div class="campo">
        <label for="recConfirmClave">Confirmar contraseña</label>
        <input type="password" id="recConfirmClave" required>
      </div>

      <div class="contador">
        Reenviar código en 
        <span id="contadorTiempo">120</span>s
      </div>

      <button type="button" id="btnReenviar" disabled>
        Reenviar código
      </button>

      <button type="submit" class="btn-principal">
        Restablecer contraseña
      </button>

    </form>
  </div>

</div>
