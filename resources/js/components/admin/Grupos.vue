<template>
  <section class="content">
    <div class="container-fluid">
      <div class="block-header" v-if="$gate.isAdmin() || $gate.isUser()">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <ul class="breadcrumb breadcrumb-style">
              <li class="breadcrumb-item">
                <h4 class="page-title">Grupos</h4>
              </li>
              <li class="breadcrumb-item bcrumb-1">
                <a href="/dashboard">
                  <i class="fas fa-home"></i>
                  Inicio
                </a>
              </li>
              <li class="breadcrumb-item active">Grupos</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card" v-if="$gate.isAdmin() || $gate.isUser()">
            <div class="card-header">
              <h3 class="card-title">Listado de los grupos</h3>

              <div class="card-tools">
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
                    Agregar Grupo
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
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Cantidad</th>
                    <th>Rango Edades</th>
                    <th>Lugar</th>
                    <th>Tematica</th>
                    <th>Detalles</th>
                    <th>Funciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="grupo in grupos.data" :key="grupo.id">
                    <td>{{ grupo.id }}</td>
                    <td>{{ grupo.nombre }}</td>
                    <td>{{ grupo.correo }}</td>
                    <td>{{ grupo.cantidad }}</td>
                    <td>{{ grupo.edades }}</td>
                    <td>{{ grupo.lugar }}</td>
                    <td>{{ grupo.tematica }}</td>
                    <td>{{ grupo.detalles | truncate(10, "...") }}</td>
                    <td>
                      <a href="#" @click="editModal(grupo)">
                        <i id="icono" class="fa fa-edit blue"></i>
                      </a>
                      /
                      <a href="#" @click="eliminarGrupo(grupo.id)">
                        <i id="icono" class="fa fa-trash red"></i>
                      </a>
                      /
                      <a href="#" @click="detailsModal(grupo)">
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
                :data="grupos"
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
              <h5 class="modal-title" v-show="!editmode">Registro de grupo</h5>
              <h5 class="modal-title" v-show="editmode">
                Actualización de grupo
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

            <form @submit.prevent="editmode ? actualizarGrupo() : crearGrupo()">
              <div class="modal-body">
                <div class="form-group">
                  <label>Nombre del grupo</label>
                  <input
                    v-model="form.nombre"
                    type="text"
                    name="nombre"
                    class="form-control"
                    :disabled="bloquearNombre"
                    placeholder="Escriba el nombre del grupo G-####"
                  />
                  <has-error :form="form" field="nombre"></has-error>
                </div>
                <div class="form-group">
                  <label>Correo</label>
                  <input
                    v-model="form.correo"
                    type="text"
                    name="correo"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('correo') }"
                    placeholder="Escriba el correo"
                    required
                    minlength="3"
                    maxlength="30"
                  />
                  <has-error :form="form" field="correo"></has-error>
                </div>

                <div class="form-group">
                  <label>Cantidad del grupo</label>
                  <input
                    v-model="form.cantidad"
                    type="number"
                    name="cantidad"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('cantidad') }"
                    placeholder="Escriba la cantidad del grupo"
                    minlength="3"
                    maxlength="20"
                    required
                  />
                  <has-error :form="form" field="cantidad"></has-error>
                </div>

                <div class="form-group">
                  <label>Promedio de edades</label>
                  <input
                    v-model="form.edades"
                    type="range"
                    name="edades"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('edades') }"
                    required
                    min="5"
                    max="150"
                    step="1"
                  />
                  <has-error :form="form" field="edades"></has-error>
                  <label for="">Promedio: {{ form.edades }}</label>
                </div>

                <div class="form-group">
                  <label>Lugar de procedencia</label>
                  <input
                    v-model="form.lugar"
                    type="text"
                    name="lugar"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('lugar') }"
                    placeholder="Escriba el lugar de procedencia"
                    required
                  />
                  <has-error :form="form" field="lugar"></has-error>
                </div>
                <div class="form-group">
                  <label>Tematica</label>
                  <select
                    class="form-control"
                    v-model="form.tematica"
                    :class="{ 'is-invalid': form.errors.has('tematica') }"
                    required
                    @change="verInputOtraTematica()"
                  >
                    <option disabled value="">Seleccione una tematica</option>
                    <option value="Todas las tematicas">
                      Todas las tematicas
                    </option>
                    <option value="Biodiversidad">Biodiversidad</option>
                    <option value="Cultura">Cultura</option>
                    <option value="Otros">Otros</option>
                  </select>
                  <div id="inputOtros" v-show="VerOtraTematica">
                    <input
                      type="text"
                      v-model="form.tematica"
                      name="lugar"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('tematica') }"
                      placeholder="Escriba la otra tematica de interes..."
                      required
                    />
                  </div>
                  <has-error :form="form" field="tematica"></has-error>
                </div>
                <div class="form-group">
                  <label>Detalles a considerar</label>
                  <textarea
                    name="detalles"
                    v-model="form.detalles"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('detalles') }"
                    cols="5"
                    rows="5"
                  ></textarea>
                  <has-error :form="form" field="detalles"></has-error>
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
              <h5 class="modal-title">Detalles del grupo</h5>
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
                <label>Nombre del grupo</label>
                <input
                  v-model="form.nombre"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
              <div class="form-group">
                <label>Correo del grupo</label>
                <input
                  v-model="form.correo"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
              <div class="form-group">
                <label>Cantidad en el grupo</label>
                <input
                  v-model="form.cantidad"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
              <div class="form-group">
                <label>Rango de edades</label>
                <input
                  v-model="form.edades"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
              <div class="form-group">
                <label>Lugar de procedencia</label>
                <input
                  v-model="form.lugar"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
              <div class="form-group">
                <label>Temática</label>
                <input
                  v-model="form.tematica"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
              <div class="form-group">
                <label>Detalles</label>
                <textarea
                  v-model="form.detalles"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                  name="detalles"
                  id=""
                  cols="5"
                  rows="5"
                >
                </textarea>
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
      editmode: false,
      bloquearNombre: false,
      errors: {},
      grupos: {},
      nuevoGrupos: {},
      verDetalles: true,
      filtrarBusqueda: "",
      VerOtraTematica: false,
      form: new Form({
        id: "",
        nombre: "",
        cantidad: "",
        correo: "",
        edades: "",
        lugar: "",
        tematica: "",
        detalles: "",
      }),
    };
  },
  methods: {
    filtrar() {
      if (this.filtrarBusqueda == "") {
        this.grupos.data = this.nuevoGrupos;
      } else if (this.filtrarBusqueda != "") {
        this.grupos.data = this.gruposFiltradas;
      }
    },
    verInputOtraTematica() {
      if (this.form.tematica == "Otros") {
        this.VerOtraTematica = true;
        this.form.tematica = "Escriba la tematica..."
      } else {
        this.VerOtraTematica = false;
      }
    },
    editModal(grupo) {
      this.editmode = true;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(grupo);
      this.form.errors.clear();
      this.bloquearNombre = true;
    },
    newModal() {
      this.editmode = false;
      this.bloquearNombre = false;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.errors.clear();
    },
    detailsModal(grupo) {
      $("#exampleModal").modal("show");
      this.form.fill(grupo);
    },

    getResults(page = 1) {
      this.$Progress.start();

      axios
        .get("/api/grupo?page=" + page)
        .then(({ data }) => (this.grupos = data.data));
      this.$Progress.finish();
    },

    cargarGrupos() {
      if (this.$gate.isAdmin() || this.$gate.isUser()) {
        axios.get("/api/grupo").then(({ data }) => (this.grupos = data.data));
        axios
          .get("/api/grupo/listar")
          .then(({ data }) => (this.nuevoGrupos = data.data));
      }
    },
    crearGrupo() {
      if (/^[G]{1}-\d{1,4}$/.test(this.form.nombre)) {
        this.form
          .post("/api/grupo", {
            params: { nombre: this.form.nombre },
          })
          .then((response) => {
            if (response.data.success == false) {
              Toast.fire({
                icon: "error",
                title: "Nombre ya existe!",
              });
            } else {
              $("#addNew").modal("hide");

              Toast.fire({
                icon: "success",
                title: response.data.message,
              });

              this.$Progress.finish();
              this.cargarGrupos();
            }
          })
          .catch(() => {
            Toast.fire({
              icon: "error",
              title: "Complete los campos!",
            });
          });
      } else {
        Toast.fire({
          icon: "error",
          title: "Formato de nombre incorrecto!",
        });
      }
    },
    /*////////////////////////////////////////////////////////////*/

    actualizarGrupo() {
      if (/^[G]{1}-\d{1,4}$/.test(this.form.nombre)) {
        this.$Progress.start();
        this.form
          .put("/api/grupo/" + this.form.id)
          .then((response) => {
            // success
            $("#addNew").modal("hide");
            Toast.fire({
              icon: "success",
              title: response.data.message,
            });
            this.$Progress.finish();
            //  Fire.$emit('AfterCreate');

            this.cargarGrupos();
          })
          .catch(() => {
            this.$Progress.fail();
          });
      } else {
        Toast.fire({
          icon: "error",
          title: "Formato de nombre incorrecto!",
        });
      }
    },

    eliminarGrupo(id) {
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
            .delete("/api/grupo/" + id)
            .then(() => {
              Swal.fire(
                "Eliminado!",
                "Se ha eliminado la información.",
                "success"
              );
              // Fire.$emit('AfterCreate');
              this.cargarGrupos();
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
    this.cargarGrupos();
    this.$Progress.finish();
  },
  filters: {
    truncate: function (text, length, suffix) {
      return text.substring(0, length) + suffix;
    },
  },
  computed: {
    grupoFiltradas: function () {
      return this.nuevoGrupos.filter((grupo) => {
        return (
          grupo.nombre
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) ||
          grupo.correo
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) ||
          grupo.edades
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) ||
          grupo.lugar
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) ||
          grupo.tematica
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) ||
          grupo.cantidad
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) ||
          grupo.detalles
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase())
        );
      });
    },
  },
};
</script>


<style scoped>
#inputOtros{
  margin-top: 10px;
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
