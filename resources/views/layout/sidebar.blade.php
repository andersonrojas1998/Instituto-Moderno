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
            </div>
          </div>
        </div>        
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
      <a class="nav-link" data-toggle="collapse" href="#mod-matriculas" aria-expanded="{{ is_active_route(['basic-ui/*']) }}" aria-controls="basic-ui">
        <i class="menu-icon mdi mdi-format-list-bulleted-type"></i>
        <span class="menu-title">Matriculas</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ show_class(['basic-ui/*']) }}" id="mod-matriculas">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item {{ active_class(['icons/material']) }}">            
            <a class="nav-link" href="{{ url('/matricula/inicio') }}"><i class="menu-icon  mdi mdi-chevron-double-right"></i> Inicio</a>
          </li>          
        </ul>
        <ul class="nav flex-column sub-menu">
          <li class="nav-item {{ active_class(['icons/material']) }}">            
            <a class="nav-link" href="{{ url('/matricula/creacion') }}"><i class="menu-icon  mdi mdi-chevron-double-right"></i> Creacion</a>
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
        <ul class="nav flex-column sub-menu">
          <li class="nav-item {{ active_class(['icons/material']) }}">            
            <a class="nav-link" href="{{ url('/docentes/creacion') }}"><i class="menu-icon mdi mdi-chevron-double-right"></i> Creaci&oacute;n</a>
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
            <a class="nav-link" href="{{ url('/Boletin/inicio') }}"><i class="menu-icon mdi mdi-fax"></i> Inicio</a>
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
      <a class="nav-link" data-toggle="collapse" href="#mod-certificate" aria-expanded="{{ is_active_route(['basic-ui/*']) }}" aria-controls="basic-ui">
        <i class="menu-icon mdi mdi-certificate"></i>
        <span class="menu-title">Certificados</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ show_class(['basic-ui/*']) }}" id="mod-certificate">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item {{ active_class(['icons/material']) }}">            
            <a class="nav-link" href="{{ url('/certificado/inicio') }}"><i class="menu-icon mdi mdi-fax"></i> Inicio</a>
          </li>
        </ul>
      </div>
    </li>

    <li class="nav-item {{ active_class(['basic-ui/*']) }}">
      <a class="nav-link" data-toggle="collapse" href="#mod-constancia" aria-expanded="{{ is_active_route(['basic-ui/*']) }}" aria-controls="basic-ui">
        <i class="menu-icon mdi mdi-checkbox-multiple-marked"></i>
        <span class="menu-title">Constancias</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ show_class(['basic-ui/*']) }}" id="mod-constancia">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item {{ active_class(['icons/material']) }}">            
            <a class="nav-link" href="{{ url('/constancia/inicio') }}"><i class="menu-icon mdi mdi-fax"></i> Inicio</a>
          </li>
        </ul>
      </div>
    </li>

    <!--<li class="nav-item {{ active_class(['basic-ui/*']) }}">
      <a class="nav-link" data-toggle="collapse" href="#mod-book" aria-expanded="{{ is_active_route(['basic-ui/*']) }}" aria-controls="basic-ui">
        <i class="menu-icon mdi mdi-book-open-page-variant"></i>
        <span class="menu-title">Libro Calificador</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ show_class(['basic-ui/*']) }}" id="mod-book">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item {{ active_class(['icons/material']) }}">            
            <a class="nav-link" href="{{ url('/grados/inicio') }}"><i class="menu-icon mdi mdi-fax"></i> Inicio</a>
          </li>
        </ul>
      </div>
    </li> -->
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

  </ul>
</nav>