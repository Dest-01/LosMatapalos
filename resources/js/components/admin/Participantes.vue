<template>
  <section class="content">
    <div class="container-fluid">
      <div class="block-header" v-if="$gate.isAdmin() || $gate.isUser()">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <ul class="breadcrumb breadcrumb-style">
              <li class="breadcrumb-item">
                <h4 class="page-title">Participantes</h4>
              </li>
              <li class="breadcrumb-item bcrumb-1">
                <a href="/admin/dashboard">
                  <i class="fas fa-home"></i>
                  Inicio
                </a>
              </li>
              <li class="breadcrumb-item active">Participantes</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card" v-if="$gate.isAdmin() || $gate.isUser()">
            <div class="card-header">
              <h3 class="card-title">Listado de los participantes</h3>

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
                    onclick="limpiarCampo()"
                  >
                    <i class="fa fa-plus-square"></i>
                    Agregar participante
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
                    <th>Nacionalidad</th>
                    <th>Funciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="persona in personas.data" :key="persona.id">
                    <td>{{ persona.identificacion }}</td>
                    <td>{{ persona.nombre }}</td>
                    <td>{{ persona.apellido1 }}</td>
                    <td>{{ persona.apellido2 }}</td>
                    <td>{{ persona.nacionalidad }}</td>
                    <td>
                      <a href="#" @click="editModal(persona)">
                        <i id="icono" class="fa fa-edit blue"></i>
                      </a>
                      /
                      <a href="#" @click="eliminarPersona(persona.id)">
                        <i id="icono" class="fa fa-trash red"></i>
                      </a>
                      /
                      <a href="#" @click="detailsModal(persona)">
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
                Registro de participante
              </h5>
              <h5 class="modal-title" v-show="editmode">
                Actualización de participante
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
                    @change="tiposDeIndentificacon()"
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
                      v-model="DNINacional"
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
                      v-mask="[/[1-9]/, '-####-####']"
                    />
                    <has-error :form="form" field="identificacion"></has-error>
                  </div>

                  <div v-show="CedulaResidencial" class="form-group identitad">
                    <input
                      v-model="DNIResidencial"
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
                      pattern="[0-9]{10}"
                      v-mask="'##########'"
                    />
                    <has-error :form="form" field="identificacion"></has-error>
                  </div>

                  <div v-show="Pasaporte" class="form-group identitad">
                    <input
                      id="pasaporte"
                      v-model="DNIPasaporte"
                      :disabled="bloquearInputIdP"
                      type="text"
                      name="identificacion"
                      class="form-control"
                      :class="{
                        'is-invalid': form.errors.has('identificacion'),
                      }"
                      placeholder="Formato de 11 a 12 dígitos"
                      onchange="validatePasaporte()"
                      pattern="[0-9]{11,12}"
                      v-mask="'############'"
                    />
                    <has-error :form="form" field="identificacion"></has-error>
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
                  <label>Nombre del participante</label>
                  <input
                    v-model="form.nombre"
                    type="text"
                    name="nombre"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('nombre') }"
                    placeholder="Escriba el nombre del participante"
                    minlength="3"
                    maxlength="20"
                    required
                  />
                  <has-error :form="form" field="nombre"></has-error>
                </div>

                <div class="form-group">
                  <label>Primer Apellido</label>
                  <input
                    v-model="form.apellido1"
                    type="text"
                    name="apellido1"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('apellido1') }"
                    placeholder="Escriba el primer apellido del participante"
                    minlength="3"
                    maxlength="20"
                    required
                  />
                  <has-error :form="form" field="apellido1"></has-error>
                </div>

                <div class="form-group">
                  <label>Segundo Apellido</label>
                  <input
                    v-model="form.apellido2"
                    type="text"
                    name="apellido2"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('apellido2') }"
                    placeholder="Escriba el segundo apellido del participante"
                    minlength="3"
                    maxlength="20"
                    required
                  />
                  <has-error :form="form" field="apellido2"></has-error>
                </div>

                <div class="form-group">
                  <label>Nacionalidad</label>
                  <input
                    v-model="form.nacionalidad"
                    type="text"
                    name="nacionalidad"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('nacionalidad') }"
                    required
                    placeholder="Escriba la nacionalidad del participante"
                  />
                  <has-error :form="form" field="nacionalidad"></has-error>
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
              <h5 class="modal-title">Detalles del participante</h5>
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
                <label>Nombre</label>
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
                <label>Nacionalidad</label>
                <input
                  v-model="form.nacionalidad"
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
      valorMostrar: "10",
      /*Funcionan con el selec para ocultar y mostrar los campos*/
      tipoIndenteficacion: "",
      CedulaResidencial: false,
      CedulaNacional: false,
      Pasaporte: false,

      BloquearIdentificacion: true, //Bloquea el input de identificacion al editar
      verIdentificacion: true,
      verIdentificacionedit: false,
      editmode: false,
      errors: {},
      personas: {},
      nuevoPersonas: {},
      verDetalles: true,
      filtrarBusqueda: "",
      DNINacional: "",
      DNIResidencial: "",
      DNIPasaporte: "",
      form: new Form({
        id: "",
        identificacion: "",
        nombre: "",
        apellido1: "",
        apellido2: "",
        nacionalidad: "",
      }),
    };
  },
  methods: {
    filtrar() {
      if (this.filtrarBusqueda == "") {
        this.personas.data = this.nuevoPersonas;
      } else if (this.filtrarBusqueda != "") {
        this.personas.data = this.personasFiltradas;
      }
    },
    /*////////////////////////////////////////////////////////////*/
    /*-------------------------Validaciones----------------------*/
    tiposDeIndentificacon() {
      if (this.tipoIndenteficacion == "Cedula Nacional") {
        this.CedulaNacional = true;
        this.Pasaporte = false;
        this.CedulaResidencial = false;
        this.form.identificacion = "";
        this.DNINacional = "";
        this.DNIResidencial = "";
        this.DNIPasaporte = "";
      } else if (this.tipoIndenteficacion == "Cedula Residencial") {
        this.CedulaNacional = false;
        this.Pasaporte = false;
        this.CedulaResidencial = true;
        this.form.identificacion = "";
        this.DNINacional = "";
        this.DNIResidencial = "";
        this.DNIPasaporte = "";
      } else if (this.tipoIndenteficacion == "Pasaporte") {
        this.CedulaNacional = false;
        this.Pasaporte = true;
        this.CedulaResidencial = false;
        this.form.identificacion = "";
        this.DNINacional = "";
        this.DNIResidencial = "";
        this.DNIPasaporte = "";
      }
    },
    /*////////////////////////////////////////////////////////////*/
 mostrar() {
      if (this.$gate.isAdmin() || this.$gate.isUser()) {
        this.form
          .get("/api/participantes/mostrar/", {
            params: { valor: this.valorMostrar },
          })
          .then(({ data }) => (this.personas = data.data));
      }
    },
    getResults(page = 1) {
      this.$Progress.start();

      axios
        .get("/api/participantes?page=" + page, {
          params: { valor: this.valorMostrar },
        })
        .then(({ data }) => (this.personas = data.data));
      this.$Progress.finish();
    },
    actualizarPersona() {
      this.$Progress.start();
      this.form
        .put("/api/participantes/" + this.form.id)
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
      this.form.reset();
      $("#addNew").modal("show");
      this.form.errors.clear();
    },
    detailsModal(participante) {
      $("#exampleModal").modal("show");
      this.form.fill(participante);
    },
    limpiar() {
      this.form.nombre = "";
      this.form.apellido1 = "";
      this.form.apellido2 = "";
      this.form.telefono = "";
      this.form.correo = "";
      this.form.errors.clear();
    },
    async cargarPersona() {
      if (this.$gate.isAdmin() || this.$gate.isUser()) {
        await axios
          .get("/api/participantes")
          .then(({ data }) => (this.personas = data.data));
        await axios
          .get("/api/participantes/listar")
          .then(({ data }) => (this.nuevoPersonas = data.data));
      }
    },
        asignarDNI() {
      if (this.DNINacional != "") {
        this.form.identificacion = this.DNINacional;
      } else if (this.DNIResidencial != "") {
        this.form.identificacion = this.DNIResidencial;
      } else if (this.DNIPasaporte) {
        this.form.identificacion = this.DNIPasaporte;
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
          /^[1-9]-\d{4}-\d{4}$/.test(this.form.identificacion) ||
          /^[1-9]\d{9}$/.test(this.form.identificacion) ||
          /^\d{11,12}$/.test(this.form.identificacion)
        ) {
          this.form
            .post("/api/participantes", {
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
        } else {
          Swal.fire("Error!", "Formato de identificación incorrecto!", "error");
        }
      }else{
Swal.fire("Error!", "Campo de identificación esta vacio!", "error");
      }
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
            .delete("/api/participantes/" + id)
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
    console.log("Componente Participantes Montado.");
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
          persona.nacionalidad
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
