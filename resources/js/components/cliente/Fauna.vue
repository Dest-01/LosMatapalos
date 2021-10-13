<template>
  <div class="Total">
    <div class="titulo">
      <h1>GALERIA FAUNA</h1>
    </div>

    <div class="container-all">
      <div v-for="fauna in faunas.data" :key="fauna.id" class="container">
        <img
          v-bind:src="'/images/Fauna/' + fauna.imagen"
          width="100%"
          height="100%"
          alt=""
          @click="verImagen(fauna)"
          data-bs-toggle="modal"
          data-bs-target="#exampleModal"
        />
        <span class="title">Nombre comun: {{ fauna.nombreComun }}</span>
        <span class="text posicion1"
          >Nombre Cientifico: {{ fauna.nombreCientifico }}</span
        >
        <span class="text posicion2">Tipo: {{ fauna.tipo }}</span>
        <span class="text posicion3"
          >Familia: {{ fauna.familiaCientifca }}</span
        >
      </div>
    </div>
    <div class="paginacion">
      <pagination
        style="font-family: fantasy; color: black"
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
              type="button"
              class="btn-close white"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <div>
              <img
                v-bind:src="'/images/Fauna/' + form.imagen"
                width="100%"
                height="100%"
                alt=""
              />
            </div>
            <div class="mb-3">
              <label for="exampleFormControlTextarea1" class="form-label"
                >Descripcion:</label
              >
              <label for="exampleFormControlTextarea1" class="form-label"
                >{{form.descripcion}}</label
              >
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
@import url("https://fonts.googleapis.com/css?family=Poppins");
body,
html {
  height: 100%;
  margin: 0;
  background: #2b2927;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
    Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial,
    sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  min-height: 100vh;
}
.modal-content {
  width: 900px;
  right: 40%;
}

.total {
  margin: 85px;
}

.modal-content {
  position: relative;
  display: -ms-flexbox;
  display: flex;
  -ms-flex-direction: column;
  flex-direction: column;
  pointer-events: auto;
  background-color: #00000000;
  background-clip: padding-box;
  border: 1px solid rgb(0 0 0 / 0%);
  border-radius: 0.3rem;
  outline: 0;
  box-shadow: 2px 2px 2px 2px rgb(0 0 0 / 20%);
  width: 850px;
}
.modal-title {
    color: white;
    margin-bottom: 0;
    line-height: 1.6;
}

.form-label {
    font-family: 'Poppins';
    margin-bottom: .5rem;
    color: rgb(255 255 255);
    font-weight: 700;
}
.form-control[data-v-82d23cc6]:disabled, .form-control[data-v-82d23cc6]:read-only {
    background-color: #fff7f712;
    opacity: 1;
    border: 1px solid rgb(0 0 0 / 0%);
    color: white;
    font-size: 15px;
    font-weight: 500;
}

footer {
  margin-top: 40px;
  width: 100%;
  float: left;
}

.titulo {
  font-family: sans-serif;
  margin-top: 90px;
  font-weight: bold;
  font-size: 1.6em;
  text-shadow: 1px 5px 10px black;
  transition-duration: 0.3s;
}
.paginacion {
  margin: 5px 70px 55px 70px;
  padding: 1em;
  /* padding: 1px; */
  /* border-radius: 0.2rem; */
  /*box-shadow: 0 4px 6px 0 rgb(122 122 122);*/
  /* position: absolute; */
  /* left: 45%; */
  /* bottom: -250px; */
  /* height: auto; */
  /* width: 150px; */
  /* background: #c3c3c373;*/
}
ol,
ul {
  /* left: 45%; */
  padding-left: 50%;
}

h1 {
  text-align: center;
  color: black;
}
.container-all {
  width: fit-content;
  margin: 10px 70px 30px 70px;
  height: auto;
  display: flex; /* o inline-flex */
  flex-direction: row;
  flex-wrap: wrap;
  align-content: flex-start;
}
.container {
  background: #66666699;
  width: calc(33% - 6px);
  overflow: hidden;
  display: block;
  position: relative;
  float: left;
  padding: 5px;
  margin: 68px 5px 68px 5px;
  border-radius: 0.2rem;
  box-shadow: 0 4px 6px 0 rgba(0, 0, 0, 0.3);
  counter-reset: pagination;
  text-align: center;
}

img {
  width: 100%;
  transition-duration: 0.3s;
  max-width: 100%;
  display: block;
  overflow: hidden;
  cursor: pointer;
  box-shadow: 3px 3px 3px 2px rgb(0 0 0 / 20%);
}
.title {
  position: absolute;
  display: block;
  cursor: pointer;
  top: 25%;
  display: none;
  left: 50%;
  margin-right: -50%;
  transform: translate(-50%, -50%);
  font-weight: bold;
  font-size: 1.8em;
  text-shadow: 1px 5px 10px black;
  transition-duration: 0.3s;
}
.text {
  position: absolute;
  top: 40%;
  cursor: pointer;
  max-width: 80%;
  text-align: center;
  left: 50%;
  text-shadow: 1px 5px 10px black;
  font-size: 23px;
  display: none;
  margin-right: -50%;
  transition-duration: 0.3s;
  transform: translate(-50%, -50%);
}
.posicion1 {
  top: 50%;
}
.posicion2 {
  top: 70%;
}
.posicion3 {
  top: 80%;
}
.posicion4 {
  top: 90%;
}
.btn {
  position: absolute;
  top: 80%;
  cursor: pointer;
  max-width: 80%;
  text-align: center;
  left: 50%;
  text-shadow: 1px 5px 10px black;
  font-size: 1em;

  margin-right: -50%;
  transition-duration: 0.3s;
  transform: translate(-50%, -50%);
}

.container:hover img {
  transform: scale(1.2);
  transition-duration: 0.3s;
  filter: grayscale(50%);
  opacity: 0.7;
}
.container:hover span {
  color: white;
  display: block;
  transition-duration: 0.3s;
}
@media only screen and (max-width: 900px) {
  .titulo {
    margin-top: 150px;
  }
  .container-all {
    margin: 5px 5px 1px 120px;
    width: 1000px;
  }
  .container {
    width: calc(50% - 6px);
  }
  ol,
  ul {
    /* left: 45%; */
    padding-left: 45%;
  }
  .modal-content {
    width: 100%;
    right: auto;
    top: 200px;
  }
}
@media only screen and (max-width: 400px) {
  .titulo {
    margin-top: 150px;
  }
  .container-all {
    margin: 5px 6px auto auto;
    width: auto;
  }
  .container {
    width: 100%;
  }
  ol,
  ul {
    /* left: 45%; */
    padding-left: 30%;
  }
  .modal-content {
    width: 100%;
    right: auto;
    top: 200px;
  }
}
</style>