<template>
  <div class="Total">
    <div class="titulo">
      <h1>GALERIA</h1>
    </div>

    <div class="container-all">
      <div
        v-for="donativo in donativos.data"
        :key="donativo.id"
        class="container"
      >
        <img
          v-bind:src="'/images/donativos/' + donativo.photo"
          width="100%"
          height="100%"
          alt=""
        />
        <span class="title">{{ donativo.idPersona }}</span>
        <span class="text"
          >Morbi diam viverra mattis sociis magna, habitasse penatibus non
          lectus</span
        >
        <button
          type="button"
          @click="verImagen(donativo)"
          class="btn btn-success btn-rounded"
        >
          VER
        </button>
      </div>
    </div>
    <div class="paginacion">
      <pagination
        style="font-family: fantasy"
        :data="donativos"
        @pagination-change-page="getResults"
      ></pagination>
    </div>
    <!-- Modal -->
    <div
      class="modal fade"
      id="addNew"
      tabindex="-1"
      role="dialog"
      aria-labelledby="addNew"
      aria-hidden="true"
     
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" v-show="!verModal"></h5>
            <h5 class="modal-title" v-show="verModal">{{form.idPersona}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form>
            <div class="modal-body">
              <div>
                <img
                  v-bind:src="'/images/donativos/' + form.photo"
                  width="100%"
                  height="100%"
                  alt=""
                />
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      verModal: false,
      donativos: {},
      form: new Form({
        id: "",
        idPersona: "",
        photo: "",
      }),
    };
  },
  methods: {
    verImagen(donativo) {
      this.verModal = true;
      $("#addNew").modal("show");
      this.form.fill(donativo);
      this.show = false;
    },
    cerrarModal() {
      this.verModal = false;
      this.show = false;
    },
    getResults(page = 1) {
      this.$Progress.start();
      axios
        .get("/api/floraCliente?page=" + page)
        .then(({ data }) => (this.donativos = data.data));
      this.$Progress.finish();
    },
    cargarDonativos() {
      axios
        .get("/api/floraCliente")
        .then(({ data }) => (this.donativos = data.data));
    },
  },
  created() {
    this.$Progress.start();
    this.cargarDonativos();
    this.$Progress.finish();
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
.modal-content{
    width: 1000px;
    right: 45%;
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
    background-color: #ffffffba;
    background-clip: padding-box;
    border: 1px solid rgba(0,0,0,.2);
    border-radius: .3rem;
    outline: 0;
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
  box-shadow: 0 4px 6px 0 rgb(122 122 122);
  /* position: absolute; */
  /* left: 45%; */
  /* bottom: -250px; */
  /* height: auto; */
  /* width: 150px; */
  background: #c3c3c373;
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
}
.title {
  position: absolute;
  display: block;
  cursor: pointer;
  top: 35%;
  display: none;
  left: 50%;
  margin-right: -50%;
  transform: translate(-50%, -50%);
  font-weight: bold;
  font-size: 1.6em;
  text-shadow: 1px 5px 10px black;
  transition-duration: 0.3s;
}
.text {
  position: absolute;
  top: 70%;
  cursor: pointer;
  max-width: 80%;
  text-align: center;
  left: 50%;
  text-shadow: 1px 5px 10px black;
  font-size: 1em;
  display: none;
  margin-right: -50%;
  transition-duration: 0.3s;
  transform: translate(-50%, -50%);
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
    margin: 5px 6px auto auto;
  }
  .container {
    width: calc(50% - 6px);
  }
  ol,
  ul {
    /* left: 45%; */
    padding-left: 45%;
  }
    .modal-content{
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
  }
  .container {
    width: 100%;
  }
  ol,
  ul {
    /* left: 45%; */
    padding-left: 30%;
  }
  .modal-content{
    width: 100%;
    right: auto;
    top: 200px;
}
}
</style>