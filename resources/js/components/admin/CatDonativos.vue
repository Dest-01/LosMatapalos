            <template>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card" v-if="$gate.isAdmin()">
            <div class="card-header">
              <h3 class="card-title">Lista de donativos necesarios</h3>

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
                  <label>Nombre del donativo necesario</label>
                  <input style="text-transform: capitalize;"
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
                    @change="mostrarOpcion($event.target.value)"
                  />
                 <label v-show="mostrarEstado" v-text="estado">{{estado}}</label>
                  <has-error :form="form" field="estado"></has-error>
                </div>
                <div class="form-group">
                  <div>
                    <div class="row">
                      <div class="col-8">
                        <label class="btn btn-default p-0">
                          <input
                            type="file"
                            accept="image/*"
                            ref="file"
                            name="photo"
                            @change="updatePhoto"
                            :class="{ 'is-invalid': form.errors.has('photo') }"
                          />
                          <has-error :form="form" field="photo"></has-error>
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
      mostrarEstado: true,
      estado: "No es necesario",
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
    mostrarOpcion(val){
       if (this.form.estado == "no") {
        this.mostrarEstado = true;
        this.estado = "No es necesario";
      }else{
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
      $("#addNew").modal("show");
      this.form.fill(catdonativo);
    },
    newModal() {
      this.editmode = false;
      this.form.reset();
      this.estado = "No es necesario";
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