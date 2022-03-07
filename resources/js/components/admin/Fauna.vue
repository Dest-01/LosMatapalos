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
                    <th>Id Fauna</th>
                    <th>Nombre Común</th>
                    <th>Nombre Científico</th>
                    <th>Descripción</th>
                    <th>Grupo</th>
                    <th>Imagen</th>
                    <th>Familia científica</th>
                    <th>Fecha de registro</th>
                    <th>Funciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="fauna in faunas.data" :key="fauna.id">
                    <td>{{ fauna.id }}</td>
                    <td>{{ fauna.nombreComun }}</td>
                    <td>
                      {{ fauna.nombreCientifico }}
                    </td>
                    <td>{{ fauna.descripcion | truncate(10, "...") }}</td>
                    <td>{{ fauna.tipo }}</td>
                    <td>
                      <img
                        v-bind:src="'/images/Fauna/' + fauna.imagen"
                        width="50px"
                        height="50px"
                      />
                    </td>
                    <td>
                      {{ fauna.familiaCientifca }}
                    </td>
                    <td>
                      {{ fauna.fechaRegistro }}
                    </td>
                    <td>
                      <a href="#" @click="editModal(fauna)">
                        <i id="icono" class="fa fa-edit blue"></i>
                      </a>
                      /
                      <a href="#" @click="eliminarFauna(fauna.id)">
                        <i id="icono" class="fa fa-trash red"></i>
                      </a>
                      /
                      <a
                        href="#"
                        @click="detailsModal(fauna)"
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
                :data="faunas"
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
                  <label>Grupo de especie</label>
                   <select
                    class="form-control"
                    v-model="form.tipo"
                    :class="{ 'is-invalid': form.errors.has('tipo') }"
                    required
                  >
                    <option disabled value="">Seleccione un elemento</option>
                    <option value="Aves">Aves</option>
                    <option value="Mamíferos">Mamíferos</option>
                    <option value="Reptiles">Reptiles</option>
                     <option value="Insectos">Insectos</option>
                     <option value="Anfibios">Anfibios</option>
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
                            name="imagen"
                            @change="updatePhoto"
                            :class="{ 'is-invalid': form.errors.has('imagen') }"
                            id="SubirImagen"
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
              <h5 class="modal-title">Detalles de la fauna</h5>
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
                  v-model="form.nombreComun"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
              <div id="inputsModal" class="form-group">
                <label>Nombre científico</label>
                <input
                  v-model="form.nombreCientifico"
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
                  v-model="form.fechaRegistro"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
              <div class="form-group">
                <label>Foto de la fauna</label>
                <img
                  v-bind:src="'/images/fauna/' + form.imagen"
                  width="100%"
                  height="350px"
                />
              </div>
              <div id="inputsModal" class="form-group">
                <label>Grupo de fauna</label>
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
                  v-model="form.familiaCientifca"
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
      editmode: false,
      currentImage: undefined,
      previewImage: undefined,
      progress: 0,
      message: "",
      imageInfos: [],
      faunas: {},
       todoFauna: {},
      verDetalles: true,
      filtrarBusqueda: "",
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
           filtrar() {
      if (this.filtrarBusqueda == "") {
        this.faunas.data = this.todoFauna;
      } else if (this.filtrarBusqueda != "") {
        this.faunas.data = this.faunaFiltros;
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
          this.form.imagen = reader.result;
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
    detailsModal(fauna) {
      $("#ModalVer").modal("show");
      this.form.fill(fauna);
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
        axios.get("/api/fauna/listar").then(({ data }) => (this.todoFauna = data.data));
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
  computed: {
            faunaFiltros: function () {
      return this.todoFauna.filter((fauna) => {
        return (
          fauna.descripcion
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) ||
          fauna.familiaCientifca
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) ||
          fauna.fechaRegistro
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) ||
          fauna.nombreCientifico
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) ||
            fauna.nombreComun
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) ||
            fauna.tipo
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase())
        );
      });
    },
  }
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