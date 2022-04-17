<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <router-link to="/admin/dashboard" data-widget="pushmenu" class="nav-link">
                <i class="nav-icon fas fa-home blue"></i>
                <p>
                    Inicio
                </p>
            </router-link>
        </li>


            <li class="nav-item">
                <router-link to="/admin/organizaciones" data-widget="pushmenu" class="nav-link">
                    <i class="fa fa-users nav-icon blue"></i>
                    <p>Registro Organización</p>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link to="/admin/personas" data-widget="pushmenu" class="nav-link">
                    <i class="fa fa-users nav-icon blue"></i>
                    <p>Registro Persona</p>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link to="/admin/grupos" data-widget="pushmenu" class="nav-link">
                    <i class="fa fa-users nav-icon blue"></i>
                    <p>Registro Grupo</p>
                </router-link>
            </li>
        @can('isAdmin')
            <li class="nav-item">
                <router-link to="/admin/usuarios" data-widget="pushmenu" class="nav-link">
                    <i class="fa fa-users nav-icon blue"></i>
                    <p>Usuarios</p>
                </router-link>
            </li>
           <!-- <li class="nav-item">
                <router-link to="/developer" class="nav-link">
                    <i class="nav-icon fas fa-cogs dark blue"></i>
                    <p>
                        Desarrolladores
                    </p>
                </router-link>
            </li>
            -->
        @endcan

            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-people-carry green"></i>
                    <p>
                        Donaciones
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">



                    <li class="nav-item">
                        <router-link to="/admin/donativos" data-widget="pushmenu" class="nav-link">
                            <i class="nav-icon fas fa-boxes green"></i>
                            <p>
                                Registrar donativos
                            </p>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link to="/admin/Catdonativos" data-widget="pushmenu" class="nav-link">
                            <i class="nav-icon fas fa-thumbtack green"></i>
                            <p>
                                Donativos necesarios
                            </p>
                        </router-link>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon far fa-edit green"></i>
                    <p>
                        Reservas
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <router-link to="/admin/reservar" data-widget="pushmenu" class="nav-link">
                            <i class="nav-icon fas fa-file-alt green"></i>
                            <p>
                                Reservas
                            </p>
                        </router-link>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-leaf green"></i>
                    <p>
                        Biodiversidad
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">

                    <li class="nav-item">
                        <router-link to="/admin/flora" data-widget="pushmenu" class="nav-link">
                            <i class="nav-icon fas fa-seedling green"></i>
                            <p>
                                Flora
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/admin/fauna" data-widget="pushmenu" class="nav-link">
                            <i class="nav-icon fas fa-dove green"></i>
                            <p>
                                Fauna
                            </p>
                        </router-link>
                    </li>
                </ul>

            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-hands-helping orange"></i>
                    <p>
                        Voluntariado
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">

                    <li class="nav-item">
                        <router-link to="/admin/voluntarioPersona" data-widget="pushmenu" class="nav-link">
                            <i class="nav-icon fas fa-fist-raised orange"></i>
                            <p>
                                Voluntario Persona
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/admin/voluntarioEstudiante" data-widget="pushmenu" class="nav-link">
                            <i class="nav-icon fas fa-handshake orange"></i>
                            <p>
                                Voluntariado Estudiante
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/admin/participantes" data-widget="pushmenu" class="nav-link">
                            <i class="nav-icon fas fa-handshake orange"></i>
                            <p>
                                Participantes
                            </p>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link to="/admin/actividad" data-widget="pushmenu" class="nav-link">
                            <i class="nav-icon fas fa-calendar-check orange"></i>
                            <p>
                                Actividades
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/admin/voluntarioActividad" data-widget="pushmenu" class="nav-link">
                            <i class="nav-icon fas fa-calendar-check orange"></i>
                            <p>
                                Voluntario actividad
                            </p>
                        </router-link>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-archive gray"></i>
                    <p>
                        Repositorio
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">

                    <li class="nav-item">
                        <router-link to="/admin/repositorio" data-widget="pushmenu" class="nav-link">
                            <i class="nav-icon fas fa-file-pdf gray"></i>
                            <p>
                                PDF
                            </p>
                        </router-link>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
              <router-link to="/admin/articulos" data-widget="pushmenu" class="nav-link">
                  <i class="nav-icon fab fa-medium gray"></i>
                  <p>
                     Productos Marca
                  </p>
              </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/admin/eventos" data-widget="pushmenu" class="nav-link">
                <i class="nav-icon fas fa-images gray"></i>
                <p>
                   Galeria Eventos
                </p>
            </router-link>
        </li>
        <li class="nav-item">
            <router-link to="/admin/reportes" data-widget="pushmenu" class="nav-link">
                <i class="nav-icon fas fa-print white"></i>
                <p>
                   Generar Reportes
                </p>
            </router-link>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
                <i class="nav-icon fas fa-power-off red"></i>
                <p>
                    {{ __('Salir') }}
                </p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</nav>
