@extends('layouts.app')

@section('content')
  
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
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif
    <!--<div class="container-search">
        <span class="container-search__icon material-symbols-outlined">
          search
        </span>
        <form method="GET" action="{{ route('medico.dashboard') }}" class="form-buscar">
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
    </div>-->
    <livewire:buscador-h-c />
    
    <script src="js/app.js" defer></script>
    @endsection
