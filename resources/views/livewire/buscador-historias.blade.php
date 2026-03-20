@php
        $persona = Auth::user();
        $medico = $persona->medico;
    @endphp

    @if($medico->especialidad === 'general' || $medico->especialidad === 'psiquiatria')
        {{-- FORMULARIO GENERAL --}}

        <div class="historia-doc__encabezado">

            <form id="" method="POST" action="{{ route('historias.store') }}" enctype="multipart/form-data" class="form-container historia-doc-form">
            @csrf

            <div class="historia-doc">

                <div class="historia-doc__cintillo">
                    <img src="img/cintillo.jpeg" class="logo-left">
                </div>

                <div class="historia-doc__header">
                    <h3 class="historia-doc__titulo-central">HISTORIA MÉDICA</h3>
                </div>

                <div class="historia-doc__body">

                    <div class="historia-doc__row historia-doc__row--search">
                        <div class="campo historia-doc__field historia-doc__field--tipo-busqueda">
                            <label for="cedula">Cédula:</label>
                            <div id="campoCedula" class="historia-doc__inline-group">
                                <label for="tipo" class="hidden">Tipo:</label>
                                <input type="text" id="tipo" name="tipo" wire:model="tipo" required>
                                <input 
                                    type="text" 
                                    wire:model.live.debounce.500ms="buscar" 
                                    class="container-search__bar" 
                                    placeholder="Escriba para buscar..."
                                >
                            </div>
                        </div>
                    </div>

                    <div class="campo hidden">
                        <label for="cedula">Cédula:</label>
                        <input type="text" name="cedula" wire:model="cedula" required>
                    </div>

                    <div class="historia-doc__row historia-doc__row--two">
                        <div class="campo historia-doc__field">
                            <label for="apellido">Apellido</label>
                            <input type="text" name="apellido" wire:model="apellido" required>
                        </div>

                        <div class="campo historia-doc__field">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" wire:model="nombre" required>
                        </div>
                    </div>

                    <div class="historia-doc__row historia-doc__row--two">
                        <div class="campo historia-doc__field">
                            <label for="nombre2">Segundo Nombre</label>
                            <input type="text" name="nombre2" wire:model="nombre2">
                        </div>

                        <div class="campo historia-doc__field">
                            <label for="apellido2">Segundo Apellido</label>
                            <input type="text" name="apellido2" wire:model="apellido2" required>
                        </div>
                    </div>

                    <div class="historia-doc__row historia-doc__row--two">
                        <div class="campo historia-doc__field">
                            <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" wire:model="fecha_nacimiento" required>
                            @error('fecha_nacimiento')
                                <span class="error-message">Dato inválido</span>
                            @enderror
                        </div>

                        <div class="campo historia-doc__field">
                            <label for="direccion_odo">Dirección</label>
                            <input type="text" id="direccion_odo" name="direccion" wire:model="direccion" required>
                        </div>
                    </div>

                    <div class="historia-doc__row historia-doc__row--four">
                        <div class="campo historia-doc__field">
                            <label for="sexo">Sexo</label>
                            <input type="text" id="sexo" name="sexo" wire:model="sexo" required>
                            @error('sexo')
                                <span class="error-message">Dato inválido</span>
                            @enderror
                        </div>

                        <div class="campo historia-doc__field">
                            <label for="correo_odo">Correo Electrónico</label>
                            <input type="email" id="correo_odo" name="correo" wire:model="correo" required>
                        </div>

                        <div class="campo historia-doc__field historia-doc__field--telefono">
                            <label for="telefono">Teléfono</label>
                            <div id="campoCedula" class="historia-doc__inline-group">
                                <label for="codigo" class="hidden">Codigo:</label>
                                <input type="tel" id="codigo" name="codigo" wire:model="codigo"
                                   placeholder="0412"
                                   required>

                                <input type="tel" id="telefono" name="telefono" wire:model="telefono"
                                   placeholder="1234567"
                                   required>
                            </div>
                            @error('telefono')
                                <span class="error-message">Dato inválido</span>
                            @enderror
                        </div>
                    </div>

                    <div class="campo historia-doc__field historia-doc__field--full">
                        <label for="motivo_consulta_gen">Motivo de consulta</label>
                        <input type="text" id="motivo_consulta_gen" name="motivo_consulta" value="{{ old('motivo_consulta') }}" required>
                    </div>

                    <div class="campo historia-doc__field historia-doc__field--full">
                        <label for="enfermedad_gen">Enfermedad actual</label>
                        <input type="text" id="enfermedad_gen" name="enfermedad" value="{{ old('enfermedad') }}" required>
                    </div>

                    <div class="campo historia-doc__field historia-doc__field--full">
                        <label for="antecedentes_familiares_gen">Antecedentes Familiares</label>
                        <input type="text" id="antecedentes_familiares_gen" name="antecedentes_familiares" value="{{ old('antecedentes_familiares') }}" required>
                    </div>

                    <div class="campo historia-doc__field historia-doc__field--full">
                        <label>Antecedentes Personales</label>

                        <input type="hidden" id="input_antecedentes" name="antecedentes_personales" value="{{ old('antecedentes_personales') }}">

                        <div class="antecedentes-selector historia-doc__selector">
                            <button type="button" class="btn-ant" data-valor="hemorragia">Hemorragia</button>
                            <button type="button" class="btn-ant" data-valor="cardiovascular">Cardiovascular</button>
                            <button type="button" class="btn-ant" data-valor="respiratorio">Respiratorio</button>
                            <button type="button" class="btn-ant" data-valor="alergias">Alergias</button>
                            <button type="button" class="btn-ant" data-valor="diabetes">Diabetes</button>
                            <button type="button" class="btn-ant" data-valor="epilepsia">Epilepsia</button>
                            <button type="button" class="btn-ant" data-valor="tratamiento_medico">Tratamiento Médico</button>
                            <button type="button" class="btn-ant" data-valor="medicacion">Medicación</button>
                        </div>
                    </div>

                    <div class="campo historia-doc__field historia-doc__field--full">
                        <label for="radiodiagnostico_gen">Radiodiagnóstico</label>
                        <input type="text" id="radiodiagnostico_gen" name="radiodiagnóstico" value="{{ old('radiodiagnóstico') }}" required>
                    </div>

                    <div class="campo historia-doc__field historia-doc__field--full">
                        <label for="tratamiento_gen">Tratamiento</label>
                        <input type="text" id="tratamiento_gen" name="tratamiento" value="{{ old('tratamiento') }}" required>
                    </div>

                    <div class="submit-button historia-doc__actions">
                        <button type="submit" id="btnRegistroContinuar">Registrar Historia</button>
                    </div>

                </div>
            </div>
        </form>

    @else
        {{-- FORMULARIO ODONTOLOGÍA --}}
        <form id="" method="POST" action="" enctype="multipart/form-data" class="form-container historia-doc-form">
            @csrf

            <div class="historia-doc historia-doc--odontologia">
                <div class="historia-doc__header">
                    <h3 class="historia-doc__title">HISTORIA ODONTOLÓGICA</h3>
                </div>

                <div class="historia-doc__body">

                    <div class="historia-doc__row historia-doc__row--search">
                        <div class="campo historia-doc__field historia-doc__field--tipo-busqueda">
                            <label for="cedula">Cédula:</label>
                            <div id="campoCedula" class="historia-doc__inline-group">
                                <label for="tipo" class="hidden">Tipo:</label>
                                <input type="text" id="tipo" name="tipo" wire:model="tipo" required>
                                <input 
                                    type="text" 
                                    wire:model.live.debounce.500ms="buscar" 
                                    class="container-search__bar" 
                                    placeholder="Escriba para buscar..."
                                >
                            </div>
                        </div>
                    </div>

                    <div class="campo hidden">
                        <label for="cedula">Cédula:</label>
                        <input type="text" name="cedula" wire:model="cedula" required>
                    </div>

                    <div class="historia-doc__row historia-doc__row--two">
                        <div class="campo historia-doc__field">
                            <label for="apellido">Apellido</label>
                            <input type="text" name="apellido" wire:model="apellido" required>
                        </div>

                        <div class="campo historia-doc__field">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" wire:model="nombre" required>
                        </div>
                    </div>

                    <div class="historia-doc__row historia-doc__row--two">
                        <div class="campo historia-doc__field">
                            <label for="nombre2">Segundo Nombre</label>
                            <input type="text" name="nombre2" wire:model="nombre2">
                        </div>

                        <div class="campo historia-doc__field">
                            <label for="apellido2">Segundo Apellido</label>
                            <input type="text" name="apellido2" wire:model="apellido2" required>
                        </div>
                    </div>

                    <div class="historia-doc__row historia-doc__row--two">
                        <div class="campo historia-doc__field">
                            <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" wire:model="fecha_nacimiento" required>
                            @error('fecha_nacimiento')
                                <span class="error-message">Dato inválido</span>
                            @enderror
                        </div>

                        <div class="campo historia-doc__field">
                            <label for="direccion_odo">Dirección</label>
                            <input type="text" id="direccion_odo" name="direccion" wire:model="direccion" required>
                        </div>
                    </div>

                    <div class="historia-doc__row historia-doc__row--four">
                        <div class="campo historia-doc__field">
                            <label for="sexo">Sexo</label>
                            <input type="text" id="sexo" name="sexo" wire:model="sexo" required>
                            @error('sexo')
                                <span class="error-message">Dato inválido</span>
                            @enderror
                        </div>

                        <div class="campo historia-doc__field">
                            <label for="correo_odo">Correo Electrónico</label>
                            <input type="email" id="correo_odo" name="correo" wire:model="correo" required>
                        </div>

                        <div class="campo historia-doc__field historia-doc__field--telefono">
                            <label for="telefono">Teléfono</label>
                            <div id="campoCedula" class="historia-doc__inline-group">
                                <label for="codigo" class="hidden">Codigo:</label>
                                <input type="tel" id="codigo" name="codigo" wire:model="codigo"
                                   placeholder="1234567"
                                   required>

                                <input type="tel" id="telefono" name="telefono" wire:model="telefono"
                                   placeholder="1234567"
                                   required>
                            </div>
                            @error('telefono')
                                <span class="error-message">Dato inválido</span>
                            @enderror
                        </div>
                    </div>

                    <div class="campo historia-doc__field historia-doc__field--full">
                        <label for="motivo_consulta_odo">Motivo de consulta:</label>
                        <input type="text" id="motivo_consulta_odo" name="motivo_consulta" value="{{ old('motivo_consulta') }}" required>
                    </div>

                    <div class="campo historia-doc__field historia-doc__field--full">
                        <label for="enfermedad_odo">Enfermedad actual:</label>
                        <input type="text" id="enfermedad_odo" name="enfermedad" value="{{ old('enfermedad') }}" required>
                    </div>

                    <div class="campo historia-doc__field historia-doc__field--full">
                        <label for="antecedentes_familiares_odo">Antecedentes Familiares:</label>
                        <input type="text" id="antecedentes_familiares_odo" name="antecedentes_familiares" value="{{ old('antecedentes_familiares') }}" required>
                    </div>

                    <div class="campo historia-doc__field historia-doc__field--full">
                        <label>Antecedentes Personales:</label>

                        <input type="hidden" id="input_antecedentes" name="antecedentes_personales" value="{{ old('antecedentes_personales') }}">

                        <div class="antecedentes-selector historia-doc__selector">
                            <button type="button" class="btn-ant" data-valor="hemorragia">Hemorragia</button>
                            <button type="button" class="btn-ant" data-valor="cardiovascular">Cardiovascular</button>
                            <button type="button" class="btn-ant" data-valor="respiratorio">Respiratorio</button>
                            <button type="button" class="btn-ant" data-valor="alergias">Alergias</button>
                            <button type="button" class="btn-ant" data-valor="diabetes">Diabetes</button>
                            <button type="button" class="btn-ant" data-valor="epilepsia">Epilepsia</button>
                            <button type="button" class="btn-ant" data-valor="tratamiento_medico">Tratamiento Médico</button>
                            <button type="button" class="btn-ant" data-valor="medicacion">Medicación</button>
                        </div>
                    </div>

                    <div class="campo historia-doc__field historia-doc__field--full">
                        <label for="examen_odo">Examen Físico Bucal:</label>
                        <select id="examen_odo" name="examen" required>
                            <option value="labios">Labios</option>
                            <option value="lengua">Lengua</option>
                            <option value="piso_bucal">Piso Bucal</option>
                            <option value="encias">Encías</option>
                            <option value="atm">ATM</option>
                            <option value="oclusion">Oclusión</option>
                        </select>
                        @error('examen')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!--<div class="campo historia-doc__field historia-doc__field--full">
                        <label for="odontograma_odo">Odontograma (Opcional):</label>
                        <input type="file" id="odontograma_odo" name="odontograma" accept="image/*,application/pdf">
                    </div>-->

                    <div class="campo historia-doc__field historia-doc__field--full">
                        <label for="radiodiagnostico_odo">Radiodiagnóstico:</label>
                        <input type="text" id="radiodiagnostico_odo" name="radiodiagnóstico" value="{{ old('radiodiagnóstico') }}" required>
                    </div>

                    <div class="campo historia-doc__field historia-doc__field--full">
                        <label for="tratamiento_odo">Tratamiento:</label>
                        <input type="text" id="tratamiento_odo" name="tratamiento" value="{{ old('tratamiento') }}" required>
                    </div>

                    <div class="dientes-block">
                        <div class="campo odontologia-section historia-doc__field historia-doc__field--full">
                            <label for="dientes">Seleccione el Diente Tratado (Solo Odontología):</label>

                            <input type="hidden" id="input_diente" name="dientes" value="{{ old('dientes') }}">

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
                            @error('dientes')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="submit-button historia-doc__actions">
                        <button type="submit" id="btnRegistroContinuar">Registrar Historia</button>
                    </div>

                </div>
            </div>
        </form>

        </div>
    @endif