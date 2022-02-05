<template>
  <div class="principal">
    <div class="titulo">
      <h1 style="text-align: center">
        Repositorio <span style="color: #38ab81">Documentos</span>
      </h1>
    </div>
    <div class="secundario">
      <table>
        <thead>
          <tr>
            <th class="icono"></th>
            <th class="nombre" scope="col">Nombre</th>
            <th class="descripcion" scope="col">Descripción</th>
            <th class="botones" scope="col"></th>
            <th class="botones" scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="documentoRepo in documentosRepositorio.data"
            :key="documentoRepo.id"
          >
            <td class="icono">
              <img
                src="/images/PDFIcono.png"
                alt="PDFIcono"
                width="100%"
                height="100%"
              />
            </td>
            <td class="nombre">{{ documentoRepo.nombre }}</td>
            <td class="descripcion">{{ documentoRepo.descripcion }}</td>
            <td class="botones">
              <a
                class="btn btn-info btn-sm px-3"
                v-bind:href="
                  '/documentos/repositorioDocumental/' + documentoRepo.documento
                "
                target="_blank"
                rel="noopener noreferrer"
              >
                <i class="fas fa-info-circle"></i
              ></a>
            </td>
            <td class="botones">
              <a
                class="btn btn-danger btn-sm px-3"
                v-bind:href="
                  '/documentos/repositorioDocumental/' + documentoRepo.documento
                "
                v-bind:download="'' + documentoRepo.nombre"
                ><i class="fas fa-download"></i
              ></a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
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
  margin-top: 50px;
  padding: 0;
}
.secundario {
  margin: 10px 50px;
  display: grid;
  justify-content: center;
}
table {
  margin: 10px 50px;
  font-size: 20px;
}
.icono {
  width: 50px;
}
thead {
  background: #e7e7e76b;
}
tr,
th {
  border-bottom: 1px solid #38ab8191;
}
.nombre,
.icono,
.descripcion,
.botones {
  padding: 20px 10px;
}
.nombre {
  width: 250px;
}
.descripcion {
  width: 500px;
}
.botones {
  width: 50px;
}

@media screen and (max-width: 900px) {
  .secundario {
    min-height: 700px;
    max-height: auto;
    width: 100%;
    margin: 0;
  }

}
</style>