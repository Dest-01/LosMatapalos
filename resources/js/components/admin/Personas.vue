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
                    <td class="text-capitalize">{{ persona.nombre }}</td>
                    <td>{{ persona.apellido1 }}</td>
                    <td>{{ persona.apellido2 }}</td>
                    <td>{{ persona.telefono }}</td>
                    <td>{{ persona.correo }}</td>
                    <td>
                      <a href="#" @click="editModal(persona)">
                        <i class="fa fa-edit blue"></i>
                      </a>
                      /
                      <a href="#" @click="eliminarPersona(persona.id)">
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
                <div class="form-group">
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

                <div class="form-group">
                  <div v-show="CedulaNacional" class="form-group">
                    <input
                      v-model="form.identificacion"
                      type="text"
                      name="identificacion"
                      class="form-control"
                      :class="{
                        'is-invalid': form.errors.has('identificacion'),
                      }"
                      placeholder="Formato #-####-####"
                      id="nacional"
                      onchange="validate()"
                    />
                    <has-error :form="form" field="identificacion"></has-error>
                  </div>

                  <div v-show="CedulaResidencial" class="form-group">
                    <input
                      v-model="form.identificacion"
                      type="text"
                      name="identificacion"
                      class="form-control"
                      :class="{
                        'is-invalid': form.errors.has('identificacion'),
                      }"
                      placeholder="Formato de 10 dígitos"
                      id="residencial"
                      onchange="validateResidencial()"
                    />
                    <has-error :form="form" field="identificacion"></has-error>
                  </div>

                  <div v-show="Pasaporte" class="form-group">
                    <input
                      v-model="form.identificacion"
                      type="text"
                      name="identificacion"
                      class="form-control"
                      :class="{
                        'is-invalid': form.errors.has('identificacion'),
                      }"
                      placeholder="Formato de 11 a 12 dígitos"
                      id="pasaporte"
                      onchange="validatePasaporte()"
                    />
                    <has-error :form="form" field="identificacion"></has-error>
                  </div>
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
                    max="99999999"
                    placeholder="#### ####"
                    pattern="[0-9]{8}"
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
                    size="32"
                    placeholder="ejemplo@gmail.com"
                    minlength="3"
                    maxlength="64"
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
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      OcultartablaReportes: true,
      CedulaBloqueo: false,
      editmode: false,
      CedulaResidencial: false,
      CedulaNacional: false,
      Pasaporte: false,
      registro: false,
      tipoIndenteficacion: "",
      errors: {},
      personas: {},
      total: "",
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
  mounted() {
    const plugin = document.createElement("script");
    plugin.setAttribute("src", "/js/utilitarios.js");
    plugin.async = true;
    document.head.appendChild(plugin);
  },
  methods: {
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
      this.CedulaBloqueo = true;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(persona);
      this.form.errors.clear();
    },
    newModal() {
      this.editmode = false;
      this.CedulaBloqueo = false;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.errors.clear();
    },
    limpiar() {
      this.form.nombre = "";
      this.form.apellido1 = "";
      this.form.apellido2 = "";
      this.form.telefono = "";
      this.form.correo = "";
      this.form.errors.clear();
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

    cargarPersona() {
      if (this.$gate.isAdmin() || this.$gate.isUser()) {
        axios
          .get("/api/persona")
          .then(({ data }) => (this.personas = data.data));
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
  eliminarPersona(id) {},

  created() {
    this.$Progress.start();
    this.cargarPersona();
    this.$Progress.finish();
  },
};
</script>


<style scoped>
.custom-select {
  position: relative;
  width: 100%;
  text-align: left;
  outline: none;
  height: 45px;
  line-height: 47px;
}

.custom-select .selected {
  background-color: #080808;
  border-radius: 6px;
  border: 1px solid #666666;
  color: #fff;
  padding-left: 1em;
  cursor: pointer;
  user-select: none;
}

.custom-select .selected.open {
  border: 1px solid #ad8225;
  border-radius: 6px 6px 0px 0px;
}

.custom-select .selected:after {
  position: absolute;
  content: "";
  top: 22px;
  right: 1em;
  width: 0;
  height: 0;
  border: 5px solid transparent;
  border-color: #fff transparent transparent transparent;
}

.custom-select .items {
  color: rgb(2, 2, 2);
  border-radius: 0px 0px 6px 6px;
  overflow: hidden;
  border-right: 1px solid #ad8225;
  border-left: 1px solid #ad8225;
  border-bottom: 1px solid #ad8225;
  position: absolute;
  background-color: #ffffff;
  left: 0;
  right: 0;
  z-index: 1;
}

.custom-select .items div {
  color: rgb(0, 0, 0);
  padding-left: 1em;
  cursor: pointer;
  user-select: none;
}

.custom-select .items div:hover {
  background-color: #ad8225;
}

.selectHide {
  display: none;
}

.selectHide {
  display: none;
}
</style>
