<template>
  <div class="Total">
    <div class="titulo">
      <h1 style="text-align: center">
        Galeria <span style="color: #38ab81">Flora</span>
      </h1>
    </div>
    <div class="menu">
      <button @click="filtrarPlanta()" class="btn_menu">Herbaceas</button>
      <button class="btn_menu">Leñosas</button>
    </div>
    <div v-if="floras.data == 0" class="row">
      <div class="mensaje">
        <i class="far fa-folder-open"></i>
        <h1>Oops!</h1>
        <h3>No hay registros en galería de flora</h3>
        <h4>Muy pronto...</h4>
      </div>
    </div>
    <div v-else class="container-all wow fadeInLeft" data-wow-duration="2s">
      <div v-for="flora in floras.data" :key="flora.id" class="container">
        <img
          v-bind:src="'/images/flora/' + flora.photo"
          width="100%"
          height="100%"
          alt=""
          @click="verImagen(flora)"
          data-bs-toggle="modal"
          data-bs-target="#exampleModal"
        />
        <div class="descripcion">
          <span class="text">Nombre comun: {{ flora.nom_comun }}</span>
          <span class="text"
            >Nombre Cientifico: {{ flora.nom_cientifico }}</span
          >
          <span class="text">Tipo: {{ flora.tipo }}</span>
          <span class="text">Familia: {{ flora.fam_cientifica }}</span>
          <button
            @click="verImagen(flora)"
            data-bs-toggle="modal"
            data-bs-target="#exampleModal"
            class="btn btn-danger"
          >
            Ver
          </button>
        </div>
      </div>
    </div>
    <div class="paginacion">
      <pagination
        style="font-family: fantasy; color: black"
        :data="floras"
        @pagination-change-page="getResults"
      ></pagination>
    </div>

    <!-- Modal -->
    <div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              Nombre Cientifico: {{ form.nom_cientifico }}
            </h5>
            <button
              type="button"
              class="btn-close white"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <div>
              <img
                v-bind:src="'/images/flora/' + form.photo"
                width="100%"
                height="100%"
                alt=""
              />
            </div>
            <div class="modal-footer">
              <label>Descripcion: {{ form.descripcion }}</label>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      floras: {},
      form: new Form({
        id: "",
        nom_comun: "",
        nom_cientifico: "",
        descripcion: "",
        photo: "",
      }),
    };
  },
  methods: {
    verImagen(flora) {
      this.form.fill(flora);
    },

    getResults(page = 1) {
      this.$Progress.start();
      axios
        .get("/api/floraCliente?page=" + page)
        .then(({ data }) => (this.floras = data.data));
      this.$Progress.finish();
    },
    cargarFlora() {
      axios
        .get("/api/floraCliente")
        .then(({ data }) => (this.floras = data.data));
    },
  },
  created() {
    this.$Progress.start();
    this.cargarFlora();
    this.$Progress.finish();
  },
  filters: {
    truncate: function (text, length, suffix) {
      return text.substring(0, length) + suffix;
    },
  },
  computed: {},
};
</script>


<style scoped>
.titulo {
  margin-top: 40px;
  padding: 5px;
}
.titulo {
  animation-name: desplazar;
  animation-duration: 1s;
  opacity: 0;
  animation-fill-mode: forwards;
}
.mensaje {
  width: 100%;
  margin-top: 20px;
  margin-block: 100px;
  text-align: center;
}
.container-all {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  justify-content: center;
  margin: 5px auto;
  padding: 0;
}
.container {
  width: 450px;
  height: 350px;
  box-sizing: content-box;
  font-size: 25px;
  text-align: center;
  margin: 15px;
  padding: 0;
  border-radius: 15px;
  box-shadow: 1px 1px 10px 0 black;
  transition: transform 0.6s;
}
.container:hover {
  transform: scale(1.1);
}
.container img {
  object-fit: cover;
  z-index: 1;
  width: 100%;
  height: 100%;
  border: 3px solid #38ab81b0;
  border-radius: 15px;
  padding: 0;
}

.descripcion {
  color: #fff;
  font-size: 1em;
  font-weight: 700;
  position: relative;
  z-index: 10;
  display: flex;
  flex-direction: column;
  justify-content: center;
  box-sizing: border-box;
  top: -100%;
  opacity: 0;
  transition: all 0.8s;
  width: 100%;
  height: 100%;
}
.menu {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  margin: 10px auto;
  padding: 5px;
  justify-content: center;
}
.btn_menu {
  margin: 5px;
  padding: 10px;
  font-size: 20px;
  font-weight: 600;
  background: #1290accf;
  width: 150px;
  height: 50px;
  border: 0;
  border-radius: 5px;
  color: #fff;
  transition: all 0.4s;
}
.btn_menu:hover {
  background: #0c7c96;
}
.btn {
  width: 50%;
  left: 25%;
  position: relative;
  background: #1290accf;
}

.container > .descripcion:hover {
  opacity: 1;
}
.modal-content {
  color: #fff;
  font-size: 20px;
  font-weight: 800;
  background: rgba(17, 17, 17, 0.76);
  border: 0;
  box-shadow: 1px 1px 10px 0 black;
  padding: 0;
  width: 55vw;
  height: 70vh;
  box-sizing: content-box;
  left: -15vw;
}

.modal-body {
  width: 55vw;
  height: 70vh;
  box-sizing: content-box;
  padding: 1px;
}
.modal-body img {
  box-sizing: border-box;
  object-fit: cover;
  width: 55vw;
  height: 70vh;
}

.modal-footer {
  background: rgba(17, 17, 17, 0.76);
  justify-content: start;
  border-bottom-right-radius: 10px;
  border-bottom-left-radius: 10px;
  border-bottom: 1px solid black;
  box-shadow: -2px 2px 3px 0 #000000ab;
}
.modal-footer label {
  color: #fff;
}

.paginacion {
  margin: 10px auto;
  padding: 1em;
  width: 300px;
  justify-content: center;
}
button span {
  color: #fff;
  font-size: 1.25rem;
  font-weight: 500;
}
.pagination {
  justify-content: center;
  font-family: fantasy;
  color: black;
  background: #f0f0f0;
  padding: 5px;
  border-radius: 30px;
  font-weight: 900;
}

@keyframes desplazar {
  /*Creacion de la animacion, se establece el orden en que va a ocurrir los cambios*/
  0% {
    margin-top: 80px;
    opacity: 0;
  }
  50% {
    opacity: 0.5;
  }
  100% {
    margin-top: 40px;
    opacity: 1;
  }
}

@media screen and (max-width: 900px) {
  .paginacion {
    width: 100%;
  }
}
</style>