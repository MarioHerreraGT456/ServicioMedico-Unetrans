@extends('layouts.app')

@section('content')
<main class="main-content">
    <div class="container-welcome">
      <h1>Historial de Consultas</h1>
    </div>
     <div class="container-search">
        <!--ESTA ES LA BARRA DE BUSQUEDA-->
        <span class="container-search__icon material-symbols-outlined">
          search
        </span>
        <form method="GET" action="{{ route('consultas') }}" class="form-buscar">
          @csrf
        <input
          id="searchCedula"
          class="container-search__bar"
          type="text"
          name="buscar"
          placeholder="Ingresar Datos"
        />

        <button id="btnBuscarPaciente" class="container-search__btn">
          Buscar
        </button>
        </form>
    </div>
     {{-- resultado de la busqueda --}}
    <div id="view-perfil" class="view">
        {{-- mensaje sino hay busqueda --}}
       @if (!request('buscar'))
      <div class="" id="mensajeBuscarPaciente">
        <span>Por favor, ingresar la cédula del paciente</span>
      </div>
      @endif
     
        {{-- resultado de la busqueda --}}
        @foreach ($consultas as $consulta)
          <div class="card-consulta">
              <h2>Cedula Paciente: {{ $consulta->cedula }}</h2>
              <p><strong>Paciente:</strong> {{ $consulta->nombre }} {{ $consulta->apellido }}</p>
              <p><strong>Doctor:</strong> {{ $consulta->nombre_doctor }} </p>
              <p><strong>Fecha Consulta:</strong> {{ $consulta->fecha_consulta }}</p>
              <p><strong>Fecha Nacimiento:</strong> {{ $consulta->fecha_nacimiento }}</p>

              <p><strong>Especialidad:</strong> {{ $consulta->especialidad }}</p>
              <p><strong>Motivo:</strong> {{ $consulta->motivo }}</p>
              <p><strong>TA:</strong> {{ $consulta->TA }}</p>
              <p><strong>Tratamiento:</strong> {{ $consulta->tratamiento }}</p>
          </div>
      @endforeach
    </div>
    @if ($consultas->isEmpty() )
      <div class="card-consulta">
          <h2>No se encontraron resultados para la cédula: {{ request('buscar') }}</h2>
      </div>
      @endif
      
</main>

@endsection