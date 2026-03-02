<header class="main-header">
  <nav class="main-header__nav-start">
    <div class="main-header__nav">

      <!-- BOTÓN MENÚ -->
      <div class="main-header__menu ">
        <span class="main-header__icon-menu material-symbols-outlined">
          menu
        </span>
      </div>
    

      <!-- LOGO -->
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

<!-- ================= MENU LATERAL PACIENTE ================= -->


<aside  class="sidebar">

  <div class="close">
    &times;
  </div>
  <div class="sidebar__header">
    {{-- @auth
    <img src="{{ asset('storage/' . $path) }}" alt="Foto de Perfil">
    
      
    <span class="sidebar__name">{{ Auth::user()->nombre }}</span>
    @endauth --}}
    @auth
    @php
        $perfil = Auth::user()->perfil(); // Obtiene el perfil según el rol
        $foto = $perfil ? $perfil->foto : null;
    @endphp
    <img src="{{ asset('storage/' . $foto) }}" 
         alt="Foto de Perfil"
         onerror="this.style.display='none'">
    <span class="sidebar__name">{{ Auth::user()->nombre }}</span>
    @endauth
  </div>

  <nav class="sidebar__nav">
    <button class="sidebar__item active" data-view="inicio">
      <span class="material-symbols-outlined">home</span>
      Inicio
    </button>

    <button class="sidebar__item" data-view="historias">
      <span class="material-symbols-outlined">folder</span>
      Historias
    </button>

    <a href="{{ route('perfil') }}" style="text-decoration: none;">
      <button class="sidebar__item" data-view="perfil">
        <span class="material-symbols-outlined">person</span>
        Perfil
      </button>
    </a>
    @auth
   
  @php
        $user = auth()->user();
    @endphp

    @if($user->rol === 'paciente' && $user->paciente && $user->paciente->categoria === 'personal')
      <a href="{{ route('agregar-familiar') }}" style="text-decoration: none;">
        <button class="sidebar__item" data-view="solicitar">
            <span class="material-symbols-outlined">person</span>
            Agregar familiar
        </button>
        </a>
    @endif
@endauth
  </nav>

</aside>