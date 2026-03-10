@extends('layouts.app')

@section('content')
<main class="main-content">
    <div class="container-welcome">
        <h1>Historial de Consultas</h1>
    </div>

    {{-- MOSTRAR BUSCADOR SOLO A MÉDICOS --}}
    @if ($persona->rol === 'medico')
        <div class="container-search">
            <span class="container-search__icon material-symbols-outlined">search</span>
            <form method="GET" action="{{ route('consultas') }}" class="form-buscar">
                <input id="searchCedula" class="container-search__bar" type="text" name="buscar" placeholder="Buscar por cédula o nombre..." value="{{ $buscar }}">
                <button type="submit" class="container-search__btn">Buscar</button>
            </form>
        </div>

        {{-- Mensaje inicial para médico si no ha buscado --}}
        @if (!$buscar)
            <div id="mensajeBuscarPaciente" style="text-align: center; margin-top: 20px;">
                <span>Por favor, ingrese los datos para buscar un historial.</span>
            </div>
        @endif
    @endif

    {{-- LISTADO DE RESULTADOS --}}
    <div id="view-perfil" class="view" style="margin-top: 20px;">
        @forelse ($consultas as $consulta)
            <div class="card-consulta">
                <h2>Cédula Paciente: {{ $consulta->cedula }}</h2>
                <p><strong>Paciente:</strong> {{ $consulta->nombre }} {{ $consulta->apellido }}</p>
                <p><strong>Doctor:</strong> {{ $consulta->nombre_doctor }} </p>
                <p><strong>Fecha Consulta:</strong> {{ $consulta->fecha_consulta }}</p>
                <p><strong>Especialidad:</strong> {{ $consulta->especialidad }}</p>
                <p><strong>Motivo:</strong> {{ $consulta->motivo }}</p>
                <p><strong>Tratamiento:</strong> {{ $consulta->tratamiento }}</p>
            </div>
        @empty
            {{-- Si se buscó algo y no hay nada, o si el paciente no tiene historial --}}
            @if ($buscar || $persona->rol === 'paciente')
                <div class="alert-info" style="text-align: center;">
                    <span>No se encontraron registros de consultas.</span>
                </div>
            @endif
        @endforelse
    </div>
</main>
@endsection