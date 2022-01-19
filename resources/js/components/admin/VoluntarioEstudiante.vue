<template>
  <section class="content">
    <div class="container-fluid">
      <div class="block-header" v-if="$gate.isAdmin() || $gate.isUser()">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <ul class="breadcrumb breadcrumb-style">
              <li class="breadcrumb-item">
                <h4 class="page-title">Voluntario Estudiantes</h4>
              </li>
              <li class="breadcrumb-item bcrumb-1">
                <a href="/dashboard">
                  <i class="fas fa-home"></i>
                  Inicio
                </a>
              </li>
              <li class="breadcrumb-item active">Voluntario Estudiantes</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card" v-if="$gate.isAdmin() || $gate.isUser()">
            <div class="card-header">
              <h3 class="card-title">Listado de estudiantes voluntarios</h3>
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
                  Agregar Estudiante
                </button>
              </div>
            </div>
            <!-- fin del card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Identificación de voluntario</th>
                    <th>Id de voluntario</th>
                    <th>Carrera</th>
                    <th>Cantidad de actividades</th>
                    <th>Foto</th>
                    <th>Funciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="voluntarioestudiante in voluntarioEst.data"
                    :key="voluntarioestudiante.id"
                  >
                    <td>{{ voluntarioestudiante.id }}</td>
                    <td>{{ voluntarioestudiante.identificacionPersona }}</td>
                    <td>{{ voluntarioestudiante.voluntariado_id }}</td>
                    <td>{{ voluntarioestudiante.carrera }}</td>
                    <!--<td>{{ voluntarios.data.find(function(el) { return el.id == voluntarioestudiante.voluntariado_id; } ).cantidad }}</td>-->
                    <td v-if="voluntarios">
                      {{
                        voluntarios.data.find(
                          (el) => el.id == voluntarioestudiante.voluntariado_id
                        ).cantidad
                      }}
                    </td>

                    <td>
                      <img
                        v-bind:src="
                          '/images/voluntariado/' + voluntarioestudiante.imagen
                        "
                        width="50px"
                        height="50px"
                      />
                    </td>
                    <td>
                      <a
                        href="#"
                        @click="
                          editModal(voluntarioestudiante),
                            ObtenerCantidad(
                              voluntarioestudiante.voluntariado_id
                            )
                        "
                      >
                        <i class="fa fa-edit blue"></i>
                      </a>
                      /
                      <a
                        href="#"
                        @click="
                          eliminarVoluntarioEst(
                            voluntarioestudiante.id,
                            voluntarioestudiante.voluntariado_id
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
                :data="voluntarioEst"
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
                Registro de estudiante voluntario
              </h5>
              <h5 class="modal-title" v-show="editmode">
                Actualización de estudiante voluntario
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
                editmode ? actualizarVoluntarioEst() : crearVoluntarioEst()
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
                <div class="form-group">
                  <label>Cedula del estudiante</label>
                  <input
                    :disabled="bloquearCedulaVoluntario"
                    v-model="form.identificacionPersona"
                    type="text"
                    name="identificacionPersona"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('identificacionPersona') }"
                  />
                  <has-error :form="form" field="identificacionPersona"></has-error>
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
                    placeholder="Id de voluntario"
                    minlength="1"
                  />
                  <has-error :form="form" field="idVoluntario"></has-error>
                </div>

                <div class="form-group">
                  <label>Carrera universitaria</label>
                  <input
                    v-model="form.carrera"
                    type="text"
                    name="carrera"
                    class="form-control"
                    :disabled="bloquearCamposExtras"
                    :class="{ 'is-invalid': form.errors.has('carrera') }"
                    minlength="3"
                    maxlength="50"
                    placeholder="Carrera universitaria"
                  />

                  <has-error :form="form" field="carrera"></has-error>
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
                            :disabled="bloquearCamposExtras"
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
                    minlength="1"
                    maxlength="30"
                    placeholder="Cantidad de actividades"
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
      <div
        class="modal fade"
        id="personaModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="personaModal"
        aria-hidden="true"
      >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Registro de estudiante</h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
                @click="cerrarModal(), limpiarPersona()"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <!-- <form @submit.prevent="createUser"> -->

            <form @submit.prevent="crearPersona()">
              <div class="modal-body">
                <div class="form-group">
                  <label>Tipo de indentificación</label>
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

                <div class="form-group">
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
                <div class="form-group">
                  <label>Nombre</label>
                  <input
                    style="text-transform: capitalize"
                    v-model="formPer.nombre"
                    type="text"
                    name="nombre"
                    class="form-control"
                    :class="{ 'is-invalid': formPer.errors.has('nombre') }"
                    required
                    minlength="3"
                    maxlength="20"
                    pattern="[a-zA-Z'-'\s]*"
                    placeholder="Nombre del estudiante"
                  />
                  <has-error :form="formPer" field="nombre"></has-error>
                </div>
                <div class="form-group">
                  <label>Primer Apellido</label>
                  <input
                    style="text-transform: capitalize"
                    v-model="formPer.apellido1"
                    type="text"
                    name="apellido1"
                    class="form-control"
                    :class="{ 'is-invalid': formPer.errors.has('apellido1') }"
                    required
                    minlength="3"
                    maxlength="20"
                    pattern="[a-zA-Z'-'\s]*"
                    placeholder="Primer apellido del estudiante"
                  />
                  <has-error :form="formPer" field="apellido1"></has-error>
                </div>
                <div class="form-group">
                  <label>Segundo Apellido</label>
                  <input
                    style="text-transform: capitalize"
                    v-model="formPer.apellido2"
                    type="text"
                    name="apellido2"
                    class="form-control"
                    :class="{ 'is-invalid': formPer.errors.has('apellido2') }"
                    required
                    minlength="3"
                    maxlength="20"
                    pattern="[a-zA-Z'-'\s]*"
                    placeholder="Segundo apellido del estudiante"
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
                    size="20"
                    min="10000000"
                    placeholder="#### ####"
                    pattern="[0-9]{8}"
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
              <div class="modal-footer">
                <button
                  @click="limpiarPersona()"
                  type="button"
                  class="btn btn-secondary"
                  data-dismiss="modal"
                >
                  Cancelar
                </button>
                <button
                  @click="crearPersona()"
                  type="submit"
                  class="btn btn-success"
                >
                  Guardar
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
      currentImage: undefined,
      previewImage: undefined,
      progress: 0,
      message: "",
      imageInfos: [],
      CedulaResidencial: false,
      CedulaNacional: false,
      Pasaporte: false,
      tipoIndenteficacion: "",
      registro: false,
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
      voluntarioEst: {},
      TablaUnion: {},
      form: new Form({
        id: "",
        identificacion: "",
        identificacionPersona: "",
        voluntariado_id: "",
        carrera: "",
        imagen: "",
        idVoluntario: "",
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

    getResults(page = 1) {
      this.$Progress.start();
      axios
        .get("/api/voluntarioEstudiante?page=" + page)
        .then(({ data }) => (this.voluntarioEst = data.data));

      this.$Progress.finish();
    },
    editModal(voluntarioEstudiante) {
      this.editmode = true;
      this.form.reset();
      $("#SubirImagen").val("");
      this.previewImage = "";
      $("#addNew").modal("show");
      this.form.fill(voluntarioEstudiante);
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
      $("#SubirImagen").val("");
      this.previewImage = "";
      $("#addNew").modal("show");
      this.showBuscadores = true;
      this.form.errors.clear();
      this.formVoluntario.errors.clear();
      this.showMensajesCedula2 = false;
      this.CedulaBloqueo = false;
      this.buscadorC = "";
      this.bloquearCamposExtras = true;
      this.bloquearCamposIdVoluntario = true;
    },
    abrirModal() {
      $("#personaModal").modal("show");
    },
    limpiar() {
      this.form.identificacion = "";
      this.form.voluntariado_id = "";
      this.form.imagen = "";
      this.form.carrera = "";
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
    SiExisteCedula() {
      for (let i = 0; i < this.cedulas.length; i++) {
        if (this.cedulas[i].identificacion == this.buscadorC) {
          this.showMensajesCedula = false;
          this.showMensajesCedula2 = true;
          this.CedulaBloqueo = true;
          this.form.identificacion = this.cedulas[i].id;
          this.form.identificacionPersona = this.buscadorC;
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
    ConsultaCedula() {
      this.form
        .get("/api/voluntarioEstudiante/obtenerCedula", {
          params: { buscadorC: this.buscadorC },
        })
        .then(({ data }) => (this.cedulas = data.data))
        .then((response) => {
          this.SiExisteCedula();
        });
    },
    ObtenerCantidad(VoluntarioId) {
      this.form
        .get("/api/voluntarioEstudiante/obtenerCantidad", {
          params: { VolCantidad: VoluntarioId },
        })
        .then(({ data }) => (this.CantidadActividades = data.data))
        .then((response) => {
          this.editarVoluntario();
        });
    },
    cargarVoluntarioEst() {
      if (this.$gate.isAdmin() || this.$gate.isUser()) {
        axios
          .get("/api/voluntarioEstudiante/")
          .then(({ data }) => (this.voluntarioEst = data.data));
      }
    },

    crearPersona() {
      this.formPer
        .post("/api/voluntarioEstudiante/guardarPersona", {
          params: { id: this.formPer.id },
        })
        .then((response) => {
          if (response.data.success == false) {
            Toast.fire({
              icon: "error",
              title: "Cedula ya existe!",
            });
          } else {
            $("#personaModal").modal("hide");
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
    cargarVoluntario() {
      if (this.$gate.isAdmin() || this.$gate.isUser()) {
        axios
          .get("/api/voluntario")
          .then(({ data }) => (this.voluntarios = data.data));
      }
    },
    crearVoluntarioEst() {
      this.$Progress.start();
      this.form.voluntariado_id = this.form.idVoluntario;
      this.form
        .post("/api/voluntarioEstudiante")
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
            this.cargarVoluntarioEst();
          }
        })
        .catch(() => {
          Toast.fire({
            icon: "error",
            title: "Ocurrio un problema!",
          });
        });
    },
    actualizarVoluntarioEst() {
      this.$Progress.start();
      this.formVoluntario.id = this.form.idVoluntario;
      this.formVoluntario.cantidad = this.form.cantidad;
      this.formVoluntario.put("/api/voluntario/" + this.formVoluntario.id);
      this.form
        .put("/api/voluntarioEstudiante/" + this.form.id)
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
          this.cargarVoluntarioEst();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    eliminarVoluntarioEst(id, idvoluntaario) {
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
          this.form.delete("/api/voluntarioEstudiante/" + id);
          this.form
            .delete("/api/voluntario/" + idvoluntaario)
            .then(() => {
              Swal.fire(
                "Eliminado!",
                "Se ha eliminado la información.",
                "success"
              );
              // Fire.$emit('AfterCreate');
              this.cargarVoluntario();
              this.cargarVoluntarioEst();
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
    this.cargarVoluntario();
    this.cargarVoluntarioEst();
    this.$Progress.finish();
  },
  filters: {
    truncate: function (text, length, suffix) {
      return text.substring(0, length) + suffix;
    },
  },
  computed: {
    VoluntariosConCantidad: function () {
      // utilizando se map agrega la propiedad estado por cada elemento del array productos
      let productosConEstado = this.voluntarios.map((p) => {
        p.cantidad = this.voluntarioEst.find((el) => {
          return el.voluntariado_id === p.id;
        }).cantidad;
        return p;
      });
      return productosConEstado;
    },
  },
};
</script>

<style scoped>
.mostrar {
  display: list-item;
  opacity: 1;
  background: rgba(121, 120, 120, 0.623);
  overflow: hidden;
  position: fixed;
}
</style>