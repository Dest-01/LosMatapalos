            <template>
  <section class="content">
    <div class="container-fluid">
      <div class="block-header" v-if="$gate.isAdmin() || $gate.isUser()">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <ul class="breadcrumb breadcrumb-style">
              <li class="breadcrumb-item">
                <h4 class="page-title">Donativos Necesarios</h4>
              </li>
              <li class="breadcrumb-item bcrumb-1">
                <a href="/dashboard">
                  <i class="fas fa-home"></i>
                  Inicio
                </a>
              </li>
              <li class="breadcrumb-item active">Donativos Necesarios</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card" v-if="$gate.isAdmin() || $gate.isUser()">
            <div class="card-header">
              <h3 class="card-title">Lista de donativos necesarios</h3>

              <div class="card-tools">
                <div>
                  <button
                    type="button"
                    class="btn btn-sm btn-primary"
                    @click="newModal"
                  >
                    <i class="fa fa-plus-square"></i>
                    agregar nuevo
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
                    <th>Estado</th>
                    <th>Imagen</th>
                    <th>Funciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="catDonativo in catDonativos.data"
                    :key="catDonativo.id"
                  >
                    <td>{{ catDonativo.id }}</td>
                    <td>{{ catDonativo.nombre }}</td>
                    <td v-if="catDonativo.estado == 0">No es necesario</td>
                    <td v-else>Es necesario</td>
                    <td>
                      <img
                        v-bind:src="'/images/CatDonativos/' + catDonativo.photo"
                        width="30%"
                        height="100px"
                      />
                    </td>
                    <td>
                      <a href="#" @click="editModal(catDonativo)">
                        <i id="icono" class="fa fa-edit blue"></i>
                      </a>
                      /
                      <a href="#" @click="eliminarCatDonativo(catDonativo.id)">
                        <i id="icono" class="fa fa-trash red"></i>
                      </a>
                      /
                      <a href="#" @click="detailsModal(catDonativo)">
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
                :data="catDonativos"
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
                Crear donativo necesario
              </h5>
              <h5 class="modal-title" v-show="editmode">
                Actualizar donativo necesario
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

            <!-- <form @submit.prevent="createUser"> -->

            <form
              @submit.prevent="
                editmode ? actualizarCatDonativo() : crearCatDonativo()
              "
            >
              <div class="modal-body">
                <div class="form-group">
                  <label>Nombre del donativo necesario</label>
                  <input
                    v-model="form.nombre"
                    type="text"
                    name="nombre"
                    required
                    minlength="3"
                    maxlength="25"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('nombre') }"
                    placeholder="Escriba el donativo necesario"
                  />
                  <has-error :form="form" field="nombre"></has-error>
                </div>
                <div class="form-group">
                  <label>Estado</label>
                  <input
                    id="checkbox"
                    type="checkbox"
                    v-model="form.estado"
                    true-value="1"
                    false-value="0"
                    v-on:input="checkboxVal = $event.target.value"
                    @change="mostrarOpcion($event.target.value)"
                  />
                  <label v-show="mostrarEstado" v-text="estado">{{
                    estado
                  }}</label>
                  <has-error :form="form" field="estado"></has-error>
                </div>
                <div class="form-group">
                  <div>
                    <div class="row">
                      <div class="col-8">
                        <label for="">Imagen del donativo necesario</label>
                        <label class="btn btn-default p-0">
                          <input
                            type="file"
                            accept="image/*"
                            ref="file"
                            name="photo"
                            @change="updatePhoto"
                            :class="{ 'is-invalid': form.errors.has('photo') }"
                            id="SubirImagen"
                          />
                          <has-error :form="form" field="photo"></has-error>
                        </label>
                      </div>
                    </div>
                    <div class="progress"></div>
                    <div v-if="previewImage">
                      <div>
                        <img
                          class="preview my-3"
                          :src="previewImage"
                          alt=""
                          title="Imagen Previa"
                          width="100%"
                          height="250px"
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
                  Cerrar
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
        id="exampleModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModal"
        aria-hidden="true"
      >
        <div class="modal-dialog" role="document">
          <div id="modal-contentino" class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Detalles del donativo necesaro</h5>
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
                <label>Nombre de donativo necesario</label>
                <input
                  v-model="form.nombre"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
              <div class="form-group">
                <label>Estado del donativo necesario</label>
                <input
                  v-if="form.estado == 0"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                  value="No es necesario"
                />
                <input
                  v-else
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                  value="Es necesario"
                />
              </div>
              <div class="form-group">
                <label>Imagen</label>
                <img
                  v-bind:src="'/images/CatDonativos/' + form.photo"
                  width="100%"
                  height="400px"
                />
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
      editmode: false,
      currentImage: undefined,
      previewImage: undefined, //Imagen Previa al cargar
      progress: 0,
      message: "",
      imageInfos: [],
      mostrarEstado: true,
      estado: "No es necesario",
      filtrarBusqueda: "",
      verDetalles: true,
      catDonativos: {},
      nuevoCatDonativos: {},
      form: new Form({
        id: "",
        nombre: "",
        estado: 0,
        photo: "",
      }),
    };
  },
  methods: {
    filtrar() {
      if (this.filtrarBusqueda == "") {
        this.catDonativos.data = this.nuevoCatDonativos;
      } else if (this.filtrarBusqueda != "") {
        this.catDonativos.data = this.catDonativosFiltrados;
      }
    },

    updatePhoto(e) {
      let file = e.target.files[0];
      this.previewImage = URL.createObjectURL(file);
      this.currentImage = file;
      let reader = new FileReader();

      if (file["size"] < 12111775) {
        reader.onloadend = (file) => {
          //console.log('RESULT', reader.result)
          this.form.photo = reader.result;
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
    mostrarOpcion(val) {
      if (this.form.estado == 0) {
        this.mostrarEstado = true;
        this.estado = "No es necesario";
      } else {
        this.estado = "Necesario";
      }
    },

    getResults(page = 1) {
      this.$Progress.start();

      axios
        .get("/api/catDonativo?page=" + page)
        .then(({ data }) => (this.catDonativos = data.data));

      this.$Progress.finish();
    },
    actualizarCatDonativo() {
      this.$Progress.start();
      this.form
        .put("/api/catDonativo/" + this.form.id)
        .then((response) => {
          // success
          $("#addNew").modal("hide");
          Toast.fire({
            icon: "success",
            title: response.data.message,
          });
          this.$Progress.finish();
          //  Fire.$emit('AfterCreate');

          this.cargarCatDonativos();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    editModal(catdonativo) {
      this.editmode = true;
      this.form.reset();
      this.form.errors.clear();
      $("#addNew").modal("show");
      this.form.fill(catdonativo);
      this.previewImage = form.photo;
    },
    newModal() {
      this.editmode = false;
      this.previewImage = undefined;
      this.form.reset();
      this.form.errors.clear();
      this.estado = "No es necesario";
      $("#SubirImagen").val("");
      this.previewImage = "";
      $("#addNew").modal("show");
    },
    detailsModal(catdonativo) {
      $("#exampleModal").modal("show");
      this.form.fill(catdonativo);
    },
    cargarCatDonativos() {
      if (this.$gate.isAdmin() || this.$gate.isUser()) {
        axios
          .get("/api/catDonativo")
          .then(({ data }) => (this.catDonativos = data.data));
      }
    },

    crearCatDonativo() {
      this.$Progress.start();
      this.form
        .post("/api/catDonativo")
        .then((response) => {
          $("#addNew").modal("hide");

          Toast.fire({
            icon: "success",
            title: response.data.message,
          });

          this.$Progress.finish();
          this.cargarCatDonativos();
        })
        .catch(() => {
          Toast.fire({
            icon: "error",
            title: "Campos vacios!",
          });
        });
    },
    eliminarCatDonativo(id) {
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
            .delete("/api/catDonativo/" + id)
            .then(() => {
              Swal.fire(
                "Eliminado!",
                "Se ha eliminado la información.",
                "success"
              );
              // Fire.$emit('AfterCreate');
              this.cargarCatDonativos();
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
  eliminarCatDonativo(id) {},

  created() {
    this.$Progress.start();
    this.cargarCatDonativos();
    this.$Progress.finish();
  },
  filters: {
    truncate: function (text, length, suffix) {
      return text.substring(0, length) + suffix;
    },
  },
  computed: {},
};
</script>


<style scoped>
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
#modal-contentino {
  width: 150%;
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
