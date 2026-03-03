@extends('layouts.app')

@section('content')


  <h2 class="title-form">Agregar contraseña</h2>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form id="formRegistroPaciente" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
      @csrf
      
        <div class="campo hidden">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="{{ $nombre }}" required>
        
        </div>


      <div class="campo hidden">
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" value="{{ $apellido }}" required>
           
        </div>
      
       {{-- <div class="campo hidden">
    <label for="cedula">Cédula:</label>
    <div id="campoCedula">
        @isset($cedula2)
        <input type="hidden" id="tipo" name="tipo" value="{{ $tipo }}">
          
            <input type="hidden" name="cedula2" value="{{ $cedula2 }}">
        @else
    
            <input type="hidden" name="cedula" value="{{ $cedula }}">
        @endisset
    </div>

    
    
</div> --}}
<div class="campo hidden">
    @isset($cedula2)
    <label for="cedula"></label>
    <label for="cedula2"></label>
    <div class="campoCedula">
        <input type="hidden" id="tipo" name="tipo" value="{{ $tipo }}">
        <input type="hidden" name="cedula" value="{{ $cedula }}">
        <input type="hidden" name="cedula2" value="{{ $cedula2 }}">
        {{-- ¡IMPORTANTE! Necesitas enviar tipo_personal para que el controlador sepa a dónde ir --}}
        <input type="hidden" name="tipo_personal" value="{{ $tipo_personal ?? '' }}">
    </div>
    @else
    <label for="cedula">Cédula:</label>
    <div class="campoCedula">
        <input type="hidden" id="tipo" name="tipo" value="{{ $tipo }}">
        <input type="hidden" name="cedula" value="{{ $cedula }}">
    </div>
    @endisset
</div>


       <div class="campo hidden">
            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" value="{{ $direccion }}" required>
           
        </div>

        <div class="campo hidden">
            <label for="telefono">Teléfono:</label>
            <input type="tel" id="telefono" name="telefono" value="{{ $telefono }}"
                   placeholder="04141234567 o +584141234567"
                   pattern="^(\+58|0)(414|424|412|422|416|426)[0-9]{7}$"
                   title="Formato válido: +584121234567 o 014121234567" required>
            
        </div>

     <div class="campo hidden">
            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" value="{{ $correo }}" required>
           
        </div>

        <div class="campo hidden">
            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ $fecha_nacimiento }}" required>
          
        </div>

        <div class="campo hidden">
            <label for="edad">Edad:</label>
            <input type="tell" id="edad" name="edad" value="{{ $edad }}" required>
        </div>

      <!--SEXO-->
       <div class="campo hidden">
            <label for="sexo">Sexo:</label>
            <input type="text" id="sexo" name="sexo" value="{{ $sexo }}" required>  
        </div>

        <!-- ESTADO CIVIL -->
        <div class="campo hidden">
            <label for="selectEstadoCivil">Estado Civil:</label>
            <input type="text" id="estado_civil" name="estado_civil" value="{{ $estado_civil }}" required>
            
            
        </div>

        <!-- TIPO DE PACIENTE -->
        <div class="campo hidden">
            <label for="categoria">Tipo de Paciente:</label>
            <input type="text" id="categoria" name="categoria" value="{{ $categoria }}" required>
          
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

        <div class="hidden">
            <label for="rol" class="hidden">Rol:</label>
            <input type="hidden" name="rol" value="{{ $rol }}">
        </div>
        
      {{-- <div id="registroPacienteMsg" class="form-msg oai-hidden"></div> --}}
      <div class="campo">
        <button type="submit" id="btnRegistroContinuar">Confirmar</button>

      </div>


    </form>
    <script src="js/app.js" defer></script>

@endsection