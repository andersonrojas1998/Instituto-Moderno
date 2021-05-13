<nav class="sidebar sidebar-offcanvas dynamic-active-class-disabled" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile not-navigation-link">
      <div class="nav-link">
        <div class="user-wrapper">
          <div class="profile-image">
            <img src="{{ url('images/user1.png') }}" alt="profile image">
          </div>
          <div class="text-wrapper">
            <p class="profile-name">{{Auth::user()->name }}</p>
            <div class="dropdown" data-display="static">
              <a href="#" class="nav-link d-flex user-switch-dropdown-toggler" id="UsersettingsDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <small class="designation text-muted">online</small>
                <span class="status-indicator online"></span>
              </a>
              <!--<div class="dropdown-menu" aria-labelledby="UsersettingsDropdown">
                <a class="dropdown-item p-0">
                  <div class="d-flex border-bottom">
                    <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                      <i class="mdi mdi-bookmark-plus-outline mr-0 text-gray"></i>
                    </div>
                    <div class="py-3 px-4 d-flex align-items-center justify-content-center border-left border-right">
                      <i class="mdi mdi-account-outline mr-0 text-gray"></i>
                    </div>
                    <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                      <i class="mdi mdi-alarm-check mr-0 text-gray"></i>
                    </div>
                  </div>
                </a>
                <a class="dropdown-item mt-2"> Manage Accounts </a>
                <a class="dropdown-item"> Change Password </a>
                <a class="dropdown-item"> Check Inbox </a>                                
              </div>-->
            </div>
          </div>
        </div>
        <!--<button class="btn btn-success btn-block">New Project <i class="mdi mdi-plus"></i>
        </button>-->
      </div>
    </li>


    <li class="nav-item {{ active_class(['basic-ui/*']) }}">
      <a class="nav-link" data-toggle="collapse" href="#mod-students" aria-expanded="{{ is_active_route(['basic-ui/*']) }}" aria-controls="basic-ui">
        <i class="menu-icon mdi mdi-account-card-details"></i>
        <span class="menu-title">Estudiantes</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ show_class(['basic-ui/*']) }}" id="mod-students">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item {{ active_class(['icons/material']) }}">            
            <a class="nav-link" href="{{ url('/Estudiantes/inicio') }}"><i class="menu-icon  mdi mdi-chevron-double-right"></i> Inicio</a>
          </li>          
        </ul>
      </div>
    </li>


    <li class="nav-item {{ active_class(['basic-ui/*']) }}">
      <a class="nav-link" data-toggle="collapse" href="#mod-teacher" aria-expanded="{{ is_active_route(['basic-ui/*']) }}" aria-controls="basic-ui">
        <i class="menu-icon mdi mdi-account-multiple"></i>
        <span class="menu-title">Docentes</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ show_class(['basic-ui/*']) }}" id="mod-teacher">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item {{ active_class(['icons/material']) }}">            
            <a class="nav-link" href="{{ url('/docentes/inicio') }}"><i class="menu-icon mdi mdi-chevron-double-right"></i> Inicio</a>
          </li>          
        </ul>
      </div>
    </li>
    <li class="nav-item {{ active_class(['basic-ui/*']) }}">
      <a class="nav-link" data-toggle="collapse" href="#mod-boletin" aria-expanded="{{ is_active_route(['basic-ui/*']) }}" aria-controls="basic-ui">
        <i class="menu-icon mdi mdi-buffer"></i>
        <span class="menu-title">Boletines</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ show_class(['basic-ui/*']) }}" id="mod-boletin">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item {{ active_class(['icons/material']) }}">            
            <a class="nav-link" href="{{ url('/Boletin/inicio') }}"><i class="menu-icon mdi mdi-chevron-double-right"></i> Inicio</a>
          </li>          
        </ul>
      </div>
    </li>
    <li class="nav-item {{ active_class(['basic-ui/*']) }}">
      <a class="nav-link" data-toggle="collapse" href="#mod-calificacion" aria-expanded="{{ is_active_route(['basic-ui/*']) }}" aria-controls="basic-ui">
        <i class="menu-icon mdi mdi-dna"></i>
        <span class="menu-title">Calificaciones</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ show_class(['basic-ui/*']) }}" id="mod-calificacion">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item {{ active_class(['icons/material']) }}">            
            <a class="nav-link" href="{{ url('/Calificaciones/inicio') }}"><i class="menu-icon mdi mdi-chevron-double-right"></i> Inicio</a>
          </li>                    
          <li class="nav-item {{ active_class(['icons/material']) }}">            
            <a class="nav-link" href="{{ url('/Calificaciones/formato-excel') }}"><i class="menu-icon mdi mdi-chevron-double-right"></i> Importar Excel</a>
          </li>
          <li class="nav-item {{ active_class(['icons/material']) }}">            
            <a class="nav-link" href="{{ url('/Calificaciones/resumen') }}"><i class="menu-icon mdi mdi-chevron-double-right"></i>Resumen Por Grados</a>
          </li>
          <li class="nav-item {{ active_class(['icons/material']) }}">            
            <a class="nav-link" href="{{ url('/Calificaciones/Puntuacion-promedio') }}"><i class="menu-icon mdi mdi-chevron-double-right"></i>Puntuaci&oacute;n y Promedio</a>
          </li>
        </ul>
      </div>
    </li>
    
    <li class="nav-item {{ active_class(['basic-ui/*']) }}">
      <a class="nav-link" data-toggle="collapse" href="#mod-categoria" aria-expanded="{{ is_active_route(['basic-ui/*']) }}" aria-controls="basic-ui">
        <i class="menu-icon mdi mdi-brightness-7"></i>
        <span class="menu-title">Parametrizaci&oacute;n</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ show_class(['basic-ui/*']) }}" id="mod-categoria">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item {{ active_class(['icons/material']) }}">            
            <a class="nav-link" href="{{ url('/grados/inicio') }}"><i class="menu-icon mdi mdi-numeric"></i> Grados</a>
          </li>          
          <li class="nav-item {{ active_class(['icons/material']) }}">            
            <a class="nav-link" href="{{ url('/materias/inicio') }}"><i class="menu-icon  mdi mdi-puzzle"></i>Materias</a>
          </li>          
        </ul>
      </div>
    </li>

    <!--<li class="nav-item {{ active_class(['/']) }}">
      <a class="nav-link" href="{{ url('/') }}">
        <i class="menu-icon mdi mdi-chevron-double-right"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>-->
   <!-- <li class="nav-item {{ active_class(['basic-ui/*']) }}">
      <a class="nav-link" data-toggle="collapse" href="#basic-ui" aria-expanded="{{ is_active_route(['basic-ui/*']) }}" aria-controls="basic-ui">
        <i class="menu-icon mdi mdi-dna"></i>
        <span class="menu-title">Basic UI Elements</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ show_class(['basic-ui/*']) }}" id="basic-ui">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item {{ active_class(['basic-ui/buttons']) }}">
            <a class="nav-link" href="{{ url('/basic-ui/buttons') }}">Buttons</a>
          </li>
          <li class="nav-item {{ active_class(['basic-ui/dropdowns']) }}">
            <a class="nav-link" href="{{ url('/basic-ui/dropdowns') }}">Dropdowns</a>
          </li>
          <li class="nav-item {{ active_class(['basic-ui/typography']) }}">
            <a class="nav-link" href="{{ url('/basic-ui/typography') }}">Typography</a>
          </li>
        </ul>
      </div>
    </li>

    <li class="nav-item {{ active_class(['charts/chartjs']) }}">
      <a class="nav-link" href="{{ url('/charts/chartjs') }}">
        <i class="menu-icon mdi mdi-chart-line"></i>
        <span class="menu-title">Charts</span>
      </a>
    </li>
    <li class="nav-item {{ active_class(['tables/basic-table']) }}">
      <a class="nav-link" href="{{ url('/tables/basic-table') }}">
        <i class="menu-icon mdi mdi-table-large"></i>
        <span class="menu-title">Tables</span>
      </a>
    </li>
    <li class="nav-item {{ active_class(['icons/material']) }}">
      <a class="nav-link" href="{{ url('/icons/material') }}">
        <i class="menu-icon mdi mdi-emoticon"></i>
        <span class="menu-title">Icons</span>
      </a>
    </li>
    <li class="nav-item {{ active_class(['user-pages/*']) }}">
      <a class="nav-link" data-toggle="collapse" href="#user-pages" aria-expanded="{{ is_active_route(['user-pages/*']) }}" aria-controls="user-pages">
        <i class="menu-icon mdi mdi-lock-outline"></i>
        <span class="menu-title">User Pages</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ show_class(['user-pages/*']) }}" id="user-pages">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item {{ active_class(['user-pages/login']) }}">
            <a class="nav-link" href="{{ url('/user-pages/login') }}">Login</a>
          </li>
          <li class="nav-item {{ active_class(['user-pages/register']) }}">
            <a class="nav-link" href="{{ url('/user-pages/register') }}">Register</a>
          </li>
          <li class="nav-item {{ active_class(['user-pages/lock-screen']) }}">
            <a class="nav-link" href="{{ url('/user-pages/lock-screen') }}">Lock Screen</a>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="https://www.bootstrapdash.com/demo/star-laravel-free/documentation/documentation.html" target="_blank">
        <i class="menu-icon mdi mdi-file-outline"></i>
        <span class="menu-title">Documentation</span>
      </a>
    </li>-->
  </ul>
</nav>