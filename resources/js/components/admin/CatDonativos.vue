            <template>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card" v-if="$gate.isAdmin()">
            <div class="card-header">
              <h3 class="card-title">Lista de categoria donativos</h3>

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
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="catDonativo in catDonativos.data"
                    :key="catDonativo.id"
                  >
                    <td>{{ catDonativo.id }}</td>
                    <td class="text-capitalize">{{ catDonativo.nombre }}</td>
                    <td>{{ catDonativo.estado }}</td>
                    <td>
                      <img
                        v-bind:src="'/images/CatDonativos/' + catDonativo.photo"
                        width="50px"
                        height="50px"
                      />
                    </td>
                    <td>
                      <a href="#" @click="editModal(catDonativo)">
                        <i class="fa fa-edit blue"></i>
                      </a>
                      /
                      <a href="#" @click="eliminarCatDonativo(catDonativo.id)">
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
                :data="catDonativos"
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
                Crear nueva categoria donativo
              </h5>
              <h5 class="modal-title" v-show="editmode">
                Actualizar categoria donativo
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
                  <label>Nombre</label>
                  <input
                    v-model="form.nombre"
                    type="text"
                    name="nombre"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('nombre') }"
                  />
                  <has-error :form="form" field="nombre"></has-error>
                </div>
                <div class="form-group">
                  <label>Estado</label>
                  <input
                    id="checkbox"
                    type="checkbox"
                    v-model="form.estado"
                    true-value="yes"
                    false-value="no"
                    v-on:input="checkboxVal = $event.target.value"
                  />
                 
                  <has-error :form="form" field="estado"></has-error>
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
      catDonativos: {},
      form: new Form({
        id: "",
        nombre: "",
        estado: "",
        photo: "",
      }),
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
      $("#addNew").modal("show");
      this.form.fill(catdonativo);
    },
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#addNew").modal("show");
    },

    cargarCatDonativos() {
      if (this.$gate.isAdmin()) {
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
            title: "Ocurrio un error!",
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