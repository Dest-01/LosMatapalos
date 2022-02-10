<template>
  <section class="content">
    <div class="container-fluid">
      <div class="block-header" v-if="$gate.isAdmin() || $gate.isUser()">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <ul class="breadcrumb breadcrumb-style">
              <li class="breadcrumb-item">
                <h4 class="page-title">Donativos</h4>
              </li>
              <li class="breadcrumb-item bcrumb-1">
                <a href="/dashboard">
                  <i class="fas fa-home"></i>
                  Inicio
                </a>
              </li>
              <li class="breadcrumb-item active">Donativos</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card" v-if="$gate.isAdmin() || $gate.isUser()">
            <div class="card-header">
              <h3 class="card-title">Lista de donativos</h3>

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
                    Registrar Donativo
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

                    Registro Donante
                  </button>
                </div>
                <div>
                  <button
                    type="button"
                    class="btn btn-sm btn-primary"
                    @click="modalOrganizacion()"
                  >
                    <i class="fa fa-plus-square"></i>
                    Registro organización donante
                  </button>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Persona Donante</th>
                    <th>Organización Donante</th>
                    <th>Tipo donativo</th>
                    <th>Detalles de donativo</th>
                    <th>Foto de donativo</th>
                    <th>Fecha de donativo</th>
                    <th>Estado de Donación</th>
                    <th>Funciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="donativo in donativos.data" :key="donativo.id">
                    <td>{{ donativo.id }}</td>
                    <td>{{ donativo.identificacionPersona }}</td>
                    <td>{{ donativo.identificacionOrganizacion }}</td>
                    <td class="text-capitalize">{{ donativo.tipo }}</td>
                    <td>{{ donativo.detalle | truncate(30, "...") }}</td>
                    <td>
                      <img
                        v-bind:src="'/images/donativos/' + donativo.photo"
                        width="50px"
                        height="50px"
                      />
                    </td>
                    <td>{{ donativo.fecha }}</td>
                    <td>{{ donativo.estado }}</td>
                    <td>
                      <a href="#" @click="editModal(donativo)">
                        <i id="icono" class="fa fa-edit blue"></i>
                      </a>
                      /
                      <a href="#" @click="eliminarDonativo(donativo.id)">
                        <i id="icono" class="fa fa-trash red"></i>
                      </a>
                      /
                      <a
                        data-mdb-toggle="modal"
                        data-mdb-target="#exampleModal"
                        href="#"
                        @click="detailsModal(donativo)"
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
                :data="donativos"
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

      <!-- Modal de Donativos -->
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
                Crear nuevo donativo
              </h5>
              <h5 class="modal-title" v-show="editmode">Actualizar donativo</h5>
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
                editmode ? actualizarDonativo() : crearDonativo()
              "
            >
              <div class="modal-body">
                <div v-show="verCamposdeConsulta" class="form-group">
                  <label>Consultar Identificación:</label>
                  <input
                    v-model="buscador"
                    type="text"
                    name="buscador"
                    class="form-control"
                    :disabled="bloquearCampoConsulta"
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
                  <label>Identificación Donante</label>
                  <input
                    v-model="form.identificacionPersona"
                    type="text"
                    name="identificacionPersona"
                    class="form-control"
                    :disabled="bloquearSiempre"
                  />
                </div>
                <div v-show="verCampoDeIdentificacionEdit" class="form-group">
                  <label>Identificación Organización</label>
                  <input
                    v-model="form.identificacionOrganizacion"
                    type="text"
                    name="identificacionOrganizacion"
                    class="form-control"
                    :disabled="bloquearSiempre"
                  />
                </div>

                <div class="form-group">
                  <label>Tipo de donativo</label>
                  <select
                    v-model="form.tipo"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('tipo') }"
                    :disabled="bloquearCamposReservacion"
                  >
                    <option disabled value="">Seleccione un elemento</option>
                    <option value="Material">{{ Material }}</option>
                    <option value="Monetario">{{ Monetario }}</option>
                  </select>

                  <has-error :form="form" field="estado"></has-error>
                </div>

                <div class="form-group">
                  <label>Detalles de Donación</label>
                  <textarea
                    v-model="form.detalle"
                    type="text"
                    name="detalle"
                    class="form-control"
                    :disabled="bloquearCamposReservacion"
                    :class="{ 'is-invalid': form.errors.has('detalle') }"
                  >
                  </textarea>
                  <has-error :form="form" field="detalle"></has-error>
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
                            :disabled="bloquearCamposReservacion"
                            :class="{ 'is-invalid': form.errors.has('photo') }"
                            id="SubirImagen"
                          />
                          <has-error :form="form" field="photo"></has-error>
                        </label>
                      </div>
                      <div class="col-4"></div>
                    </div>
                    <div class="progress"></div>
                    <div v-if="previewImage">
                      <div>
                        <img
                          class="preview my-3"
                          :src="previewImage"
                          alt=""
                          title="imagenPrevia"
                          width="200px"
                          height="200px"
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
                  <label>Fecha de Donación</label>
                  <input
                    v-model="form.fecha"
                    type="date"
                    name="fecha"
                    class="form-control"
                    :disabled="bloquearCamposReservacion"
                    :class="{ 'is-invalid': form.errors.has('fecha') }"
                    required
                  />
                  <has-error :form="form" field="fecha"></has-error>
                </div>
                <div class="form-group">
                  <label>Estado del donativo</label>
                  <select
                    class="form-control"
                    v-model="form.estado"
                    :disabled="bloquearCamposReservacion"
                    :class="{ 'is-invalid': form.errors.has('estado') }"
                  >
                    <div class="form-group"></div>
                    <option disabled value="">Seleccione un elemento</option>
                    <option value="Recibido">Recibido</option>
                    <option value="Pendiente">Pendiente</option>
                    <option value="Rechazado">Rechazado</option>
                  </select>

                  <has-error :form="form" field="estado"></has-error>
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
                  :disabled="bloquearCamposReservacion"
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
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Detalles del donativo</h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <div id="inputsModal" class="form-group">
                <label>Identificación Persona Donante</label>
                <input
                  v-model="form.identificacionPersona"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
              <div id="inputsModal" class="form-group">
                <label>Identificación Organización Donante</label>
                <input
                  v-model="form.identificacionOrganizacion"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
              <div id="inputsModal" class="form-group">
                <label>Tipo donativo</label>
                <input
                  v-model="form.tipo"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
              <div id="inputsModal" class="form-group">
                <label>Detalles donativo</label>
                <textarea
                  v-model="form.detalle"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                ></textarea>
              </div>
              <div  class="form-group">
                <label>Foto del donativo</label>
                <img
                  v-bind:src="'/images/donativos/' + form.photo"
                  width="100%"
                  height="350px"
                />
              </div>
              <div id="inputsModal" class="form-group">
                <label>Fecha del donativo</label>
                <input
                  v-model="form.fecha"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
              <div id="inputsModal" class="form-group">
                <label>Estado del donativo</label>
                <input
                  v-model="form.estado"
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
      <!-- MODAL DE ORGANICIONES Y PERSONAS-->
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      currentImage: undefined,
      previewImage: undefined, //Imagen Previa al cargar
      editmode: false,
      buscador: "", //v-model de buscar en el input de consulta
      donativos: {}, //Se llena con ultimos 10 donativos
      personaIdArray: {}, //Array para guardar la identificacion encontrada en persona
      organizacionIdArray: {}, //Array para guardar la identificacion encontrada en organizacion
      nuevoDonativos: {}, //Para hacer el filtro en computed
      mensajeDeExistencia: "", //Vamos a mostrar un mensaje que valide si existe la identificacion
      VermensajeSiExiste: false, //ver mensaje si existe
      VermensajeNoExiste: false, //ver mensaje si no existe
      bloquearCamposReservacion: true, //Bloqueamos los campos de reservacion
      bloquearCampoConsulta: false, //Bloqueamos el input de la consulta para evitar que se modifique
      verCamposdeConsulta: true, //Ver campo de consulta
      verCampoDeIdentificacionEdit: false, //Sirve para mostrar un campo con la identificacion
      bloquearSiempre: true, //Bloqueamos los inputs donde pintamos los ver
      message: "",
      filtrarBusqueda: "", //va en el input de buscar en la tabla
      /*Funcionan con el selec para ocultar y mostrar los campos*/
      tipoIndenteficacion: "",
      CedulaResidencial: false,
      CedulaNacional: false,
      Pasaporte: false,
      registroBloquear: true, //Bloquear el boton para registrar
      bloquearCancelar: true, //Bloquear el boton de cancelar de los inputs de indentificacion
      bloquearInputId: false, //Bloquear el inuput de cedula
      bloquearInputIdR: false, //Bloquear el input de residencial
      bloquearInputIdP: false, //Bloquear el input de Pasaporte
      verDetalles: true,
      form: new Form({
        id: "",
        persona: "",
        idPersona: "",
        identificacionPersona: "",
        idOrganizacion: "",
        identificacionOrganizacion: "",
        tipo: "",
        detalle: "",
        photo: "",
        fecha: "",
        estado: "",
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
      Monetario: "Monetario",
      Material: "Material",
    };
  },

  methods: {
    updatePhoto(e) {
      let file = e.target.files[0];
      this.previewImage = URL.createObjectURL(file);
      this.currentImage = file;
      let reader = new FileReader();

      if (file["size"] < 12111775) {
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

    filtrar() {
      if (this.filtrarBusqueda == "") {
        this.cargarDonativos();
      } else if (this.filtrarBusqueda != "") {
        this.donativos.data = this.donativosFiltradas;
      }
    },
    /*////////////////////////////////////////////////////////////*/
    /*-------------------------Validaciones----------------------*/
    validarCedulaNacional() {
      if (/^[1-9]-\d{4}-\d{4}$/.test(this.formPer.identificacion)) {
        this.bloquearInputId = true;
        this.registroBloquear = false;
        this.bloquearCancelar = false;
        return;
      } else {
        this.bloquearInputId = false;
        this.registroBloquear = true;
        this.bloquearCancelar = true;
        return;
      }
    },
    validarCedulaResidencial() {
      if (/^[1-9]\d{9}$/.test(this.formPer.identificacion)) {
        this.bloquearInputIdR = true;
        this.registroBloquear = false;
        this.bloquearCancelar = false;
        return;
      } else {
        this.bloquearInputIdR = false;
        this.registroBloquear = true;
        this.bloquearCancelar = true;
        return;
      }
    },
    validarPasaporte() {
      if (/^\d{11,12}$/.test(this.formPer.identificacion)) {
        this.bloquearInputIdP = true;
        this.registroBloquear = false;
        this.bloquearCancelar = false;
        return;
      } else {
        this.bloquearInputIdP = false;
        this.registroBloquear = true;
        this.bloquearCancelar = true;
        return;
      }
    },
    bloquearCedula() {
      this.form.identificacion = "";
      this.bloquearInputId = false; //Desbloqueamos el input del id
      this.bloquearInputIdR = false;
      this.bloquearInputIdP = false;
      this.registroBloquear = true; //Bloqueamos el boton de registrar
      this.bloquearCancelar = true; //bloqueamos el boton de cancelar
    },
    cambioSelect() {
      this.bloquearInputId = false; //Desbloqueamos el input del id
      this.bloquearInputIdR = false;
      this.bloquearInputIdP = false;
      this.registroBloquear = true; //Bloqueamos el boton de registrar
      this.bloquearCancelar = true; //bloqueamos el boton de cancelar
    },

    tiposDeIndentificacon() {
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
    /*////////////////////////////////////////////////////////////*/

    comprobarExistenciaIdentificacion() {
      if (
        this.personaIdArray.length != 0 ||
        this.organizacionIdArray.length != 0
      ) {
        for (let i = 0; i < this.personaIdArray.length; i++) {
          if (this.personaIdArray[i].identificacion == this.buscador) {
            this.VermensajeSiExiste = true;
            this.VermensajeNoExiste = false;
            this.mensajeDeExistencia = "Si existe!";
            this.form.identificacionPersona =
              this.personaIdArray[i].identificacion;
            this.bloquearCampoConsulta = true;
            this.bloquearCamposReservacion = false;
          }
        }
        for (let i = 0; i < this.organizacionIdArray.length; i++) {
          if (this.organizacionIdArray[i].identificacion == this.buscador) {
            this.VermensajeSiExiste = true;
            this.VermensajeNoExiste = false;
            this.mensajeDeExistencia = "Si existe!";
            this.form.identificacionOrganizacion =
              this.organizacionIdArray[i].identificacion;
            this.bloquearCampoConsulta = true;
            this.bloquearCamposReservacion = false;
          }
        }
      } else {
        this.VermensajeSiExiste = false;
        this.VermensajeNoExiste = true;
        this.mensajeDeExistencia = "No existe!";
      }
    },
    cancelarbusqueda() {
      //vamos a cancelar la busqueda bloqueando los input de reservacion
      this.bloquearCampoConsulta = false;
      this.bloquearCamposReservacion = true;
      (this.form.identificacionPersona = ""),
        (this.form.identificacionOrganizacion = ""),
        (this.VermensajeSiExiste = false);
      this.VermensajeNoExiste = false;
      this.mensajeDeExistencia = "";
    },

    limpiarDonativo() {
      this.form.errors.clear();
    },

    modalPersona() {},
    modalOrganizacion() {},

    editModal(donativo) {
      this.editmode = true;
      (this.verCamposdeConsulta = false),
        (this.verCampoDeIdentificacionEdit = true),
        $("#addNew").modal("show");
      $("#SubirImagen").val("");
      this.previewImage = "";
      this.form.fill(donativo);
      this.form.errors.clear();
    },
    newModal() {
      this.cancelarbusqueda();
      (this.verCamposdeConsulta = true),
        (this.verCampoDeIdentificacionEdit = false),
        (this.editmode = false);
      this.previewImage = "";
      this.form.reset();
      this.form.errors.clear();
      $("#SubirImagen").val("");
      $("#addNew").modal("show");
    },

    detailsModal(donativo) {
      $("#ModalVer").modal("show");
      this.form.fill(donativo);
    },
    ConsultaCedula() {
      if (this.buscador.length != 0) {
        this.form
          .get("/api/donativo/verificar", {
            params: { buscador: this.buscador },
          })
          .then(({ data }) => (this.personaIdArray = data.data));
        this.form
          .get("/api/donativo/verificarOrg", {
            params: { buscador: this.buscador },
          })
          .then(({ data }) => (this.organizacionIdArray = data.data));
        this.comprobarExistenciaIdentificacion();
      } else {
        this.VermensajeSiExiste = false;
        this.VermensajeNoExiste = true;
        this.mensajeDeExistencia =
          "Campo vacío, por favor digite una identificación";
      }
    },
    getResults(page = 1) {
      this.$Progress.start();

      axios
        .get("/api/donativo?page=" + page)
        .then(({ data }) => (this.donativos = data.data));

      this.$Progress.finish();
    },
    cargarDonativos() {
      if (this.$gate.isAdmin() || this.$gate.isUser()) {
        axios
          .get("/api/donativo")
          .then(({ data }) => (this.donativos = data.data));
        axios
          .get("/api/donativo/listar")
          .then(({ data }) => (this.nuevoDonativos = data.data));
      }
    },
    crearDonativo() {
      this.$Progress.start();
      this.form
        .post("/api/donativo")
        .then((response) => {
          $("#addNew").modal("hide");

          Toast.fire({
            icon: "success",
            title: response.data.message,
          });

          this.$Progress.finish();
          this.cargarDonativos();
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
        .post("/api/donativo/guardarPersona", {
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
            title: "Campos Vacios!",
          });
        });
    },
    crearOrganizacion() {
      this.formOrg
        .post("/api/donativo/guardarOrganizacion", {
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
    actualizarDonativo() {
      this.$Progress.start();
      this.form
        .put("/api/donativo/" + this.form.id)
        .then((response) => {
          // success
          $("#addNew").modal("hide");
          Toast.fire({
            icon: "success",
            title: response.data.message,
          });
          this.$Progress.finish();
          //  Fire.$emit('AfterCreate');

          this.cargarDonativos();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    eliminarDonativo(id) {
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
            .delete("/api/donativo/" + id)
            .then(() => {
              Swal.fire(
                "Eliminado!",
                "Se ha eliminado la información.",
                "success"
              );
              // Fire.$emit('AfterCreate');
              this.cargarDonativos();
            })
            .catch((data) => {
              Swal.fire("Fallo!", "Esta acción no está autorizada!", "warning");
            });
        }
      });
    },
  },
  created() {
    this.$Progress.start();
    this.cargarDonativos();
    this.$Progress.finish();
  },
  filters: {
    truncate: function (text, length, suffix) {
      return text.substring(0, length) + suffix;
    },
  },
  computed: {
    donativosFiltradas: function () {
      return this.nuevoDonativos.filter((donativo) => {
        return (
          donativo.estado
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) ||
          donativo.fecha
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) ||
          donativo.identificacionOrganizacion
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) ||
          donativo.identificacionPersona
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) ||
          donativo.tipo
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) ||
          donativo.detalle
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
.modal-content {
width: 150%;
}
.modal-body {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  justify-content: space-around;
}
#inputsModal{
  width: 45%;
  margin: 10px 15px;
}
</style>