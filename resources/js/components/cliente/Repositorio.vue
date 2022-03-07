<template>
  <div class="principal">
    <div class="titulo">
      <h1 style="text-align: center">
        {{$t('Repo_Doc')}} <span style="color: #38ab81">{{$t('Docs')}}</span>
      </h1>
    </div>
    <div class="menu">
      <button @click="vertodo()" class="btn_menu">{{$t('Todo')}}</button>
      <button @click="filtroPP()" class="btn_menu">
        {{$t('Practicas_P')}}
      </button>
      <button @click="filtroTesis()" class="btn_menu">{{$t('Tesis')}}</button>
      <button @click="filtroArticulosCientificos()" class="btn_menu">
        {{$t('Articulos_C')}}
      </button>
      <button @click="filtroLibros()" class="btn_menu">{{$t('Libros')}}</button>
    </div>
    <div v-if="documentosRepositorio.data == 0" class="row">
      <div class="mensaje">
        <i class="far fa-folder-open"></i>
        <h1>Oops!</h1>
        <h3>{{$t('no_hay_docs')}}</h3>
        <h4>{{$t('coming_soon')}}</h4>
      </div>
    </div>
    <div v-else class="secundario" style="overflow-x:auto;">
      <table>
        <thead>
          <tr>
            <th class="icono"></th>
            <th class="nombre" scope="col">{{$t('Nombre')}}</th>
            <th class="descripcion" scope="col">{{$t('Descripcion')}}</th>
            <th class="botones" scope="col">{{$t('Ver')}}</th>
            <th class="botones" scope="col">{{$t('Descargar')}}</th>
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
        :limit="5"
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
      todosDocumentos: {},
      filtrarPracticasPro: "Prácticas Profesionales",
      filtrarTesis: "Tesis",
      filtrarArticulos: "Artículos Científicos",
      filtrarLibros: "Libros",
    };
  },
  methods: {
    vertodo() {
      this.documentosRepositorio.data = this.todosDocumentos;
    },
    filtroPP() {
      this.documentosRepositorio.data = this.arrayPP;
    },
    filtroLibros() {
      this.documentosRepositorio.data = this.arrayLibros;
    },
    filtroArticulosCientificos() {
      this.documentosRepositorio.data = this.arrayArticulos;
    },
    filtroTesis() {
      this.documentosRepositorio.data = this.arrayTesis;
    },

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
      axios
        .get("/api/repositorioCliente/List")
        .then(({ data }) => (this.todosDocumentos = data.data));
    },
  },
  created() {
    this.$Progress.start();
    this.cargarDocumentos();
    this.$Progress.finish();
  },
  computed: {
    arrayPP: function () {
      return this.todosDocumentos.filter((documento) => {
        return documento.tipo
          .toLowerCase()
          .includes(this.filtrarPracticasPro.toLowerCase());
      });
    },
    arrayLibros: function () {
      return this.todosDocumentos.filter((documento) => {
        return documento.tipo
          .toLowerCase()
          .includes(this.filtrarLibros.toLowerCase());
      });
    },
    arrayTesis: function () {
      return this.todosDocumentos.filter((documento) => {
        return documento.tipo
          .toLowerCase()
          .includes(this.filtrarTesis.toLowerCase());
      });
    },
    arrayArticulos: function () {
      return this.todosDocumentos.filter((documento) => {
        return documento.tipo
          .toLowerCase()
          .includes(this.filtrarArticulos.toLowerCase());
      });
    },
  },
};
</script>

<style scoped>
.row{
  width: 100%;
}
.menu {
  opacity: 0;
  animation-name: aparecerTitulo;
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  margin: 10px auto;
  padding: 5px;
  justify-content: center;
  animation-delay: 1s;
  animation-fill-mode: forwards;
  animation-duration: 3s;
  transition: opacity 3s;
}
.btn_menu {
  margin: 5px;
  padding: 10px;
  font-size: 20px;
  font-weight: 600;
  background: #1290accf;
  width: 180px;
  height: 80px;
  border: 0;
  border-radius: 5px;
  color: #fff;
  transition: all 0.4s;
}
.btn_menu:hover {
  background: #0c7c96;
}

.mensaje {
  width: 100%;
  margin-top: 100px;
  margin-block: 100px;
  text-align: center;
}

.far {
  font-size: 8rem;
  color: #39ab81;
}
.principal {
  margin-top: 50px;
  padding: 0;
}
.titulo {
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
  text-align: center;
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

@keyframes aparecerTitulo {
  0% {
    opacity: 0;
  }
  50% {
    opacity: 0.5;
  }
  100% {
    opacity: 1;
  }
}

@keyframes moverArribaAbajo {
  0% {
    margin-top: -300px;
  }
  100% {
    margin-top: 10px;
  }
}

@media only screen and (max-width: 900px) {
  .secundario {
    width: 95%;
    margin: 10px 10px 170px 10px;
  }
  .icono{
    padding: 5px 5px 5px 130px;
  }
  .icono img{
    width: 50px;
  }
  table{
    margin: 10px 20px;
  }
}
</style>