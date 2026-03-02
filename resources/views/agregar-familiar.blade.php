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

    <form id="formRegistroPersonal" method="POST" action="{{ route('personal.store') }}" enctype="multipart/form-data">
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
            <label for="cedula">Cédula del familiar:</label>
            <div id="campoCedula">
                <label for="tipo" class="hidden">Tipo:</label>
                <select name="tipo" id="tipo">
                    <option value="V" {{ old('tipo') == 'V' ? 'selected' : '' }}>V</option>
                    <option value="E" {{ old('tipo') == 'E' ? 'selected' : '' }}>E</option>
                </select>
                <input type="text" id="cedula" name="cedula" value="{{ old('cedula') }}"
                       title="Formato válido: V12345678, E12345678" placeholder="12345678" required>
            </div>
            @error('cedula')
                <span class="error-message">Dato inválido</span>
            @enderror
            @error('tipo')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>

        @auth
            @php
                $perfil = Auth::user()->perfil();
                $cedula_titular = $perfil ? $perfil->cedula : null;
            @endphp
            <input type="hidden" name="cedula2" value="{{ old('cedula2', $cedula_titular) }}">
        @endauth

        <div class="campo">
            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" value="{{ old('direccion') }}" required>
            @error('direccion')
                <span class="error-message">Dato inválido</span>
            @enderror
        </div>

        <div class="campo">
            <label for="telefono">Teléfono:</label>
            <input type="tel" id="telefono" name="telefono" value="{{ old('telefono') }}"
                   placeholder="04141234567 o +584141234567"
                   pattern="^(\+58|0)(414|424|412|422|416|426)[0-9]{7}$"
                   title="Formato válido: +584121234567 o 014121234567" required>
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
                <option value="Masculino" {{ old('sexo') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                <option value="Femenino" {{ old('sexo') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
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
            <button type="submit" id="btnRegistroContinuar">Registrar</button>
        </div>
    </form>
    <script src="js/app.js" defer></script>
@endsection