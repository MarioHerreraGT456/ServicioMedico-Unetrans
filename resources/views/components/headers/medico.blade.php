<header class="main-header">
  <nav class="main-header__nav-start">
    <div class="main-header__nav">

      <div class="main-header__menu desktop-only">
        <span class="main-header__icon-menu material-symbols-outlined">menu</span>
      </div>

      <div class="main-header__menu mobile-only">
        <span class="js-menu-trigger material-symbols-outlined" style="font-size: 35px; cursor: pointer;">menu</span>
      </div>

      <div class="main-header__logo">
        <img src="img/logo.jpg" alt="imagen de logo" class="main-header__img" onerror="this.style.display='none'"/>
      </div>

    </div>

    <ul class="main-header__list">
      <li class="main-header__item">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="button" class="main-header__link btn-logout" style="background: none; border: none; cursor: pointer;">
                Cerrar Sesión
            </button>
        </form>
      </li>
    </ul>
  </nav>
</header>

<aside id="sidebarMedico" class="sidebar">
  
  <div class="close">&times;</div>
  
 <div class="close">&times;</div>
  
  <div class="sidebar__header">
    @auth
    @php
        $user = auth()->user();
        $foto = $user->foto;
    @endphp

    @if($foto)
        <img src="{{ asset('storage/' . $foto) }}" 
            alt="Foto de Perfil"
            style="object-fit: cover;"
            onerror="this.style.display='none'">
    @else
        <img src="{{ asset('img/perfil.jpg') }}" 
            alt="Foto por defecto"
            style="object-fit: cover;">
    @endif

    <span class="sidebar__name">{{ $user->nombre }} {{ $user->apellido}}</span>
    @endauth
  </div>

  <nav class="sidebar__nav">

    <!-- SIEMPRE -->
    <a href="{{ route('medico.dashboard') }}" style="text-decoration: none;">
      <button class="sidebar__item" data-view="inicio">
        <span class="material-symbols-outlined">home</span>
        Inicio
      </button>
    </a>

    <a href="{{ route('perfil') }}" style="text-decoration: none;">
      <button class="sidebar__item" data-view="perfil">
        <span class="material-symbols-outlined">person</span>
        Perfil
      </button>
    </a>

    @php
        $cargo = $user->medico->cargo ?? null;
    
    @endphp
    <!-- MÉDICO NORMAL -->
    @if($cargo !== 'jefe' && $cargo !== 'asistente' && !auth('admin')->check())
    <a href="{{ route('consultas') }}" style="text-decoration: none;">
        <button class="sidebar__item" data-view="solicitar">
            <span class="material-symbols-outlined">search</span>
            Consultas
        </button>
    </a>

    <a href="{{ route('historias') }}" style="text-decoration: none;">
        <button class="sidebar__item" data-view="solicitar">
            <span class="material-symbols-outlined">description</span>
            Historias
        </button>
    </a>
    @endif

    <!-- ASISTENTE -->
    @if($cargo === 'asistente')
    <a href="{{ route('crear-consultas') }}" style="text-decoration: none;">
        <button class="sidebar__item" data-view="solicitar">
            <span class="material-symbols-outlined">assignment_add</span>
            Crear Consultas
        </button>
    </a>
    @endif
    
    <!-- MÉDICO NORMAL -->
    @if($cargo !== 'jefe' && $cargo !== 'asistente' && !auth('admin')->check())
    <a href="{{ route('crear-historias') }}" style="text-decoration: none;">
        <button class="sidebar__item" data-view="solicitar">
            <span class="material-symbols-outlined">note_add</span>
            Crear Historias
        </button>
    </a>
    @endif

    <!-- JEFE -->
    @if(($user->rol === 'medico' && $user->medico && $user->medico->cargo === 'jefe') || auth('admin')->check())
        <a href="{{ route('registrar-medico') }}" style="text-decoration: none;">
            <button class="sidebar__item" data-view="solicitar">
                <span class="material-symbols-outlined">group_add</span>
                Crear Médicos
            </button>
        </a>

        <a href="{{ route('usuarios.inactivar') }}" style="text-decoration: none;">
            <button class="sidebar__item" data-view="solicitar">
                <span class="material-symbols-outlined">block</span>
                Inactivar Cuentas
            </button>
        </a>
    @endif

    <div class="mobile-only" style="width: 100%; margin-top: 10px;">
        <form method="POST" action="{{ route('logout') }}" style="width: 100%;">
            @csrf
            <button type="button" class="btn-logout"
                style="width: 100%; justify-content: flex-start; background: #ffebee; color: #c62828;">
                <span class="material-symbols-outlined">logout</span>
                Cerrar Sesión
            </button>
        </form>
    </div>

  </nav>
</aside>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/cerrarSesion.js') }}"></script>