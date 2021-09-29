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
    { path: '/admin/participantes', component: require('./components/admin/participantes.vue').default },
    { path: '/admin/reservar', component: require('./components/admin/Reservar.vue').default },

    


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//------------------=-------------------------------RUTAS CLIENTE-------------------------------------------------
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    { path: '/', component: require('./components/cliente/Home.vue').default },
    { path: '/home', component: require('./components/cliente/Home.vue').default },
    { path: '/reservacion', component: require('./components/cliente/Reservar.vue').default },
    { path: '/donaciones', component: require('./components/cliente/Donaciones.vue').default },
    { path: '/somos', component: require('./components/cliente/QuienesSomos.vue').default },
    { path: '/actividades', component: require('./components/cliente/actividades.vue').default },
    { path: '/pruebas', component: require('./components/cliente/pruebas.vue').default },
    { path: '/fauna', component: require('./components/cliente/Fauna.vue').default },
    { path: '/flora', component: require('./components/cliente/Flora.vue').default },
];
