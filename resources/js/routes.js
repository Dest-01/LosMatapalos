/*IMPORTAN LOS DE ADMIN*/
import Personas from './components/admin/Personas.vue'
import Organizaciones from './components/admin/Organizaciones.vue'
import Grupos from './components/admin/Grupos.vue'
import DonativosAdmin from './components/admin/Donativos.vue'
import CatDonativos from './components/admin/CatDonativos.vue'
import Voluntario from './components/admin/Voluntario.vue'
import VoluntarioPersona from './components/admin/VoluntarioPersona.vue'
import VoluntarioEstudiante from './components/admin/VoluntarioEstudiante.vue'
import ActividadesAdmin from './components/admin/Actividades.vue'
import ActividadesParticipantes from './components/admin/ActividadesParticipantes.vue'
import Participantes from './components/admin/Participantes.vue'
import ReservacionAdmin from './components/admin/Reservar.vue'
import VoluntarioActividad from './components/admin/VoluntarioActividad'
import FaunaAdmin from './components/admin/Fauna'
import FloraAdmin from './components/admin/flora.vue'
import Articulos from './components/admin/Articulos.vue'
import Reportes from './components/admin/Reportes1.vue'
import RepositorioAdmin from './components/admin/RepositorioDocumental.vue'
import Dashboard from './components/admin/Dashboard.vue'
import Perfil from './components/admin/Perfil.vue'
import Usuarios from './components/admin/Usuarios.vue'
import EventosAdmin from './components/admin/Eventos.vue'

/*IMPORTAN LOS DE CLIENTE*/
import App from './components/layouts/App.vue'
import NotFound from './components/views/NotFound.vue'

import Home from './components/cliente/Home.vue'
import Reservacion from './components/cliente/Reservar.vue'
import Donacion from './components/cliente/Donaciones.vue'
import Fauna from './components/cliente/Fauna.vue'
import Flora from './components/cliente/Flora.vue'
import Repositorio from './components/cliente/Repositorio.vue'
import Marca from './components/cliente/Productos.vue'
import AcercaDe from './components/cliente/AboutUs.vue'
import Eventos from './components/cliente/Eventos.vue'




export default [
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //--------------------------------------------------RUTAS ADMIN------------------------------------------------
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    {
        path: '/admin/personas',
        component: Personas
    },
    {
        path: '/admin/organizaciones',
        component: Organizaciones
    },
    {
        path: '/admin/grupos',
        component: Grupos
    },
    {
        path: '/admin/donativos',
        component: DonativosAdmin
    },
    {
        path: '/admin/Catdonativos',
        component: CatDonativos
    },
    {
        path: '/admin/voluntario',
        component: Voluntario
    },
    {
        path: '/admin/voluntarioPersona',
        component: VoluntarioPersona
    },
    {
        path: '/admin/voluntarioEstudiante',
        component: VoluntarioEstudiante
    },
    {
        path: '/admin/actividad',
        component: ActividadesAdmin
    },
    {
        path: '/admin/actividadParticipantes',
        component: ActividadesParticipantes
    },
    {
        path: '/admin/participantes',
        component: Participantes
    },
    {
        path: '/admin/reservar',
        component: ReservacionAdmin
    },
    {
        path: '/admin/voluntarioActividad',
        component: VoluntarioActividad
    },
    {
        path: '/admin/fauna',
        component: FaunaAdmin
    },
    {
        path: '/admin/flora',
        component: FloraAdmin
    },
    {
        path: '/admin/articulos',
        component: Articulos
    },
    {
        path: '/admin/reportes',
        component: Reportes
    },
    {
        path: '/admin/repositorio',
        component: RepositorioAdmin
    },
    {
        path: '/admin/dashboard',
        component: Dashboard
    },
    {
        path: '/admin',
        component: Dashboard
    },
    {
        path: '/admin/perfil',
        component: Perfil
    },
    {
        path: '/admin/usuarios',
        component: Usuarios
    },
    {
        path: '/admin/eventos',
        component: EventosAdmin
    },
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //------------------=-------------------------------RUTAS CLIENTE-------------------------------------------------
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    {
        path: '/',
        component: App,
        children: [{
                path: '',
                component: Home,
            },
            {
                path: '/inicio',
                component: Home,
            },
            {
                path: '/reservacion',
                component: Reservacion,
            },
            {
                path: '/donaciones',
                component: Donacion,
            },
            {
                path: '/fauna',
                component: Fauna,
            },
            {
                path: '/flora',
                component: Flora,
            },
            {
                path: '/AcercaDe',
                component: AcercaDe,
            },
            {
                path: '/marca',
                component: Marca,
            },
            {
                path: '/repositorio',
                component: Repositorio,
            },
            {
                path: '/eventos',
                component: Eventos,
            },
            {
                path: '*',
                component: NotFound,
            },
        ],
    },
];
