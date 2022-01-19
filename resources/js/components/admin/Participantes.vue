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
                <a href="/dashboard">
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
                <button
                  type="button"
                  class="btn btn-sm btn-primary"
                  @click="newModal"
                  onclick="esconder()"
                >
                  <i class="fa fa-plus-square"></i>
                  Agregar Participante
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
                    <th>Nacionalidad</th>

                    <th>Funciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="participante in participantes.data"
                    :key="participante.id"
                  >
                    <td>{{ participante.identificacion }}</td>
                    <td class="text-capitalize">{{ participante.nombre }}</td>
                    <td>{{ participante.apellido1 }}</td>
                    <td>{{ participante.apellido2 }}</td>
                    <td>{{ participante.nacionalidad }}</td>
                    <td>
                      <a href="#" @click="editModal(participante)">
                        <i class="fa fa-edit blue"></i>
                      </a>
                      /
                      <a
                        href="#"
                        @click="eliminarParticipante(participante.id)"
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
                :data="participantes"
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
              @submit.prevent="
                editmode ? actualizarParticipantes() : crearParticipante()
              "
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

                <div class="form-group ocultar">
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
                    <has-error
                      :form="form"
                      field="identificacion"
                    ></has-error>
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
                    <has-error
                      :form="form"
                      field="identificacion"
                    ></has-error>
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
                    <has-error
                      :form="form"
                      field="identificacion"
                    ></has-error>
                  </div>
                </div>

                <div class="form-group">
                  <label>Nombre</label>
                  <input
                    v-model="form.nombre"
                    type="text"
                    name="nombre"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('nombre') }"
                    required
                    minlength="3"
                    maxlength="30"
                   pattern="[a-zA-Z'-'\s]*"
                    placeholder="Nombre del participante"
                   
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
                    
                    required
                    minlength="3"
                    maxlength="30"
                    placeholder="Primer apellido del participante"
                    pattern="[a-zA-Z'-'\s]*"
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
                  required
                    minlength="3"
                    maxlength="30"
                     pattern="[a-zA-Z'-'\s]*"
                    placeholder="Segundo apellido del participante"
                  
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
                      pattern="[a-zA-Z'-'\s]*"
                    :class="{ 'is-invalid': form.errors.has('nacionalidad') }"
                    
                   required
                    minlength="3"
                    maxlength="30"
                    placeholder="Nacionalidad del participante"
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
      CedulaResidencial: false,
      CedulaNacional: false,
      Pasaporte: false,
      tipoIndenteficacion: "",
      registro: false,
      CedulaBloqueo: false,
      editmode: false,
      errors: {},
      participantes: {},
      form: new Form({
        id: "",
        nombre: "",
        apellido1: "",
        apellido2: "",
        nacionalidad: "",
      }),
    };
  },
  methods: {
    getResults(page = 1) {
      this.$Progress.start();

      axios
        .get("/api/participantes?page=" + page)
        .then(({ data }) => (this.participantes = data.data));

      this.$Progress.finish();
    },
    actualizarParticipantes() {
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

          this.cargarParticipantes();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    editModal(participante) {
      this.editmode = true;
      this.CedulaBloqueo = true;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(participante);
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
      this.form.nacionalidad = "";
      this.form.errors.clear();
    },

    cargarParticipantes() {
      if (this.$gate.isAdmin() || this.$gate.isUser()) {
        axios
          .get("/api/participantes")
          .then(({ data }) => (this.participantes = data.data));
      }
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

    crearParticipante() {
      this.form
        .post("/api/participantes", {
          params: { id: this.form.id },
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
            this.cargarParticipantes();
          }
        })
        .catch(() => {
          Toast.fire({
            icon: "error",
            title: "Campos vacios",
          });
        });
    },

    eliminarParticipante(id) {
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
              this.cargarParticipantes();
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
  eliminarParticipante(id) {},

  created() {
    this.$Progress.start();
    this.cargarParticipantes();
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
