<header class="main-header">
  <nav class="main-header__nav-start">
    <div class="main-header__nav">

      <div class="main-header__menu">
        <span class="main-header__icon-menu material-symbols-outlined">
          menu
        </span>
      </div>

      <div class="main-header__logo">
        <img src="img/logo.png"
             alt="imagen de logo"
             class="main-header__img"
             onerror="this.style.display='none'"/>
      </div>

    </div>

    <ul class="main-header__list">
      <li class="main-header__item">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="main-header__link">Cerrar Sesión</button>
        </form>
        {{-- <a class="main-header__link" href="{{ route('logout') }}" id="logoutHeader">
          Cerrar Sesión
        </a> --}}
      </li>
    </ul>
  </nav>
</header>

<!-- ================= MENU LATERAL MÉDICO ================= -->
<aside id="sidebarMedico" class="sidebar">
  <div class="close">
    &times;
  </div>

  <div class="sidebar__header">
     @auth
    @php
        $perfil = Auth::user()->perfil(); // Obtiene el perfil según el rol
        $foto = $perfil ? $perfil->foto : null;
    @endphp
    <img src="{{ asset('storage/' . $foto) }}" 
         alt="Foto de Perfil"
         onerror="this.style.display='none'">
    <span class="sidebar__name">{{ Auth::user()->nombre }}</span>


  </div>

  <nav class="sidebar__nav">

    <button class="sidebar__item active" data-view="inicio">
      <span class="material-symbols-outlined">home</span>
      Inicio
    </button>

    <a href="{{ route('perfil') }}" style="text-decoration: none;">
      <button class="sidebar__item" data-view="perfil">
        <span class="material-symbols-outlined">person</span>
        Perfil
      </button>
    </a>

    <button class="sidebar__item" data-view="consultas">
      <span class="material-symbols-outlined">search</span>
      Consultas
    </button>

    <button class="sidebar__item" data-view="historial">
      <span class="material-symbols-outlined">folder</span>
      Historial
    </button>

    <button class="sidebar__item" data-view="estadisticas">
      <span class="material-symbols-outlined">bar_chart</span>
      Estadísticas
    </button>

    <a href="{{ route('crear-consultas') }}" style="text-decoration: none;">
        <button class="sidebar__item" data-view="solicitar">
            <span class="material-symbols-outlined">person</span>
            Crear Consultas
        </button>
    </a>
    @php
        $user = auth()->user();
    @endphp

    @if($user->rol === 'medico' && $user->medico && $user->medico->cargo === 'jefe')

        <a href="{{ route('registrar-medico') }}" style="text-decoration: none;">
        <button class="sidebar__item" data-view="solicitar">
            <span class="material-symbols-outlined">person</span>
            Crear Médicos
        </button>
        </a>
    @endif
    @endauth

  </nav>

</aside>