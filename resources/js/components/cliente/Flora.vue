<template>
  <div style="margin: auto">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!--MODAL PARA LA IMAGEN-->

 <!--MODAL PARA LA IMAGEN-->

    <h1 style="margin-top: 90px">Galeria Flora</h1>
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
        <button type="button" class="btn btn-success btn-rounded">
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
  </div>
</template>
<script>
export default {
  data() {
    return {
      donativos: {},
    };
  },
  methods: {
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
.pagination {
  display: flex;
  padding-left: 0;
  list-style: none;
  border-radius: 0.25rem;
}
.paginacion {
  margin: 0 auto;
  padding: 1rem;
  border-radius: 0.2rem;
  box-shadow: 0 4px 6px 0 rgba(0, 0, 0, 0.3);
  position: absolute;
  left: 45%;
  bottom: -250px;
  height: auto;
  width: 150px;
  background: #19c54e47;
}

h1 {
  text-align: center;
  color: black;
}
.container-all {
  width: fit-content;
  margin: 30px auto auto 30px;
  height: auto;
}
.container {
  background: #66666699;
  width: calc(33% - 6px);
  overflow: hidden;
  display: block;
  position: relative;
  float: left;
  padding: 5px;
  margin: 3rem auto auto 5px;
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
.btn{
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
  .container {
    width: calc(50% - 6px);
  }
}
@media only screen and (max-width: 400px) {
  .container {
    width: 100%;
  }
}



</style>