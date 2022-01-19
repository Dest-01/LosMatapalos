<template>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card" v-if="$gate.isAdmin()">
            <div class="card-header">
              <h3 class="card-title">Lista Repositorio de Documentos</h3>

              <div class="card-tools">
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
                    <td class="text-capitalize">{{ repositorio.nombre }}</td>
                    <td class="text-capitalize">{{ repositorio.fecha }}</td>
                    <td class="text-capitalize">
                      {{ repositorio.descripcion | truncate(30, "...") }}
                    </td>
                    <td>
                      <a href="#" @click="editModal(repositorio)">
                        <i class="fa fa-edit blue"></i>
                      </a>
                      /
                      <a
                        href="#"
                        @click="eliminarRepositorioDocumental(repositorio.id)"
                      >
                        <i class="fa fa-trash red"></i>
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
                  <label>Nombre Documento</label>
                  <input
                    v-model="form.nombre"
                    type="text"
                    name="nombre"
                    class="form-control"
                    placeholder="Nombre del documento"
                    required
                    :class="{ 'is-invalid': form.errors.has('nombre') }"
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
                    maxlength="60"
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
                            required
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
                  <input
                    v-model="form.tipo"
                    type="text"
                    name="tipo"
                    class="form-control"
                    placeholder="Tipo de archivo"
                    required
                    :disabled="tipoPDF"
                    value="PDF"
                    :class="{
                      'is-invalid': form.errors.has('tipo'),
                    }"
                  />
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
      tipoPDF: true,
      repositorios: {},
      form: new Form({
        id: "",
        nombre: "",
        fecha: "",
        descripcion: "",
        tipo: "PDF",
        documento: "",
      }),
    };
  },
  methods: {
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
      this.fomr.fecha = "";
      this.form.descripcion = "";
      this.form.tipo = "";
      this.form.documento = "";
      this.form.errors.clear();
    },
    getResults(page = 1) {
      this.$Progress.start();
      axios
        .get(`/api/repositorio?page=` + page)
        .then(({ data }) => (this.repositorios = data.data));
      this.$Progress.finish();
    },
    editModal(repositorio) {
      this.editmode = true;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(repositorio);
    },
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.errors.clear();
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
    filteredItems() {
      return this.autocompleteItems.filter((i) => {
        return i.text.toLowerCase().indexOf(this.tag.toLowerCase()) !== -1;
      });
    },
  },
};
</script>

<style>
</style>