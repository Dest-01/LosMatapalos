<template>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card" v-if="$gate.isAdmin()">
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
              </div>
            </div>
            <!-- fin del card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Cedula de voluntario</th>
                    <th>Universidad</th>
                    <th>Carrera</th>
                    <th>Id de voluntario</th>
                    <th>Funciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="voluntarioestudiante in voluntarioEst.data"
                    :key="voluntarioestudiante.id"
                  >
                    <td>{{ voluntarioestudiante.id }}</td>
                    <td>{{ voluntarioestudiante.identificacion }}</td>
                    <td>{{ voluntarioestudiante.Universidad }}</td>
                    <td>{{ voluntarioestudiante.carrera }}</td>
                    <td>{{ voluntarioestudiante.voluntariado_id }}</td>
                    <td>
                      <a href="#" @click="editModal(voluntarioestudiante)">
                        <i class="fa fa-edit blue"></i>
                      </a>
                      /
                      <a
                        href="#"
                        @click="eliminarVoluntarioEst(voluntarioestudiante.id)"
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
      <div v-if="!$gate.isAdmin()">
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
                    @click="
                      ConsultaCedula(), ComprobarCampos(), NoexisteCedula()
                    "
                  >
                    Comprobar cedula
                  </button>
                  <button
                    type="button"
                    class="btn btn-danger my-4"
                    @click="cancelarCedula()"
                  >
                    Cancelar
                  </button>
                </div>
                <div v-show="showBuscadores" class="form-group">
                  <label>Nombre de voluntario a consultar:</label>
                  <input
                    v-model="buscadorV"
                    type="text"
                    name="buscadorV"
                    class="form-control"
                    :disabled="VoluntarioBloqueo"
                  />
                </div>
                <div>
                  <label
                    v-show="showMensajesVoluntario"
                    v-text="MensajeVoluntario"
                    style="color: red"
                  ></label>
                  <label
                    v-show="showMensajesVoluntario2"
                    v-text="MensajeVoluntario2"
                    style="color: green"
                  ></label>
                </div>
                <div v-show="showBuscadores" class="form-group">
                  <button
                    type="button"
                    class="btn btn-success my-4"
                    @click="
                      ConsultaNombreVoluntario(),
                        ComprobarCampos(),
                        NoexisteNombreV()
                    "
                  >
                    Comprobar voluntario
                  </button>
                  <button
                    type="button"
                    class="btn btn-danger my-4"
                    @click="cancelarVoluntario()"
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
                  <label>Nombre del voluntariado</label>
                  <input
                    :disabled="bloquearCedulaVoluntario"
                    v-model="form.voluntariado_id"
                    type="text"
                    name="voluntariado_id"
                    class="form-control"
                    :class="{
                      'is-invalid': form.errors.has('voluntariado_id'),
                    }"
                  />
                  <has-error :form="form" field="voluntariado_id"></has-error>
                </div>
                <div class="form-group">
                  <label>Universidad perteneciente</label>
                  <input
                    v-model="form.Universidad"
                    type="text"
                    name="Universidad"
                    class="form-control"
                    :disabled="bloquearCamposExtras"
                    :class="{ 'is-invalid': form.errors.has('Universidad') }"
                  />
                  <has-error :form="form" field="Universidad"></has-error>
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
                  />
                  <has-error :form="form" field="carrera"></has-error>
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
    </div>
  </section>
</template>
<script>
export default {
  data() {
    return {
      MensajeCedula: "",
      MensajeCedula2: "Se encontro la cedula!",
      MensajeVoluntario: "",
      MensajeVoluntario2: "Se encontro el nombre!",
      showBuscadores: false, //se oculta al editar
      showMensajesCedula: false,
      showMensajesCedula2: false,
      showMensajesVoluntario: false,
      showMensajesVoluntario2: false,
      bloquearCedulaVoluntario: true,
      bloquearCamposExtras: true,
      editmode: false,
      CedulaBloqueo: false,
      VoluntarioBloqueo: false,
      buscadorC: "",
      buscadorV: "",
      errors: {},
      cedulas: {},
      voluntarioNombre: {},
      voluntarioEst: {},
      form: new Form({
        id: "",
        identificacion: "",
        voluntariado_id: "",
        Universidad: "",
        carrera: "",
      }),
    };
  },
  methods: {
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
      $("#addNew").modal("show");
      this.form.fill(voluntarioEstudiante);
      this.showBuscadores = false;
    },
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#addNew").modal("show");
      this.showBuscadores = true;
    },
    limpiar() {
      this.form.identificacion = "";
      this.form.voluntario_id = "";
      this.form.universidad = "";
      this.form.carrera = "";
      this.buscadorC = "";
      this.buscadorV = "";
      this.form.errors.clear();
    },
    SiExisteCedula() {
      for (let i = 0; i < this.cedulas.length; i++) {
        if (this.cedulas[i].id == this.buscadorC) {
          this.showMensajesCedula = false;
          this.showMensajesCedula2 = true;
          this.CedulaBloqueo = true;
          this.form.identificacion = this.buscadorC;
        }
      }
    },
    SiExisteNombre() {
      for (let i = 0; i < this.voluntarioNombre.length; i++) {
        if (this.voluntarioNombre[i].nombre == this.buscadorV) {
          this.VoluntarioBloqueo = true;
          this.showMensajesVoluntario = false;
          this.showMensajesVoluntario2 = true;
          this.form.voluntariado_id = this.voluntarioNombre[i].id;
        }
      }
    },
    cancelarCedula() {
      this.CedulaBloqueo = false;
      this.showMensajesCedula = false;
      this.showMensajesCedula2 = false;
      this.form.identificacion = "";
    },
    cancelarVoluntario() {
      this.VoluntarioBloqueo = false;
      this.showMensajesVoluntario = false;
      this.showMensajesVoluntario2 = false;
      this.form.voluntariado_id = "";
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
    NoexisteNombreV() {
      if (this.voluntarioNombre.length == 0) {
        this.showMensajesVoluntario = true;
        this.MensajeVoluntario = "El nombre de voluntario no esta registrado";
      }
      if (this.buscadorV.length == 0) {
        this.showMensajesVoluntario = true;
        this.MensajeVoluntario =
          "Campo vacio, por favor digite un nombre de voluntario";
      }
    },
    ComprobarCampos() {
   if(this.cedulas.length != 0){
     this.ComprobarCampos2();
   }
    },
    ComprobarCampos2(){
      if(this.voluntarioNombre.length != 0){
        this.bloquearCamposExtras = false;
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
    ConsultaNombreVoluntario() {
      this.form
        .get("/api/voluntarioEstudiante/NombreVoluntario/", {
          params: { buscadorV: this.buscadorV },
        })
        .then(({ data }) => (this.voluntarioNombre = data.data))
        .then((response) => {
          this.SiExisteNombre();
        });
    },
    cargarVoluntarioEst() {
      if (this.$gate.isAdmin()) {
        axios
          .get("/api/voluntarioEstudiante/")
          .then(({ data }) => (this.voluntarioEst = data.data));
      }
    },
    crearVoluntarioEst() {
      this.form
        .post("/api/voluntarioEstudiante/")
        .then((response) => {
          $("#addNew").modal("hide");

          Toast.fire({
            icon: "success",
            title: response.data.message,
          });

          this.$Progress.finish();
          this.cargarVoluntarioEst();
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
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    eliminarVoluntarioEst(id) {
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
            .delete("/api/voluntarioEstudiante/" + id)
            .then(() => {
              Swal.fire(
                "Eliminado!",
                "Se ha eliminado la información.",
                "success"
              );
              // Fire.$emit('AfterCreate');
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
    this.cargarVoluntarioEst();
    this.$Progress.finish();
  },
};
</script>