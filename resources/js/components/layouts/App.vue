<template>
  <div id="main-app">
    <navbar>
        
    </navbar>
    
    <router-view></router-view>
    <vue-progress-bar></vue-progress-bar>
    <!-- Aca se renderizaran las vistas vue dependiendo las rutas -->
    <div class="footer">
        <footer class="bg-dark text-center text-white">
        <!-- Copyright -->
        <div class="text-center p-3">
            <h5 style="padding: 10px">
                {{ $t('NombreCompleto') }}
            </h5>
            <h5 style="padding: 10px">
                <a href="https://www.facebook.com/pgaiuna/" target="_blank"><i class="fab fa-facebook white"></i></a>
                <a href="https://www.instagram.com/pgaiuna/?r=nametag" target="_blank"><i
                        class="fab fa-instagram white"></i></a>
            </h5>
            <h5 style="padding: 10px">
                {{ $t('CopyRight') }}
            </h5>

        </div>
        <!-- Copyright -->
    </footer>
      </div>
  </div>
</template>

<script>
import navbar from "../views/Navbar.vue";

export default {
  data: () => ({}),
  components: {
    navbar: navbar,
  },
};
</script>

<style >
.v-application.v-application--is-ltr.theme--light {
  background-color: #eee;
}
</style>