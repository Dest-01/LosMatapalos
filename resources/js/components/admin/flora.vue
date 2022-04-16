<template>
  <section class="content">
    <div class="container-fluid">
      <div class="block-header" v-if="$gate.isAdmin() || $gate.isUser()">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <ul class="breadcrumb breadcrumb-style">
              <li class="breadcrumb-item">
                <h4 class="page-title">Flora</h4>
              </li>
              <li class="breadcrumb-item bcrumb-1">
                <a href="/admin/dashboard">
                  <i class="fas fa-home"></i>
                  Inicio
                </a>
              </li>
              <li class="breadcrumb-item active">Flora</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card" v-if="$gate.isAdmin() || $gate.isUser()">
            <div class="card-header">
              <h3 class="card-title">Lista de flora</h3>

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
                    @blur="filtrar()"
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
                  Agregar Nuevo
                </button>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Id Flora</th>
                    <th>Nombre común</th>
                    <th>Nombre científico</th>
                    <th>Descripción</th>
                    <th>Grupo</th>
                    <th>Imagen</th>
                    <th>Familia científico</th>
                    <th>Fecha registro</th>
                    <th>Funciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="Flora in flora.data" :key="Flora.id">
                    <td>{{ Flora.id }}</td>
                    <td>{{ Flora.nom_comun }}</td>
                    <td>{{ Flora.nom_cientifico }}</td>
                    <td>{{ Flora.descripcion | truncate(10, "...") }}</td>
                    <td>{{ Flora.tipo }}</td>
                    <td>
                      <img
                        v-bind:src="'/images/flora/' + Flora.photo"
                        width="50px"
                        height="50px"
                      />
                    </td>
                    <td>{{ Flora.fam_cientifica }}</td>
                    <td>{{ Flora.fecha_registro }}</td>

                    <td>
                      <a href="#" @click="editModal(Flora)">
                        <i id="icono" class="fa fa-edit blue"></i>
                      </a>
                      /
                      <a href="#" @click="eliminarFlora(Flora.id)">
                        <i id="icono" class="fa fa-trash red"></i>
                      </a>
                        /
                      <a
                        href="#"
                        @click="detailsModal(Flora)"
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
                :data="flora"
                :limit="5"
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
                Registrar nueva flora
              </h5>
              <h5 class="modal-title" v-show="editmode">Actualizar flora</h5>
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

            <form @submit.prevent="editmode ? actualizarFlora() : crearFlora()">
              <div class="modal-body">
                <div class="form-group">
                  <label>Nombre común</label>
                  <input
                    v-model="form.nom_comun"
                    type="text"
                    name="nom_comun"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('nom_comun') }"
                    placeholder="Nombre común de la fauna"
                    required
                    minlength="3"
                    maxlength="30"
                    pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]{1,30}"
                    title="Nombre común valido de flora, no incluya números."
                  />
                  <has-error :form="form" field="nom_comun"></has-error>
                </div>

                <div class="form-group">
                  <label>Nombre científico</label>
                  <input
                    v-model="form.nom_cientifico"
                    type="text"
                    name="nom_cientifico"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('nom_cientifico') }"
                    placeholder="Nombre científico de la fauna"
                     required
                    minlength="3"
                    maxlength="30"
                    pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]{1,30}"
                    title="Nombre común valido de flora, no incluya números."
                    
                  />
                  <has-error :form="form" field="nom_cientifico"></has-error>
                </div>

                <div class="form-group">
                  <label>Descripción</label>
                  <textarea
                    v-model="form.descripcion"
                    class="form-control"
                    name="Descripcion"
                    :class="{ 'is-invalid': form.errors.has('descripcion') }"
                    placeholder="Breve descripción"
                    required
                    minlength="3"
                    maxlength="250"
                    id=""
                    rows="3"
                     pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ0-9\s]{1,60}"
                  ></textarea>
                  <has-error :form="form" field="descripcion"></has-error>
                </div>

                <div class="form-group">
                  <label>Grupo de flora</label>
                  <select
                    class="form-control"
                    v-model="form.tipo"
                    :class="{ 'is-invalid': form.errors.has('tipo') }"
                    required
                  >
                    <option disabled value="">Seleccione un elemento</option>
                    <option value="Plantas leñosas">Plantas leñosas</option>
                    <option value="Plantas herbaceas">Plantas herbaceas</option>
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
                            id="SubirImagen"
                            required
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

                <div class="form-group">
                  <label>Familia científica</label>
                  <input
                    v-model="form.fam_cientifica"
                    type="text"
                    name="fam_cientifica"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('fam_cientifica') }"
                    placeholder="Nombre de la familia científica"
                     required
                    minlength="3"
                    maxlength="30"
                     pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]{1,30}"
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
                    required
                     min="2021-01-01"
                  />
                  <has-error :form="form" field="fecha_registro"></has-error>
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
              <h5 class="modal-title">Detalles de la flora</h5>
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
                <label>Nombre común</label>
                <input
                  v-model="form.nom_comun"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
              <div id="inputsModal" class="form-group">
                <label>Nombre científico</label>
                <input
                  v-model="form.nom_cientifico"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
              <div id="inputsModal" class="form-group">
                <label>Descripción</label>
                <textarea v-model="form.descripcion"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles">
                  
                </textarea>
              </div>
              <div id="inputsModal" class="form-group">
                <label>Fecha registro</label>
                <input
                  v-model="form.fecha_registro"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
              <div class="form-group">
                <label>Foto de la flora</label>
                <img
                  v-bind:src="'/images/flora/' + form.photo"
                  width="100%"
                  height="350px"
                />
              </div>
              <div id="inputsModal" class="form-group">
                <label>Grupo de flora</label>
                <input
                  v-model="form.tipo"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
              <div id="inputsModal" class="form-group">
                <label>Familia científico</label>
                <input
                  v-model="form.fam_cientifica"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
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
      <!--FIN DEL MODAL VER INFORMACION-->
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
      flora: {},
      todoFlora: {},
      verDetalles: true,
      filtrarBusqueda: "",
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
       filtrar() {
      if (this.filtrarBusqueda == "") {
        this.fora.data = this.todoFlora;
      } else if (this.filtrarBusqueda != "") {
        this.flora.data = this.floraFiltros;
      }
    },
    updatePhoto(e) {
      let file = e.target.files[0];
      this.previewImage = URL.createObjectURL(file);
      this.currentImage = file;
      let reader = new FileReader();

      if (file["size"] < 9111775) {
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
     mostrar() {
      if (this.$gate.isAdmin() || this.$gate.isUser()) {
        this.form
          .get("/api/flora/mostrar/", {
            params: { valor: this.valorMostrar },
          })
          .then(({ data }) => (this.flora = data.data));
      }
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
      $("#SubirImagen").val("");
      this.previewImage = "";
      $("#addNew").modal("show");
      this.form.fill(Flora);
    },
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#SubirImagen").val("");
      this.previewImage = "";
      $("#addNew").modal("show");
    },
     detailsModal(flora) {
      $("#ModalVer").modal("show");
      this.form.fill(flora);
    },

    cargarFlora() {
      if (this.$gate.isAdmin() || this.$gate.isUser()) {
        axios.get("/api/flora").then(({ data }) => (this.flora = data.data));
        axios.get("/api/flora/listar").then(({ data }) => (this.todoFlora = data.data));
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
        floraFiltros: function () {
      return this.todoFlora.filter((flora) => {
        return (
          flora.descripcion
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) ||
          flora.fam_cientifica
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) ||
          flora.fecha_registro
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) ||
          flora.nom_cientifico
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) ||
            flora.nom_comun
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) ||
            flora.tipo
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase())
        );
      });
    },
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
@media only screen and (min-device-width: 300px) and (max-device-width:1199px) {
  .modal-content {
    width: 100%;
  }
  #modal-contentino{
    width: 100%;
  }
  #inputsModal{
    width: 100%;
  }
  .form-group img{
    height: 250px;
  }
    .pagination {
    display: flex;
    padding-left: 0;
    list-style: none;
    border-radius: 0.25rem;
    flex-wrap: wrap;
  }
}
</style>