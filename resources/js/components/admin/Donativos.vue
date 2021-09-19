<template>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card" v-if="$gate.isAdmin()">
            <div class="card-header">
              <h3 class="card-title">Lista de donativos</h3>
              <div class="card-tools">
                <button
                  type="button"
                  class="btn btn-sm btn-primary"
                  @click="abrirModal()"
                >
                  <i class="fa fa-plus-square"></i>
                  Registro Donante
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
                  agregar nuevo
                </button>
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
                    <td>{{ donativo.idPersona }}</td>
                    <td>{{ donativo.idOrganizacion }}</td>
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
                        <i class="fa fa-edit blue"></i>
                      </a>
                      /
                      <a href="#" @click="eliminarDonativo(donativo.id)">
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
                :data="donativos"
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
                <div v-show="show" class="form-group">
                  <label>Cedula a registrar:</label>
                  <input
                    v-model="buscador"
                    type="text"
                    name="buscador"
                    class="form-control"
                    :disabled="CedulaBloqueo"
                  />
                </div>
                <div>
                  <label v-show="showExistenciaCedula" v-text="MensajeCedula" style="color: red"></label>
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
                  <label>Tipo de donativo</label>
                  <select
                    class="form-control"
                    v-model="form.tipo"
                    :disabled="isDisabled"
                    :class="{ 'is-invalid': form.errors.has('tipo') }"
                  >
                    <option disabled value="">Seleccione un elemento</option>
                    <option>Material</option>
                    <option>Monetario</option>
                  </select>

                  <has-error :form="form" field="estado"></has-error>
                </div>

                <div class="form-group">
                  <label>Detalles de Donación</label>
                  <input
                    v-model="form.detalle"
                    type="text"
                    name="detalle"
                    class="form-control"
                    :disabled="isDisabled"
                    :class="{ 'is-invalid': form.errors.has('detalle') }"
                  />
                  <has-error :form="form" field="detalle"></has-error>
                </div>
                <div class="form-group">
                  <label for="photo" class="col-sm-2 control-label">Foto</label>
                  <div class="custom-file">
                    <input
                      type="file"
                      @change="updatePhoto"
                      name="photo"
                      class="custom-file-input"
                      :disabled="isDisabled"
                      id="inputGroupFile01"
                      :class="{ 'is-invalid': form.errors.has('photo') }"
                    />
                    <label class="custom-file-label" for="inputGroupFile01"
                      >Seleccione un imagen</label
                    >
                  </div>
                </div>
                <div class="form-group">
                  <label>Fecha de Donación</label>
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
                  <label>Estado del donativo</label>
                  <select
                    class="form-control"
                    v-model="form.estado"
                    :disabled="isDisabled"
                    :class="{ 'is-invalid': form.errors.has('estado') }"
                  >
                    <div class="form-group"></div>
                    <option disabled value="">Seleccione un elemento</option>
                    <option>Recibido</option>
                    <option>Pendiente</option>
                    <option>Rechazado</option>
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
      MensajeCedula: "Digite un numero de cedula",
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
      donativos: {},
      form: new Form({
        id: "",
        persona: "",
        idPersona: "",
        idOrganizacion: "",
        tipo: "",
        detalle: "",
        photo: "",
        fecha: "",
        estado: "",
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
      (this.id = 0), (this.tituloModal = "Registro Organizacion");
      this.showPersona = false;
      this.showOrganizacion = true;
    },
    cerrarModal() {
      this.modal = 0;
    },
    updatePhoto(e) {
      let file = e.target.files[0];
      let reader = new FileReader();

      if (file["size"] < 2111775) {
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

    getResults(page = 1) {
      this.$Progress.start();

      axios
        .get("/api/donativo?page=" + page)
        .then(({ data }) => (this.donativos = data.data));

      this.$Progress.finish();
    },
    habilitarCampos() {
      for (let i = 0; i < this.cedulas.length; i++) {
        if (this.cedulas[i].id == this.buscador) {
          this.isDisabled = false;
          this.CedulaBloqueo = true;
          this.form.idPersona = this.buscador;
        }
      }
    },
    habilitarCamposOrg() {
      for (let i = 0; i < this.cedulasOrg.length; i++) {
        if (this.cedulasOrg[i].id == this.buscador) {
          this.isDisabled = false;
          this.CedulaBloqueo = true;
          this.form.idOrganizacion = this.buscador;
        
        }
      }
    },
    NoexisteCedula() {
      if (this.cedulas.length == 0 && this.cedulasOrg.length == 0) {
        this.showExistenciaCedula = true;
         this.MensajeCedula =
          "El numero de cedula no esta registrado";
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
    },
    ConsultaCedula() {
      this.form
        .get("/api/donativo/verificar", {
          params: { buscador: this.buscador },
        })
        .then(({ data }) => (this.cedulas = data.data))
        .then((response) => {
          this.habilitarCampos();
        });
      this.form
        .get("/api/donativo/verificarOrg", {
          params: { buscador: this.buscador },
        })
        .then(({ data }) => (this.cedulasOrg = data.data))
        .then((response) => {
          this.habilitarCamposOrg();
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
    editModal(donativo) {
      this.editmode = true;
      // this.form.reset();

      $("#addNew").modal("show");
      this.form.fill(donativo);
      this.isDisabled = false;
      this.CedulaBloqueo = true;
      this.show = false;
      this.showIdentificacion = true;
      this.showExistenciaCedula = false;
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
    },

    cargarDonativos() {
      if (this.$gate.isAdmin()) {
        axios
          .get("/api/donativo")
          .then(({ data }) => (this.donativos = data.data));
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
            title: "Ocurrio un problema",
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
            title: "Ocurrio un problema",
          });
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
    this.cargarDonativos();
    this.$Progress.finish();
  },
  filters: {
    truncate: function (text, length, suffix) {
      return text.substring(0, length) + suffix;
    },
  },
  computed: {
    filteredItems() {
      return this.autocompleteItems.filter((i) => {
        return i.text.toLowerCase().indexOf(this.tag.toLowerCase()) !== -1;
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
</style>