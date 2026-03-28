@extends('layouts.app')

@section('content')
    <!--<h2 class="title-form">Crear Historia</h2>-->
    
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

   <livewire:buscador-historias />

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
    <script src="js/antecendentes.js" defer></script>
@endsection