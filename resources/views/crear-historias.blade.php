@extends('layouts.app')

@section('content')
    <h2 class="title-form">Registro Médico y Odontológico</h2>
    
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="selector-especialidad" style="margin-bottom: 20px;">
        <label for="tipo_historia"><strong>Seleccione el tipo de historia:</strong></label>
        <select id="tipo_historia" onchange="toggleFormularios()">
            <option value="general">Historia General</option>
            <option value="odontologia">Historia Odontológica</option>
        </select>
    </div>

    <form id="formGeneral" method="POST" action="{{ route('historias.store') }}" enctype="multipart/form-data">
        @csrf
        <h3>Datos - Historia General</h3>
        
        <div class="campo">
            <label for="nombre_gen">Nombre:</label>
            <input type="text" id="nombre_gen" name="nombre" value="{{ old('nombre') }}" required>
        </div>

        <div class="campo">
            <label for="apellido_gen">Apellido:</label>
            <input type="text" id="apellido_gen" name="apellido" value="{{ old('apellido') }}" required>
        </div>
      
        <div class="campo">
            <label for="cedula_gen">Cédula:</label>
            <div id="campoCedula_gen" style="display: flex; gap: 10px;">
                <select name="tipo" id="tipo_gen" style="width: 60px;">
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
            <label for="edad_gen">Edad:</label>
            <input type="number" id="edad_gen" name="edad" value="{{ old('edad') }}" required>
        </div>

       

        <div class="campo">
            <label for="direccion_gen">Dirección:</label>
            <input type="text" id="direccion_gen" name="direccion" value="{{ old('direccion') }}" required>
        </div>

        <div class="campo">
            <label for="telefono_gen">Teléfono:</label>
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

        <div class="campo">
            <button type="submit">Registrar Historia General</button>
        </div>
    </form>


    <form id="formOdontologia" method="POST" action="" enctype="multipart/form-data" style="display: none;">
        @csrf
        <h3>Datos - Historia Odontológica</h3>
        
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
            <div id="campoCedula_odo" style="display: flex; gap: 10px;">
                <select name="tipo" id="tipo_odo" style="width: 60px;">
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
            <label for="edad_odo">Edad:</label>
            <input type="number" id="edad_odo" name="edad" value="{{ old('edad') }}" required>
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
            <label for="telefono_odo">Teléfono:</label>
            <input type="tel" id="telefono_odo" name="telefono" value="{{ old('telefono') }}" pattern="^(\+58|0)(414|424|412|422|416|426)[0-9]{7}$" required>
        </div>

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
            <label for="diente_odo">Diente a tratar:</label>
            <select id="diente_odo" name="diente" required>
                <option value="18">18</option><option value="17">17</option><option value="16">16</option>
                <option value="15">15</option><option value="14">14</option><option value="13">13</option>
                <option value="12">12</option><option value="11">11</option><option value="21">21</option>
                <option value="22">22</option><option value="23">23</option><option value="25">25</option> <option value="26">26</option><option value="27">27</option><option value="28">28</option>
                <option value="38">38</option><option value="37">37</option><option value="36">36</option>
                <option value="35">35</option><option value="34">34</option><option value="33">33</option>
                <option value="32">32</option><option value="31">31</option><option value="41">41</option>
                <option value="42">42</option><option value="43">43</option><option value="44">44</option>
                <option value="45">45</option><option value="46">46</option><option value="47">47</option>
                <option value="48">48</option>
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

        <div class="campo">
            <button type="submit">Registrar Historia Odontológica</button>
        </div>
    </form>

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
    <script src="js/app.js" defer></script>
@endsection