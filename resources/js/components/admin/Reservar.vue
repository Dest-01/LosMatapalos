<template>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card" v-if="$gate.isAdmin()">
            <div class="card-header">
              <h3 class="card-title">Lista de reservas</h3>
              <div class="card-tools">
                <button
                  type="button"
                  class="btn btn-sm btn-primary"
                  @click="abrirModal()"
                >
                  <i class="fa fa-plus-square"></i>
                  Registro Persona
                </button>
              </div>
              <div class="card-tools"></div>
              <div class="card-tools">
                <button
                  style="margin-right: 20px"
                  type="button"
                  class="btn btn-sm btn-primary"
                  @click="abrirModalOrg()"
                >
                  <i class="fa fa-plus-square"></i>
                  Registro organización
                </button>
              </div>
              <div class="card-tools">
                <button
                  style="margin-right: 20px"
                  type="button"
                  class="btn btn-sm btn-primary"
                  @click="newModal"
                >
                  <i class="fa fa-plus-square"></i>
                  agregar reserva
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Persona</th>
                    <th>Organización</th>
                    <th>Cantidad de Visitantes</th>
                    <th>Fecha de reservación</th>
                    <th>Hora inicial de reservación</th>
                    <th>Hora final de reservación</th>
                    <th>Funciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="reserva in reservas.data" :key="reserva.id">
                    <td>{{ reserva.id }}</td>
                    <td>{{ reserva.idPersona }}</td>
                    <td>{{ reserva.idOrganizacion }}</td>
                    <td>{{ reserva.cantidad }}</td>
                    <td>{{ reserva.fecha }}</td>
                    <td>{{ reserva.horaInicio }}</td>
                    <td>{{ reserva.horaFin }}</td>
                    <td>
                      <a href="#" @click="editModal(reserva)">
                        <i class="fa fa-edit blue"></i>
                      </a>
                      /
                      <a href="#" @click="eliminarReserva(reserva.id)">
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
                :data="reservas"
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
              <div v-show="showPersona" class="form-group">
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
              <div v-show="showPersona" class="form-group">
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
              <div v-show="showPersona" class="form-group">
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
              <div v-show="showPersona" class="form-group">
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
              <div v-show="showPersona" class="form-group">
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
              <div v-show="showPersona" class="form-group">
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
              <!-- PARTE DE ORGANIZACION EN EL MISMO MODAL -->
              <div v-show="showOrganizacion" class="form-group">
                <label>Cedula Juridica</label>
                <input
                  v-model="formOrg.id"
                  type="text"
                  name="id"
                  class="form-control"
                  :class="{ 'is-invalid': formOrg.errors.has('id') }"
                />
                <has-error :form="formOrg" field="id"></has-error>
              </div>
              <div v-show="showOrganizacion" class="form-group">
                <label>Nombre de Organizacion</label>
                <input
                  v-model="formOrg.nombre"
                  type="text"
                  name="nombre"
                  class="form-control"
                  :class="{ 'is-invalid': formOrg.errors.has('nombre') }"
                />
                <has-error :form="formOrg" field="nombre"></has-error>
              </div>
              <div v-show="showOrganizacion" class="form-group">
                <label>Telefono Organización</label>
                <input
                  v-model="formOrg.telefono"
                  type="number"
                  name="telefono"
                  class="form-control"
                  :class="{ 'is-invalid': formOrg.errors.has('telefono') }"
                />
                <has-error :form="formOrg" field="telefono"></has-error>
              </div>
              <div v-show="showOrganizacion" class="form-group">
                <label>Correo Organización</label>
                <input
                  v-model="formOrg.correo"
                  type="email"
                  name="correo"
                  class="form-control"
                  :class="{ 'is-invalid': formOrg.errors.has('correo') }"
                />
                <has-error :form="formOrg" field="correo"></has-error>
              </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
              <button
                @click="cerrarModal(), limpiar()"
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
              >
                Cancelar
              </button>
              <button
                v-show="showPersona"
                @click="crearPersona()"
                type="button"
                class="btn btn-success"
                data-dismiss="modal"
              >
                Guardar
              </button>
              <button
                v-show="showOrganizacion"
                @click="crearOrganizacion()"
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
                Crear nueva reservar
              </h5>
              <h5 class="modal-title" v-show="editmode">Actualizar reserva</h5>
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
                editmode ? actualizarReserva() : crearReserva()
              "
            >
              <div class="modal-body">
                <div v-show="show" class="form-group">
                  <label>Cédula a consultar:</label>
                  <input
                    v-model="buscador"
                    type="text"
                    name="buscador"
                    class="form-control"
                    :disabled="CedulaBloqueo"
                  />
                </div>
                <div>
                  <label
                    v-show="showExistenciaCedula"
                    v-text="MensajeCedula"
                    style="color: red"
                  ></label>
                  <label
                    v-show="showMensajesCedula2"
                    v-text="MensajeCedula2"
                    style="color: green"
                  ></label>
                </div>
                <div v-show="show" class="form-group">
                  <button
                    type="button"
                    class="btn btn-success my-4"
                    @click="
                      ConsultaCedula(), habilitarCampos(), NoexisteCedula()
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
                <div v-show="showIdentificacion" class="form-group">
                  <label>Identificación Donante</label>
                  <input
                    v-model="form.idPersona"
                    type="text"
                    name="idPersona"
                    class="form-control"
                    :disabled="CedulaBloqueo"
                    :class="{ 'is-invalid': form.errors.has('idPersona') }"
                  />
                  <has-error :form="form" field="idPersona"></has-error>
                </div>
                <div v-show="showIdentificacion" class="form-group">
                  <label>Identificación de Organización</label>
                  <input
                    v-model="form.idOrganizacion"
                    type="text"
                    name="idOrganizacion"
                    class="form-control"
                    :disabled="CedulaBloqueo"
                    :class="{ 'is-invalid': form.errors.has('idOrganizacion') }"
                  />
                  <has-error :form="form" field="idOrganizacion"></has-error>
                </div>
                <div class="form-group">
                  <label>Cantidad de visitantes</label>
                  <input
                    v-model="form.cantidad"
                    type="number"
                    name="cantidad"
                    class="form-control"
                    :disabled="isDisabled"
                    :class="{ 'is-invalid': form.errors.has('cantidad') }"
                  />
                  <has-error :form="form" field="cantidad"></has-error>
                </div>

                <div class="form-group">
                    <label>Fecha de reservación</label>
                  <input
                    v-model="form.fecha"
                    type="date"
                    name="fecha"
                    class="form-control"
                    :disabled="isDisabled"
                    :class="{ 'is-invalid': form.errors.has('fecha') }"
                  />
                  <has-error :form="form" field="fecha"></has-error>
                </div>
               
                <div class="form-group">
                  <label>Hora incial de reservación</label>
                  <input
                    v-model="form.horaInicio"
                    type="time"
                    name="horaInicio"
                    class="form-control"
                    :disabled="isDisabled"
                    :class="{ 'is-invalid': form.errors.has('horaInicio') }"
                  />
                  <has-error :form="form" field="horaInicio"></has-error>
                </div>
                <div class="form-group">
                  <label>Hora final de reservación</label>
                  <input
                    v-model="form.horaFin"
                    type="time"
                    name="horaFin"
                    class="form-control"
                    :disabled="isDisabled"
                    :class="{ 'is-invalid': form.errors.has('horaFin') }"
                  />
                  <has-error :form="form" field="horaFin"></has-error>
                </div>
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-dismiss="modal"
                  @click="limpiarDonativo()"
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
                  :disabled="isDisabled"
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
      MensajeCedula2: "Se encontro la cedula!",
      MensajeCedula: "",
      showMensajesCedula2: false,
      showExistenciaCedula: false,
      showPersona: true,
      showOrganizacion: false,
      showIdentificacion: false,
      show: true,
      CedulaBloqueo: false,
      isDisabled: true,
      buscador: "",
      cedulas: {},
      cedulasOrg: {},
      editmode: false,
      reservas: {},
      form: new Form({
        id: "",
        idPersona: "",
        idOrganizacion: "",
        cantidad: "",
        fecha: "",
        horaInicio: "",
        horaFin: "",
      }),
      formPer: new Form({
        id: "",
        nombre: "",
        apellido1: "",
        apellido2: "",
        telefono: "",
        correo: "",
      }),
      formOrg: new Form({
        id: "",
        nombre: "",
        telefono: "",
        correo: "",
      }),
      id: 0,
      tituloModal: "",
      modal: 0,
    };
  },
  methods: {
    abrirModal(data = {}) {
      this.modal = 1;
      (this.id = 0), (this.tituloModal = "Registro cliente");
      this.showPersona = true;
      this.showOrganizacion = false;
    },
    abrirModalOrg(data = {}) {
      this.modal = 1;
      (this.id = 0), (this.tituloModal = "Registro Organización");
      this.showPersona = false;
      this.showOrganizacion = true;
    },
    cerrarModal() {
      this.modal = 0;
    },

    getResults(page = 1) {
      this.$Progress.start();

      axios
        .get("/api/reserva?page=" + page)
        .then(({ data }) => (this.reservas = data.data));

      this.$Progress.finish();
    },
    habilitarCampos() {
      for (let i = 0; i < this.cedulas.length; i++) {
        if (this.cedulas[i].id == this.buscador) {
          this.isDisabled = false;
          this.CedulaBloqueo = true;
          this.form.idPersona = this.buscador;
          this.showMensajesCedula2 = true;
          this.showExistenciaCedula = false;
        }
      }
    },
    habilitarCamposOrg() {
      for (let i = 0; i < this.cedulasOrg.length; i++) {
        if (this.cedulasOrg[i].id == this.buscador) {
          this.isDisabled = false;
          this.CedulaBloqueo = true;
          this.form.idOrganizacion = this.buscador;
          this.showMensajesCedula2 = true;
          this.showExistenciaCedula = false;
        }
      }
    },
    NoexisteCedula() {
      if (this.cedulas.length == 0 && this.cedulasOrg.length == 0) {
        this.showExistenciaCedula = true;
        this.MensajeCedula = "El numero de cedula no esta registrado";
      }
      if (this.buscador.length == 0) {
        this.showExistenciaCedula = true;
        this.MensajeCedula =
          "Campo vacio, por favor digite un número de cedula";
      }
    },

    limpiarDonativo() {
      this.showExistenciaCedula = false;
      this.form.errors.clear();
    },
    limpiar() {
      this.formPer.id = "";
      this.formPer.nombre = "";
      this.formPer.apellido1 = "";
      this.formPer.apellido2 = "";
      this.formPer.telefono = "";
      this.formPer.correo = "";
      this.formPer.errors.clear();
      this.formOrg.id = "";
      this.formOrg.nombre = "";
      this.formOrg.telefono = "";
      this.formOrg.correo = "";
      this.formOrg.errors.clear();
      this.showExistenciaCedula = false;
      this.showMensajesCedula2 = false;
    },
    cancelarCedula() {
      this.isDisabled = true;
      this.CedulaBloqueo = false;
      (this.buscador = ""), (this.showExistenciaCedula = false);
      this.showMensajesCedula2 = false;
      this.form.errors.clear();
    },
    ConsultaCedula() {
      this.form
        .get("/api/reserva/verificar", {
          params: { buscador: this.buscador },
        })
        .then(({ data }) => (this.cedulas = data.data))
        .then((response) => {
          this.habilitarCampos();
        });
      this.form
        .get("/api/reserva/verificarOrg", {
          params: { buscador: this.buscador },
        })
        .then(({ data }) => (this.cedulasOrg = data.data))
        .then((response) => {
          this.habilitarCamposOrg();
        });
    },

    actualizarReserva() {
      this.$Progress.start();
      this.form
        .put("/api/reserva/" + this.form.id)
        .then((response) => {
          // success
          $("#addNew").modal("hide");
          Toast.fire({
            icon: "success",
            title: response.data.message,
          });
          this.$Progress.finish();
          //  Fire.$emit('AfterCreate');

          this.cargarReservas();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    editModal(reserva) {
      this.editmode = true;
      // this.form.reset();

      $("#addNew").modal("show");
      this.form.fill(reserva);
      this.isDisabled = false;
      this.CedulaBloqueo = true;
      this.show = false;
      this.showIdentificacion = true;
      this.showExistenciaCedula = false;
      this.showMensajesCedula2 = false;
      this.form.errors.clear();
    },
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#addNew").modal("show");
      this.show = true;
      this.buscador = "";
      this.isDisabled = true;
      this.CedulaBloqueo = false;
      this.showIdentificacion = false;
      this.showExistenciaCedula = false;
      this.form.errors.clear();
    },

    cargarReservas() {
      if (this.$gate.isAdmin()) {
        axios
          .get("/api/reserva")
          .then(({ data }) => (this.reservas = data.data));
      }
    },

    crearReserva() {
      this.$Progress.start();
      this.form
        .post("/api/reserva/")
        .then((response) => {
          $("#addNew").modal("hide");

          Toast.fire({
            icon: "success",
            title: response.data.message,
          });

          this.$Progress.finish();
          this.cargarReservas();
        })
        .catch(() => {
          Toast.fire({
            icon: "error",
            title: "Ocurrio un error!",
          });
        });
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
            title: "Cedula existente o campos vacios",
          });
        });
    },
    crearOrganizacion() {
      this.formOrg
        .post("/api/organizacion", {
          params: { id: this.formOrg.id },
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
            title: "Cedula existente o campos vacios",
          });
        });
    },
    eliminarReserva(id) {
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
            .delete("/api/reserva/" + id)
            .then(() => {
              Swal.fire(
                "Eliminado!",
                "Se ha eliminado la información.",
                "success"
              );
              // Fire.$emit('AfterCreate');
              this.cargarReservas();
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
    this.cargarReservas();
    this.$Progress.finish();
  },
  filters: {
    truncate: function (text, length, suffix) {
      return text.substring(0, length) + suffix;
    },
  },
  computed: {},
};
</script>

<style scoped>
.mostrar {
  display: list-item;
  opacity: 1;
  background: rgba(121, 120, 120, 0.623);
}
</style>