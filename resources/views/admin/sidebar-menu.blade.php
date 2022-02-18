<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <router-link to="/admin/dashboard" class="nav-link">
                <i class="nav-icon fas fa-home blue"></i>
                <p>
                    Inicio
                </p>
            </router-link>
        </li>


            <li class="nav-item">
                <router-link to="/admin/organizaciones" class="nav-link">
                    <i class="fa fa-users nav-icon blue"></i>
                    <p>Registro Organización</p>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link to="/admin/personas" class="nav-link">
                    <i class="fa fa-users nav-icon blue"></i>
                    <p>Registro Cliente</p>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link to="/admin/grupos" class="nav-link">
                    <i class="fa fa-users nav-icon blue"></i>
                    <p>Registro Grupo</p>
                </router-link>
            </li>
        @can('isAdmin')
            <li class="nav-item">
                <router-link to="/admin/usuarios" class="nav-link">
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
                        <router-link to="/admin/donativos" class="nav-link">
                            <i class="nav-icon fas fa-boxes green"></i>
                            <p>
                                Registrar donativos
                            </p>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link to="/admin/Catdonativos" class="nav-link">
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
                        <router-link to="/admin/reservar" class="nav-link">
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
                        <router-link to="/admin/flora" class="nav-link">
                            <i class="nav-icon fas fa-seedling green"></i>
                            <p>
                                Flora
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/admin/fauna" class="nav-link">
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
                        <router-link to="/admin/voluntarioPersona" class="nav-link">
                            <i class="nav-icon fas fa-fist-raised orange"></i>
                            <p>
                                Voluntario Persona
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/admin/voluntarioEstudiante" class="nav-link">
                            <i class="nav-icon fas fa-handshake orange"></i>
                            <p>
                                Voluntariado Estudiante
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/admin/participantes" class="nav-link">
                            <i class="nav-icon fas fa-handshake orange"></i>
                            <p>
                                Participantes
                            </p>
                        </router-link>
                    </li>
                    <!--
              <li class="nav-item">
                <router-link to="/admin/voluntario" class="nav-link">
                  <i class="nav-icon fas fa-fist-raised orange"></i>
                  <p>
                    Voluntariado
                  </p>
                </router-link>
              </li> -->
                    <li class="nav-item">
                        <router-link to="/admin/actividad" class="nav-link">
                            <i class="nav-icon fas fa-calendar-check orange"></i>
                            <p>
                                Actividades
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/admin/voluntarioActividad" class="nav-link">
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
                        <router-link to="/admin/repositorio" class="nav-link">
                            <i class="nav-icon fas fa-file-pdf gray"></i>
                            <p>
                                PDF
                            </p>
                        </router-link>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-clipboard white"></i>
                    <p>
                        Reportes
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">

                    <li class="nav-item">
                        <router-link to="/admin/reportes" class="nav-link">
                            <i class="nav-icon fas fa-print white"></i>
                            <p>
                                Consultar Reporte
                            </p>
                        </router-link>
                    </li>

                </ul>
            </li>
            <li class="nav-item">
              <router-link to="/admin/articulos" class="nav-link">
                  <i class="nav-icon fas fa-file-word gray"></i>
                  <p>
                     Marca
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
