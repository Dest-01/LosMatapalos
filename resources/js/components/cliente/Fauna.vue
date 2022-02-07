<template>
  <div class="Total Fauna">
    <div class="titulo">
      <h1 style="text-align: center">
        Galeria <span style="color: #38ab81">Fauna</span>
      </h1>
    </div>
    <div class="menu">
      <button class="btn_menu">Aves</button>
      <button class="btn_menu">Mamíferos</button>
    </div>
    <div v-if="faunas.data == 0" class="row">
      <div class="mensaje">
        <i class="far fa-folder-open"></i>
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
        :data="faunas"
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
              Nombre Cientifico: {{ form.nombreCientifico }}
            </h5>
            <button
              style="background: none; border: none; font-size: 1.25rem; font-weight: 500;"
              type="button"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <img
              v-bind:src="'/images/Fauna/' + form.imagen"
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
</template>
<script>
export default {
  data() {
    return {
      bloquearCampo: true,
      faunas: {},
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
  left: -50%;
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
.modal-footer label{
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