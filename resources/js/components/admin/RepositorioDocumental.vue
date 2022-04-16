<template>
  <section class="content">
    <div class="container-fluid">
            <div class="block-header" v-if="$gate.isAdmin() || $gate.isUser()">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <ul class="breadcrumb breadcrumb-style">
              <li class="breadcrumb-item">
                <h4 class="page-title">Repositorio</h4>
              </li>
              <li class="breadcrumb-item bcrumb-1">
                <a href="/admin/dashboard">
                  <i class="fas fa-home"></i>
                  Inicio
                </a>
              </li>
              <li class="breadcrumb-item active">Repositorio</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card" v-if="$gate.isAdmin()">
            <div class="card-header">
              <h3 class="card-title">Lista repositorio de documentos</h3>

              <div class="card-tools">
                <div>
                  <select
                    class="form-control"
                    v-model="valorMostrar"
                    @change="mostrar()"
                  >
                    <option value="10">Mostrar 10</option>
                    <option value="25">Mostrar 25</option>
                    <option value="50">Mostrar 50</option>
                  </select>
                </div>
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
                    Agregar Documento
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
                    <th>Nombre del archivo</th>
                    <th>Fecha</th>
                    <th>Descripción</th>
                    <th>Funciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="repositorio in repositorios.data"
                    :key="repositorio.id"
                  >
                    <td>{{ repositorio.id }}</td>
                    <td>{{ repositorio.nombre }}</td>
                    <td>{{ repositorio.fecha }}</td>
                    <td>{{ repositorio.descripcion | truncate(10, "...") }}</td>
                    <td>
                      <a href="#" @click="editModal(repositorio)">
                        <i id="icono" class="fa fa-edit blue"></i>
                      </a>
                      /
                      <a
                        href="#"
                        @click="eliminarRepositorioDocumental(repositorio.id)"
                      >
                        <i id="icono" class="fa fa-trash red"></i>
                      </a>
                      /
                      <a href="#" @click="detailsModal(repositorio)">
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
                :data="repositorios"
                @pagination-change-page="getResults"
              ></pagination>
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>

      <div v-if="!$gate.isAdmin()">
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
                Crear nuevo documento
              </h5>
              <h5 class="modal-title" v-show="editmode">
                Actualizar documento
              </h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form
              @submit.prevent="
                editmode ? actualizarDocumento() : crearDocumentos()
              "
            >
              <div class="modal-body">
                <div class="form-group">
                  <label>Nombre del documento</label>
                  <input
                    v-model="form.nombre"
                    type="text"
                    name="nombre"
                    class="form-control"
                    placeholder="Nombre del documento"
                    required
                    :class="{ 'is-invalid': form.errors.has('nombre') }"
                     pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]{3,30}"
                     minlength="1"
                     maxlength="30"
                  />
                  <has-error :form="form" field="nombre"></has-error>
                </div>

                <div class="form-group">
                  <label>Fecha de publicación</label>
                  <input
                    v-model="form.fecha"
                    type="date"
                    name="fecha"
                    class="form-control"
                    placeholder="Fecha de publicacion del documento"
                    required
                    :class="{ 'is-invalid': form.errors.has('fecha') }"
                  />
                  <has-error :form="form" field="fecha"></has-error>
                </div>
                <div class="form-group">
                  <label>Descripción</label>
                  <textarea
                    v-model="form.descripcion"
                    class="form-control"
                    name="descripcion"
                    :class="{ 'is-invalid': form.errors.has('descripcion') }"
                    placeholder="Breve descripción"
                    required
                    minlength="3"
                    maxlength="255"
                     pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]{3,255}"
                    id=""
                    rows="3"
                  ></textarea>
                  <has-error :form="form" field="descripcion"></has-error>
                </div>

                <div class="form-group">
                  <div>
                    <div class="row">
                      <div class="col-8">
                        <label class="btn btn-default p-0">
                          <input
                            type="file"
                            accept="application/pdf"
                            ref="file"
                            @change="onFileChange"
                            :class="{
                              'is-invalid': form.errors.has('documento'),
                            }"
                            id="documento"
                            name="documento"
                          />
                          <has-error :form="form" field="documento"></has-error>
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
                          width="100px"
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
                <div class="form-group">
                  <label>Tipo de archivo</label>
                  <select
                    class="form-control"
                    v-model="form.tipo"
                    :class="{ 'is-invalid': form.errors.has('tipo') }"
                    required
                  >
                    <option disabled value="">
                      Seleccione el tipo de archivo
                    </option>
                    <option value="Prácticas Profesionales">
                      Prácticas Profesionales
                    </option>
                    <option value="Tesis">Tesis</option>
                    <option value="Artículos Científicos">
                      Artículos Científicos
                    </option>
                    <option value="Libros">Libros</option>
                  </select>
                  <has-error :form="form" field="tipo"></has-error>
                </div>
              </div>

              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-dismiss="modal"
                  @click="limpiar()"
                >
                  Cancelar
                </button>
                <button
                  v-show="editmode"
                  type="submit"
                  class="btn btn-primary"
                  enctype="multipart/form-data"
                >
                  Actualizar
                </button>
                <button
                  v-show="!editmode"
                  type="submit"
                  class="btn btn-primary"
                  enctype="multipart/form-data"
                >
                  Guardar
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Modal de ver informacion -->
      <div
        class="modal fade"
        id="exampleModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModal"
        aria-hidden="true"
      >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Detalles del documento</h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <div class="form-group">
                <label>Nombre del documento</label>
                <input
                  v-model="form.nombre"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
              <div class="form-group">
                <label>Fecha de subida</label>
                <input
                  v-model="form.fecha"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
              <div class="form-group">
                <label>Descripción</label>
                <textarea
                  v-model="form.descripcion"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                  name=""
                  id=""
                  cols="30"
                  rows="10"
                ></textarea>
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
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      valorMostrar: "10",
      editmode: false,
      currentImage: undefined,
      previewImage: undefined,
      progress: 0,
      message: "",
      imageInfos: [],
      repositorios: {},
      repositoriosTodos: {},
      verDetalles: true,
      filtrarBusqueda: "",
      form: new Form({
        id: "",
        nombre: "",
        fecha: "",
        descripcion: "",
        tipo: "",
        documento: "",
      }),
    };
  },
  methods: {
    filtrar() {
      if (this.filtrarBusqueda == "") {
        this.repositorios.data = this.repositoriosTodos;
      } else if (this.filtrarBusqueda != "") {
        this.repositorios.data = this.repositoriosFiltrados;
      }
    },
    onFileChange(e) {
      let CargarArchivo = e.target.files[0];
      if (CargarArchivo) {
        let reader = new FileReader();
        reader.onload = (e) => {
          this.form.documento = e.target.result;
        };
        reader.readAsDataURL(CargarArchivo);
      } else {
        Swal.fire("Oops...", "No se cargo ningún archivo", "error");
      }
    },
    limpiar() {
      this.form.nombre = "";
      this.form.fecha = "";
      this.form.descripcion = "";
      this.form.tipo = "";
      this.form.documento = "";
      this.form.errors.clear();
    },
    mostrar() {
      if (this.$gate.isAdmin() || this.$gate.isUser()) {
        this.form
          .get("/api/repositorio/mostrar/", {
            params: { valor: this.valorMostrar },
          })
          .then(({ data }) => (this.repositorios = data.data));
      }
    },
    getResults(page = 1) {
      this.$Progress.start();
      axios
        .get(`/api/repositorio?page=` + page, {
          params: { valor: this.valorMostrar },
        })
        .then(({ data }) => (this.repositorios = data.data));
      this.$Progress.finish();
    },
    editModal(repositorio) {
      repositorio.documento = null;
      this.editmode = true;
      this.form.reset();
      $("#documento").val("");
      $("#addNew").modal("show");
      this.form.fill(repositorio);
    },
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.errors.clear();
    },
    detailsModal(repositorio) {
      $("#exampleModal").modal("show");
      this.form.fill(repositorio);
    },
    cargarDocumentos() {
      if (this.$gate.isAdmin()) {
        axios
          .get(`/api/repositorio`)
          .then(({ data }) => (this.repositorios = data.data));
      }
    },
    actualizarDocumento() {
      this.$Progress.start();
      console.log(this.form);
      this.form
        .put(`/api/repositorio/${this.form.id}`)
        .then((response) => {
          $("#addNew").modal("hide");
          Toast.fire({
            icon: "success",
            title: response.data.message,
          });
          this.$Progress.finish();
          this.cargarDocumentos();
          this.limpiar();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    eliminarRepositorioDocumental(id) {
      Swal.fire({
        title: "Seguro que lo desea eliminar?",
        text: "Esta acción no puede revertirse!",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Si, Eliminar!",
      }).then((result) => {
        if (result.value) {
          this.form
            .delete(`/api/repositorio/${id}`)
            .then(() => {
              Swal.fire(
                "Eliminado!",
                "Se ha eliminado la información.",
                "success"
              );
              this.cargarDocumentos();
            })
            .catch((data) => {
              Swal.fire("Fallo!", data.message, "warning");
            });
        }
      });
    },
    crearDocumentos() {
      this.$Progress.start();
      this.form
        .post(`/api/repositorio`)
        .then((response) => {
          $("#addNew").modal("hide");
          Toast.fire({
            icon: "success",
            title: response.data.message,
          });
          this.$Progress.finish();
          this.cargarDocumentos();
          this.limpiar();
        })
        .catch(() => {
          Toast.fire({
            icon: "error",
            title: "Ocurrio un error!",
          });
        });
    },
  },
  mounted() {
    console.log("Component mounted.");
  },
  eliminarRepositorioDocumental(id) {},
  created() {
    this.$Progress.start();
    this.cargarDocumentos();
    this.$Progress.finish();
  },
  filters: {
    truncate: function (text, length, suffix) {
      return text.substring(0, length) + suffix;
    },
  },
  computed: {
    repositoriosFiltrados: function () {
      return this.repositoriosTodos.filter((repositorio) => {
        return (
          repositorio.nombre
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) ||
          repositorio.fecha
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) ||
          repositorio.descripcion
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase())
        );
      });
    },
  },
};
</script>


<style lang="css" scoped>
.card-tools {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
}
.card-title {
  margin: 1px;
  line-height: inherit;
  float: left;
  font-size: 1.8rem;
  font-weight: 400;
}
.card-tools div {
  padding: 10px;
}
.card-tools div button {
  height: 36px;
  font-size: 15px;
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
@media only screen and (min-device-width: 100px) and (max-device-width: 900px) {
  .pagination {
    display: flex;
    padding-left: 0;
    list-style: none;
    border-radius: 0.25rem;
    flex-wrap: wrap;
  }
}
</style>
