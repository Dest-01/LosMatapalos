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
    <div class="paginacion">
      <pagination
        :data="documentosRepositorio"
        @pagination-change-page="getResults"
      ></pagination>
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
.titulo{
  opacity: 0;
  animation-name: aparecerTitulo;
  animation-delay: 1s;
  animation-fill-mode: forwards;
  animation-duration: 3s;
  transition: opacity 3s;
}

.secundario {
  margin: 10px 50px;
  display: grid;
  justify-content: center;
  animation-name: moverArribaAbajo;
  animation-duration: 3s;
  animation-fill-mode: forwards;
  transition: margin-top 3s;
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

.paginacion {
  margin: 10px auto;
  padding: 1em;
  width: 300px;
  justify-content: center;
}

.pagination {
  justify-content: center;
  padding: 5px;
  background: #f0f0f0;
  border-radius: 30px;
  font-weight: 900;
}

@keyframes aparecerTitulo{
  0%{
    opacity: 0;
  }
  50%{
    opacity: 0.5;
  }
  100%{
    opacity: 1;
  }
}

@keyframes moverArribaAbajo{
  0%{
    margin-top: -300px;
  }
  100%{
    margin-top: 10px;
  }
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