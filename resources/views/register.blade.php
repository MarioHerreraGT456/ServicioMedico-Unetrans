@extends('layouts.app')

@section('content')
<div class="auth-shell">
  <div class="auth-card">

    {{-- Panel izquierdo (azul) --}}
    <aside class="auth-side">
      <h2>Servicio Médico</h2>
      <p>Registro de pacientes para atención y control de historial clínico.</p>
    </aside>

    {{-- Formulario --}}
    <main class="auth-main">
      <button type="button" id="btnCerrarRegistro" class="btn-cerrar-overlay" aria-label="Cerrar">
        ✕
      </button>

      <h2 class="auth-title">Registro</h2>

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form id="formRegistroPaciente" method="POST" action="{{ route('register') }}" class="auth-form">
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
            title="Formato válido: V12345678, E12345678"
            placeholder="V12345678"
            required
          >
        </div>

        <div class="campo">
          <label for="direccion">Dirección:</label>
          <input type="text" id="direccion" name="direccion" required>
        </div>

        <div class="campo">
          <label for="telefono">Teléfono:</label>
          <input
            type="tel"
            id="telefono"
            name="telefono"
            placeholder="04141234567 o +584141234567"
            pattern="^(\+58|0)(414|424|412|422|416|426)[0-9]{7}$"
            title="Formato válido: +584121234567 o 014121234567"
            required
          >
        </div>

        <div class="campo">
          <label for="correo">Correo:</label>
          <input type="email" id="correo" name="correo" required>
        </div>

        <div class="campo">
          <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
          <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
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
          <label for="tipo">Tipo de Paciente:</label>
          <select id="tipo" name="tipo" class="select-placeholder" required>
            <option value="estudiante">Estudiante</option>
            <option value="personal">Personal</option>
          </select>
        </div>

        {{-- Tal como en tu documento: los bloques de carrera/personal están comentados.
            NO los descomento aquí para no cambiar tu lógica.
        --}}

        <div class="campo">
          <label for="password">Contraseña:</label>
          <input type="password" id="password" name="password" required>
        </div>

        <div class="campo">
          <label for="password_confirmation">Confirme contraseña:</label>
          <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>

        <div class="campo">
          <label for="rol" class="hidden">Rol:</label>
          <input type="hidden" name="rol" value="paciente">
        </div>

        <button type="submit" id="btnRegistroContinuar">Registrar</button>

        <div class="auth-switch">
          <p>¿Ya tienes cuenta?</p>
          <a href="{{ route('login') }}">Iniciar sesión</a>
        </div>

      </form>
    </main>

  </div>
</div>
@endsection