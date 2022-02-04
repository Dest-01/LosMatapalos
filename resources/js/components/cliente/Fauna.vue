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
    <div v-else class="container-all">
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

.titulo {
  margin-top: 40px;
  padding: 5px;
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
  margin: 10px;
  padding: 0;
  border-radius: 15px;
  box-shadow: 1px 1px 10px 0 black;
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
  color: black;
  font-size: 20px;
  font-weight: 800;
  background: #ffffff5e;
  border: 0;
  box-shadow: 1px 1px 10px 0 black;
  padding: 0;
}

.paginacion {
  margin: 10px auto;
  padding: 1em;
  width: 300px;
  justify-content: center;
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

@media screen and (max-width: 900px) {
  .paginacion {
    width: 100%;
  }
}
</style>