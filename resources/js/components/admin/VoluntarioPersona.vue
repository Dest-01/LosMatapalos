<template>
  <section class="content">
    <div class="container-fluid">
      <div class="block-header" v-if="$gate.isAdmin() || $gate.isUser()">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <ul class="breadcrumb breadcrumb-style">
              <li class="breadcrumb-item">
                <h4 class="page-title">Voluntario Personas</h4>
              </li>
              <li class="breadcrumb-item bcrumb-1">
                <a href="/dashboard">
                  <i class="fas fa-home"></i>
                  Inicio
                </a>
              </li>
              <li class="breadcrumb-item active">Voluntario Personas</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card" v-if="$gate.isAdmin() || $gate.isUser()">
            <div class="card-header">
              <h3 class="card-title">Listado de personas voluntariadas</h3>
              <div class="card-tools">
                <button
                  type="button"
                  class="btn btn-sm btn-primary"
                  @click="newModal"
                >
                  <i class="fa fa-plus-square"></i>
                  Agregar Nuevo
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
                    <th>Cedula de voluntario</th>
                    <th>Id de voluntario</th>
                    <th>Lugar</th>
                    <th>Cantidad de actividades</th>
                    <th>Funciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="voluntariopersonas in voluntarioPer.data"
                    :key="voluntariopersonas.id"
                  >
                    <td>{{ voluntariopersonas.id }}</td>
                    <td>{{ voluntariopersonas.identificacion }}</td>
                    <td>{{ voluntariopersonas.voluntariado_id }}</td>
                    <td>{{ voluntariopersonas.lugar }}</td>
                    <td>
                      {{
                        voluntarios.data.find(
                          (el) => el.id == voluntariopersonas.voluntariado_id
                        ).cantidad
                      }}
                    </td>
                    <td>
                      <a
                        href="#"
                        @click="
                          editModal(voluntariopersonas),
                            ObtenerCantidad(voluntariopersonas.voluntariado_id)
                        "
                      >
                        <i class="fa fa-edit blue"></i>
                      </a>
                      /
                      <a
                        href="#"
                        @click="
                          eliminarVoluntarioPer(
                            voluntariopersonas.id,
                            voluntariopersonas.voluntariado_id
                          )
                        "
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
                     placeholder="Numero de cedula a consultar"
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
                    @click="ConsultaCedula(), NoexisteCedula()"
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
                  <label>Id del voluntario</label>
                  <input
                    :disabled="bloquearCamposIdVoluntario"
                    v-model="form.idVoluntario"
                    type="number"
                    name="idVoluntario"
                    class="form-control"
                    :class="{
                      'is-invalid': form.errors.has('idVoluntario'),
                    }"
                    required
                    min="1"
                    placeholder="1"

                  />
                  <has-error :form="form" field="idVoluntario"></has-error>
                </div>
                <div class="form-group">
                  <label>Lugar de procedencia</label>
                  <input
                    v-model="form.lugar"
                    type="text"
                    name="lugar"
                    class="form-control"
                    :disabled="bloquearCamposExtras"
                    :class="{ 'is-invalid': form.errors.has('lugar') }"
                    required
                    minlength="3"
                    maxlength="50"
                    placeholder="Lugar de procedencia de la personas"
                  />
                  <has-error :form="form" field="lugar"></has-error>
                </div>

                <div class="form-group">
                  <label>Cantidad de actividades</label>
                  <input
                    :disabled="bloquearCamposExtras"
                    v-model="form.cantidad"
                    type="number"
                    name="cantidad"
                    class="form-control"
                    :class="{
                      'is-invalid': form.errors.has('cantidad'),
                    }"
                    required
                    min="1"
                    placeholder="Cantidad de actividades realizadas"

                  />
                  <has-error :form="form" field="cantidad"></has-error>
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
                  :disabled="bloquearCamposExtras"
                >
                  Registrar
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- Modal de persona -->
      <div class="modal" id="modalPersona" :class="{ mostrar: modal }">
        <div class="modal-dialog">
          <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">{{ tituloModal }}</h4>
              <button
                @click="cerrarModal(), limpiarPersona()"
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
                  required
                  minlength="8"
                  maxlength="18"
                  placeholder="Cedula de la persona"
                />
                <has-error :form="formPer" field="id"></has-error>
              </div>
              <div class="form-group">
                <label>Nombre</label>
                <input
                  v-model="formPer.nombre"
                  type="text"
                  name="nombre"
                  class="form-control"
                  :class="{ 'is-invalid': formPer.errors.has('nombre') }"
                  required
                  minlength="3"
                  maxlength="20"
                  pattern="[a-zA-Z'-'\s]*"
                  placeholder="Nombre de la persona"
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
                  required
                  minlength="3"
                  maxlength="20"
                  pattern="[a-zA-Z'-'\s]*"
                  placeholder="Primer apellido de la persona"
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
                  required
                  minlength="3"
                  maxlength="20"
                  pattern="[a-zA-Z'-'\s]*"
                  placeholder="Segundo apellido de la persona"
                />
                <has-error :form="formPer" field="apellido2"></has-error>
              </div>
              <div class="form-group">
                <label>Teléfono</label>
                <input
                  v-model="formPer.telefono"
                  type="number"
                  name="telefono"
                  class="form-control"
                  :class="{ 'is-invalid': formPer.errors.has('telefono') }"
                  min="10000000"
                  placeholder="12345678"
                  pattern="[0-9]{8,12}"
                  required
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
                  size="32"
                  placeholder="ejemplo@gmail.com"
                  minlength="3"
                  maxlength="64"
                  pattern="[a-zA-Z0-9.-_]{1,}@[a-zA-Z.-]{2,}[.]{1}[a-zA-Z]{2,}"
                  required
                />
                <has-error :form="formPer" field="correo"></has-error>
              </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
              <button
                @click="cerrarModal(), limpiarPersona()"
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
      showBuscadores: false, //se oculta al editar
      showMensajesCedula: false,
      showMensajesCedula2: false,
      bloquearCedulaVoluntario: true,
      bloquearCamposExtras: true,
      bloquearCamposIdVoluntario: true,
      editmode: false,
      CedulaBloqueo: false,
      buscadorC: "",
      errors: {},
      cedulas: {},
      voluntarios: {},
      CantidadActividades: {},
      verificar: "",
      voluntarioPer: {},
      form: new Form({
        id: "",
        idVoluntario: "",
        identificacion: "",
        voluntariado_id: "",
        lugar: "",
        cantidad: "",
      }),
      formPer: new Form({
        id: "",
        nombre: "",
        apellido1: "",
        apellido2: "",
        telefono: "",
        correo: "",
      }),
      formVoluntario: new Form({
        id: "",
        cantidad: "",
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
      this.bloquearCamposExtras = false;
      this.bloquearCamposIdVoluntario = true;
      this.formVoluntario.cantidad = this.CantidadActividades.cantidad;
      this.form.errors.clear();
      this.formVoluntario.errors.clear();
      
    },
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#addNew").modal("show");
      this.showBuscadores = true;
      this.form.errors.clear();
      this.formVoluntario.errors.clear();
      this.limpiar();
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
      this.form.voluntariado_id = "";
      this.form.lugar = "";
      this.buscadorC = "";
      this.showMensajesCedula2 = false;
      this.showMensajesCedula = false;
      this.CedulaBloqueo = false;
      this.VoluntarioBloqueo = false;
      this.form.errors.clear();
      this.formVoluntario.errors.clear();
      this.bloquearCamposExtras = true;
      this.bloquearCamposIdVoluntario = true;
      this.formVoluntario.id = "";
      this.formVoluntario.cantidad = "";
    },
    limpiarPersona() {
      this.formPer.nombre = "";
      this.formPer.apellido1 = "";
      this.formPer.apellido2 = "";
      this.formPer.telefono = "";
      this.formPer.correo = "";
      this.formPer.errors.clear();
    },

    SiExisteCedula() {
      for (let i = 0; i < this.cedulas.length; i++) {
        if (this.cedulas[i].id == this.buscadorC) {
          this.showMensajesCedula = false;
          this.showMensajesCedula2 = true;
          this.CedulaBloqueo = true;
          this.form.identificacion = this.buscadorC;
          this.bloquearCamposExtras = false;
          this.bloquearCamposIdVoluntario = false;
        }
      }
    },
    editarVoluntario() {
      for (let i = 0; i < this.CantidadActividades.length; i++) {
        this.form.idVoluntario = this.CantidadActividades[i].id;
        this.form.cantidad = this.CantidadActividades[i].cantidad;
      }
    },
    cancelarCedula() {
      this.CedulaBloqueo = false;
      this.showMensajesCedula = false;
      this.showMensajesCedula2 = false;
      this.form.identificacion = "";
      this.bloquearCamposExtras = true;
      this.bloquearCamposIdVoluntario = true;
      this.form.errors.clear();
      this.formVoluntario.errors.clear();
    },

    NoexisteCedula() {
      if (this.cedulas.length == 0) {
        this.showMensajesCedula = true;
        this.MensajeCedula = "La cedula no se encuentra registrada";
      }
      if (this.buscadorC.length == 0) {
        this.showMensajesCedula = true;
        this.MensajeCedula =
          "Campo vacio, por favor digite un numero de cedula";
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
    ObtenerCantidad(VoluntarioId) {
      this.form
        .get("/api/voluntarioPersona/obtenerCantidad", {
          params: { VolCantidad: VoluntarioId },
        })
        .then(({ data }) => (this.CantidadActividades = data.data))
        .then((response) => {
          this.editarVoluntario();
        });
    },
    cargarVoluntarioPer() {
      if (this.$gate.isAdmin() || this.$gate.isUser()) {
        axios
          .get("/api/voluntarioPersona/")
          .then(({ data }) => (this.voluntarioPer = data.data));
      }
    },
    crearPersona() {
      this.formPer
        .post("/api/voluntarioPersona/guardarPersona/", {
          params: { id: this.formPer.idVoluntario },
        })
        .then((response) => {
          if (response.data.success == false) {
            Toast.fire({
              icon: "error",
              title: "Cedula ya existe!",
            });
          } else {
            $("#addNew").modal("hide");
            Toast.fire({
              icon: "success",
              title: response.data.message,
            });
            this.cerrarModal();
            this.$Progress.finish();
          }
        })
        .catch(() => {
          Toast.fire({
            icon: "error",
            title: "Campos vacios",
          });
        });
    },
    cargarVoluntario() {
      if (this.$gate.isAdmin() || this.$gate.isUser()) {
        axios
          .get("/api/voluntarioPersona/cargarVoluntarios/")
          .then(({ data }) => (this.voluntarios = data.data));
      }
    },
    crearVoluntarioPer() {
      this.$Progress.start();
      this.form.voluntariado_id = this.form.idVoluntario;
      this.form
        .post("/api/voluntarioPersona/", {
          params: { id: this.form.id },
        })
        .then((response) => {
          if (response.data.success == false) {
            Toast.fire({
              icon: "error",
              title: "Id del voluntario ya existe!",
            });
          } else {
            $("#addNew").modal("hide");
            Toast.fire({
              icon: "success",
              title: response.data.message,
            });

            this.$Progress.finish();
            this.cargarVoluntario();
            this.cargarVoluntarioPer();
            this.limpiar();
          }
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
      this.formVoluntario.id = this.form.idVoluntario;
      this.formVoluntario.cantidad = this.form.cantidad;
      this.formVoluntario.put("/api/voluntario/" + this.formVoluntario.id);
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
          this.cargarVoluntario();
          this.cargarVoluntarioPer();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    eliminarVoluntarioPer(id, idvoluntaario) {
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
          this.form.delete("/api/voluntarioPersona/" + id);
          this.form
            .delete("/api/voluntario/" + idvoluntaario)
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
    this.cargarVoluntario();
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

<style scoped>
.mostrar {
  display: list-item;
  opacity: 1;
  background: rgba(121, 120, 120, 0.623);
}
</style>