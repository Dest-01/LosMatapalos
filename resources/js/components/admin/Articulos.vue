<template>
  <section class="content">
    <div class="container-fluid">
      <div class="block-header" v-if="$gate.isAdmin() || $gate.isUser()">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <ul class="breadcrumb breadcrumb-style">
              <li class="breadcrumb-item">
                <h4 class="page-title">Marca</h4>
              </li>
              <li class="breadcrumb-item bcrumb-1">
                <a href="/dashboard">
                  <i class="fas fa-home"></i>
                  Inicio
                </a>
              </li>
              <li class="breadcrumb-item active">Marca</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card" v-if="$gate.isAdmin() || $gate.isUser()">
            <div class="card-header">
              <h3 class="card-title">Lista de Articulos</h3>

              <div class="card-tools">
                 <div>
                  <input
                    v-on:keyup="filtrar()"
                    v-model="filtrarBusqueda"
                    class="form-control"
                    type="text"
                    name="buscar"
                    placeholder="Buscar..."
                  />
                </div>
                <div>
                <button
                  type="button"
                  class="btn btn-sm btn-primary"
                  @click="newModal"
                >
                  <i class="fa fa-plus-square"></i>
                  Agregar Artículo
                </button>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Descripción</th>
                    <th>Imagen</th>
                    <th>Funciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="articulo in Articulos.data" :key="articulo.id">
                    <td>{{ articulo.id }}</td>
                    <td>{{ articulo.Nombre }}</td>
                    <td>{{ articulo.Tipo }}</td>
                    <td>{{ articulo.Descripcion | truncate(10, "...") }}</td>
                    <td>
                      <img
                        v-bind:src="'/images/Articulos/' + articulo.Image"
                        width="50px"
                        height="50px"
                      />
                    </td>
                    <td>
                      <a href="#" @click="editModal(articulo)">
                        <i id="icono" class="fa fa-edit blue"></i>
                      </a>
                      /
                      <a href="#" @click="eliminarArticulo(articulo.id)">
                        <i id="icono" class="fa fa-trash red"></i>
                      </a>
                      /
                      <a
                        href="#"
                        @click="detailsModal(articulo)"
                      >
                        <i id="icono" class="fa fa-eye green"></i>
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <pagination
                :data="Articulos"
                @pagination-change-page="getResults"
              ></pagination>
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>

      <div v-if="!$gate.isAdmin() && !$gate.isUser()">
        <not-found></not-found>
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
              <h5 class="modal-title" v-show="!editmode">
                Registrar nuevo artículo
              </h5>
              <h5 class="modal-title" v-show="editmode">Actualizar Articulo</h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <!-- <form @submit.prevent="createUser"> -->

            <form
              @submit.prevent="
                editmode ? actualizarArticulo() : crearArticulo()
              "
            >
              <div class="modal-body">
                <div class="form-group">
                  <label>Nombre</label>
                  <input
                    v-model="form.Nombre"
                    type="text"
                    name="Nombre"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('Nombre') }"
                    required
                    minlength="3"
                    maxlength="20"
                    placeholder="Nombre del artículo"
                  />
                  <has-error :form="form" field="Name"></has-error>
                </div>

                <div class="form-group">
                  <label>Tipo</label>
                  <input
                    v-model="form.Tipo"
                    type="text"
                    name="Tipo"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('Tipo') }"
                    required
                    minlength="3"
                    maxlength="20"
                    placeholder="Tipo de artículo"
                  />
                  <has-error :form="form" field="Tipo"></has-error>
                </div>
                <div class="form-group">
                  <label>Descripción</label>
                  <textarea
                    v-model="form.Descripcion"
                    class="form-control"
                    name="Descripcion"
                    :class="{ 'is-invalid': form.errors.has('Descripcion') }"
                    placeholder="Descripción"
                    required
                    minlength="3"
                    maxlength="60"
                    id=""
                    rows="3"
                  ></textarea>
                  <has-error :form="form" field="Descripcion"></has-error>
                </div>
                <div class="form-group">
                   <label>Imagen</label>
                  <div>
                    <div class="row">
                      <div class="col-8">
                        <label class="btn btn-default p-0">
                          <input
                            type="file"
                            accept="image/*"
                            ref="file"
                            name="Image"
                            @change="updatePhoto"
                            :class="{ 'is-invalid': form.errors.has('Image') }"
                            id="SubirImagen"
                          />
                          <has-error :form="form" field="Image"></has-error>
                        </label>
                      </div>
                      <div class="col-4"></div>
                    </div>
                    <div v-if="currentImage" class="progress">
                      <div
                        class="progress-bar progress-bar-info"
                        role="progressbar"
                        :aria-valuenow="progress"
                        aria-valuemin="0"
                        aria-valuemax="100"
                        :style="{ width: progress + '%' }"
                      >
                        {{ progress }}%
                      </div>
                    </div>
                    <div v-if="previewImage">
                      <div>
                        <img
                          class="preview my-3"
                          :src="previewImage"
                          alt=""
                          width="100%"
                        />
                      </div>
                    </div>
                    <div
                      v-if="message"
                      class="alert alert-secondary"
                      role="alert"
                    >
                      {{ message }}
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-dismiss="modal"
                >
                  Cancelar
                </button>
                <button v-show="editmode" type="submit" class="btn btn-success">
                  Actualizar
                </button>
                <button
                  v-show="!editmode"
                  type="submit"
                  class="btn btn-primary"
                >
                  Registrar
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- Modal de ver informacion -->
      <div
        class="modal fade"
        id="ModalVer"
        tabindex="-1"
        role="dialog"
        aria-labelledby="ModalVer"
        aria-hidden="true"
      >
        <div class="modal-dialog" role="document">
          <div id="modal-contentino" class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Detalles del articulo</h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div id="modal-body" class="modal-body">
              <div id="inputsModal" class="form-group">
                <label>Nombre del articulo</label>
                <input
                  v-model="form.Nombre"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
              <div id="inputsModal" class="form-group">
                <label>Tipo de artiuclo</label>
                <input
                  v-model="form.Tipo"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
              
              <div class="form-group">
                <label>Foto del articulo</label>
                <img
                  v-bind:src="'/images/Articulos/' + form.Image"
                  width="100%"
                  height="350px"
                />
              </div>
              <div id="inputsModal" class="form-group">
                <label>Descripción</label>
                <textarea v-model="form.Descripcion"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles">
                  
                </textarea>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">
                Cerrar
              </button>
            </div>
          </div>
        </div>
      </div>
      <!--FIN DEL MODAL VER INFORMACION-->
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      editmode: false,
      currentImage: undefined,
      previewImage: undefined,
      progress: 0,
      message: "",
      imageInfos: [],
      Articulos: {},
      ArticulosTodos: {},
      verDetalles: true,
      filtrarBusqueda: "",
      form: new Form({
        id: "",
        Nombre: "",
        Tipo: "",
        Image: "",
        Descripcion: "",
      }),
    };
  },
  methods: {
       filtrar() {
      if (this.filtrarBusqueda == "") {
        this.Articulos.data = this.ArticulosTodos;
      } else if (this.filtrarBusqueda != "") {
        this.Articulos.data = this.articuloFiltros;
      }
    },
    updatePhoto(e) {
      let file = e.target.files[0];
      this.previewImage = URL.createObjectURL(file);
      this.currentImage = file;
      let reader = new FileReader();
      // 2111775 = 2 MB en base64
      // 9111775
      if (file["size"] < 9111775) {
        reader.onloadend = (file) => {
          //console.log('RESULT', reader.result)
          this.form.Image = reader.result;
        };
        reader.readAsDataURL(file);
      } else {
        swal({
          type: "error",
          title: "ops...",
          text: "archivo muy grande",
        });
      }
    },

    getResults(page = 1) {
      this.$Progress.start();

      axios
        .get("/api/articulos?page=" + page)
        .then(({ data }) => (this.Articulos = data.data));

      this.$Progress.finish();
    },
    actualizarArticulo() {
      this.$Progress.start();
      this.form
        .put("/api/articulos/" + this.form.id)
        .then((response) => {
          // success
          $("#addNew").modal("hide");
          Toast.fire({
            icon: "success",
            title: response.data.message,
          });
          this.$Progress.finish();
          //  Fire.$emit('AfterCreate');

          this.cargarArticulos();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    editModal(articulo) {
      this.editmode = true;
      this.form.reset();
      this.form.errors.clear();
      $("#SubirImagen").val("");
      this.previewImage = "";
      $("#addNew").modal("show");
      this.form.fill(articulo);
    },
    newModal() {
      this.editmode = false;
      this.form.reset();
      this.form.errors.clear();
      $("#SubirImagen").val("");
      this.previewImage = "";
      $("#addNew").modal("show");
    },
     detailsModal(articulo) {
      $("#ModalVer").modal("show");
      this.form.fill(articulo);
    },

    cargarArticulos() {
      if (this.$gate.isAdmin() || this.$gate.isUser()) {
        axios
          .get("/api/articulos")
          .then(({ data }) => (this.Articulos = data.data));
           axios
          .get("/api/articulos/listar")
          .then(({ data }) => (this.ArticulosTodos = data.data));
      }
    },

    crearArticulo() {
      this.$Progress.start();
      this.form
        .post("/api/articulos")
        .then((response) => {
          $("#addNew").modal("hide");

          Toast.fire({
            icon: "success",
            title: response.data.message,
          });

          this.$Progress.finish();
          this.cargarArticulos();
        })
        .catch(() => {
          Toast.fire({
            icon: "error",
            title: "Ocurrio un error!",
          });
        });
    },
    eliminarArticulo(id) {
      Swal.fire({
        title: "Seguro que lo desea eliminar?",
        text: "Esta acción no puede revertirse!",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Si, Eliminar!",
      }).then((result) => {
        // Send request to the server
        if (result.value) {
          this.form
            .delete("/api/articulos/" + id)
            .then(() => {
              Swal.fire(
                "Eliminado!",
                "Se ha eliminado la información.",
                "success"
              );
              // Fire.$emit('AfterCreate');
              this.cargarArticulos();
            })
            .catch((data) => {
              Swal.fire("Fallo!", data.message, "warning");
            });
        }
      });
    },
  },
  mounted() {
    console.log("Component mounted.");
  },

  created() {
    this.$Progress.start();
    this.cargarArticulos();
    this.$Progress.finish();
  },
  filters: {
    truncate: function (text, length, suffix) {
      return text.substring(0, length) + suffix;
    },
  },
  computed: {
    articuloFiltros: function () {
      return this.ArticulosTodos.filter((articulo) => {
        return (
          articulo.Nombre
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) ||
          articulo.Tipo
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) ||
          articulo.Descripcion
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) 
        );
      });
    }
  },
};
</script>


<style scoped>
.mostrar {
  display: list-item;
  opacity: 1;
  background: rgba(121, 120, 120, 0.623);
}
#btnCancelar {
  padding: 1px 5px;
  margin: 1px 1px 1px 10px;
}

#icono {
  font-size: 20px;
}
.card-tools {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
}
.card-tools div {
  padding: 10px;
}
.card-tools div button {
  height: 36px;
  font-size: 15px;
}
.card-title {
  margin: 1px;
  line-height: inherit;
  float: left;
  font-size: 1.8rem;
  font-weight: 400;
}
.identitad {
  display: flex;
  flex-direction: row;
  flex-wrap: nowrap;
}
#modal-contentino {
  width: 150%;
}
#modal-body {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  justify-content: space-around;
}
#inputsModal {
  width: 45%;
  margin: 10px 15px;
}

.table th,
.table td {
  padding: 0.75rem;
  vertical-align: baseline;
  border-top: 1px solid #dee2e6;
}
@media screen and (min-width: 900px) {
  .modal-content {
    width: 100%;
  }
}
</style>