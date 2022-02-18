<template>
  <div>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand icono_una" href="https://www.una.ac.cr">
          <img src="images/una.png" alt="" width="120" height="60" />
        </a>
        <a class="navbar-brand" href="https://sendero.herokuapp.com/">
          <img src="images/logo2.png" alt="" width="120" height="60" />
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
               <router-link class="nav-link" to="/home">Inicio</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="/reservacion">Reservación</router-link>
            </li>
            <li class="nav-item">
               <router-link class="nav-link" to="/donaciones">Donaciones</router-link>
            </li>
            <li></li>
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                id="navbarDropdown"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                Galería
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
                <li><a class="dropdown-item" href="">Flora</a></li>
                <li>
                  <hr class="dropdown-divider" />
                </li>
                <li><a class="dropdown-item" href="">Fauna</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="">Repositorio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="">Marca</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="">¿Quiénes somos?</a>
            </li>
            <li class="nav-item">
              <select class="nav-link language" v-model="$i18n.locale">
                <option
                  class="dropdown-item"
                  style="color: #f8f8f8; font-size: 20px; font-weight: 400"
                  v-for="(lang, i) in langs"
                  :key="`Lang${i}`"
                  :value="lang"
                >
                  {{ lang }}
                </option>
              </select>
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
    return { langs: ["es", "en"] };
  },
};
</script>