@extends('layouts.app')

@section('content')
    <h2 class="title-form">Crear Historia</h2>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
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

    @php
        $persona = Auth::user();
        $medico = $persona->medico;
    @endphp

    @if($medico->especialidad === 'general' || $medico->especialidad === 'psiquiatria')
        {{-- FORMULARIO GENERAL --}}
        <form id="" method="POST" action="{{ route('historias.store') }}" enctype="multipart/form-data" class="form-container">
            @csrf
            <h3>Datos - Historia General</h3>

            {{-- CONTENEDOR FLEX CON DOS COLUMNAS --}}
            <div class="form-row">
                {{-- Columna izquierda --}}
                <div class="form-column">
                    <div class="campo">
                        <label for="nombre_gen">Nombre:</label>
                        <input type="text" id="nombre_gen" name="nombre" value="{{ old('nombre') }}" required>
                    </div>
                    <div class="campo">
                        <label for="nombre_gen">Segundo Nombre:</label>
                        <input type="text" id="nombre_gen" name="nombre2" value="{{ old('nombre2') }}" required>
                    </div>

                    <div class="campo">
                        <label for="apellido_gen">Apellido:</label>
                        <input type="text" id="apellido_gen" name="apellido" value="{{ old('apellido') }}" required>
                    </div>
                    <div class="campo">
                        <label for="apellido_gen">Segundo Apellido:</label>
                        <input type="text" id="apellido_gen" name="apellido2" value="{{ old('apellido2') }}" required>
                    </div>

                    <div class="campo">
                        <label for="cedula_gen">Cédula:</label>
                        <div class="cedula-group">
                            <select name="tipo" id="tipo_gen">
                                <option value="V" {{ old('tipo') == 'V' ? 'selected' : '' }}>V</option>
                                <option value="E" {{ old('tipo') == 'E' ? 'selected' : '' }}>E</option>
                            </select>
                            <input type="number" id="cedula_gen" name="cedula" value="{{ old('cedula') }}" placeholder="12345678" required>
                        </div>
                    </div>

                    <div class="campo">
                        <label for="sexo_gen">Sexo:</label>
                        <select id="sexo_gen" name="sexo" required>
                            <option value="masculino" {{ old('sexo') == 'masculino' ? 'selected' : '' }}>Masculino</option>
                            <option value="femenino" {{ old('sexo') == 'femenino' ? 'selected' : '' }}>Femenino</option>
                        </select>
                    </div>

                    <div class="campo">
                        <label for="fecha_nacimiento_gen">Fecha de Nacimiento:</label>
                        <input type="date" id="fecha_nacimiento_gen" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required>
                    </div>

                 

                    <div class="campo">
                        <label for="direccion_gen">Dirección:</label>
                        <input type="text" id="direccion_gen" name="direccion" value="{{ old('direccion') }}" required>
                    </div>
                </div>

                {{-- Columna derecha --}}
                <div class="form-column">
                    <div class="campo">
                        <label for="telefono_gen">Teléfono:</label>
                        <select name="codigo" id="codigo">
                    <option value="0414">0414</option>
                    <option value="0424">0424</option>
                    <option value="0412">0412</option>
                    <option value="0416">0416</option>
                    <option value="0426">0426</option>
                </select>
                        <input type="tel" id="telefono_gen" name="telefono" value="{{ old('telefono') }}" placeholder="04141234567" pattern="^(\+58|0)(414|424|412|422|416|426)[0-9]{7}$" required>
                    </div>

                    <div class="campo">
                        <label for="motivo_consulta_gen">Motivo de consulta:</label>
                        <input type="text" id="motivo_consulta_gen" name="motivo_consulta" value="{{ old('motivo_consulta') }}" required>
                    </div>

                    <div class="campo">
                        <label for="enfermedad_gen">Enfermedad actual:</label>
                        <input type="text" id="enfermedad_gen" name="enfermedad" value="{{ old('enfermedad') }}" required>
                    </div>

                    <div class="campo">
                        <label for="antecedentes_familiares_gen">Antecedentes Familiares:</label>
                        <input type="text" id="antecedentes_familiares_gen" name="antecedentes_familiares" value="{{ old('antecedentes_familiares') }}" required>
                    </div>

                    <div class="campo">
                        <label for="antecedentes_personales_gen">Antecedentes Personales:</label>
                        <select id="antecedentes_personales_gen" name="antecedentes_personales" required>
                            <option value="hemorragia">Hemorragia</option>
                            <option value="cardiovascular">Cardiovascular</option>
                            <option value="respiratorio">Respiratorio</option>
                            <option value="alergias">Alergias</option>
                            <option value="diabetes">Diabetes</option>
                            <option value="epilepsia">Epilepsia</option>
                            <option value="tratamiento_medico">Tratamiento Médico</option>
                            <option value="medicacion">Medicación</option>
                        </select>
                    </div>

                    <div class="campo">
                        <label for="radiodiagnostico_gen">Radiodiagnóstico:</label>
                        <input type="text" id="radiodiagnostico_gen" name="radiodiagnóstico" value="{{ old('radiodiagnóstico') }}" required>
                    </div>

                    <div class="campo">
                        <label for="tratamiento_gen">Tratamiento:</label>
                        <input type="text" id="tratamiento_gen" name="tratamiento" value="{{ old('tratamiento') }}" required>
                    </div>
                </div>
            </div>

            {{-- BOTÓN FUERA DE LAS COLUMNAS --}}
            <div class="submit-button">
                <button type="submit" id="btnRegistroContinuar">Registrar Historia</button>
            </div>
        </form>

    @else
        {{-- FORMULARIO ODONTOLOGÍA --}}
        <form id="" method="POST" action="" enctype="multipart/form-data" class="form-container">
            @csrf
            <h3>Datos - Historia Odontológica</h3>

            {{-- CONTENEDOR FLEX CON DOS COLUMNAS (todos los campos excepto el bloque de dientes) --}}
            <div class="form-row">
                {{-- Columna izquierda --}}
                <div class="form-column">
                    <div class="campo">
                        <label for="nombre_odo">Nombre:</label>
                        <input type="text" id="nombre_odo" name="nombre" value="{{ old('nombre') }}" required>
                    </div>

                    <div class="campo">
                        <label for="apellido_odo">Apellido:</label>
                        <input type="text" id="apellido_odo" name="apellido" value="{{ old('apellido') }}" required>
                    </div>

                    <div class="campo">
                        <label for="cedula_odo">Cédula:</label>
                        <div class="cedula-group">
                            <select name="tipo" id="tipo_odo">
                                <option value="V">V</option>
                                <option value="E">E</option>
                            </select>
                            <input type="number" id="cedula_odo" name="cedula" value="{{ old('cedula') }}" required>
                        </div>
                    </div>

                    <div class="campo">
                        <label for="sexo_odo">Sexo:</label>
                        <select id="sexo_odo" name="sexo" required>
                            <option value="masculino">Masculino</option>
                            <option value="femenino">Femenino</option>
                        </select>
                    </div>

                    <div class="campo">
                        <label for="fecha_nacimiento_odo">Fecha de Nacimiento:</label>
                        <input type="date" id="fecha_nacimiento_odo" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required>
                    </div>

               

                    <div class="campo">
                        <label for="correo_odo">Correo Electrónico:</label>
                        <input type="email" id="correo_odo" name="correo" value="{{ old('correo') }}" required>
                    </div>

                    <div class="campo">
                        <label for="direccion_odo">Dirección:</label>
                        <input type="text" id="direccion_odo" name="direccion" value="{{ old('direccion') }}" required>
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

                </div>

                {{-- Columna derecha --}}
                <div class="form-column">
                    <div class="campo">
                        <label for="motivo_consulta_odo">Motivo de consulta:</label>
                        <input type="text" id="motivo_consulta_odo" name="motivo_consulta" value="{{ old('motivo_consulta') }}" required>
                    </div>

                    <div class="campo">
                        <label for="enfermedad_odo">Enfermedad actual:</label>
                        <input type="text" id="enfermedad_odo" name="enfermedad" value="{{ old('enfermedad') }}" required>
                    </div>

                    <div class="campo">
                        <label for="antecedentes_familiares_odo">Antecedentes Familiares:</label>
                        <input type="text" id="antecedentes_familiares_odo" name="antecedentes_familiares" value="{{ old('antecedentes_familiares') }}" required>
                    </div>

                    <div class="campo">
                        <label for="antecedentes_personales_odo">Antecedentes Personales:</label>
                        <select id="antecedentes_personales_odo" name="antecedentes_personales" required>
                            <option value="hemorragia">Hemorragia</option>
                            <option value="cardiovascular">Cardiovascular</option>
                            <option value="respiratorio">Respiratorio</option>
                            <option value="alergias">Alergias</option>
                            <option value="diabetes">Diabetes</option>
                            <option value="epilepsia">Epilepsia</option>
                            <option value="tratamiento_medico">Tratamiento Médico</option>
                            <option value="medicacion">Medicación</option>
                        </select>
                    </div>

                    <div class="campo">
                        <label for="examen_odo">Examen Físico Bucal:</label>
                        <select id="examen_odo" name="examen" required>
                            <option value="labios">Labios</option>
                            <option value="lengua">Lengua</option>
                            <option value="piso_bucal">Piso Bucal</option>
                            <option value="encias">Encías</option>
                            <option value="atm">ATM</option>
                            <option value="oclusion">Oclusión</option>
                        </select>
                    </div>

                    <div class="campo">
                        <label for="odontograma_odo">Odontograma (Opcional):</label>
                        <input type="file" id="odontograma_odo" name="odontograma" accept="image/*,application/pdf">
                    </div>

                    <div class="campo">
                        <label for="radiodiagnostico_odo">Radiodiagnóstico:</label>
                        <input type="text" id="radiodiagnostico_odo" name="radiodiagnóstico" value="{{ old('radiodiagnóstico') }}" required>
                    </div>

                    <div class="campo">
                        <label for="tratamiento_odo">Tratamiento:</label>
                        <input type="text" id="tratamiento_odo" name="tratamiento" value="{{ old('tratamiento') }}" required>
                    </div>
                </div>
            </div>

            {{-- BLOQUE ESPECIAL DE DIENTES (se mantiene igual y se coloca entre las columnas y el botón) --}}
            <div class="dientes-block">
                <div class="campo odontologia-section">
                    <label for="diente">Seleccione el Diente Tratado (Solo Odontología):</label>
                    
                    <input type="hidden" id="input_diente" name="diente" value="{{ old('diente') }}">

                    <div class="odontograma-container">
                        <div class="fila-dientes">
                            <div class="cuadrante cuadrante-izq">
                                <button type="button" class="btn-diente" data-diente="18"><img src="img/18.png" alt=""></button>
                                <button type="button" class="btn-diente" data-diente="17"><img src="img/17.png" alt=""></button>
                                <button type="button" class="btn-diente" data-diente="16"><img src="img/16.png" alt=""></button>
                                <button type="button" class="btn-diente" data-diente="15"><img src="img/15.png" alt=""></button>
                                <button type="button" class="btn-diente" data-diente="14"><img src="img/14.png" alt=""></button>
                                <button type="button" class="btn-diente" data-diente="13"><img src="img/13.png" alt=""></button>
                                <button type="button" class="btn-diente" data-diente="12"><img src="img/12.png" alt=""></button>
                                <button type="button" class="btn-diente" data-diente="11"><img src="img/11.png" alt=""></button>
                            </div>
                            <div class="cuadrante cuadrante-der">
                                <button type="button" class="btn-diente" data-diente="21"><img src="img/21.png" alt=""></button>
                                <button type="button" class="btn-diente" data-diente="22"><img src="img/22.png" alt=""></button>
                                <button type="button" class="btn-diente" data-diente="23"><img src="img/23.png" alt=""></button>
                                <button type="button" class="btn-diente" data-diente="24"><img src="img/24.png" alt=""></button>
                                <button type="button" class="btn-diente" data-diente="25"><img src="img/25.png" alt=""></button>
                                <button type="button" class="btn-diente" data-diente="26"><img src="img/26.png" alt=""></button>
                                <button type="button" class="btn-diente" data-diente="27"><img src="img/27.png" alt=""></button>
                                <button type="button" class="btn-diente" data-diente="28"><img src="img/28.png" alt=""></button>
                            </div>
                        </div>

                        <hr class="linea-divisora">

                        <div class="fila-dientes">
                            <div class="cuadrante cuadrante-izq">
                                <button type="button" class="btn-diente" data-diente="48"><img src="img/48.png" alt=""></button>
                                <button type="button" class="btn-diente" data-diente="47"><img src="img/47.png" alt=""></button>
                                <button type="button" class="btn-diente" data-diente="46"><img src="img/46.png" alt=""></button>
                                <button type="button" class="btn-diente" data-diente="45"><img src="img/45.png" alt=""></button>
                                <button type="button" class="btn-diente" data-diente="44"><img src="img/44.png" alt=""></button>
                                <button type="button" class="btn-diente" data-diente="43"><img src="img/43.png" alt=""></button>
                                <button type="button" class="btn-diente" data-diente="42"><img src="img/42.png" alt=""></button>
                                <button type="button" class="btn-diente" data-diente="41"><img src="img/41.png" alt=""></button>
                            </div>
                            <div class="cuadrante cuadrante-der">
                                <button type="button" class="btn-diente" data-diente="31"><img src="img/31.png" alt=""></button>
                                <button type="button" class="btn-diente" data-diente="32"><img src="img/32.png" alt=""></button>
                                <button type="button" class="btn-diente" data-diente="33"><img src="img/33.png" alt=""></button>
                                <button type="button" class="btn-diente" data-diente="34"><img src="img/34.png" alt=""></button>
                                <button type="button" class="btn-diente" data-diente="35"><img src="img/35.png" alt=""></button>
                                <button type="button" class="btn-diente" data-diente="36"><img src="img/36.png" alt=""></button>
                                <button type="button" class="btn-diente" data-diente="37"><img src="img/37.png" alt=""></button>
                                <button type="button" class="btn-diente" data-diente="38"><img src="img/38.png" alt=""></button>
                            </div>
                        </div>
                    </div>
                    @error('diente')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- BOTÓN FUERA DE LAS COLUMNAS --}}
            <div class="submit-button">
                <button type="submit" id="btnRegistroContinuar">Registrar Historia</button>
            </div>
        </form>
    @endif

    <script>
        function toggleFormularios() {
            const tipo = document.getElementById('tipo_historia').value;
            const formGeneral = document.getElementById('formGeneral');
            const formOdonto = document.getElementById('formOdontologia');

            if (tipo === 'general') {
                formGeneral.style.display = 'block';
                formOdonto.style.display = 'none';
            } else {
                formGeneral.style.display = 'none';
                formOdonto.style.display = 'block';
            }
        }
    </script>
    <script src="js/diente.js" defer></script>
@endsection