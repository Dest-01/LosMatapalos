<template>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card" v-if="$gate.isAdmin()">
            <div class="card-header">
              <h3 class="card-title">Listado de personas voluntarios</h3>
              <div class="card-tools">
                <button
                  type="button"
                  class="btn btn-sm btn-primary"
                  @click="newModal"
                >
                  <i class="fa fa-plus-square"></i>
                  Agregar nuevo
                </button>
                <button
                  type="button"
                  class="btn btn-sm btn-primary"
                  @click="abrirModal()"
                >
                  <i class="fa fa-plus-square"></i>
                  Agregar Persona
                </button>
              </div>
            </div>
            <!-- fin del card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Cedula de persona</th>
                    <th>Id de voluntario</th>
                    <th>Funciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="voluntariopersona in voluntarioPer.data"
                    :key="voluntariopersona.id"
                  >
                    <td>{{ voluntariopersona.id }}</td>
                    <td>{{ voluntariopersona.identificacion }}</td>
                    <td>{{ voluntariopersona.voluntariado_id }}</td>
                    <td>
                      <a href="#" @click="editModal(voluntariopersona)">
                        <i class="fa fa-edit blue"></i>
                      </a>
                      /
                      <a
                        href="#"
                        @click="eliminarVoluntarioPer(voluntariopersona.id)"
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
                :data="voluntarioPer"
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
                Registro de persona voluntario
              </h5>
              <h5 class="modal-title" v-show="editmode">
                Actualización de persona voluntario
              </h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
                @click="limpiar()"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <!-- <form @submit.prevent="createUser"> -->

            <form
              @submit.prevent="
                editmode ? actualizarVoluntarioPer() : crearVoluntarioPer()
              "
            >
              <div class="modal-body">
                <div v-show="showBuscadores" class="form-group">
                  <label>Cedula a consultar:</label>
                  <input
                    v-model="buscadorC"
                    type="text"
                    name="buscadorC"
                    class="form-control"
                    :disabled="CedulaBloqueo"
                  />
                </div>
                <div v-show="showBuscadores">
                  <label
                    v-show="showMensajesCedula"
                    v-text="MensajeCedula"
                    style="color: red"
                  ></label>
                  <label
                    v-show="showMensajesCedula2"
                    v-text="MensajeCedula2"
                    style="color: green"
                  ></label>
                </div>
                <div v-show="showBuscadores" class="form-group">
                  <button
                    type="button"
                    class="btn btn-success my-4"
                    style="width: 155px; height: 40px"
                    @click="
                      ConsultaCedula(), ComprobarCampos(), NoexisteCedula()
                    "
                  >
                    Comprobar cedula
                  </button>
                  <button
                    type="button"
                    class="btn btn-danger my-4"
                    @click="cancelarCedula()"
                    style="width: 100px; height: 40px"
                  >
                    Cancelar
                  </button>
                </div>
                <div v-show="showBuscadores" class="form-group">
                  <label>Nombre de voluntario a consultar:</label>
                  <input
                    v-model="buscadorV"
                    type="text"
                    name="buscadorV"
                    class="form-control"
                    :disabled="VoluntarioBloqueo"
                  />
                </div>
                <div>
                  <label
                    v-show="showMensajesVoluntario"
                    v-text="MensajeVoluntario"
                    style="color: red"
                  ></label>
                  <label
                    v-show="showMensajesVoluntario2"
                    v-text="MensajeVoluntario2"
                    style="color: green"
                  ></label>
                </div>
                <div v-show="showBuscadores" class="form-group">
                  <button
                    type="button"
                    class="btn btn-success my-4"
                    style="width: 155px; height: 40px"
                    @click="
                      ConsultaNombreVoluntario(),
                        ComprobarCampos(),
                        NoexisteNombreV()
                    "
                  >
                    Comprobar voluntario
                  </button>
                  <button
                    type="button"
                    class="btn btn-danger my-4"
                    style="width: 100px; height: 40px"
                    @click="cancelarVoluntario()"
                  >
                    Cancelar
                  </button>
                </div>
                <div class="form-group">
                  <label>Cedula del estudiante</label>
                  <input
                    :disabled="bloquearCedulaVoluntario"
                    v-model="form.identificacion"
                    type="text"
                    name="identificacion"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('identificacion') }"
                  />
                  <has-error :form="form" field="identificacion"></has-error>
                </div>

                <div class="form-group">
                  <label>Id del voluntariado</label>
                  <input
                    :disabled="bloquearCedulaVoluntario"
                    v-model="form.voluntariado_id"
                    type="text"
                    name="voluntariado_id"
                    class="form-control"
                    :class="{
                      'is-invalid': form.errors.has('voluntariado_id'),
                    }"
                  />
                  <has-error :form="form" field="voluntariado_id"></has-error>
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
       <!-- Modal de persona -->
      <div class="modal" :class="{ mostrar: modal }">
        <div class="modal-dialog">
          <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">{{ tituloModal }}</h4>
              <button
                @click="cerrarModal()"
                type="button"
                class="close"
                data-dismiss="modal"
              >
                &times;
              </button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
              <div class="form-group">
                <label>Cedula</label>
                <input
                  v-model="formPer.id"
                  type="text"
                  name="id"
                  class="form-control"
                  :class="{ 'is-invalid': formPer.errors.has('id') }"
                />
                <has-error :form="formPer" field="id"></has-error>
              </div>
              <div  class="form-group">
                <label>Nombre</label>
                <input
                  v-model="formPer.nombre"
                  type="text"
                  name="nombre"
                  class="form-control"
                  :class="{ 'is-invalid': formPer.errors.has('nombre') }"
                />
                <has-error :form="formPer" field="nombre"></has-error>
              </div>
              <div class="form-group">
                <label>Primer Apellido</label>
                <input
                  v-model="formPer.apellido1"
                  type="text"
                  name="apellido1"
                  class="form-control"
                  :class="{ 'is-invalid': formPer.errors.has('apellido1') }"
                />
                <has-error :form="formPer" field="apellido1"></has-error>
              </div>
              <div class="form-group">
                <label>Segundo Apellido</label>
                <input
                  v-model="formPer.apellido2"
                  type="text"
                  name="apellido2"
                  class="form-control"
                  :class="{ 'is-invalid': formPer.errors.has('apellido2') }"
                />
                <has-error :form="formPer" field="apellido2"></has-error>
              </div>
              <div class="form-group">
                <label>Telefono</label>
                <input
                  v-model="formPer.telefono"
                  type="number"
                  name="telefono"
                  class="form-control"
                  :class="{ 'is-invalid': formPer.errors.has('telefono') }"
                />
                <has-error :form="formPer" field="telefono"></has-error>
              </div>
              <div class="form-group">
                <label>Correo</label>
                <input
                  v-model="formPer.correo"
                  type="email"
                  name="correo"
                  class="form-control"
                  :class="{ 'is-invalid': formPer.errors.has('correo') }"
                />
                <has-error :form="formPer" field="correo"></has-error>
              </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
              <button
                @click="cerrarModal()"
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
              >
                Cancelar
              </button>
              <button
                @click="crearPersona()"
                type="button"
                class="btn btn-success"
                data-dismiss="modal"
              >
                Guardar
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal -->
    </div>
  </section>
</template>
<script>
export default {
  data() {
    return {
      MensajeCedula: "",
      MensajeCedula2: "Se encontro la cedula!",
      MensajeVoluntario: "",
      MensajeVoluntario2: "Se encontro el nombre!",
      showBuscadores: false, //se oculta al editar
      showMensajesCedula: false,
      showMensajesCedula2: false,
      showMensajesVoluntario: false,
      showMensajesVoluntario2: false,
      bloquearCedulaVoluntario: true,
      bloquearCamposExtras: false,
      editmode: false,
      CedulaBloqueo: false,
      VoluntarioBloqueo: false,
      buscadorC: "",
      buscadorV: "",
      errors: {},
      cedulas: {},
      voluntarioNombre: {},
      voluntarioPer: {},
      form: new Form({
        id: "",
        identificacion: "",
        voluntariado_id: "",
      }),
      formPer: new Form({
        id: "",
        nombre: "",
        apellido1: "",
        apellido2: "",
        telefono: "",
        correo: "",
      }),
      id: 0,
      tituloModal: "",
      modal: 0,
    };
  },
  methods: {
    getResults(page = 1) {
      this.$Progress.start();

      axios
        .get("/api/voluntarioPersona?page=" + page)
        .then(({ data }) => (this.voluntarioPer = data.data));

      this.$Progress.finish();
    },
    editModal(voluntarioPersona) {
      this.editmode = true;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(voluntarioPersona);
      this.showBuscadores = false;
      this.showMensajesVoluntario2 = false;
      this.showMensajesCedula2 = false;
      this.showMensajesCedula = false;
      this.showMensajesVoluntario = false;
    },
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#addNew").modal("show");
      this.showBuscadores = true;
    },
    abrirModal(data = {}) {
      this.modal = 1;
      (this.id = 0), (this.tituloModal = "Registro de persona");
    },
     cerrarModal() {
      this.modal = 0;
    },
    limpiar() {
      this.form.identificacion = "";
      this.form.voluntario_id = "";
      this.form.universidad = "";
      this.form.carrera = "";
      this.buscadorC = "";
      this.buscadorV = "";
      this.showMensajesVoluntario2 = false;
      this.showMensajesCedula2 = false;
      this.showMensajesCedula = false;
      this.showMensajesVoluntario = false;
      this.CedulaBloqueo = false;
      this.VoluntarioBloqueo = false;
      this.form.errors.clear();
    },
    SiExisteCedula() {
      for (let i = 0; i < this.cedulas.length; i++) {
        if (this.cedulas[i].id == this.buscadorC) {
          this.showMensajesCedula = false;
          this.showMensajesCedula2 = true;
          this.CedulaBloqueo = true;
          this.form.identificacion = this.buscadorC;
        }
      }
    },
    SiExisteNombre() {
      for (let i = 0; i < this.voluntarioNombre.length; i++) {
        if (this.voluntarioNombre[i].nombre == this.buscadorV) {
          this.VoluntarioBloqueo = true;
          this.showMensajesVoluntario = false;
          this.showMensajesVoluntario2 = true;
          this.form.voluntariado_id = this.voluntarioNombre[i].id;
        }
      }
    },
    cancelarCedula() {
      this.CedulaBloqueo = false;
      this.showMensajesCedula = false;
      this.showMensajesCedula2 = false;
      this.form.identificacion = "";
    },
    cancelarVoluntario() {
      this.VoluntarioBloqueo = false;
      this.showMensajesVoluntario = false;
      this.showMensajesVoluntario2 = false;
      this.form.voluntariado_id = "";
    },
    NoexisteCedula() {
      if (this.cedulas.length == 0) {
        this.showMensajesCedula = true;
        this.showMensajesVoluntario2 = false;
        this.MensajeCedula = "La cedula no se encuentra registrada";
      }
      if (this.buscadorC.length == 0) {
        this.showMensajesCedula = true;
        this.showMensajesVoluntario2 = false;
        this.MensajeCedula =
          "Campo vacio, por favor digite un numero de cedula";
      }
    },
    NoexisteNombreV() {
      if (this.voluntarioNombre.length == 0) {
        this.showMensajesVoluntario = true;
        this.MensajeVoluntario = "El nombre de voluntario no esta registrado";
      }
      if (this.buscadorV.length == 0) {
        this.showMensajesVoluntario = true;
        this.MensajeVoluntario =
          "Campo vacio, por favor digite un nombre de voluntario";
      }
    },
    ComprobarCampos() {
      for (let i = 0; i < this.cedulas.length; i++) {
        if (this.cedulas[i].id != null) {
          for (let i = 0; i < this.voluntarioNombre.length; i++) {
            if (this.voluntarioNombre[i].id != null) {
              this.bloquearCamposExtras = false;
            }
          }
        }
      }
    },

    ConsultaCedula() {
      this.form
        .get("/api/voluntarioPersona/obtenerCedula", {
          params: { buscadorC: this.buscadorC },
        })
        .then(({ data }) => (this.cedulas = data.data))
        .then((response) => {
          this.SiExisteCedula();
        });
    },
    ConsultaNombreVoluntario() {
      this.form
        .get("/api/voluntarioPersona/NombreVoluntario/", {
          params: { buscadorV: this.buscadorV },
        })
        .then(({ data }) => (this.voluntarioNombre = data.data))
        .then((response) => {
          this.SiExisteNombre();
        });
    },
    cargarVoluntarioPer() {
      if (this.$gate.isAdmin()) {
        axios
          .get("/api/voluntarioPersona/")
          .then(({ data }) => (this.voluntarioPer = data.data));
      }
    },
    crearPersona() {
      this.formPer
        .post("/api/persona", {
          params: { id: this.formPer.id },
        })
        .then((response) => {
          $("#addNew").modal("hide");

          Toast.fire({
            icon: "success",
            title: response.data.message,
          });
          this.cerrarModal();
          //  this.$Progress.finish();
        })
        .catch(() => {
          Toast.fire({
            icon: "error",
            title: "Ocurrio un problema",
          });
        });
    },
    crearVoluntarioPer() {
      this.form
        .post("/api/voluntarioPersona/")
        .then((response) => {
          $("#addNew").modal("hide");

          Toast.fire({
            icon: "success",
            title: response.data.message,
          });

          this.$Progress.finish();
          this.cargarVoluntarioPer();
        })
        .catch(() => {
          Toast.fire({
            icon: "error",
            title: "Ocurrio un problema!",
          });
        });
    },
    actualizarVoluntarioPer() {
      this.$Progress.start();
      this.form
        .put("/api/voluntarioPersona/" + this.form.id)
        .then((response) => {
          // success
          $("#addNew").modal("hide");
          Toast.fire({
            icon: "success",
            title: response.data.message,
          });
          this.$Progress.finish();
          //  Fire.$emit('AfterCreate');

          this.cargarVoluntarioPer();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    eliminarVoluntarioPer(id) {
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
            .delete("/api/voluntarioPersona/" + id)
            .then(() => {
              Swal.fire(
                "Eliminado!",
                "Se ha eliminado la información.",
                "success"
              );
              // Fire.$emit('AfterCreate');
              this.cargarVoluntarioPer();
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
  created() {
    this.$Progress.start();
    this.cargarVoluntarioPer();
    this.$Progress.finish();
  },
};
</script>

<style scoped>
.mostrar {
  display: list-item;
  opacity: 1;
  background: rgba(121, 120, 120, 0.623);
}
</style>