<template>
  <section class="content">
    <div class="container-fluid">
      <div class="block-header" v-if="$gate.isAdmin() || $gate.isUser()">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <ul class="breadcrumb breadcrumb-style">
              <li class="breadcrumb-item">
                <h4 class="page-title">Reservas</h4>
              </li>
              <li class="breadcrumb-item bcrumb-1">
                <a href="/dashboard">
                  <i class="fas fa-home"></i>
                  Inicio
                </a>
              </li>
              <li class="breadcrumb-item active">Reservas</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card" v-if="$gate.isAdmin() || $gate.isUser()">
            <div class="card-header">
              <h3 class="card-title">Lista de reservas</h3>

              <div class="card-tools">
                <button
                  style="margin-right: 20px"
                  type="button"
                  class="btn btn-sm btn-primary"
                  @click="newModal"
                  onclick="quitarAlerta()"
                >
                  <i class="fa fa-plus-square"></i>
                  agregar reservación
                </button>
                <button
                  type="button"
                  class="btn btn-sm btn-primary"
                  @click="modalPersona(), limpiar()"
                  onclick="limpiarCampo()"
                  
                >
                  <i class="fa fa-plus-square"></i>
                  Registrar Persona
                </button>
                <button
                  style="margin-right: 20px"
                  type="button"
                  class="btn btn-sm btn-primary"
                  @click="modalOrganizacion(), limpiar()"
                >
                  <i class="fa fa-plus-square"></i>
                  Registrar organización
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Identificación</th>
                    <th>Cédula Jurídica</th>
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
                    <td>{{ reserva.identificacionPersona }}</td>
                    <td>{{ reserva.identificacionOrganizacion }}</td>
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
      <div v-if="!$gate.isAdmin() && !$gate.isUser()">
        <not-found></not-found>
      </div>

      <!-- Modal de persona -->

      <!-- Modal -->
      <div
        class="modal fade"
        id="modalExtra"
        tabindex="-1"
        role="dialog"
        aria-labelledby="modalExtra"
        aria-hidden="true"
      >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" v-show="!modalExtra">
                Registrar Personas
              </h5>
              <h5 class="modal-title" v-show="modalExtra">
                Registrar Organizacion
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

            <form>
              <div class="modal-body">
                <div v-show="showPersona" class="form-group">
                  <label>Tipo de identificación</label>
                  <select
                    class="form-control"
                    v-model="tipoIndenteficacion"
                    :class="{ 'is-invalid': form.errors.has('identificacion') }"
                    @change="tipoDeIndentificacon"
                  >
                    <option disabled value="">Seleccione un tipo</option>
                    <option value="Cedula Nacional">Cédula Nacional</option>
                    <option value="Cedula Residencial">
                      Cedula Residencial
                    </option>
                    <option value="Pasaporte">Pasaporte</option>
                  </select>
                </div>

                <div v-show="showPersona" class="form-group">
                  <div v-show="CedulaNacional" class="form-group">
                    <input
                      v-model="formPer.identificacion"
                      type="text"
                      name="identificacion"
                      class="form-control"
                      :class="{
                        'is-invalid': formPer.errors.has('identificacion'),
                      }"
                      placeholder="Formato #-####-####"
                      id="nacional"
                      onchange="validate()"
                    />
                    <has-error
                      :form="formPer"
                      field="identificacion"
                    ></has-error>
                  </div>

                  <div v-show="CedulaResidencial" class="form-group">
                    <input
                      v-model="formPer.identificacion"
                      type="text"
                      name="identificacion"
                      class="form-control"
                      :class="{
                        'is-invalid': formPer.errors.has('identificacion'),
                      }"
                      placeholder="Formato de 10 dígitos"
                      id="residencial"
                      onchange="validateResidencial()"
                    />
                    <has-error
                      :form="formPer"
                      field="identificacion"
                    ></has-error>
                  </div>

                  <div v-show="Pasaporte" class="form-group">
                    <input
                      v-model="formPer.identificacion"
                      type="text"
                      name="identificacion"
                      class="form-control"
                      :class="{
                        'is-invalid': formPer.errors.has('identificacion'),
                      }"
                      placeholder="Formato de 11 a 12 dígitos"
                      id="pasaporte"
                      onchange="validatePasaporte()"
                    />
                    <has-error
                      :form="formPer"
                      field="identificacion"
                    ></has-error>
                  </div>
                </div>
                <div v-show="showPersona" class="form-group">
                  <label>Nombre</label>
                  <input
                    style="text-transform: capitalize"
                    v-model="formPer.nombre"
                    type="text"
                    name="nombre"
                    class="form-control"
                    :class="{ 'is-invalid': formPer.errors.has('nombre') }"
                    placeholder="Nombre"
                    required
                  />
                  <has-error :form="formPer" field="nombre"></has-error>
                </div>
                <div v-show="showPersona" class="form-group">
                  <label>Primer Apellido</label>
                  <input
                    style="text-transform: capitalize"
                    v-model="formPer.apellido1"
                    type="text"
                    name="apellido1"
                    class="form-control"
                    :class="{ 'is-invalid': formPer.errors.has('apellido1') }"
                    placeholder="Primer Apellido"
                    required
                  />
                  <has-error :form="formPer" field="apellido1"></has-error>
                </div>
                <div v-show="showPersona" class="form-group">
                  <label>Segundo Apellido</label>
                  <input
                    style="text-transform: capitalize"
                    v-model="formPer.apellido2"
                    type="text"
                    name="apellido2"
                    class="form-control"
                    :class="{ 'is-invalid': formPer.errors.has('apellido2') }"
                    placeholder="Segundo Apellido"
                    required
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
                    size="20"
                    min="10000000"
                    placeholder="#### ####"
                    pattern="[0-9]{8}"
                    required
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
                    size="32"
                    placeholder="ejemplo@gmail.com"
                    minlength="3"
                    maxlength="64"
                    pattern="[a-zA-Z0-9.-_]{1,}@[a-zA-Z.-]{2,}[.]{1}[a-zA-Z]{2,}"
                    required
                  />
                  <has-error :form="formPer" field="correo"></has-error>
                </div>
                <!-- PARTE DE ORGANIZACION EN EL MISMO MODAL -->
                <div v-show="showOrganizacion" class="form-group">
                  <label>Cédula Jurídica</label>
                  <input
                    v-model="formOrg.identificacion"
                    type="text"
                    name="identificacion"
                    class="form-control"
                    :class="{ 'is-invalid': formOrg.errors.has('identificacion') }"
                    placeholder="#-###-######"
                    required
                  />
                  <has-error :form="formOrg" field="identificacion"></has-error>
                </div>
                <div v-show="showOrganizacion" class="form-group">
                  <label>Nombre de Organización</label>
                  <input
                    v-model="formOrg.nombre"
                    type="text"
                    name="nombre"
                    class="form-control"
                    :class="{ 'is-invalid': formOrg.errors.has('nombre') }"
                    placeholder="Nombre de la organización"
                    required
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
                    size="20"
                    min="10000000"
                    placeholder="#### ####"
                    pattern="[0-9]{8}"
                    required
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
                    size="32"
                    placeholder="ejemplo@gmail.com"
                    minlength="3"
                    maxlength="64"
                    pattern="[a-zA-Z0-9.-_]{1,}@[a-zA-Z.-]{2,}[.]{1}[a-zA-Z]{2,}"
                    required
                  />
                  <has-error :form="formOrg" field="correo"></has-error>
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
                <button
                  v-show="modalExtra"
                  type="button"
                  class="btn btn-success"
                  @click="crearOrganizacion()"
                >
                  Registrar
                </button>
                <button
                  v-show="!modalExtra"
                  type="button"
                  class="btn btn-success"
                  @click="crearPersona()"
                   id="validar"
                  disabled="registro"

                >
                  Registrar
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>

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
                Crear nueva reservación
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
              @submit.prevent="editmode ? actualizarReserva() : crearReserva()"
            >
              <div class="modal-body">
                <div v-show="show" class="form-group">
                  <label>Identificación a consultar:</label>
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
                    @click="ConsultaCedula(), NoexisteCedula()"
                  >
                    Consultar
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
                    required
                    min="1"
                    max="30"
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
                    required
                  />
                  <has-error :form="form" field="fecha"></has-error>
                </div>

                <div class="form-group">
                  <label>Hora incial de reservación</label>
                  <input
                    v-model="form.horaInicio"
                    type="time"
                    name="horaInicio"
                    id="horaInicio"
                    class="form-control"
                    :disabled="isDisabled"
                    :class="{ 'is-invalid': form.errors.has('horaInicio') }"
                    required
                    onchange="validarHora()"

                  />
                  <has-error :form="form" field="horaInicio"></has-error>
                </div>
                <div class="form-group">
                  <label>Hora final de reservación</label>
                  <input
                    v-model="form.horaFin"
                    type="time"
                    name="horaFin"
                    id="horaFin"
                    class="form-control"
                    :disabled="isDisabled"
                    :class="{ 'is-invalid': form.errors.has('horaFin') }"
                    required
                     onchange="validarHora()"
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
                  id="reservar"
                >
                  Reservar
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
      CedulaResidencial: false,
      CedulaNacional: false,
      Pasaporte: false,
      tipoIndenteficacion: "",
      registro: false,
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
      modalExtra: false,
      reservas: {},
      form: new Form({
        id: "",
        idPersona: "",
        identificacionPersona: "",
        idOrganizacion: "",
        identificacionOrganizacion: "",
        cantidad: "",
        fecha: "",
        horaInicio: "",
        horaFin: "",
      }),
      formPer: new Form({
        id: "",
        identificacion: "",
        nombre: "",
        apellido1: "",
        apellido2: "",
        telefono: "",
        correo: "",
      }),
      formOrg: new Form({
        id: "",
        identificacion: "",
        nombre: "",
        telefono: "",
        correo: "",
      }),
      tituloModal: "",
    };
  },
  methods: {
    getResults(page = 1) {
      this.$Progress.start();

      axios
        .get("/api/reserva?page=" + page)
        .then(({ data }) => (this.reservas = data.data));

      this.$Progress.finish();
    },
    tipoDeIndentificacon() {
      if (this.tipoIndenteficacion == "Cedula Nacional") {
        this.CedulaNacional = true;
        this.Pasaporte = false;
        this.CedulaResidencial = false;
        this.form.identificacion = "";
      }
      if (this.tipoIndenteficacion == "Cedula Residencial") {
        this.CedulaNacional = false;
        this.Pasaporte = false;
        this.CedulaResidencial = true;
        this.form.identificacion = "";
      } else if (this.tipoIndenteficacion == "Pasaporte") {
        this.CedulaNacional = false;
        this.Pasaporte = true;
        this.CedulaResidencial = false;
        this.form.identificacion = "";
      }
    },
    habilitarCampos() {
      for (let i = 0; i < this.cedulas.length; i++) {
        if (this.cedulas[i].identificacion == this.buscador) {
          this.isDisabled = false;
          this.CedulaBloqueo = true;
          this.form.idPersona = this.cedulas[i].id;
          this.form.identificacionPersona = this.buscador;
          this.showMensajesCedula2 = true;
          this.showExistenciaCedula = false;
          this.MensajeCedula2 = "Se encontro la cédula";
        }
      }
    },
    habilitarCamposOrg() {
      for (let i = 0; i < this.cedulasOrg.length; i++) {
        if (this.cedulasOrg[i].identificacion == this.buscador) {
          this.isDisabled = false;
          this.CedulaBloqueo = true;
          this.form.idOrganizacion = this.cedulasOrg[i].id;
          this.form.identificacionOrganizacion = this.buscador;
          this.showMensajesCedula2 = true;
          this.showExistenciaCedula = false;
          this.MensajeCedula2 = "Se encontro la cédula";
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
      this.formPer.identificacion = "",
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
      this.showMensajesCedula2 = false;
      this.form.errors.clear();
    },

    modalPersona() {
      this.modalExtra = false;
      this.form.reset();
      $("#modalExtra").modal("show");
      this.showPersona = true;
      this.showOrganizacion = false;
    },
    modalOrganizacion() {
      this.modalExtra = true;
      this.form.reset();
      $("#modalExtra").modal("show");
      this.showPersona = false;
      this.showOrganizacion = true;
    },

    cargarReservas() {
      if (this.$gate.isAdmin() || this.$gate.isUser()) {
        axios
          .get("/api/reserva")
          .then(({ data }) => (this.reservas = data.data));
      }
    },

    crearReserva() {
      this.$Progress.start();
      this.form
        .post("/api/reserva")
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
        .post("/api/reserva/guardarPersona", {
          params: { id: this.formPer.id },
        })
        .then((response) => {
          if (response.data.success == false) {
            Toast.fire({
              icon: "error",
              title: "Cedula ya existe!",
            });
          } else {
            $("#modalExtra").modal("hide");

            Toast.fire({
              icon: "success",
              title: response.data.message,
            });
            this.$Progress.finish();
          }
        })
        .catch(() => {
          Toast.fire({
            icon: "error",
            title: "Campos vacios!",
          });
        });
    },
    crearOrganizacion() {
      this.formOrg
        .post("/api/reserva/guardarOrganizacion", {
          params: { id: this.formOrg.id },
        })
        .then((response) => {
          if (response.data.success == false) {
            Toast.fire({
              icon: "error",
              title: "Cedula ya existe!",
            });
          } else {
            $("#modalExtra").modal("hide");

            Toast.fire({
              icon: "success",
              title: response.data.message,
            });
            this.$Progress.finish();
          }
        })
        .catch(() => {
          Toast.fire({
            icon: "error",
            title: "Campos vacios!",
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
.btn {
  margin-top: 10px;
  margin-right: 20px;
}
</style>