<header class="main-header">
  <nav class="main-header__nav" style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
    <div class="main-header__logo">
      <img alt="imagen de logo" class="main-header__img" onerror="this.style.display='none'" src="img/logo.png"/>
    </div>
    
    <ul class="main-header__list">
      <li class="main-header__item"> <a class="main-header__link" href="{{ url('/') }}">Sobre Nosotros</a> </li>
      <li class="main-header__item"> <a class="main-header__link" href="{{ route('register') }}">Registrarse</a> </li>
      <li class="main-header__item"> <a class="main-header__link" href="{{ route('login') }}">Iniciar Sesión</a> </li>
    </ul>

    <span class="main-header__icon-menu js-menu-trigger material-symbols-outlined mobile-only">
      menu
    </span>
  </nav>

  <div class="sidebar" style="display: none;">
    <div class="close">&times;</div>
    <div class="sidebar__header">
      <nav class="sidebar_nav">
        <ul class="main-header__list" style="display: flex !important; flex-direction: column; padding: 0; list-style: none; gap: 10px;">
          <li class="main-header__item"> <a class="sidebar_item" href="{{ url('/') }}">Sobre Nosotros</a> </li>
          <li class="main-header__item"> <a class="sidebar_item" href="{{ route('register') }}">Registrarse</a> </li>
          <li class="main-header__item"> <a class="sidebar_item" href="{{ route('login') }}">Iniciar Sesión</a> </li>
        </ul>
      </nav>
    </div>
  </div>
</header>