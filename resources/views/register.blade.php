
  <button type="button" id="btnCerrarRegistro" class="btn-cerrar-overlay">
      ✕
  </button>

    <h2>Registro</h2>

    <form id="formRegistroPaciente" method="POST" action="{{ route('register') }}">
      @csrf
      
      <div class="campo">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
      </div>

      <div class="campo">
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required>
      </div>
      
      <div class="campo">
        <label for="cedula">Cédula:</label>
        <input 
          type="text" 
          id="cedula"
          name="cedula"
          pattern="[VvEeJjPp]{1}[0-9]{5,9}"
          title="Formato válido: V12345678, E12345678"
          placeholder="V12345678"
          required>
      </div>


      <div class="campo">
        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" required>
      </div>

      <div class="campo">
        <label for="telefono">Teléfono:</label>
        <input type="tel"
          id="telefono"
          name="telefono"
          placeholder="04141234567 o +584141234567"
        pattern="^(\+58|0)(414|424|412|422|416|426)[0-9]{7}$"
        title="Formato válido: +584121234567 o 014121234567"
        required>
      </div>  

      <div class="campo">
        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo" required>
      </div>

      <div class="campo">
        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
        <input 
          type="date" 
          id="fecha_nacimiento" 
          name="fecha_nacimiento" 
          required
        >
      </div>

      <!--SEXO-->
      <div class="campo">
      <label for="selectSexo">Sexo:</label>
      <select id="selectSexo" name="sexo" class="select-placeholder" required>
        <option value="Masculino">Masculino</option>
        <option value="Femenino">Femenino</option>
      </select>
      </div>
      
      <!--ESTADO CIVIL-->
      <div class="campo">
      <label for="selectEstadoCivil">Estado Civil:</label>
      <select id="selectEstadoCivil" name="estado_civil" class="select-placeholder" required>
        <option value="Soltero(a)">Soltero(a)</option>
        <option value="Casado(a)">Casado(a)</option>
        <option value="Divorciado(a)">Divorciado(a)</option>
        <option value="Viudo(a)">Viudo(a)</option>
      </select>
      </div>

      <!-- TIPO DE PACIENTE -->
      <div class="campo">
        <label for="tipoPaciente">Tipo de Paciente:</label>
        <select id="tipoPaciente" name="tipo_paciente" class="select-placeholder" required>
          <option value="estudiante">Estudiante</option>
          <option value="personal">Personal</option>
        </select>
      </div>

      <!-- CARRERAS (solo si es estudiante) -->
      <div class="campo">
        <label for="selectCarrera" class="hidden">PNF:</label>
        <select id="selectCarrera" name="carrera" class="select-placeholder hidden" required>
          <option value="informatica">PNF en Informática</option>
          <option value="electronica">PNF en Electrónica</option>
          <option value="quimica">PNF en Química</option>
          <option value="procesos_quimicos">PNF en Procesos Químicos</option>
          <option value="mecanica">PNF en Mecánica Automotriz</option>
          <option value="mecanica_industrial">PNF en Mecánica Industrial</option>
          <option value="materiales">PNF en Materiales</option>
          <option value="materiales">PNF en Calidad de Ambiente</option>
        </select>
      </div>
      <!-- TIPO DE PERSONAL -->
      <div class="campo">
        <label for="selectPersonal" class="hidden">Tipo de Personal:</label>
        <select id="selectPersonal" name="tipo_personal" class="select-placeholder hidden">
          <option value="Administrativo">Docente</option>
          <option value="Docente">Administrativo</option>
          <option value="Obrero">Obrero</option>
        </select>
      </div>

      <div class="campo">
        <label for="clave">Contraseña:</label>
        <input type="password" id="clave" name="clave" required>
      </div>  

      <div class="campo">
        <label for="clave">Confirme contraseña:</label>
        <input type="password" id="claveConfirm" name="claveConfirm" required>
      </div>

      <div id="registroPacienteMsg" class="form-msg oai-hidden"></div>

      <button type="submit" id="btnRegistroContinuar">Registrar</button>

    </form>
    <script src="js/app.js" defer></script>
