@extends('layouts.app')

@section('content')


    <h2 class="title-form">Registro Medico</h2>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form id="formRegistroMedico" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
      @csrf
      
     <div class="campo">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
            @error('nombre')
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
            <label for="cargo">Cargo:</label>
            <select id="cargo" name="cargo" required>
                <option value="jefe" {{ old('cargo') == 'jefe' ? 'selected' : '' }}>Jefe</option>
                <option value="asistente" {{ old('cargo') == 'asistente' ? 'selected' : '' }}>Asistente</option>
            </select>
            @error('cargo')
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

     <div class="campo">
            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" value="{{ old('correo') }}" required>
            @error('correo')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>

      <div class="campo">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            @error('password')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>

        <div class="campo">
            <label for="password_confirmation">Confirme contraseña:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
            @error('password_confirmation')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>

        <div class="campo">
            <label for="foto">Foto</label>
            <input type="file" name="foto" id="foto">
            @error('foto')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>
        <div class="hidden">
            <label for="rol" class="hidden">Rol:</label>
            <input type="hidden" name="rol" value="medico">
        </div>

      {{-- <div id="registroPacienteMsg" class="form-msg oai-hidden"></div> --}}
      <div class="campo">
        <button type="submit" id="btnRegistroContinuar">Registrar</button>

      </div>


    </form>
    <script src="js/app.js" defer></script>
@endsection