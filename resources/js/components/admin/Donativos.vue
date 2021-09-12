<template>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card" v-if="$gate.isAdmin()">
            <div class="card-header">
              <h3 class="card-title">Lista de donativos</h3>

              <div class="card-tools">
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
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Detalle</th>
                    <th>Imagen</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="donativo in donativos.data" :key="donativo.id">
                    <td>{{ donativo.id }}</td>
                    <td class="text-capitalize">{{ donativo.tipo }}</td>
                    <td>{{ donativo.detalle | truncate(30, "...") }}</td>
                    <td>
                      <img
                        v-bind:src="'/images/donativos/' + donativo.photo"
                        width="50px"
                        height="50px"
                      />
                    </td>
                    <td>{{ donativo.fecha }}</td>
                    <td>{{ donativo.estado }}</td>
                    <td>
                      <a href="#" @click="editModal(donativo)">
                        <i class="fa fa-edit blue"></i>
                      </a>
                      /
                      <a href="#" @click="eliminarDonativo(donativo.id)">
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
                :data="donativos"
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
                Crear nuevo donativo
              </h5>
              <h5 class="modal-title" v-show="editmode">Actualizar donativo</h5>
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
                editmode ? actualizarDonativo() : crearDonativo()
              "
            >
              <div class="modal-body">
                <div class="form-group">
                  <label>Tipo</label>
                  <select
                    class="form-control"
                    v-model="form.tipo"
                    :class="{ 'is-invalid': form.errors.has('tipo') }"
                  >
                    <option disabled value="">Seleccione un elemento</option>
                    <option>Material</option>
                    <option>Monetario</option>
                  </select>

                  <has-error :form="form" field="estado"></has-error>
                </div>

                <div class="form-group">
                  <label>Cedula Persona</label>
                  <select class="form-control" v-model="form.idPersona">
                    <option
                      v-for="(per, index) in personas"
                      :key="index"
                      :value="index"
                      :selected="index == form.idPersona"
                    >
                      {{ per }}
                    </option>
                  </select>
                  <has-error :form="form" field="idPersona"></has-error>
                </div>

                <div class="form-group">
                  <label>Cedula Juridica</label>
                  <select class="form-control" v-model="form.idOrganizacion">
                    <option
                      v-for="(org, index) in organizaciones"
                      :key="index"
                      :value="index"
                      :selected="index == form.idOrganizacion"
                    >
                      {{ org }}
                    </option>
                  </select>
                  <has-error :form="form" field="idPersona"></has-error>
                </div>

                <div class="form-group">
                  <label>Detalle</label>
                  <input
                    v-model="form.detalle"
                    type="text"
                    name="detalle"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('detalle') }"
                  />
                  <has-error :form="form" field="detalle"></has-error>
                </div>
                <div class="form-group">
                  <label for="photo" class="col-sm-2 control-label"
                    >Imagen</label
                  >
                  <div class="custom-file">
                    <input
                      type="file"
                      @change="updatePhoto"
                      name="photo"
                      class="custom-file-input"
                      id="inputGroupFile01"
                    />
                    <label class="custom-file-label" for="inputGroupFile01"
                      >Seleccione un imagen</label
                    >
                  </div>
                </div>
                <div class="form-group">
                  <label>Fecha</label>
                  <input
                    v-model="form.fecha"
                    type="date"
                    name="fecha"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('fecha') }"
                  />
                  <has-error :form="form" field="fecha"></has-error>
                </div>
                <div class="form-group">
                  <label>Estado</label>
                  <select
                    class="form-control"
                    v-model="form.estado"
                    :class="{ 'is-invalid': form.errors.has('estado') }"
                  >
                    <option disabled value="">Seleccione un elemento</option>
                    <option>Recibido</option>
                    <option>Pendiente</option>
                    <option>Rechazado</option>
                  </select>

                  <has-error :form="form" field="estado"></has-error>
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
                  Crear
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
      donativos: {},
      form: new Form({
        id: "",
        persona: "",
        idPersona: "",
        organizacion: "",
        idOrganizacion: "",
        tipo: "",
        detalle: "",
        photo: "",
        fecha: "",
        estado: "",
      }),
      personas: [],
      organizaciones: [],
      org: null,
      per: null,
    };
  },
  methods: {
    updatePhoto(e) {
      let file = e.target.files[0];
      let reader = new FileReader();

      if (file["size"] < 2111775) {
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

    getResults(page = 1) {
      this.$Progress.start();

      axios
        .get("/api/donativo?page=" + page)
        .then(({ data }) => (this.donativos = data.data));

      this.$Progress.finish();
    },
    actualizarDonativo() {
      this.$Progress.start();
      this.form
        .put("/api/donativo/cedula/" + this.form.id)
        .then((response) => {
          // success
          $("#addNew").modal("hide");
          Toast.fire({
            icon: "success",
            title: response.data.message,
          });
          this.$Progress.finish();
          //  Fire.$emit('AfterCreate');

          this.cargarDonativos();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    editModal(donativo) {
      this.editmode = true;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(donativo);
    },
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#addNew").modal("show");
    },

    cargarDonativos() {
      if (this.$gate.isAdmin()) {
        axios
          .get("/api/donativo")
          .then(({ data }) => (this.donativos = data.data));
      }
    },
    cargarPersona() {
      axios
        .get("/api/persona/lista")
        .then(({ data }) => (this.personas = data.data));
    },
    cargarOrganizacion() {
      axios
        .get("/api/organizacion/lista")
        .then(({ data }) => (this.organizaciones = data.data));
    },

    crearDonativo() {
      this.$Progress.start();
      this.form
        .post("/api/donativo")
        .then((response) => {
          $("#addNew").modal("hide");

          Toast.fire({
            icon: "success",
            title: response.data.message,
          });

          this.$Progress.finish();
          this.cargarDonativos();
        })
        .catch(() => {
          Toast.fire({
            icon: "error",
            title: "Ocurrio un error!",
          });
        });
    },
    eliminarDonativo(id) {
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
            .delete("/api/donativo/" + id)
            .then(() => {
              Swal.fire(
                "Eliminado!",
                "Se ha eliminado la información.",
                "success"
              );
              // Fire.$emit('AfterCreate');
              this.cargarDonativos();
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
  deleteCategory(id) {},

  created() {
    this.$Progress.start();
    this.cargarDonativos();
    this.cargarPersona();
    this.cargarOrganizacion();
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