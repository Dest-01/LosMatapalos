<template>
  <div class="Total">
    <div class="titulo">
           <h1 style="text-align: center">
        Galeria <span style="color: #38ab81">Fauna</span>
      </h1>
    </div>
        <div v-if="faunas.data == 0" class="row">
      <div class="mensaje">
        <i class="far fa-folder-open"></i>
        <h1>Oops!</h1>
        <h3>No hay registros en galeria de fauna</h3>
        <h4>Muy pronto...</h4>
      </div>
    </div>
    <div v-else class="container-all">
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
              <label for="exampleFormControlTextarea1" class="form-label">{{
                form.descripcion
              }}</label>
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
.modal-content {
  width: 900px;
  right: 40%;
}

.Total {
  min-height: 800px;
  max-height: 100%;
}

.mensaje{
  width: 100%;
  margin-top: 100px;
  margin-block: 100px;
  text-align: center;
}

.fa, .far, .fas {
    font-family: "Font Awesome 5 Free";
    font-size: 100px;
    color: #38ab81;
}
h4{
  color: #38ab81;
}


.modal-content {
  position: relative;
  display: -ms-flexbox;
  display: flex;
  -ms-flex-direction: column;
  flex-direction: column;
  pointer-events: auto;
  background-color: #0000007a;
  background-clip: padding-box;
  border: 1px solid rgb(0 0 0 / 0%);
  border-radius: 20px;
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
  font-family: "Poppins";
  margin-bottom: 0.5rem;
  color: rgb(255 255 255);
  font-weight: 700;
}
.form-control[data-v-82d23cc6]:disabled,
.form-control[data-v-82d23cc6]:read-only {
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
  margin-top: 90px;
  background: transparent;
  padding: 0;
}

.paginacion {
  margin: auto;
    padding: 1em;
    width: 300px;
    justify-content: center;
}
.pagination{
justify-content: center;
    font-family: fantasy;
    color: black;
    background: #f0f0f0;
    padding: 5px;

    border-radius: 30px;
}
ol,
ul {
  /* left: 45%; */
  padding-left: 50%;
}

h1 {
  text-align: center;
  color: #000000ad;
}
.container-all {
  width: -webkit-fit-content;
  width: -moz-fit-content;
  width: fit-content;
  margin: 10px 70px 30px 70px;
  height: auto;
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  align-content: center;
  justify-content: center;
  align-items: center;
}
.container {
  background: #66666699;
  width: 550px;
  overflow: hidden;
  display: block;
  position: relative;
  float: left;
  padding: 5px;
  margin: 5px 5px 5px 5px;
  border-radius: 0.2rem;
  box-shadow: 0 4px 6px 0 rgb(0 0 0 / 30%);
  counter-reset: pagination;
  text-align: center;
  height: 400px;
  border-radius: 20px;
}

img {
  height: 100%;
  width: 100%;
  transition-duration: 0.3s;
  max-width: 100%;
  display: block;
  overflow: hidden;
  cursor: pointer;
  box-shadow: 3px 3px 3px 2px rgb(0 0 0 / 20%);
  border-radius: 20px;
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
@media (max-width: 280px) {
  img {
    width: 100%;
    height: auto;
  }
  .titulo {
    margin-top: 150px;
  }

  .container-all {
    width: 100%;
    margin: 1px;
  }
  .container {
    width: 100%;
    height: auto;
  }
  .modal-content {
    width: 100%;
    right: auto;
    margin-top: 35%;
  }
  .container:hover span {
    font-size: 15px;
  }
}

@media (max-width: 767px) {
  img {
    width: 100%;
    height: auto;
  }
  .titulo {
    margin-top: 150px;
  }

  .container-all {
    width: 100%;
    margin: 1px;
  }
  .container {
    width: 100%;
    height: auto;
  }
  .modal-content {
    width: 100%;
    right: auto;
    margin-top: 35%;
  }
  .container:hover span {
    font-size: 17px;
  }
}
@media only screen and (min-device-width: 768px) and (max-device-width: 1023px) {
  img {
    width: 100%;
    height: auto;
  }
  .titulo {
    margin-top: 150px;
  }

  .container-all {
    width: 100%;
    margin: 1px;
  }
  .container {
    width: 100%;
    height: auto;
  }
  .modal-content {
    width: 700px;
    right: 20%;
    margin-top: 1%;
  }
  .container:hover span {
    font-size: 25px;
  }
}

@media only screen and (min-device-width: 1024px) and (max-device-width: 1280px) {
  img {
    width: 100%;
    height: auto;
  }
  .titulo {
    margin-top: 150px;
  }

  .container-all {
    width: 100%;
    margin: 1px;
  }
  .container {
    width: 100%;
    height: auto;
  }
  .modal-content {
    width: 900px;
    right: 40%;
    margin-top: 1%;
  }
  .container:hover span {
    font-size: 35px;
  }
}
</style>