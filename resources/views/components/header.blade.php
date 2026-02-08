@auth
    {{-- Usuario autenticado --}}
    @if(auth()->user()->role === 'medico')
        @include('components.headers.medico')
    @elseif(auth()->user()->role === 'paciente')
        @include('components.headers.paciente')
    @endif
@else
    {{-- Invitado (no autenticado) --}}
    @include('components.headers.guest')
@endauth