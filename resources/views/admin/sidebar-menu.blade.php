<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item">
        <router-link to="/dashboard" class="nav-link">
          <i class="nav-icon fas fa-home blue"></i>
          <p>
            Inicio
          </p>
        </router-link>
      </li>

      @can('isAdmin')
      <li class="nav-item">
        <router-link to="/admin/organizaciones" class="nav-link">
          <i class="fa fa-users nav-icon blue"></i>
          <p>Registro Organización</p>
        </router-link>
      </li>
    @endcan

      @can('isAdmin')
        <li class="nav-item">
          <router-link to="/admin/personas" class="nav-link">
            <i class="fa fa-users nav-icon blue"></i>
            <p>Registro Cliente</p>
          </router-link>
        </li>
      @endcan


      @can('isAdmin')
        <li class="nav-item">
          <router-link to="/users" class="nav-link">
            <i class="fa fa-users nav-icon blue"></i>
            <p>Usuarios</p>
          </router-link>
        </li>
      @endcan


      @can('isAdmin')
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-hand-holding-usd green"></i>
          <p>
            Donaciones
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">

 

          <li class="nav-item">
            <router-link to="/admin/donativos" class="nav-link">
              <i class="nav-icon fas fa-thumbtack green"></i>
              <p>
                Registrar donativos
              </p>
            </router-link>
          </li>
          
            <li class="nav-item">
              <router-link to="/admin/Catdonativos" class="nav-link">
                  <i class="nav-icon fas fa-thumbtack green"></i>
                  <p>
                      Categoria Donativos
                  </p>
              </router-link>
            </li>
        </ul>
      </li>

      @endcan

      
      @can('isAdmin')
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="nav-icon far fa-edit white"></i>
          <p>
            Reservas
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">

          <li class="nav-item">
            <router-link to="" class="nav-link">
              <i class="nav-icon fas fa-file-alt white"></i>
              <p>
                Reservar Organización
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/product/test" class="nav-link">
              <i class="nav-icon fas fa-file-alt white"></i>
              <p>
                Reservar Persona
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/product/tag" class="nav-link">
              <i class="nav-icon fas fa-file-alt white"></i>
              <p>
                Reservas
              </p>
            </router-link>
          </li>
        </ul>
      </li>
      @endcan


      @can('isAdmin')
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-hands-helping orange"></i>
          <p>
            Voluntario
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">

          <li class="nav-item">
            <router-link to="/product/category" class="nav-link">
              <i class="nav-icon fas fa-fist-raised orange"></i>
              <p>
                Actividad
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/product/test" class="nav-link">
              <i class="nav-icon fas fa-fist-raised orange"></i>
              <p>
                Voluntariado Persona
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/product/tag" class="nav-link">
              <i class="nav-icon fas fa-fist-raised orange"></i>
              <p>
                Voluntariado Organización
              </p>
            </router-link>
          </li>
        </ul>
      </li>
      @endcan


      

      @can('isAdmin')
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-cog green"></i>
          <p>
            Settings
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">

          <li class="nav-item">
            <router-link to="/product/category" class="nav-link">
              <i class="nav-icon fas fa-list-ol green"></i>
              <p>
                Category
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/product/test" class="nav-link">
              <i class="nav-icon fas fa-list-ol green"></i>
              <p>
                Test
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/product/tag" class="nav-link">
              <i class="nav-icon fas fa-tags green"></i>
              <p>
                Tags
              </p>
            </router-link>
          </li>
          
            <li class="nav-item">
              <router-link to="/developer" class="nav-link">
                  <i class="nav-icon fas fa-cogs white"></i>
                  <p>
                      Developer
                  </p>
              </router-link>
            </li>
        </ul>
      </li>

      @endcan
      
      

      <li class="nav-item">
        <a href="#" class="nav-link" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          <i class="nav-icon fas fa-power-off red"></i>
          <p>
            {{ __('Logout') }}
          </p>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </li>
    </ul>
  </nav>