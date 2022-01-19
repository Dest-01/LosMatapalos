<template>
  <section>
    <div class="container-fluid">
      <div class="block-header" v-if="$gate.isAdmin() || $gate.isUser()">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <ul class="breadcrumb breadcrumb-style">
              <li class="breadcrumb-item">
                <h4 class="page-title">Fauna</h4>
              </li>
              <li class="breadcrumb-item bcrumb-1">
                <a href="/dashboard">
                  <i class="fas fa-home"></i>
                  Inicio
                </a>
              </li>
              <li class="breadcrumb-item active">Fauna</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card" v-if="$gate.isAdmin() || $gate.isUser()">
            <div class="card-header">
              <h3 class="card-title">Lista de fauna</h3>

              <div class="card-tools">
                <button
                  type="button"
                  class="btn btn-sm btn-primary"
                  @click="newModal"
                >
                  <i class="fa fa-plus-square"></i>
                  Agregar Nuevo
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Id Fauna</th>
                    <th>Nombre Común</th>
                    <th>Nombre Científico</th>
                    <th>Descripción</th>
                    <th>Tipo</th>
                    <th>Imagen</th>
                    <th>Familia científica</th>
                    <th>Fecha de registro</th>
                    <th>Funciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="fauna in faunas.data" :key="fauna.id">
                    <td>{{ fauna.id }}</td>
                    <td class="text-capitalize">{{ fauna.nombreComun }}</td>
                    <td class="text-capitalize">
                      {{ fauna.nombreCientifico }}
                    </td>
                    <td>{{ fauna.descripcion | truncate(30, "...") }}</td>
                    <td class="text-capitalize">{{ fauna.tipo }}</td>
                    <td>
                      <img
                        v-bind:src="'/images/Fauna/' + fauna.imagen"
                        width="50px"
                        height="50px"
                      />
                    </td>
                    <td class="text-capitalize">
                      {{ fauna.familiaCientifca }}
                    </td>
                    <td class="text-capitalize">
                      {{ fauna.fechaRegistro }}
                    </td>
                    <td>
                      <a href="#" @click="editModal(fauna)">
                        <i class="fa fa-edit blue"></i>
                      </a>
                      /
                      <a href="#" @click="eliminarFauna(fauna.id)">
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
                :data="faunas"
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
        @click="limpiar()"
      >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" v-show="!editmode">
                Registrar nueva especie
              </h5>
              <h5 class="modal-title" v-show="editmode">Actualizar especie</h5>
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

            <form @submit.prevent="editmode ? actualizarFauna() : crearFauna()">
              <div class="modal-body">
                <div class="form-group">
                  <label>Nombre Común</label>
                  <input
                    v-model="form.nombreComun"
                    type="text"
                    name="nombreComun"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('nombreComun') }"
                    placeholder="Nombre común de la especie"
                    required
                    minlength="3"
                    maxlength="30"
                  />
                  <has-error :form="form" field="nombreComun"></has-error>
                </div>
                <div class="form-group">
                  <label>Nombre Científico</label>
                  <input
                    v-model="form.nombreCientifico"
                    type="text"
                    name="nombreCientifico"
                    class="form-control"
                    :class="{
                      'is-invalid': form.errors.has('nombreCientifico'),
                    }"
                    placeholder="Nombre científico de la especie"
                    required
                    minlength="3"
                    maxlength="30"
                  />
                  <has-error :form="form" field="nombreCientifico"></has-error>
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
                  <label>Tipo de especie</label>
                  <input
                    v-model="form.tipo"
                    type="text"
                    name="tipo"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('tipo') }"
                    placeholder="Nombre del tipo de especie"
                    required
                    minlength="3"
                    maxlength="15"
                  />
                  <has-error :form="form" field="tipo"></has-error>
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
                            name="imagen"
                            @change="updatePhoto"
                            :class="{ 'is-invalid': form.errors.has('imagen') }"
                            id="SubirImagen"
                            required
                          />
                          <has-error :form="form" field="imagen"></has-error>
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
                  <label>Familia científica</label>
                  <input
                    v-model="form.familiaCientifca"
                    type="text"
                    name="familiaCientifca"
                    class="form-control"
                    :class="{
                      'is-invalid': form.errors.has('familiaCientifca'),
                    }"
                    placeholder="Nombre de la familia científica"
                    required
                    minlength="3"
                    maxlength="30"
                  />
                  <has-error :form="form" field="familiaCientifca"></has-error>
                </div>
                <div class="form-group">
                  <label>Fecha de registro</label>
                  <input
                    v-model="form.fechaRegistro"
                    type="date"
                    name="fechaRegistro"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('fechaRegistro') }"
                    required
                    minlength="3"
                    maxlength="30"
                  />
                  <has-error :form="form" field="fechaRegistro"></has-error>
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
      faunas: {},
      form: new Form({
        id: "",
        nombreComun: "",
        nombreCientifico: "",
        descripcion: "",
        tipo: "",
        imagen: "",
        familiaCientifca: "",
        fechaRegistro: "",
      }),
    };
  },
  methods: {
    updatePhoto(e) {
      let file = e.target.files[0];
      let reader = new FileReader();

      if (file["size"] < 9111775) {
        reader.onloadend = (file) => {
          //console.log('RESULT', reader.result)
          this.form.imagen = reader.result;
        };
        reader.readAsDataURL(file);
      } else {
        Swal.fire("Oops...", "Archivo muy grande", "error");
      }
    },
    limpiar() {
      this.form.errors.clear();
    },
    editModal(Fauna) {
      this.editmode = true;
      this.form.reset();
      $("#SubirImagen").val("");
      this.previewImage = "";
      $("#addNew").modal("show");
      this.form.fill(Fauna);
    },
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#SubirImagen").val("");
      this.previewImage = "";
      $("#addNew").modal("show");
    },
    getResults(page = 1) {
      this.$Progress.start();

      axios
        .get("/api/fauna?page=" + page)
        .then(({ data }) => (this.faunas = data.data));

      this.$Progress.finish();
    },
    cargarFauna() {
      if (this.$gate.isAdmin() || this.$gate.isUser()) {
        axios.get("/api/fauna").then(({ data }) => (this.faunas = data.data));
      }
    },
    crearFauna() {
      this.$Progress.start();
      this.form
        .post("/api/fauna")
        .then((response) => {
          $("#addNew").modal("hide");

          Toast.fire({
            icon: "success",
            title: response.data.message,
          });

          this.$Progress.finish();
          this.cargarFauna();
        })
        .catch(() => {
          Toast.fire({
            icon: "error",
            title: "Ocurrio un error!",
          });
        });
    },
    actualizarFauna() {
      this.$Progress.start();
      this.form
        .put("/api/fauna/" + this.form.id)
        .then((response) => {
          // success
          $("#addNew").modal("hide");
          Toast.fire({
            icon: "success",
            title: response.data.message,
          });
          this.$Progress.finish();
          this.cargarFauna();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    eliminarFauna(id) {
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
            .delete("/api/fauna/" + id)
            .then(() => {
              Swal.fire(
                "Eliminado!",
                "Se ha eliminado la información.",
                "success"
              );
              this.cargarFauna();
            })
            .catch((data) => {
              Swal.fire("Fallo!", "Acción no autorizada", "warning");
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
    this.cargarFauna();
    this.$Progress.finish();
  },
  filters: {
    truncate: function (text, length, suffix) {
      return text.substring(0, length) + suffix;
    },
  },
};
</script>

<style scoped>
</style>