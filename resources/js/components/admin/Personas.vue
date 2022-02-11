<template>
  <section class="content">
    <div class="container-fluid">
      <div class="block-header" v-if="$gate.isAdmin() || $gate.isUser()">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <ul class="breadcrumb breadcrumb-style">
              <li class="breadcrumb-item">
                <h4 class="page-title">Personas</h4>
              </li>
              <li class="breadcrumb-item bcrumb-1">
                <a href="/dashboard">
                  <i class="fas fa-home"></i>
                  Inicio
                </a>
              </li>
              <li class="breadcrumb-item active">Personas</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card" v-if="$gate.isAdmin() || $gate.isUser()">
            <div class="card-header">
              <h3 class="card-title">Listado de los clientes</h3>

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
                    onclick="limpiarCampo()"
                  >
                    <i class="fa fa-plus-square"></i>
                    Agregar Persona
                  </button>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Cédula</th>
                    <th>Nombre</th>
                    <th>Primer Apellido</th>
                    <th>Segundo Apellido</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Funciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="persona in personas.data" :key="persona.id">
                    <td>{{ persona.identificacion }}</td>
                    <td>{{ persona.nombre }}</td>
                    <td>{{ persona.apellido1 }}</td>
                    <td>{{ persona.apellido2 }}</td>
                    <td>{{ persona.telefono }}</td>
                    <td>{{ persona.correo }}</td>
                    <td>
                      <a href="#" @click="editModal(persona)">
                        <i id="icono" class="fa fa-edit blue"></i>
                      </a>
                      /
                      <a href="#" @click="eliminarPersona(persona.id)">
                        <i id="icono" class="fa fa-trash red"></i>
                      </a>
                      /
                      <a
                        href="#"
                        @click="detailsModal(persona)"
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
                :data="personas"
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
                Registro de cliente
              </h5>
              <h5 class="modal-title" v-show="editmode">
                Actualización de cliente
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
              @submit.prevent="editmode ? actualizarPersona() : crearPersona()"
            >
              <div class="modal-body">
                <div v-show="verIdentificacion" class="form-group">
                  <label>Tipo de identificación</label>
                  <select
                    class="form-control"
                    v-model="tipoIndenteficacion"
                    :class="{ 'is-invalid': form.errors.has('identificacion') }"
                    @change="tiposDeIndentificacon(), cambioSelect()"
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
                <div v-show="verIdentificacion" class="form-group">
                  <div v-show="CedulaNacional" class="form-group identitad">
                    <input
                      @blur="validarCedulaNacional()"
                      v-model="form.identificacion"
                      :disabled="bloquearInputId"
                      type="text"
                      name="identificacion"
                      class="form-control"
                      :class="{
                        'is-invalid': form.errors.has('identificacion'),
                      }"
                      placeholder="Formato #-####-####"
                      id="nacional"
                      onchange="validarCedulaN()"
                    />
                    <button
                      id="btnCancelar"
                      type="button"
                      class="btn btn-danger"
                      :disabled="bloquearCancelar"
                      @click="bloquearCedula()"
                    >
                      <i class="fas fa-times"></i>
                    </button>
                    <has-error :form="form" field="identificacion"></has-error>
                  </div>

                  <div v-show="CedulaResidencial" class="form-group identitad">
                    <input
                      @blur="validarCedulaResidencial()"
                      v-model="form.identificacion"
                      id="residencial"
                      :disabled="bloquearInputIdR"
                      type="text"
                      name="identificacion"
                      class="form-control"
                      :class="{
                        'is-invalid': form.errors.has('identificacion'),
                      }"
                      placeholder="Formato de 10 dígitos"
                      onchange="validateResidencial()"
                    />
                    <has-error :form="form" field="identificacion"></has-error>
                    <button
                      id="btnCancelar"
                      type="button"
                      class="btn btn-danger"
                       :disabled="bloquearCancelar"
                      @click="bloquearCedula()"
                    >
                      <i class="fas fa-times"></i>
                    </button>
                  </div>

                  <div v-show="Pasaporte" class="form-group identitad">
                    <input
                      id="pasaporte"
                      @blur="validarPasaporte()"
                      v-model="form.identificacion"
                      :disabled = "bloquearInputIdP"
                      type="text"
                      name="identificacion"
                      class="form-control"
                      :class="{
                        'is-invalid': form.errors.has('identificacion'),
                      }"
                      placeholder="Formato de 11 a 12 dígitos"
                      onchange="validatePasaporte()"
                    />
                    <has-error :form="form" field="identificacion"></has-error>
                    <button
                      id="btnCancelar"
                      type="button"
                      class="btn btn-danger"
                       :disabled="bloquearCancelar"
                      @click="bloquearCedula()"
                    >
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
<!-------FIN DE LOS INPUTS DE IDENTIFICACION-------->
                <div v-show="verIdentificacionedit" class="form-group">
                  <label>Identificación</label>
                  <input
                    style="text-transform: capitalize"
                    v-model="form.identificacion"
                    type="text"
                    name="identificacion"
                    class="form-control"
                    :disabled="BloquearIdentificacion"

                  />
                  <has-error :form="form" field="identificacion"></has-error>
                </div>
                <div class="form-group">
                  <label>Nombre</label>
                  <input
                    style="text-transform: capitalize"
                    v-model="form.nombre"
                    type="text"
                    name="nombre"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('nombre') }"
                    placeholder="Nombre"
                    minlength="3"
                    maxlength="20"
                    required
                    pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ'-'\s]*"
                  />
                  <has-error :form="form" field="nombre"></has-error>
                </div>

                <div class="form-group">
                  <label>Primer Apellido</label>
                  <input
                    style="text-transform: capitalize"
                    v-model="form.apellido1"
                    type="text"
                    name="apellido1"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('apellido1') }"
                    placeholder="Primer Apellido"
                    minlength="3"
                    maxlength="20"
                    required
                    pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ'-'\s]*"
                  />
                  <has-error :form="form" field="apellido1"></has-error>
                </div>

                <div class="form-group">
                  <label>Segundo Apellido</label>
                  <input
                    style="text-transform: capitalize"
                    v-model="form.apellido2"
                    type="text"
                    name="apellido2"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('apellido2') }"
                    placeholder="Segundo Apellido"
                    minlength="3"
                    maxlength="20"
                    required
                    pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ'-'\s]*"
                  />
                  <has-error :form="form" field="apellido2"></has-error>
                </div>

                <div class="form-group">
                  <label>Teléfono</label>
                  <input
                    v-model="form.telefono"
                    type="tel"
                    name="telefono"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('telefono') }"
                    id="phone"
                    size="8"
                    min="10000000"
                    placeholder="#### ####"
                    pattern="[1-9][0-9]{7}"
                    required
                  />
                  <has-error :form="form" field="telefono"></has-error>
                </div>
                <div class="form-group">
                  <label>Correo</label>
                  <input
                    v-model="form.correo"
                    type="email"
                    name="correo"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('correo') }"
                    placeholder="ejemplo@gmail.com"
                    minlength="3"
                    maxlength="100"
                    pattern="[a-zA-Z0-9.-_]{1,}@[a-zA-Z.-]{2,}[.]{1}[a-zA-Z]{2,}"
                    required
                  />
                  <has-error :form="form" field="correo"></has-error>
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
                  :disabled="registroBloquear"
                >
                  Registrar
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!--Fin del modal-->
      <!-- Modal de ver informacion -->
      <div
        class="modal fade"
        id="exampleModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModal"
        aria-hidden="true"
      >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Detalles de la Persona</h5>
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
              <div class="form-group">
                <label>Identificación</label>
                <input
                  v-model="form.identificacion"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
              <div class="form-group">
                <label>Nombre Persona</label>
                <input
                  v-model="form.nombre"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
              <div class="form-group">
                <label>Primer Apellido</label>
                <input
                  v-model="form.apellido1"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
              <div class="form-group">
                <label>Segundo Apellido</label>
                <input
                  v-model="form.apellido2"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
              <div class="form-group">
                <label>Teléfono</label>
                <input
                  v-model="form.telefono"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
              <div class="form-group">
                <label>Correo</label>
                <input
                  v-model="form.correo"
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
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      /*Funcionan con el selec para ocultar y mostrar los campos*/
      tipoIndenteficacion: "",
      CedulaResidencial: false,
      CedulaNacional: false,
      Pasaporte: false,

      BloquearIdentificacion: true, //Bloquea el input de identificacion al editar
      verIdentificacion: true,
      verIdentificacionedit: false,
      editmode: false,
      registroBloquear: true, //Bloquear el boton para registrar
      bloquearCancelar: true, //Bloquear el boton de cancelar de los inputs de indentificacion
      bloquearInputId: false,//Bloquear el inuput de cedula
      bloquearInputIdR: false, //Bloquear el input de residencial
      bloquearInputIdP: false, //Bloquear el input de Pasaporte
      errors: {},
      personas: {},
      nuevoPersonas: {},
      verDetalles: true,
      filtrarBusqueda: "",
      form: new Form({
        id: "",
        identificacion: "",
        nombre: "",
        apellido1: "",
        apellido2: "",
        telefono: "",
        correo: "",
      }),
    };
  },
  methods: {

    filtrar() {
      if (this.filtrarBusqueda == "") {
        this.cargarPersona();
      } else if (this.filtrarBusqueda != "") {
        this.personas.data = this.personasFiltradas;
      }
    },
    /*////////////////////////////////////////////////////////////*/
    /*-------------------------Validaciones----------------------*/
    validarCedulaNacional() {
      if (/^[1-9]-\d{4}-\d{4}$/.test(this.form.identificacion)) {
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
      if (/^[1-9]\d{9}$/.test(this.form.identificacion)) {
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
      if (/^\d{11,12}$/.test(this.form.identificacion)) {
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
    cambioSelect(){
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

    getResults(page = 1) {
      this.$Progress.start();

      axios
        .get("/api/persona?page=" + page)
        .then(({ data }) => (this.personas = data.data));
      this.$Progress.finish();
    },
    actualizarPersona() {
      this.$Progress.start();
      this.form
        .put("/api/persona/" + this.form.id)
        .then((response) => {
          // success
          $("#addNew").modal("hide");
          Toast.fire({
            icon: "success",
            title: response.data.message,
          });
          this.$Progress.finish();
          //  Fire.$emit('AfterCreate');

          this.cargarPersona();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    editModal(persona) {
      this.editmode = true;
     this.verIdentificacion = false;
      this.verIdentificacionedit = true;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(persona);
      this.form.errors.clear();
    },
    newModal() {
      this.editmode = false;
      this.verIdentificacion = true;
      this.verIdentificacionedit = false;
      this.bloquearCedula();
      this.form.reset();
      $("#addNew").modal("show");
      this.form.errors.clear();
    },
    detailsModal(persona) {
      $("#exampleModal").modal("show");
      this.form.fill(persona);
    },
    limpiar() {
      this.form.nombre = "";
      this.form.apellido1 = "";
      this.form.apellido2 = "";
      this.form.telefono = "";
      this.form.correo = "";
      this.form.errors.clear();
    },
    cargarPersona() {
      if (this.$gate.isAdmin() || this.$gate.isUser()) {
        axios
          .get("/api/persona")
          .then(({ data }) => (this.personas = data.data));
        axios
          .get("/api/personas/listar")
          .then(({ data }) => (this.nuevoPersonas = data.data));
      }
    },
    crearPersona() {
      this.form
        .post("/api/persona", {
          params: { identificacion: this.form.identificacion },
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

            this.$Progress.finish();
            this.cargarPersona();
          }
        })
        .catch(() => {
          Toast.fire({
            icon: "error",
            title: "Complete los campos!",
          });
        });
    },

    eliminarPersona(id) {
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
            .delete("/api/persona/" + id)
            .then(() => {
              Swal.fire(
                "Eliminado!",
                "Se ha eliminado la información.",
                "success"
              );
              // Fire.$emit('AfterCreate');
              this.cargarPersona();
            })
            .catch((data) => {
              Swal.fire("Fallo!", "Acción no autorizada!", "warning");
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
    this.cargarPersona();
    this.$Progress.finish();
  },
  computed: {
    personasFiltradas: function () {
      return this.nuevoPersonas.filter((persona) => {
        return (
          persona.identificacion
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) ||
          persona.nombre
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) ||
          persona.apellido1
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) ||
          persona.apellido2
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) ||
          persona.telefono
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) ||
          persona.correo
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
.identitad{
  display: flex;
  flex-direction: row;
  flex-wrap: nowrap;
}
</style>
