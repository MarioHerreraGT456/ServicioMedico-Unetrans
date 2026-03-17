<form id="formRegistroConsulta" method="POST" action="{{ route('consultas.store') }}" enctype="multipart/form-data">
      @csrf


       
        <div class="campo">
            <label for="cedula">Cédula:</label>
            <div id="campoCedula">
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
       <div class="campo hidden">
            <label for="cedula">Cédula:</label>
            
            <input type="text" name="cedula" wire:model="cedula" required>
        </div>

        <div class="campo">
            <label for="nombre">Primer Nombre:</label>
            <input type="text" name="nombre" wire:model="nombre" required>
        </div>

        <div class="campo">
            <label for="nombre2">Segundo Nombre:</label>
            <input type="text" name="nombre2" wire:model="nombre2">
        </div>

        <div class="campo">
            <label for="apellido">Primer Apellido:</label>
            <input type="text" name="apellido" wire:model="apellido" required>
        </div>
        
        <div class="campo">
            <label for="apellido2">Segundo Apellido:</label>
            <input type="text" name="apellido2" wire:model="apellido2" required>
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
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" wire:model="fecha_nacimiento" required>
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
            <input type="text" id="sexo" name="sexo" wire:model="sexo" required>
            @error('sexo')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>

        <div class="campo">
            <label for="especialidad">Especialidad:</label>
            <select id="especialidad" name="especialidad" required>
                <option value="general" {{ old('especialidad') == 'general' ? 'selected' : '' }}>Medicina General</option>
                <option value="odontologia" {{ old('especialidad') == 'odontologia' ? 'selected' : '' }}>Odontología</option>
                <option value="psiquiatria" {{ old('especialidad') == 'psiquiatria' ? 'selected' : '' }}>Psiquiatría</option>    
                 <option value="fisiatria" {{ old('especialidad') == 'fisiatria' ? 'selected' : '' }}>Fisiatria</option>  
                <option value="traumatologia" {{ old('especialidad') == 'traumatologia' ? 'selected' : '' }}>Traumatología</option>  

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