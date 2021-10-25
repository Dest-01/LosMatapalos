export default [

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//--------------------------------------------------RUTAS GUIA Y PRUEBA------------------------------------------------
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    { path: '/dashboard', component: require('./components/Dashboard.vue').default },
    { path: '/profile', component: require('./components/Profile.vue').default },
    { path: '/developer', component: require('./components/Developer.vue').default },
    { path: '/users', component: require('./components/Users.vue').default },
    { path: '*', component: require('./components/NotFound.vue').default },

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//--------------------------------------------------RUTAS ADMIN------------------------------------------------
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
   
    { path: '/admin/personas', component: require('./components/admin/Personas.vue').default },
    { path: '/admin/organizaciones', component: require('./components/admin/Organizaciones.vue').default },
    { path: '/admin/donativos', component: require('./components/admin/Donativos.vue').default },
    { path: '/admin/Catdonativos', component: require('./components/admin/CatDonativos.vue').default },
    { path: '/admin/voluntario', component: require('./components/admin/Voluntario.vue').default },
    { path: '/admin/voluntarioPersona', component: require('./components/admin/VoluntarioPersona.vue').default },
    { path: '/admin/voluntarioEstudiante', component: require('./components/admin/VoluntarioEstudiante.vue').default },
    { path: '/admin/actividad', component: require('./components/admin/Actividades.vue').default },
    { path: '/admin/actividadParticipantes', component: require('./components/admin/ActividadesParticipantes.vue').default },
    { path: '/admin/participantes', component: require('./components/admin/Participantes.vue').default },
    { path: '/admin/reservar', component: require('./components/admin/Reservar.vue').default },
    { path: '/admin/voluntarioActividad', component: require('./components/admin/VoluntarioActividad').default },
    { path: '/admin/fauna', component: require('./components/admin/Fauna').default },
    { path: '/admin/flora', component: require('./components/admin/flora.vue').default },
    { path: '/admin/articulos', component: require('./components/admin/Articulos.vue').default },
    { path: '/admin/reportes1', component: require('./components/admin/Reportes1.vue').default },
    { path: '/reporte', component: require('./components/PruebaReporte.vue').default },

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------=-------------------------------RUTAS CLIENTE-------------------------------------------------
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    { path: '/', component: require('./components/cliente/Home.vue').default },
    { path: '/home', component: require('./components/cliente/Home.vue').default },
    { path: '/reservacion', component: require('./components/cliente/Reservar.vue').default },
    { path: '/donaciones', component: require('./components/cliente/Donaciones.vue').default },
    { path: '/actividades', component: require('./components/cliente/Actividades.vue').default },
    { path: '/fauna', component: require('./components/cliente/Fauna.vue').default },
    { path: '/flora', component: require('./components/cliente/Flora.vue').default },
    { path: '/AboutUs', component: require('./components/cliente/AboutUs.vue').default },
    { path: '/productos', component: require('./components/cliente/Productos.vue').default },
    { path: '/repositorio', component: require('./components/cliente/Repositorio.vue').default },
];
