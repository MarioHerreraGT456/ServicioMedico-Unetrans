@extends('layouts.app')

@section('content')
    <h2 class="title-form">Registrar Familiar</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @auth
                            
                        @php
                        $perfil = Auth::user()->perfil();
                        $cedula_titular = Auth::user()->cedula;
                      
                    @endphp

    <div class="histories-wrapper">
        <div id="selector-tipo-familiar" class="auth-box selector-modal">
            <h2 class="title-form">¿A quién desea registrar?</h2>
            <p style="text-align: center; margin-bottom: 20px; color: #666;">Seleccione una opción para continuar</p>
            
            <div class="selector-options">
                <button type="button" class="btn-selector" data-target="form-nino">
                    <span class="material-symbols-outlined">child_care</span>
                    Niño (Menor de 12 años)
                </button>
                <button type="button" class="btn-selector" data-target="form-tercera">
                    <span class="material-symbols-outlined">elderly</span>
                    Tercera Edad
                </button>
                <button type="button" class="btn-selector" data-target="form-ninguno">
                    <span class="material-symbols-outlined">person</span>
                    Ninguno (Adulto convencional)
                </button>
            </div>
        </div>
        
        <div id="form-ninguno" class="view hidden">
          
            <form id="formRegistroPersonal" method="POST" action="{{ route('envio.correo') }}" enctype="multipart/form-data">
                @csrf
        
                 <div class="campo">
            <label for="nombre">Primer Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
            @error('nombre')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>
        <div class="campo">
            <label for="nombre2">Segundo Nombre:</label>
            <input type="text" id="nombre2" name="nombre2" value="{{ old('nombre2') }}" required>
            @error('nombre')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>


      <div class="campo">
            <label for="apellido">Primer Apellido:</label>
            <input type="text" id="apellido" name="apellido" value="{{ old('apellido') }}" required>
            @error('apellido')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>
        
      <div class="campo">
            <label for="apellido2">Segundo Apellido:</label>
            <input type="text" id="apellido2" name="apellido2" value="{{ old('apellido2') }}" required>
            @error('apellido')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>
        
                <div class="campo">
                    <label for="cedula2">Cédula del familiar:</label>
                    <div id="campoCedula">
                        <label for="tipo" class="hidden">Tipo:</label>
                        <select name="tipo" id="tipo">
                            <option value="V" {{ old('tipo') == 'V' ? 'selected' : '' }}>V</option>
                            <option value="E" {{ old('tipo') == 'E' ? 'selected' : '' }}>E</option>
                        </select>
                        
                        <input type="text" id="cedula" name="cedula" value="{{ $cedula_titular }}"
                               title="Formato válido: V12345678, E12345678" placeholder="12345678" class="hidden" required>
                             
                        <input type="text" id="cedula2" name="cedula2" value="{{ old('cedula2') }}"
                               title="Formato válido: V12345678, E12345678" placeholder="12345678" required>
                    </div>
                    @error('cedula')
                        <span class="error-message">Dato inválido</span>
                    @enderror
                    @error('tipo')
                        <span class="error-message">Dato inválido</span>
                    @enderror
                </div>
        
               
        
                <div class="campo">
                    <label for="direccion">Dirección:</label>
                    <input type="text" id="direccion" name="direccion" value="{{ old('direccion') }}" required>
                    @error('direccion')
                        <span class="error-message">Dato inválido</span>
                    @enderror
                </div>
        
                <div class="campo">
            <label for="telefono">Teléfono:</label>
              <div id="campoCedula">
                <label for="codigo" class="hidden">Codigo:</label>
                <select name="codigo" id="codigo">
                    <option value="0414">0414</option>
                    <option value="0424">0424</option>
                    <option value="0412">0412</option>
                    <option value="0416">0416</option>
                    <option value="0426">0426</option>
                </select>
             <input type="tel" id="telefono" name="telefono" value="{{ old('telefono') }}"
                   placeholder="1234567"
                   
                    required>
                 </div>
                   @error('telefono')
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
                    <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required>
                    @error('fecha_nacimiento')
                        <span class="error-message">Dato inválido</span>
                    @enderror
                </div>
               
                <!-- SEXO -->
                <div class="campo">
                    <label for="selectSexo">Sexo:</label>
                    <select id="selectSexo" name="sexo" required>
                        <option value="masculino" {{ old('sexo') == 'masculino' ? 'selected' : '' }}>Masculino</option>
                        <option value="femenino" {{ old('sexo') == 'femenino' ? 'selected' : '' }}>Femenino</option>
                    </select>
                    @error('sexo')
                        <span class="error-message">Dato inválido</span>
                    @enderror
                </div>
        
                <!-- ESTADO CIVIL -->
                <div class="campo">
                    <label for="selectEstadoCivil">Estado Civil:</label>
                    <select id="selectEstadoCivil" name="estado_civil" required>
                        <option value="Soltero(a)" {{ old('estado_civil') == 'Soltero(a)' ? 'selected' : '' }}>Soltero(a)</option>
                        <option value="Casado(a)" {{ old('estado_civil') == 'Casado(a)' ? 'selected' : '' }}>Casado(a)</option>
                        <option value="Divorciado(a)" {{ old('estado_civil') == 'Divorciado(a)' ? 'selected' : '' }}>Divorciado(a)</option>
                        <option value="Viudo(a)" {{ old('estado_civil') == 'Viudo(a)' ? 'selected' : '' }}>Viudo(a)</option>
                    </select>
                    @error('estado_civil')
                        <span class="error-message">Dato inválido</span>
                    @enderror
                </div>
              <div class="campo hidden">
                    <label for="tipo_paciente">Tipo de Personal:</label>
                    <input type="hidden" name="tipo_paciente" value="administrativo">
                     @error('tipo_paciente')
                        <span class="error-message">Dato inválido</span>
                    @enderror
                </div>
                <div class="campo">
            <label for="tipo_personal">Tipo de Parentesco:</label>
            <select name="tipo_personal" id="tipo_personal">
                <option value="hijo" {{ old('tipo_personal') == 'hijo' ? 'selected' : '' }}>Hijo(a)</option>
                <option value="casado" {{ old('tipo_personal') == 'casado' ? 'selected' : '' }}>Esposo(a)</option>
                <option value="hermano" {{ old('tipo_personal') == 'hermano' ? 'selected' : '' }}>Hermano(a)</option>
                <option value="familiar" {{ old('tipo_personal') == 'familiar' ? 'selected' : '' }}>Padre o Madre</option>
                <option value="tio" {{ old('tipo_personal') == 'tio' ? 'selected' : '' }}>Tío(a)</option>
                <option value="sobrino" {{ old('tipo_personal') == 'sobrino' ? 'selected' : '' }}>Sobrino(a)</option>
                <option value="primo" {{ old('tipo_personal') == 'primo' ? 'selected' : '' }}>Primo(a)</option>
            </select>
        </div>
        
                <div class="campo hidden">
                    <label for="categoria">Tipo de Paciente:</label>
                    <input type="hidden" name="categoria" value="personal">
                    @error('categoria')
                        <span class="error-message">Dato inválido</span>
                    @enderror
                </div>
                
                <div class="hidden">
                    <label for="rol" class="hidden">Rol:</label>
                    <input type="hidden" name="rol" value="paciente">
                </div>
              
                <div class="campo">
                    <button type="submit" id="btnRegistroContinuar">Registrar</button>
                </div>
            </form>
              <button type="button" class="btn-regresar" title="Volver al selector">
        <span class="material-symbols-outlined">arrow_back</span>
    </button>

        </div>

        <div id="form-tercera" class="view hidden">
            
            <h2 class="title-form">Registrar Persona Tercera Edad</h2>
             <form id="formRegistroPersonal" method="POST" action="{{ route('envio.correo') }}" enctype="multipart/form-data">
                @csrf
        
                <div class="campo">
            <label for="nombre">Primer Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
            @error('nombre')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>
        <div class="campo">
            <label for="nombre2">Segundo Nombre:</label>
            <input type="text" id="nombre2" name="nombre2" value="{{ old('nombre2') }}" required>
            @error('nombre')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>


      <div class="campo">
            <label for="apellido">Primer Apellido:</label>
            <input type="text" id="apellido" name="apellido" value="{{ old('apellido') }}" required>
            @error('apellido')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>
        
      <div class="campo">
            <label for="apellido2">Segundo Apellido:</label>
            <input type="text" id="apellido2" name="apellido2" value="{{ old('apellido2') }}" required>
            @error('apellido')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>
        
                <div class="campo">
                    <label for="cedula2">Cédula del familiar:</label>
                    <div id="campoCedula">
                        <label for="tipo" class="hidden">Tipo:</label>
                        <select name="tipo" id="tipo">
                            <option value="V" {{ old('tipo') == 'V' ? 'selected' : '' }}>V</option>
                            <option value="E" {{ old('tipo') == 'E' ? 'selected' : '' }}>E</option>
                        </select>
                        
                        <input type="hidden" id="cedula" name="cedula" value="{{ $cedula_titular }}"
                               title="Formato válido: V12345678, E12345678" placeholder="12345678" class="hidden" required>
                             
                        <input type="text" id="cedula2" name="cedula2" value="{{ old('cedula2') }}"
                               title="Formato válido: V12345678, E12345678" placeholder="12345678" required>
                    </div>
                    @error('cedula')
                        <span class="error-message">Dato inválido</span>
                    @enderror
                    @error('tipo')
                        <span class="error-message">Dato inválido</span>
                    @enderror
                </div>
        
               
        
                <div class="campo">
                    <label for="direccion">Dirección:</label>
                    <input type="text" id="direccion" name="direccion" value="{{ old('direccion') }}" required>
                    @error('direccion')
                        <span class="error-message">Dato inválido</span>
                    @enderror
                </div>
        
                <div class="campo">
            <label for="telefono">Teléfono:</label>
              <div id="campoCedula">
                <label for="codigo" class="hidden">Codigo:</label>
                <select name="codigo" id="codigo">
                    <option value="0414">0414</option>
                    <option value="0424">0424</option>
                    <option value="0412">0412</option>
                    <option value="0416">0416</option>
                    <option value="0426">0426</option>
                </select>
            <input type="tel" id="telefono" name="telefono" value="{{ old('telefono') }}"
                   placeholder="1234567"
                   
                    required>
                 </div>
                   @error('telefono')
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
                    <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required>
                    @error('fecha_nacimiento')
                        <span class="error-message">Dato inválido</span>
                    @enderror
                </div>
               
        
                <!-- SEXO -->
                <div class="campo">
                    <label for="selectSexo">Sexo:</label>
                    <select id="selectSexo" name="sexo" required>
                        <option value="masculino" {{ old('sexo') == 'masculino' ? 'selected' : '' }}>Masculino</option>
                        <option value="femenino" {{ old('sexo') == 'femenino' ? 'selected' : '' }}>Femenino</option>
                    </select>
                    @error('sexo')
                        <span class="error-message">Dato inválido</span>
                    @enderror
                </div>
        
                <!-- ESTADO CIVIL -->
                <div class="campo">
                    <label for="selectEstadoCivil">Estado Civil:</label>
                    <select id="selectEstadoCivil" name="estado_civil" required>
                        <option value="Soltero(a)" {{ old('estado_civil') == 'Soltero(a)' ? 'selected' : '' }}>Soltero(a)</option>
                        <option value="Casado(a)" {{ old('estado_civil') == 'Casado(a)' ? 'selected' : '' }}>Casado(a)</option>
                        <option value="Divorciado(a)" {{ old('estado_civil') == 'Divorciado(a)' ? 'selected' : '' }}>Divorciado(a)</option>
                        <option value="Viudo(a)" {{ old('estado_civil') == 'Viudo(a)' ? 'selected' : '' }}>Viudo(a)</option>
                    </select>
                    @error('estado_civil')
                        <span class="error-message">Dato inválido</span>
                    @enderror
                </div>
              <div class="campo hidden">
                    <label for="tipo_paciente">Tipo de Personal:</label>
                    <input type="hidden" name="tipo_paciente" value="administrativo">
                </div>

                <div class="campo">
            <label for="tipo_personal">Tipo de Parentesco:</label>
            <select name="tipo_personal" id="tipo_personal">
    
                <option value="familiar" {{ old('tipo_personal') == 'familiar' ? 'selected' : '' }}>Padre o Madre</option>
                <option value="tio" {{ old('tipo_personal') == 'tio' ? 'selected' : '' }}>Tío(a)</option>
                <option value="sobrino" {{ old('tipo_personal') == 'sobrino' ? 'selected' : '' }}>Sobrino(a)</option>

            </select>
        </div>
        
                <div class="campo hidden">
                    <label for="categoria">Tipo de Paciente:</label>
                    <input type="hidden" name="categoria" value="personal">
                    @error('categoria')
                        <span class="error-message">Dato inválido</span>
                    @enderror
                </div>
                
                <div class="hidden">
                    <label for="rol" class="hidden">Rol:</label>
                    <input type="hidden" name="rol" value="paciente">
                </div>
              
                <div class="campo">
                    <button type="submit" id="btnRegistroContinuar">Registrar</button>
                </div>
            </form>
            <button type="button" class="btn-regresar" title="Volver al selector">
        <span class="material-symbols-outlined">arrow_back</span>
    </button>
        </div>

        <div id="form-nino" class="view hidden">
           
            <h2 class="title-form">Registrar Niño (Sin Cédula)</h2>
            <form id="formRegistroPersonal" method="POST" action="{{ route('envio.correo') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="categoria_especial" value="nino">

                <div class="campo full-width">
                    <label for="numero_hijo">¿Qué número de hijo es? (Ej: 1, 2...):</label>
                    <input type="tell" id="numero_hijo" min="1" 
           data-cedula-padre="{{ $cedula_titular ?? '' }}" 
           {{-- data-anio-padre="{{ $anio_titular ?? '00' }}"  --}}
           placeholder="Ingrese el número de hijo" required>
                </div>

                 <div class="campo">
            <label for="nombre">Primer Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
            @error('nombre')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>
        <div class="campo">
            <label for="nombre2">Segundo Nombre:</label>
            <input type="text" id="nombre2" name="nombre2" value="{{ old('nombre2') }}" required>
            @error('nombre')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>


      <div class="campo">
            <label for="apellido">Primer Apellido:</label>
            <input type="text" id="apellido" name="apellido" value="{{ old('apellido') }}" required>
            @error('apellido')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>
        
      <div class="campo">
            <label for="apellido2">Segundo Apellido:</label>
            <input type="text" id="apellido2" name="apellido2" value="{{ old('apellido2') }}" required>
            @error('apellido')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>

                <div class="campo">
                    <label for="cedula2">Cédula Generada:</label>
                    <div id="campoCedula">
                        <select name="tipo" class="hidden"><option value="V" selected>V</option></select>
                        <input type="text" name="cedula" value="{{ $cedula_titular }}" class="hidden">
                        
                        <input type="text" id="cedula2_nino" name="cedula2" 
                               readonly tabindex="-1" 
                               style="background-color: #f3f4f6; pointer-events: none; color: #6b7280; font-weight: bold;" 
                               placeholder="Se generará automáticamente"  required>
                    </div>
                </div>

                <div class="campo">
                    <label for="direccion">Dirección:</label>
                    <input type="text" id="direccion" name="direccion" required>
                </div>

               <div class="campo">
            <label for="telefono">Teléfono:</label>
              <div id="campoCedula">
                <label for="codigo" class="hidden">Codigo:</label>
                <select name="codigo" id="codigo">
                    <option value="0414">0414</option>
                    <option value="0424">0424</option>
                    <option value="0412">0412</option>
                    <option value="0416">0416</option>
                    <option value="0426">0426</option>
                </select>
            <input type="tel" id="telefono" name="telefono" value="{{ old('telefono') }}"
                   placeholder="1234567"
                   
                    required>
                 </div>
                   @error('telefono')
                       <span class="error-message">Dato inválido</span>
                   @enderror
        </div>

                <div class="campo">
                    <label for="correo">Correo:</label>
                    <input type="email" id="correo" name="correo" required>
                </div>

                <div class="campo">
                    <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                    <input type="date" id="fecha_nacimiento1" name="fecha_nacimiento" required>
                </div>

            

                <div class="campo">
                    <label for="selectSexo">Sexo:</label>
                    <select id="selectSexo" name="sexo" required>
                        <option value="masculino">Masculino</option>
                        <option value="femenino">Femenino</option>
                    </select>
                </div>

                 <div class="campo hidden">
                    <label for="selectEstadoCivil">Estado Civil:</label>
                    <input type="hidden" id="selectEstadoCivil" name="estado_civil" value="Soltero(a)" required>
                    
                    @error('estado_civil')
                        <span class="error-message">Dato inválido</span>
                    @enderror
                </div>

                <div class="campo hidden">
                    <label for="tipo_personal">Tipo de Parentesco:</label>
                    <input type="hidden" name="tipo_personal" value="hijo" class="hidden">
                    
                </div>
                <input type="hidden" name="tipo_paciente" value="administrativo">

                <input type="hidden" name="categoria" value="personal">
                <input type="hidden" name="rol" value="paciente">
              
                <div class="campo">
                    <button type="submit" id="btnRegistroContinuarNino" class="btn-principal">Registrar Niño</button>
                </div>
            </form>
             <button type="button" class="btn-regresar" title="Volver al selector">
        <span class="material-symbols-outlined">arrow_back</span>
    </button>
        </div>
          @endauth

    <script src="js/app.js" defer></script>
    <script src="js/selector-familiar.js" defer></script>
@endsection