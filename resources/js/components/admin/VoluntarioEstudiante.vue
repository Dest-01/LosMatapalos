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
                <a href="/admin/dashboard">
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
                    Agregar nuevo
                  </button>
                </div>
                <div>
                  <button
                    type="button"
                    class="btn btn-sm btn-primary"
                    @click="modalPersona()"
                    onclick="limpiarCampo()"
                  >
                    <i class="fa fa-plus-square"></i>
                    Agregar Estudiante
                  </button>
                </div>
              </div>
            </div>
            <!-- fin del card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
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
                        width="100px"
                        height="70px"
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
                        <i id="icono" class="fa fa-edit blue"></i>
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
                        <i id="icono" class="fa fa-trash red"></i>
                      </a>
                      /
                      <a
                        href="#"
                        @click="
                          detailsModal(voluntarioestudiante),
                            ObtenerCantidad(
                              voluntarioestudiante.voluntariado_id
                            )
                        "
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
                :data="voluntarioEst"
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
                <div v-show="verCamposdeConsulta" class="form-group">
                  <label>Consultar identificación:</label>
                  <input
                    v-model="buscador"
                    type="text"
                    name="buscador"
                    class="form-control"
                    :disabled="bloquearCampoConsulta"
                    placeholder="Escriba la identificación a consultar..."
                  />
                </div>
                <div v-show="verCamposdeConsulta">
                  <label
                    v-show="VermensajeSiExiste"
                    v-text="mensajeDeExistencia"
                    style="color: green"
                  ></label>
                  <label
                    v-show="VermensajeNoExiste"
                    v-text="mensajeDeExistencia"
                    style="color: red"
                  ></label>
                </div>
                <div v-show="verCamposdeConsulta" class="form-group">
                  <button
                    type="button"
                    class="btn btn-success my-4"
                    @click="ConsultaCedula()"
                  >
                    Consultar
                  </button>
                  <button
                    type="button"
                    class="btn btn-danger my-4"
                    @click="cancelarbusqueda()"
                  >
                    Cancelar
                  </button>
                </div>
                <div v-show="verCampoDeIdentificacionEdit" class="form-group">
                  <label>Identificación persona</label>
                  <input
                    v-model="form.identificacionPersona"
                    type="text"
                    name="identificacionPersona"
                    class="form-control"
                    :disabled="bloquearSiempre"
                  />
                </div>

                <div class="form-group">
                  <label>Id del voluntario</label>
                  <input
                    v-model="form.idVoluntario"
                    type="number"
                    name="idVoluntario"
                    class="form-control"
                    :disabled="bloquearSiempre"
                    placeholder="Escriba un Id..."
                    :class="{
                      'is-invalid': form.errors.has('idVoluntario'),
                    }"
                    required
                    min="1"
                    max="9999"
                    v-mask="'####'"
                  />
                  <has-error :form="form" field="idVoluntario"></has-error>
                </div>
                <div v-show="ocultarGenerador" class="form-group">
                  <button
                    type="button"
                    class="btn btn-success my-7"
                    @click="GenerarIdRamdon()"
                    :disabled="bloquearCamposVoluntario"
                  >
                    Generar ID Voluntario
                  </button>
                </div>

                <div class="form-group">
                  <label>Carrera universitaria</label>
                  <input
                    v-model="form.carrera"
                    type="text"
                    name="carrera"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('carrera') }"
                    minlength="3"
                    maxlength="50"
                    required
                    placeholder="Escriba la carrera..."
                    :disabled="bloquearCamposVoluntario"
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
                            :class="{ 'is-invalid': form.errors.has('imagen') }"
                            id="SubirImagen"
                            :disabled="bloquearCamposVoluntario"
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
                  <label>Cantidad de actividades</label>
                  <input
                    v-model="form.cantidad"
                    type="number"
                    name="cantidad"
                    class="form-control"
                    :class="{
                      'is-invalid': form.errors.has('cantidad'),
                    }"
                    min="0"
                    max="999"
                    v-mask="'###'"
                    placeholder="Escriba la cantidad de actividades..."
                    :disabled="bloquearCamposVoluntario"
                  />
                  <has-error :form="form" field="cantidad"></has-error>
                </div>
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-dismiss="modal"
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
                  :disabled="bloquearCamposVoluntario"
                >
                  Registrar
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!--Modal de ver-->
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
              <h5 class="modal-title">Detalles del estudiante voluntariado</h5>
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
                <label>Identificación del estudiante voluntario</label>
                <input
                  v-model="form.identificacionPersona"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
              <div id="inputsModal" class="form-group">
                <label>Id de voluntario</label>
                <input
                  v-model="form.voluntariado_id"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
              <div id="inputsModal" class="form-group">
                <img
                  v-bind:src="'/images/voluntariado/' + form.imagen"
                  width="320px"
                  height="250px"
                />
              </div>
              <div id="inputsModal" class="form-group">
                <label>Cantidad de actividades</label>
                <input
                  v-model="form.cantidad"
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

      <!--Modal de Persona-->
      <div
        class="modal fade"
        id="modalPersona"
        tabindex="-1"
        role="dialog"
        aria-labelledby="modalPersona"
        aria-hidden="true"
      >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Registrar persona</h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form @submit.prevent="crearPersona()">
              <div class="modal-body">
                <div class="form-group">
                  <label>Tipo de identificación</label>
                  <select
                    class="form-control"
                    v-model="tipoIndenteficacion"
                    :class="{ 'is-invalid': form.errors.has('identificacion') }"
                    @change="tiposDeIndentificacon()"
                    required
                  >
                    <option disabled value="">Seleccione un tipo</option>
                    <option value="Cedula Nacional">Cédula Nacional</option>
                    <option value="Cedula Residencial">
                      Cedula Residencial
                    </option>
                    <option value="Pasaporte">Pasaporte</option>
                  </select>
                </div>
                <!---------------------------------------------------------->
                <!-------------INPUTS DE IDENTIFICACION----------------------------------------------->
                <!---------------------------------------------------------->
                <div class="form-group">
                  <div v-show="CedulaNacional" class="form-group identitad">
                    <input
                      v-model="DNINacional"
                      type="text"
                      name="identificacion"
                      class="form-control"
                      :class="{
                        'is-invalid': formPer.errors.has('identificacion'),
                      }"
                      placeholder="Formato #-####-####"
                      id="nacional"
                      onchange="validarCedulaN()"
                      v-mask="[/[1-9]/, '-####-####']"
                    />

                    <has-error
                      :form="formPer"
                      field="identificacion"
                    ></has-error>
                  </div>

                  <div v-show="CedulaResidencial" class="form-group">
                    <input
                      v-model="DNIResidencial"
                      id="residencial"
                      type="text"
                      name="identificacion"
                      class="form-control"
                      :class="{
                        'is-invalid': formPer.errors.has('identificacion'),
                      }"
                      placeholder="Formato de 10 dígitos"
                      onchange="validateResidencial()"
                      pattern="[0-9]{10}"
                      v-mask="'##########'"
                    />
                    <has-error
                      :form="formPer"
                      field="identificacion"
                    ></has-error>
                  </div>

                  <div v-show="Pasaporte" class="form-group identitad">
                    <input
                      id="pasaporte"
                      v-model="DNIPasaporte"
                      type="text"
                      name="identificacion"
                      class="form-control"
                      :class="{
                        'is-invalid': formPer.errors.has('identificacion'),
                      }"
                      placeholder="Formato de 11 a 12 dígitos"
                      onchange="validatePasaporte()"
                      pattern="[0-9]{11,12}"
                      v-mask="'############'"
                    />
                    <has-error
                      :form="formPer"
                      field="identificacion"
                    ></has-error>
                  </div>
                </div>
                <!-------FIN DE LOS INPUTS DE IDENTIFICACION-------->
                <div class="form-group">
                  <label>Nombre</label>
                  <input
                    v-model="formPer.nombre"
                    type="text"
                    name="nombre"
                    class="form-control"
                    :class="{ 'is-invalid': formPer.errors.has('nombre') }"
                    placeholder="Escriba el nombre del donante"
                    required
                    minlength="2"
                    maxlength="30"
                    pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]{1,30}"
                    title="Escriba su nombre."
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
                    placeholder="Primer apellido del donante"
                    minlength="3"
                    maxlength="30"
                    required
                    pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ]{1,30}"
                    title="Digite el primer apellido."
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
                    placeholder="Segundo apellido del donante"
                    minlength="3"
                    maxlength="30"
                    pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ]{1,30}"
                    title="Digite el segundo apellido."
                    required
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
                    :class="{ 'is-invalid': form.errors.has('telefono') }"
                    min="1"
                    placeholder="Formato: #### ####"
                    required
                    pattern="[0-9]{8}"
                    title="Digite un número de teléfono"
                    v-mask="[/[2-9]/, '#######']"
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
                  type="button"
                  class="btn btn-secondary"
                  data-dismiss="modal"
                >
                  Cancelar
                </button>
                <button type="submit" class="btn btn-primary">Registrar</button>
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
      ocultarGenerador: false,
      valorMostrar: "10",
      currentImage: undefined,
      previewImage: undefined,
      message: "",
      progress: 0,
      editmode: false,
      personaIdArray: {},
      voluntarios: {},
      CantidadActividades: {},
      voluntarioEst: {},
      voluntarioEstTodo: {},
      buscador: "",
      mensajeDeExistencia: "", //Vamos a mostrar un mensaje que valide si existe la identificacion
      VermensajeSiExiste: false, //ver mensaje si existe
      VermensajeNoExiste: false, //ver mensaje si no existe
      bloquearCamposVoluntario: true, //Bloqueamos los campos de reservacion
      bloquearCamposVoIdluntario: true,
      bloquearCampoConsulta: false, //Bloqueamos el input de la consulta para evitar que se modifique
      verCamposdeConsulta: true, //Ver campo de consulta
      verCampoDeIdentificacionEdit: false, //Sirve para mostrar un campo con la identificacion
      bloquearSiempre: true, //Bloqueamos los inputs donde pintamos los ver
      filtrarBusqueda: "", //va en el input de buscar en la tabla
      verDetalles: true,
      /////////////////////////////////////////////////////////////////////
      /*TODO PARA GUARDAR EN CLIENTE*/
      tipoIndenteficacion: "",
      CedulaResidencial: false,
      CedulaNacional: false,
      Pasaporte: false,
      DNINacional: "",
      DNIResidencial: "",
      DNIPasaporte: "",
      valorDNI: 0,
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
        identificacion: "",
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
    };
  },
  methods: {
    GenerarIdRamdon() {
      let numeros = Math.floor(Math.random() * 1000);
      this.form.idVoluntario = numeros;
    },
    /*////////////////////////////////////////////////////////////*/
    /*-------------------------Validaciones----------------------*/
    tiposDeIndentificacon() {
      if (this.tipoIndenteficacion == "Cedula Nacional") {
        this.CedulaNacional = true;
        this.Pasaporte = false;
        this.CedulaResidencial = false;
        this.formPer.identificacion = "";
        this.DNINacional = "";
        this.DNIResidencial = "";
        this.DNIPasaporte = "";
      }
      if (this.tipoIndenteficacion == "Cedula Residencial") {
        this.CedulaNacional = false;
        this.Pasaporte = false;
        this.CedulaResidencial = true;
        this.formPer.identificacion = "";
        this.DNINacional = "";
        this.DNIResidencial = "";
        this.DNIPasaporte = "";
      } else if (this.tipoIndenteficacion == "Pasaporte") {
        this.CedulaNacional = false;
        this.Pasaporte = true;
        this.CedulaResidencial = false;
        this.formPer.identificacion = "";
        this.DNINacional = "";
        this.DNIResidencial = "";
        this.DNIPasaporte = "";
      }
    },
    /*////////////////////////////////////////////////////////////*/
    filtrar() {
      if (this.filtrarBusqueda == "") {
        this.voluntarioEst.data = this.voluntarioEstTodo;
      } else if (this.filtrarBusqueda != "") {
        this.voluntarioEst.data = this.voluntarioEstFiltrado;
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

    editModal(voluntarioEstudiante) {
      this.editmode = true;
      this.editmode = true;
      this.ocultarGenerador = false;
      (this.verCamposdeConsulta = false),
        (this.verCampoDeIdentificacionEdit = true),
        (this.bloquearCamposVoluntario = false),
        (this.bloquearCamposVoIdluntario = true);
      this.form.reset();
      $("#SubirImagen").val("");
      this.previewImage = "";
      $("#addNew").modal("show");
      this.form.fill(voluntarioEstudiante);
      this.formVoluntario.cantidad = this.CantidadActividades.cantidad;
      this.form.errors.clear();
      this.formVoluntario.errors.clear();
    },
    newModal() {
      this.editmode = false;
      (this.verCamposdeConsulta = true),
        (this.verCampoDeIdentificacionEdit = false),
        this.cancelarbusqueda();
      this.ocultarGenerador = true;
      this.form.reset();
      $("#SubirImagen").val("");
      this.previewImage = "";
      $("#addNew").modal("show");
      this.form.errors.clear();
      this.formVoluntario.errors.clear();
      this.DNIResidencial = "";
      this.DNIPasaporte = "";
      this.DNINacional = "";
    },
    detailsModal(voluntarioEstudiante) {
      $("#ModalVer").modal("show");
      this.form.fill(voluntarioEstudiante);
      this.formVoluntario.cantidad = this.CantidadActividades.cantidad;
    },
    modalPersona() {
      $("#modalPersona").modal("show");
      this.formPer.reset();
      this.formPer.errors.clear();
    },
    mostrar() {
      if (this.$gate.isAdmin() || this.$gate.isUser()) {
        this.form
          .get("/api/voluntarioEstudiante/mostrar/", {
            params: { valor: this.valorMostrar },
          })
          .then(({ data }) => (this.voluntarioEst = data.data));
      }
    },
    getResults(page = 1) {
      this.$Progress.start();
      axios
        .get("/api/voluntarioEstudiante?page=" + page, {
          params: { valor: this.valorMostrar },
        })
        .then(({ data }) => (this.voluntarioEst = data.data));
      this.$Progress.finish();
    },

    editarVoluntario() {
      for (let i = 0; i < this.CantidadActividades.length; i++) {
        this.form.idVoluntario = this.CantidadActividades[i].id;
        this.form.cantidad = this.CantidadActividades[i].cantidad;
      }
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
        axios
          .get("/api/voluntarioEstudiante/listar")
          .then(({ data }) => (this.voluntarioEstTodo = data.data));
      }
    },

    //Mostrar mensaje de existencia
    mostrarmensajeDeExistencia() {
      this.VermensajeSiExiste = true;
      this.VermensajeNoExiste = false;
      this.mensajeDeExistencia = "Si existe!";
      this.bloquearCampoConsulta = true;
      this.bloquearCamposVoluntario = false;
      this.bloquearCamposVoIdluntario = false;
    },
    //Realizamos un recorrido for each para llenar el form de voluntariado de persona
    llenarFormVoluntarioPersona() {
      this.personaIdArray.forEach((element) => {
        this.form.identificacionPersona = element.identificacion;
        this.form.identificacion = element.id;
      });
    },
    cancelarbusqueda() {
      //vamos a cancelar la busqueda bloqueando los input de voluntariado persona
      this.bloquearCampoConsulta = false;
      this.bloquearCamposVoluntario = true;
      this.bloquearCamposVoIdluntario = true;
      (this.form.identificacionPersona = ""), (this.VermensajeSiExiste = false);
      this.VermensajeNoExiste = false;
      this.mensajeDeExistencia = "";
      this.valorDNI = 0;
      this.buscador = "";
      this.personaIdArray = {};
    },
    async ConsultaCedula() {
      if (this.buscador.length != 0) {
        if (
          /^[1-9]-\d{4}-\d{4}$/.test(this.buscador) ||
          /^[1-9]\d{9}$/.test(this.buscador) ||
          /^\d{11,12}$/.test(this.buscador)
        ) {
          await axios
            .get("/api/voluntarioEstudiante/verificarCedula", {
              params: { buscador: this.buscador },
            })
            .then((response) => {
              if (response.data.success == true) {
                this.valorDNI = 1;
                this.mostrarmensajeDeExistencia();
                axios
                  .get("/api/voluntarioEstudiante/obtenerCedula", {
                    params: { buscador: this.buscador },
                  })
                  .then(({ data }) => (this.personaIdArray = data.data));
              } else {
                this.VermensajeSiExiste = false;
                this.VermensajeNoExiste = true;
                this.mensajeDeExistencia = "No existe!";
              }
            });
        } else {
          this.VermensajeSiExiste = false;
          this.VermensajeNoExiste = true;
          this.mensajeDeExistencia = "No existe!";
        }
      } else {
        this.VermensajeSiExiste = false;
        this.VermensajeNoExiste = true;
        this.mensajeDeExistencia =
          "Campo vacío, por favor digite una identificación";
      }
    },
    asignarDNI() {
      if (this.DNINacional != "") {
        this.formPer.identificacion = this.DNINacional;
      } else if (this.DNIResidencial != "") {
        this.formPer.identificacion = this.DNIResidencial;
      } else if (this.DNIPasaporte) {
        this.formPer.identificacion = this.DNIPasaporte;
      }
    },
    crearPersona() {
      if (
        this.DNINacional != "" ||
        this.DNIResidencial != "" ||
        this.DNIPasaporte != ""
      ) {
        this.asignarDNI();
        if (
          /^[1-9]-\d{4}-\d{4}$/.test(this.formPer.identificacion) ||
          /^[1-9]\d{9}$/.test(this.formPer.identificacion) ||
          /^\d{11,12}$/.test(this.formPer.identificacion)
        ) {
          this.formPer
            .post("/api/voluntarioEstudiante/guardarPersona", {
              params: { identificacion: this.formPer.identificacion },
            })
            .then((response) => {
              if (response.data.success == false) {
                Toast.fire({
                  icon: "error",
                  title: "Cedula ya existe!",
                });
              } else {
                $("#modalPersona").modal("hide");

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
        } else {
          Swal.fire("Error!", "Formato de identificación incorrecto!", "error");
        }
      } else {
        Swal.fire("Error!", "Campo de identificación esta vacio!", "error");
      }
    },
    cargarVoluntario() {
      if (this.$gate.isAdmin() || this.$gate.isUser()) {
        axios
          .get("/api/voluntario")
          .then(({ data }) => (this.voluntarios = data.data));
      }
    },
    VoluntarioEst() {
      this.$Progress.start();
      this.form.voluntariado_id = this.form.idVoluntario;
      this.form
        .post("/api/voluntarioEstudiante", {
          params: {  idVoluntario: this.form.idVoluntario, IdentificacionEst: this.form.identificacionPersona },
        })
        .then((response) => {
          if (response.data.success == false) {
            Toast.fire({
              icon: "error",
              title: "El voluntario ya existe!",
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
    crearVoluntarioEst() {
      if (this.valorDNI == 1) {
        this.llenarFormVoluntarioPersona();
      }
      if (this.form.identificacionPersona.length != "") {
        if (
          /^[1-9]-\d{4}-\d{4}$/.test(this.form.identificacionPersona) ||
          /^[1-9]\d{9}$/.test(this.form.identificacionPersona) ||
          (/^\d{11,12}$/.test(this.form.identificacionPersona) &&
            this.form.idPersona != 0)
        ) {
          this.VoluntarioEst();
        } else {
          Swal.fire("Error!", "Identificacion formato incorrecto!", "error");
        }
      } else {
        Swal.fire("Error!", "Primero verifique que existe!", "error");
      }
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
    console.log("Componente Voluntario Estudiante Montado.");
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
    voluntarioEstFiltrado: function () {
      return this.voluntarioEstTodo.filter((voluntario) => {
        return (
          voluntario.identificacionPersona
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) ||
          voluntario.carrera
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase())
        );
      });
    },
  },
};
</script>


<style scoped>
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
@media only screen and (min-device-width: 300px) and (max-device-width: 1199px) {
  .modal-content {
    width: 100%;
  }
  #modal-contentino {
    width: 100%;
  }
  #inputsModal {
    width: 100%;
  }
  .form-group img {
    height: 250px;
  }
}
@media only screen and (min-device-width: 100px) and (max-device-width: 900px) {
  .pagination {
    display: flex;
    padding-left: 0;
    list-style: none;
    border-radius: 0.25rem;
    flex-wrap: wrap;
  }
}
</style>
