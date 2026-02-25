@extends('layouts.app')

@section('content')
  
  


    <h2 class="title-form">Crear Consulta</h2>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form id="formRegistroConsulta" method="POST" action="{{ route('consultas.store') }}" enctype="multipart/form-data">
      @csrf
      
     <div class="campo">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
            @error('nombre')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>


      <div class="campo">
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" value="{{ old('apellido') }}" required>
            @error('apellido')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>
      
       <div class="campo">
            <label for="cedula">Cédula:</label>
            <div id="campoCedula">
                <label for="tipo" class="hidden">Tipo:</label>
                <select name="tipo" id="tipo">
                    <option value="V">V</option>
                    <option value="E">E</option>
                </select>
                <input type="text" id="cedula" name="cedula" value="{{ old('cedula') }}"
                       title="Formato válido: V12345678, E12345678" placeholder="12345678" required>
            </div>
            @error('cedula')
                <span class="error-message">Dato inválido</span>
            @enderror
           
        </div>


       <div class="campo">
            <label for="nombre_doctor">Nombre del Doctor:</label>
            <input type="text" id="nombre_doctor" name="nombre_doctor" value="{{ old('nombre_doctor') }}" required>
            @error('nombre_doctor')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>

        <div class="campo">
            <label for="TA">Tensión Arterial:</label>
            <input type="text" id="TA" name="TA" value="{{ old('TA') }}" required>
            @error('TA')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>

        <div class="campo">
            <label for="motivo">Motivo de Consulta:</label>
            <input type="text" id="motivo" name="motivo" value="{{ old('motivo') }}" required>
            @error('motivo')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>

        <div class="campo">
            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required>
            @error('fecha_nacimiento')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>

        <div class="campo">
            <label for="fecha_consulta">Fecha de Consulta:</label>
            <input type="date" id="fecha_consulta" name="fecha_consulta" value="{{ old('fecha_consulta') }}" required>
            @error('fecha_consulta')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>

      <!--SEXO-->
       <div class="campo">
            <label for="selectSexo">Sexo:</label>
            <select id="selectSexo" name="sexo" required>
                <option value="Masculino" {{ old('sexo') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                <option value="Femenino" {{ old('sexo') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
            </select>
            @error('sexo')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>

        <div class="campo">
            <label for="especialidad">Especialidad:</label>
            <select id="especialidad" name="especialidad" required>
                <option value="medicina geneal" {{ old('especialidad') == 'medicina geneal' ? 'selected' : '' }}>Medicina General</option>
                <option value="odontologia" {{ old('especialidad') == 'odontologia' ? 'selected' : '' }}>Odontología</option>
                <option value="psiquiatria" {{ old('especialidad') == 'psiquiatria' ? 'selected' : '' }}>Psiquiatría</option>    
            </select>
            @error('especialidad')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>

      <!-- CARRERAS (solo si es estudiante) -->
    <!--
      {{-- <div class="campo">
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
      </div> --}} -->

        <div class="campo">
            <label for="tratamiento">Tratamiento:</label>
            <textarea id="tratamiento" name="tratamiento" required>{{ old('tratamiento') }}</textarea>
            @error('tratamiento')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>

        
      {{-- <div id="registroPacienteMsg" class="form-msg oai-hidden"></div> --}}
      <div class="campo">
        <button type="submit" id="btnRegistroContinuar">Registrar</button>

      </div>


    </form>
    <script src="js/app.js" defer></script>
    @endsection
