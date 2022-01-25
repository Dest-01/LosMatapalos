<template>
  <div class="principal">
    <div class="titulo">
      <h1 style="text-align: center">
        Repositorio <span style="color: #38ab81">Documentos</span>
      </h1>
    </div>
    <div class="secundario">
      <table class="table align-middle">
        <thead>
          <tr>
            <th class="icono"></th>
            <th class="nombre" scope="col">Nombre</th>
            <th class="nombre" scope="col">descripción</th>
            <th class="botones" scope="col"></th>
            <th class="botones" scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <tr  v-for="documentoRepo in documentosRepositorio.data" :key="documentoRepo.id">
            <td class="icono">
              <img
                src="/images/PDFIcono.png"
                width="50px"
                height="50px"
                alt=""
              />
            </td>
            <td class="nombre">{{documentoRepo.nombre}}</td>
            <td class="nombre">{{documentoRepo.descripcion}}</td>
            <td class="botones">
              <a  class="btn btn-info btn-sm px-3" v-bind:href="'/documentos/repositorioDocumental/' + documentoRepo.documento" target="_blank" rel="noopener noreferrer"> <i class="fas fa-info-circle"></i></a>
            </td>
            <td class="botones">
              <a  class="btn btn-danger btn-sm px-3" v-bind:href="'/documentos/repositorioDocumental/' + documentoRepo.documento"  v-bind:download="''+ documentoRepo.nombre"><i class="fas fa-download"></i></a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <h1 style="display: none" id="error">An error occurred</h1>
    <div id="loader" class="lds-ring">
      <div></div>
      <div></div>
      <div></div>
      <div></div>
    </div>

    <div id="pages-container"></div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      documentosRepositorio: {},
    };
  },
  methods: {
    getResults(page = 1) {
      this.$Progress.start();

      axios
        .get("/api/repositorioCliente?page=" + page)
        .then(({ data }) => (this.documentosRepositorio = data.data));

      this.$Progress.finish();
    },
    cargarDocumentos() {
      axios
        .get("/api/repositorioCliente")
        .then(({ data }) => (this.documentosRepositorio = data.data));
    },
  },
  created() {
    this.$Progress.start();
    this.cargarDocumentos();
    this.$Progress.finish();
  },
};
</script>

<style scoped>
.principal {
  margin: 130px 10px 10px 10px;
  width: 100%;
  min-height: 750px;
  max-height: 100%;
  text-align: center;
  font-family: "Poppins";
}
.titulo {
  margin: 10px;
}
.secundario {
  width: 100%;
  height: 500px;
  margin: 10px 10px 10px 10px;
  padding: 20px 250px;
  text-align: start;
}
.table tbody {
  border: 1px;
  border-block: unset;
  border-bottom-color: #5a5a5a87;
  border-bottom-style: groove;
}
.icono {
  width: 100px;
}
.nombre {
  width: 400px;
  font-size: 1.5rem;
  font-weight: 400;
}
.botones {
  width: 50px;
}
.table > :not(caption) > * > * {
  padding: 1.2rem 0.1rem;
}

@media (max-width: 768px) {
  .secundario {
    width: 100%;
    height: auto;
    margin: 1px 1px;
    padding: 1px 18px 1px 1px;
  }
  .nombre {
    width: 400px;
    font-size: 1.1rem;
    font-weight: 400;
  }
}
</style>