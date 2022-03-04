<template>
  <section class="content">
    <div class="container-fluid">
      <div class="block-header">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <ul class="breadcrumb breadcrumb-style">
              <li class="breadcrumb-item">
                <h4 class="page-title">Actividades</h4>
              </li>
              <li class="breadcrumb-item bcrumb-1">
                <a href="/dashboard">
                  <i class="fas fa-home"></i>
                  Inicio
                </a>
              </li>
              <li class="breadcrumb-item active">Actividades</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card" v-if="$gate.isAdmin() || $gate.isUser()">
            <div class="card-header">
              <h3 class="card-title">Lista de actividades</h3>

              <div class="card-tools">
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
                    <th>Id Actividad</th>
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Descripción</th>
                    <th>Cantidad participantes</th>
                    <th>Imagen</th>
                    <th>Tipo de actividad</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="Actividad in Actividades.data" :key="Actividad.id">
                    <td>{{ Actividad.id }}</td>
                    <td>{{ Actividad.nombre }}</td>
                    <td>{{ Actividad.fecha }}</td>
                    <td>{{ Actividad.hora }}</td>
                    <td>{{ Actividad.descripcion | truncate(10, "...") }}</td>
                    <td>
                      {{ Actividad.cantParticipantes }}
                    </td>
                    <td>
                      <img
                        v-bind:src="'/images/actividades/' + Actividad.imagen"
                        width="50px"
                        height="50px"
                      />
                    </td>
                    <td>
                      {{ Actividad.tipo }}
                    </td>
                    <td>
                      <a href="#" @click="editModal(Actividad)">
                        <i id="icono" class="fa fa-edit blue"></i>
                      </a>
                      /
                      <a href="#" @click="eliminarActividad(Actividad.id)">
                        <i id="icono" class="fa fa-trash red"></i>
                      </a>
                      /
                      <a
                        href="#"
                        @click="detailsModal(Actividad)"
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
                :data="Actividades"
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
                Crear nueva actividad
              </h5>
              <h5 class="modal-title" v-show="editmode">
                Actualizar actividad
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
                editmode ? actualizarActividad() : crearActividad()
              "
            >
              <div class="modal-body">
                <div class="form-group">
                  <label>Nombre de actividaad</label>
                  <input
                    v-model="form.nombre"
                    type="text"
                    name="nombre"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('nombre') }"
                    placeholder="Nombre de la actividad"
                    required
                    minlength="3"
                    maxlength="20"
                    pattern="[a-zA-Z'-'\s]*"
                  />
                  <has-error :form="form" field="nombre"></has-error>
                </div>

                <div class="form-group">
                  <label>Fecha</label>
                  <input
                    v-model="form.fecha"
                    type="date"
                    name="nombre"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('fecha') }"
                    required
                    placeholder="Fecha de actividad"
                  />
                  <has-error :form="form" field="fecha"></has-error>
                </div>

                <div class="form-group">
                  <label>Hora</label>
                  <input
                    v-model="form.hora"
                    type="time"
                    name="hora"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('hora') }"
                    required
                  />
                  <has-error :form="form" field="hora"></has-error>
                </div>
                <div class="form-group">
                  <label>Descripción</label>
                  <textarea
                    v-model="form.descripcion"
                    class="form-control"
                    name="descripcion"
                    :class="{ 'is-invalid': form.errors.has('descripcion') }"
                    placeholder="Breve descripción"
                    minlength="3"
                    maxlength="255"
                    id=""
                    rows="3"
                    required
                  ></textarea>
                  <has-error :form="form" field="descripcion"></has-error>
                </div>

                <div class="form-group">
                  <label>Cantidad Participantes</label>
                  <input
                    v-model="form.cantParticipantes"
                    type="number"
                    name="cantParticipantes"
                    class="form-control"
                    :class="{
                      'is-invalid': form.errors.has('cantParticipantes'),
                    }"
                    min="1"
                    max="30"
                    required
                    placeholder="Cantidad de participantes"
                  />
                  <has-error :form="form" field="cantParticipantes"></has-error>
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
                  <label>Tipo de actividad</label>
                  <select
                    class="form-control"
                    v-model="form.tipo"
                    :class="{ 'is-invalid': form.errors.has('tipo') }"
                    required
                  >
                    <option disabled value="">Seleccione un elemento</option>
                    <option value="Voluntarios">Voluntarios</option>
                    <option value="Público">Público</option>
                  </select>

                  <has-error :form="form" field="estado"></has-error>
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
              <h5 class="modal-title">Detalles de la actividad</h5>
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
                <label>Nombre de actividad</label>
                <input
                  v-model="form.nombre"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
              <div id="inputsModal" class="form-group">
                <label>Fecha de actividad</label>
                <input
                  v-model="form.fecha"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
                 <div id="inputsModal" class="form-group">
                <label>Hora de actividaad</label>
                <input
                  v-model="form.hora"
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
           
              <div class="form-group">
                <label>Foto de la actividad</label>
                <img
                  v-bind:src="'/images/actividades/' + form.imagen"
                  width="100%"
                  height="350px"
                />
              </div>
              <div id="inputsModal" class="form-group">
                <label>Cantidad de participantes</label>
                <input
                  v-model="form.cantParticipantes"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
              <div id="inputsModal" class="form-group">
                <label>Tipo de actividad</label>
                <input
                  v-model="form.tipo"
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
      Actividades: {},
      ActividadesTodas: {},
      verDetalles: true,
      filtrarBusqueda: "",
      form: new Form({
        id: "",
        nombre: "",
        fecha: "",
        hora: "",
        descripcion: "",
        cantParticipantes: "",
        imagen: "",
        tipo: "",
      }),
    };
  },
  methods: {
    updatePhoto(e) {
      let file = e.target.files[0];
      this.previewImage = URL.createObjectURL(file);
      this.currentImage = file;
      let reader = new FileReader();
      // 2111775 = 2 MB en base64
      // 9111775
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
    filtrar() {
      if (this.filtrarBusqueda == "") {
        this.actividades.data = this.ActividadesTodas;
      } else if (this.filtrarBusqueda != "") {
        this.Actividades.data = this.ActividadesFiltradas;
      }
    },
    limpiar() {
      this.form.errors.clear();
    },

    getResults(page = 1) {
      this.$Progress.start();
      axios
        .get("/api/actividad?page=" + page)
        .then(({ data }) => (this.Actividades = data.data));
      this.$Progress.finish();
    },
    actualizarActividad() {
      this.$Progress.start();
      this.form
        .put("/api/actividad/" + this.form.id)
        .then((response) => {
          // success
          $("#addNew").modal("hide");
          Toast.fire({
            icon: "success",
            title: response.data.message,
          });
          this.$Progress.finish();
          //  Fire.$emit('AfterCreate');

          this.cargarActividad();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    editModal(Actividad) {
      this.editmode = true;
      this.form.reset();
      $("#SubirImagen").val("");
      this.previewImage = "";
      $("#addNew").modal("show");
      this.form.fill(Actividad);
    },
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#SubirImagen").val("");
      this.previewImage = "";
      $("#addNew").modal("show");
    },
      detailsModal(actividad) {
      $("#ModalVer").modal("show");
      this.form.fill(actividad);
    },

    cargarActividad() {
      if (this.$gate.isAdmin() || this.$gate.isUser()) {
        axios
          .get("/api/actividad")
          .then(({ data }) => (this.Actividades = data.data));
          axios
          .get("/api/actividad/listar")
          .then(({ data }) => (this.ActividadesTodas = data.data));
      }
    },

    crearActividad() {
      this.$Progress.start();
      this.form
        .post("/api/actividad")
        .then((response) => {
          $("#addNew").modal("hide");

          Toast.fire({
            icon: "success",
            title: response.data.message,
          });

          this.$Progress.finish();
          this.cargarActividad();
        })
        .catch(() => {
          Toast.fire({
            icon: "error",
            title: "Ocurrio un error!",
          });
        });
    },
    eliminarActividad(id) {
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
            .delete("/api/actividad/" + id)
            .then(() => {
              Swal.fire(
                "Eliminado!",
                "Se ha eliminado la información.",
                "success"
              );
              // Fire.$emit('AfterCreate');
              this.cargarActividad();
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
  eliminarActividad(id) {},

  created() {
    this.$Progress.start();
    this.cargarActividad();
    this.$Progress.finish();
  },
  filters: {
    truncate: function (text, length, suffix) {
      return text.substring(0, length) + suffix;
    },
  },
  computed: {
    ActividadesFiltradas: function() {
       return this.ActividadesTodas.filter((actividad) => {
        return (
          actividad.nombre
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) ||
          actividad.fecha
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) ||
          actividad.hora
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) ||
          actividad.descripcion
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) ||
            actividad.tipo
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase())
        );
      });
    }
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
}
</style>