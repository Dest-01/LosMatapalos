<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview"  role="menu" data-accordion="false">
        <li class="nav-item">
            <router-link to="/admin/dashboard" data-widget="treeview" class="nav-link">
                <i class="nav-icon fas fa-home blue"></i>
                <p>
                    Inicio
                </p>
            </router-link>
        </li>


            <li class="nav-item">
                <router-link to="/admin/organizaciones" onclick="ocultarSideBar()" class="nav-link">
                    <i class="fa fa-users nav-icon blue"></i>
                    <p>Registro Organización</p>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link to="/admin/personas" onclick="ocultarSideBar()" class="nav-link">
                    <i class="fa fa-users nav-icon blue"></i>
                    <p>Registro Persona</p>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link to="/admin/grupos" onclick="ocultarSideBar()" class="nav-link">
                    <i class="fa fa-users nav-icon blue"></i>
                    <p>Registro Grupo</p>
                </router-link>
            </li>
        @can('isAdmin')
            <li class="nav-item">
                <router-link to="/admin/usuarios" onclick="ocultarSideBar()" class="nav-link">
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
                        <router-link to="/admin/donativos" onclick="ocultarSideBar()" class="nav-link">
                            <i class="nav-icon fas fa-boxes green"></i>
                            <p>
                                Registrar donativos
                            </p>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link to="/admin/Catdonativos" onclick="ocultarSideBar()" class="nav-link">
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
                        <router-link to="/admin/reservar" onclick="ocultarSideBar()" class="nav-link">
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
                        <router-link to="/admin/flora" onclick="ocultarSideBar()" class="nav-link">
                            <i class="nav-icon fas fa-seedling green"></i>
                            <p>
                                Flora
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/admin/fauna" onclick="ocultarSideBar()" class="nav-link">
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
                        <router-link to="/admin/voluntarioPersona" onclick="ocultarSideBar()" class="nav-link">
                            <i class="nav-icon fas fa-fist-raised orange"></i>
                            <p>
                                Voluntario Persona
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/admin/voluntarioEstudiante" onclick="ocultarSideBar()" class="nav-link">
                            <i class="nav-icon fas fa-handshake orange"></i>
                            <p>
                                Voluntariado Estudiante
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/admin/participantes" onclick="ocultarSideBar()" class="nav-link">
                            <i class="nav-icon fas fa-handshake orange"></i>
                            <p>
                                Participantes
                            </p>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link to="/admin/actividad" onclick="ocultarSideBar()" class="nav-link">
                            <i class="nav-icon fas fa-calendar-check orange"></i>
                            <p>
                                Actividades
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/admin/voluntarioActividad" onclick="ocultarSideBar()" class="nav-link">
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
                        <router-link to="/admin/repositorio" onclick="ocultarSideBar()" class="nav-link">
                            <i class="nav-icon fas fa-file-pdf gray"></i>
                            <p>
                                PDF
                            </p>
                        </router-link>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
              <router-link to="/admin/articulos" onclick="ocultarSideBar()" class="nav-link">
                  <i class="nav-icon fab fa-medium gray"></i>
                  <p>
                     Productos Marca
                  </p>
              </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/admin/eventos" onclick="ocultarSideBar()" class="nav-link">
                <i class="nav-icon fas fa-images gray"></i>
                <p>
                   Galeria Eventos
                </p>
            </router-link>
        </li>
        <li class="nav-item">
            <router-link to="/admin/reportes" onclick="ocultarSideBar()" class="nav-link">
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
