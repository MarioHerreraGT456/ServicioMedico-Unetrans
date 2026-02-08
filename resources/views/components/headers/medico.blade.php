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

  <div class="sidebar__header">
    <img src="img/perfil.jpg" alt="Perfil">
    <span class="sidebar__name">Médico</span>
  </div>

  <nav class="sidebar__nav">

    <button class="sidebar__item active" data-view="inicio">
      <span class="material-symbols-outlined">home</span>
      Inicio
    </button>

    <button class="sidebar__item" data-view="perfil">
      <span class="material-symbols-outlined">person</span>
      Perfil
    </button>

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

  </nav>

</aside>