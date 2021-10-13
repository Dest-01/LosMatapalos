<template>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card" v-if="$gate.isAdmin()">
            <div class="card-header">
              <h3 class="card-title">Lista flora</h3>

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
                    <th>Id Flora</th>
                    <th>Nombre comun</th>
                    <th>Nombre cientifico</th>
                    <th>Descripcion</th>
                    <th>Tipo</th>
                    <th>Photo</th>
                    <th>Familia cientifica</th>
                    <th>Fecha registro</th>   
                    
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="Flora in flora.data" :key="Flora.id">
                    <td>{{ Flora.id }}</td>
                    <td class="text-capitalize">{{ Flora.nom_comun }}</td>
                    <td class="text-capitalize">{{ Flora.nom_cientifico }}</td>
                     <td>{{Flora.descripcion | truncate(30, '...')}}</td>
                    <td class="text-capitalize">{{ Flora.tipo }}</td>
                    <td>
                      <img
                        v-bind:src="'/images/flora/' + Flora.photo"
                        width="50px"
                        height="50px"
                      />
                    </td>
                    <td class="text-capitalize">{{ Flora.fam_cientifica }}</td>
                    <td class="text-capitalize">{{ Flora.fecha_registro }}</td>
                    
                    
                    <td>
                      <a href="#" @click="editModal(Flora)">
                        <i class="fa fa-edit blue"></i>
                      </a>
                      /
                      <a href="#" @click="eliminarFlora(Flora.id)">
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
                :data="flora"
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
        @click="limpiar()"
      >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" v-show="!editmode">
                Registrar nueva especie
              </h5>
              <h5 class="modal-title" v-show="editmode">
                Actualizar especie
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
                editmode ? actualizarFlora() : crearFlora()
              "
            >
              <div class="modal-body">
                <div class="form-group">
                  <label>Nombre comun</label>
                  <input
                    v-model="form.nom_comun"
                    type="text"
                    name="nom_comun"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('nom_comun') }"
                  />
                  <has-error :form="form" field="nom_comun"></has-error>
                </div>
                
                
                <div class="form-group">
                  <label>Nombre cientifico</label>
                  <input
                    v-model="form.nom_cientifico"
                    type="text"
                    name="nom_cientifico"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('nom_cientifico') }"
                  />
                  <has-error :form="form" field="nom_cientifico"></has-error>
                </div>

                <div class="form-group">
                  <label>Descripcion</label>
                  <input
                    v-model="form.descripcion"
                    type="text"
                    name="Descripcion"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('descripcion') }"
                  />
                  <has-error :form="form" field="descripcion"></has-error>
                </div>

                <div class="form-group">
                  <label>Tipo de flora</label>
                  <select
                    class="form-control"
                    v-model="form.tipo"
                    :class="{ 'is-invalid': form.errors.has('tipo') }">
                    <option disabled value="">Seleccione un elemento</option>
                    <option>Plantas leñosas</option>
                    <option>Plantas herbaceas</option>
                  </select>

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
                        :style="{ width: progress + '%' }">
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
                  <label>Familia cientifica</label>
                  <input
                    v-model="form.fam_cientifica"
                    type="text"
                    name="fam_cientifica"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('fam_cientifica') }"
                  />
                  <has-error :form="form" field="fam_cientifica"></has-error>
                </div>

                <div class="form-group">
                  <label>Fecha de registro</label>
                  <input
                    v-model="form.fecha_registro"
                    type="date"
                    name="fecha_registro"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('fecha_registro') }"
                  />
                  <has-error :form="form" field="fecha_registro"></has-error>
                </div>
       
              </div>

              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-dismiss="modal"
                  @click="limpiar()">
                  Cancelar
                </button>
                <button v-show="editmode" type="submit" class="btn btn-success">
                  Actualizar
                </button>
                <button
                  v-show="!editmode"
                  type="submit"
                  class="btn btn-primary">
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
      flora: {},
      form: new Form({
        id: "",
        nom_comun: "",
        nom_cientifico: "",
        fecha_registro: "",
        descripcion: "",
        photo: "",
        tipo: "",
        fam_cientifica: "",
      }),
    };
  },
  methods: {
    updatePhoto(e) {
      let file = e.target.files[0];
      this.previewImage = URL.createObjectURL(file);
      this.currentImage = file;
      let reader = new FileReader();

      if (file["size"] < 30111775) {
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
    limpiar() {
      this.form.errors.clear();
    },

    getResults(page = 1) {
      this.$Progress.start();
      axios
        .get("/api/flora?page=" + page)
        .then(({ data }) => (this.flora = data.data));
      this.$Progress.finish();
    },
    actualizarFlora() {
      this.$Progress.start();
      this.form
        .put("/api/flora/" + this.form.id)
        .then((response) => {
          // success
          $("#addNew").modal("hide");
          Toast.fire({
            icon: "success",
            title: response.data.message,
          });
          this.$Progress.finish();
          //  Fire.$emit('AfterCreate');

          this.cargarFlora();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    editModal(Flora) {
      this.editmode = true;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(Flora);
    },
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#addNew").modal("show");
    },

    cargarFlora() {
      if (this.$gate.isAdmin()) {
        axios
          .get("/api/flora")
          .then(({ data }) => (this.flora = data.data));
      }
    },

    crearFlora() {
      this.$Progress.start();
      this.form
        .post("/api/flora")
        .then((response) => {
          $("#addNew").modal("hide");

          Toast.fire({
            icon: "success",
            title: response.data.message,
          });

          this.$Progress.finish();
          this.cargarFlora();
        })
        .catch(() => {
          Toast.fire({
            icon: "error",
            title: "Ocurrio un error!",
          });
        });
    },
    eliminarFlora(id) {
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
            .delete("/api/flora/" + id)
            .then(() => {
              Swal.fire(
                "Eliminado!",
                "Se ha eliminado la información.",
                "success"
              );
              // Fire.$emit('AfterCreate');
              this.cargarFlora();
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
  eliminarFlora(id) {},

  created() {
    this.$Progress.start();
    this.cargarFlora();
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