@extends('layouts.app')

@section('content')
<main class="main-content">
    <div class="container-welcome">
        <h1>Historial de Consultas</h1>
    </div>
  @if ($persona->rol === 'medico')
    <div class="container-search" style="margin-bottom: 20px;">
        <span class="container-search__icon material-symbols-outlined">search</span>
        <form method="GET" action="{{ route('historias') }}" class="form-buscar">
            <input class="container-search__bar" type="text" name="buscar" placeholder="Cédula o nombre..." value="{{ $buscar }}">
            <button type="submit" class="container-search__btn">Buscar</button>
        </form>
    </div>
@endif

    <div id="view-perfil" class="view">
        @foreach($consultas as $consulta)
    <div class="card-consulta">
        <h3>{{ $consulta->nombre }} {{ $consulta->apellido }} ({{ $consulta->especialidad }})</h3>
        
        <div class="info-grid">
            <p><strong>Cédula:</strong> {{ $consulta->tipo }}-{{ $consulta->cedula }}</p>
            <p><strong>Teléfono:</strong> {{ $consulta->telefono }}</p>
            <p><strong>Sexo:</strong> {{ $consulta->sexo }}</p>
            <p><strong>Dirección:</strong> {{ $consulta->direccion }}</p>
            <p><strong>Fecha de Nacimiento:</strong> {{ $consulta->fecha_nacimiento }}</p>
            
            <p><strong>Enfermedad:</strong> {{ $consulta->enfermedad }}</p>
            <p><strong>Motivo:</strong> {{ $consulta->motivo_consulta }}</p>
            <p><strong>Antecedentes Familiares:</strong> {{ $consulta->antecedentes_familiares }}</p>


            
        </div>

        {{-- Campos específicos que ahora sí llegan --}}
        @if($consulta->especialidad === 'Odontología')
            <div class="dental-info" style="background: #f0f7ff; padding: 10px; margin-top: 10px;">
                <p><strong>🦷 Diente:</strong> {{ $consulta->diente }}</p>
                <p><strong>Examen Bucal:</strong> {{ $consulta->examen }}</p>
             
            </div>
        @endif

        <p><strong>Antecedentes Personales:</strong> {{ $consulta->antecedentes_personales }}</p>
        <p><strong>Tratamiento:</strong> {{ $consulta->tratamiento }}</p>
    </div>
@endforeach
    </div>
</main>
@endsection