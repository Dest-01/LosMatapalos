<template>
  <div class="Total Fauna">
    <div class="titulo">
      <h1 style="text-align: center">
        Galeria <span style="color: #38ab81">Fauna</span>
      </h1>
    </div>
    <div class="menu">
      <button @click="vertodo()" class="btn_menu">Todo</button>
      <button @click="filtroDeAves()" class="btn_menu">Aves</button>
      <button @click="filtroAnfibios()" class="btn_menu">Anfibios</button>
      <button @click="filtroInsectos()" class="btn_menu">Insectos</button>
      <button @click="filtroDeMamiferos()" class="btn_menu">Mamíferos</button>
      <button @click="filtroReptiles()" class="btn_menu">Reptiles</button>
    </div>
    <div v-if="faunas.data == 0" class="row">
      <div class="mensaje">
        <i class="far fa-image"></i>
        <h1>Oops!</h1>
        <h3>No hay registros en galería de fauna</h3>
        <h4>Muy pronto...</h4>
      </div>
    </div>
    <div v-else class="container-all wow fadeInLeft" data-wow-duration="2s">
      <div v-for="fauna in faunas.data" :key="fauna.id" class="container">
        <img
          v-bind:src="'/images/Fauna/' + fauna.imagen"
          width="100%"
          height="100%"
          alt="Fauna"
          @click="verImagen(fauna)"
          data-bs-toggle="modal"
          data-bs-target="#exampleModal"
        />
        <div class="descripcion">
          <span class="text">Nombre común: {{ fauna.nombreComun }}</span>
          <span class="text"
            >Nombre Científico: {{ fauna.nombreCientifico }}</span
          >
          <span class="text">Tipo: {{ fauna.tipo }}</span>
          <span class="text">Familia: {{ fauna.familiaCientifca }}</span>
          <button
            @click="verImagen(fauna)"
            data-mdb-toggle="modal"
            data-mdb-target="#exampleModal"
            class="btn btn-outline-info"
            data-mdb-ripple-color="dark"
            id="btnVer"
          >
            Ver
          </button>
        </div>
      </div>
    </div>
    <div class="paginacion">
      <pagination
        :data="faunas"
        @pagination-change-page="getResults"
      ></pagination>
    </div>

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
              Nombre común: {{ form.nombreComun }}
            </h5>
            <button
              type="button"
              class="btn-close"
              data-mdb-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <img
              v-bind:src="'/images/Fauna/' + form.imagen"
              v-bind:alt="form.nom_comun"
              width="100%"
              height="720px"
            />
            <div>
              <h5>Descripcion: {{ form.descripcion }}</h5>
            </div>
          </div>
          <!-------FIN DE LOS INPUTS DE IDENTIFICACION-------->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      bloquearCampo: true,
      faunas: {},
      faunasTodo: {},
      filtrarBusqueda: "Aves",
      filtrarAnfibios: "Anfibios",
      filtrarInsectos: "Insectos",
      filtrarReptiles: "Reptiles",
      filtrarMamiferos: "Mamiferos",
      form: new Form({
        id: "",
        nombreComun: "",
        nombreCientifico: "",
        descripcion: "",
        imagen: "",
      }),
    };
  },
  methods: {
    cerrarModal() {
      $("#exampleModal").modal("hide");
    },
    vertodo() {
      this.faunas.data = this.faunasTodo;
    },
    filtroDeAves() {
      this.faunas.data = this.filtroAves;
    },
    filtroAnfibios() {
      this.faunas.data = this.filtroAnfibio;
    },
    filtroInsectos() {
      this.faunas.data = this.filtroInsecto;
    },
    filtroDeMamiferos() {
      this.faunas.data = this.filtroMamifero;
    },
    filtroReptiles() {
      this.faunas.data = this.filtroReptile;
    },

    verImagen(fauna) {
      this.form.fill(fauna);
    },

    getResults(page = 1) {
      this.$Progress.start();
      axios
        .get("/api/faunaCliente?page=" + page)
        .then(({ data }) => (this.faunas = data.data));
      this.$Progress.finish();
    },
    cargarFauna() {
      axios
        .get("/api/faunaCliente")
        .then(({ data }) => (this.faunas = data.data));
      axios
        .get("/api/faunaCliente/List")
        .then(({ data }) => (this.faunasTodo = data.data));
    },
  },
  created() {
    this.$Progress.start();
    this.cargarFauna();
    this.$Progress.finish();
  },
  filters: {
    truncate: function (text, length, suffix) {
      return text.substring(0, length) + suffix;
    },
  },
  computed: {
    filtroAves: function () {
      return this.faunasTodo.filter((fauna) => {
        return fauna.tipo
          .toLowerCase()
          .includes(this.filtrarBusqueda.toLowerCase());
      });
    },
    filtroMamifero: function () {
      return this.faunasTodo.filter((fauna) => {
        return fauna.tipo
          .toLowerCase()
          .includes(this.filtrarMamiferos.toLowerCase());
      });
    },
    filtroAnfibio: function () {
      return this.faunasTodo.filter((fauna) => {
        return fauna.tipo
          .toLowerCase()
          .includes(this.filtrarAnfibios.toLowerCase());
      });
    },
    filtroInsecto: function () {
      return this.faunasTodo.filter((fauna) => {
        return fauna.tipo
          .toLowerCase()
          .includes(this.filtrarInsectos.toLowerCase());
      });
    },
    filtroReptile: function () {
      return this.faunasTodo.filter((fauna) => {
        return fauna.tipo
          .toLowerCase()
          .includes(this.filtrarReptiles.toLowerCase());
      });
    },
  },
};
</script>
<style scoped>
:root {
  --colorVerde: #39ab81;
}
.row {
  width: 100%;
}
.far {
  font-size: 8rem;
  color: #39ab81;
}
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
#btnVer {
  width: 50%;
  background: #3fa5bcd6;
  color: #fff;
  font-weight: 500;
  font-size: 17px;
  text-transform: capitalize;
  margin-left: 25%;
}
.modal-content {
  width: 1000px;
  left: -50%;
   border-top-right-radius: 5px;
    border-top-left-radius: 5px;
}
.modal-body {
  padding: 0rem;
  border-bottom-right-radius: 5px;
    border-bottom-left-radius: 5px;
}
.modal-body,
.modal-header {
  background: #000000a1;
  color: #fff;
}
.modal-header{
  border-top-right-radius: 5px;
    border-top-left-radius: 5px;
}
.container > .descripcion:hover {
  opacity: 1;
}

button span {
  color: #fff;
  font-size: 1.25rem;
  font-weight: 500;
}

.paginacion {
  margin: 10px auto;
  padding: 1.5em;
  display: flex;
  justify-content: center;
  align-content: center;
  flex-direction: row-reverse;
}

.pagination {
  justify-content: center;
  font-family: fantasy;
  color: black;
  background: #f0f0f0;
  padding: 10px;
  border-radius: 10px;
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

@media only screen and (max-device-width: 1199px) {
  .container-all {
    margin: 5px auto 5px auto;
    padding: 0;
  }
  .modal-content{
    width: 100%;
    left: 0%;
  }
  .modal-body img{
    height: 350px;
  }
}
@media only screen and (min-device-width: 200px) and (max-device-width: 399px) {
  .paginacion {
    margin: 60px 0 180px 0;
  }
}
@media only screen and (min-device-width: 400px) and (max-device-width: 900px) {
  .paginacion {
    margin: 65px 0 150px 0;
  }
}
</style>