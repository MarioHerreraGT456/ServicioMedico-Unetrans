@auth
    {{-- Usuario autenticado --}}
    @if(auth()->user()->rol === 'medico')
        @include('components.headers.medico')
    @elseif(auth()->user()->rol === 'paciente')
        @include('components.headers.paciente')
    @endif
@else
    {{-- Invitado (no autenticado) --}}
    @include('components.headers.guest')
@endauth