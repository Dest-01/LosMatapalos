<template>
  <div>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand icono_una" href="https://www.una.ac.cr">
          <img src="images/una.png" alt="" width="100%" height="100%" />
        </a>
        <a
          class="navbar-brand icono_sendero"
          href="https://sendero.herokuapp.com/"
        >
          <img src="images/logo2.png" alt="" width="100%" height="100%" />
        </a>

        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"> </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <router-link class="nav-link" to="/inicio"
                >{{ $t("Inicio") }}
              </router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="/reservacion">{{
                $t("Reservacion")
              }}</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="/donaciones">{{
                $t("Donacion")
              }}</router-link>
            </li>
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                id="navbarDropdown"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                {{ $t("Galeria") }}
              </a>
              <ul
                class="dropdown-menu"
                aria-labelledby="navbarDropdown"
                style="
                  border-top-radius: 50px;
                  border-bottom-radius: 10px;
                  background: #38ab81;
                "
              >
                <li>
                  <router-link class="dropdown-item" to="/flora">{{
                    $t("Flora")
                  }}</router-link>
                </li>

                <li>
                  <hr class="dropdown-divider" />
                </li>
                <li>
                  <router-link class="dropdown-item" to="/fauna">{{
                    $t("Fauna")
                  }}</router-link>
                </li>
                <li>
                  <hr class="dropdown-divider" />
                </li>
                <li>
                  <router-link class="dropdown-item" to="/eventos">{{
                    $t("Actividad")
                  }}</router-link>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="/repositorio">{{
                $t("Repositorio")
              }}</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="/marca">{{
                $t("Marca")
              }}</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="/AcercaDe">{{
                $t("Quienes")
              }}</router-link>
            </li>
            <li class="nav-item">
              <a class="nav-link" @click="changeLang()" href="#">{{
                IdiomaSeleccionado
              }}</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</template>

<script>
export default {
  name: "locale-changer",
  data() {
    return {
      IdiomaSeleccionado: "",
      langs: ["es", "en"],
    };
  },
  methods: {
    changeLang() {
      this.lang = localStorage.getItem("locale") || "es";
      this.IdiomaSeleccionado = "es";
      if (this.lang === "es") {
        this.lang = "en";
        this.$i18n.locale = this.lang;
        this.IdiomaSeleccionado = "en";
      } else {
        this.lang = "es";
        this.$i18n.locale = this.lang;
        this.IdiomaSeleccionado = "es";
      }
      localStorage.setItem("locale", this.lang);
    },
  },
  created() {
    this.changeLang();
  },
};
</script>

<style scoped>
* {
  font-family: "Source Serif 4", sans-serif;
}
</style>