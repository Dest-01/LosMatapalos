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
          <div class="card" v-if="$gate.isAdmin()">
            <div class="card-header">
              <h3 class="card-title">Listado de los usuarios</h3>

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
                    Agregar Usuario
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
                    <th>Rol</th>
                    <th>Funciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="usuario in usuarios.data" :key="usuario.id">
                    <td>{{ usuario.id }}</td>
                    <td>{{ usuario.name }}</td>
                    <td>{{ usuario.email }}</td>
                    <td>{{ usuario.type }}</td>
                    <td>
                      <a href="#" @click="editModal(usuario)">
                        <i id="icono" class="fa fa-edit blue"></i>
                      </a>
                      /
                      <a href="#" @click="eliminarUsuario(usuario.id)">
                        <i id="icono" class="fa fa-trash red"></i>
                      </a>
                      /
                      <a href="#" @click="detailsModal(usuario)">
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
                :data="usuarios"
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
                Registro de usuario
              </h5>
              <h5 class="modal-title" v-show="editmode">
                Actualización de usuario
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
              @submit.prevent="editmode ? actualizarUsuario() : crearUsuario()"
            >
              <div class="modal-body">
                <div class="form-group">
                  <label>Nombre del usuario</label>
                  <input
                    v-model="form.name"
                    type="text"
                    name="name"
                    class="form-control"
                  />
                  <has-error :form="form" field="name"></has-error>
                </div>
                <div class="form-group">
                  <label>Correo del usuario</label>
                  <input
                    v-model="form.email"
                    type="text"
                    name="email"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('email') }"
                    placeholder="Escriba el correo"
                    required
                    minlength="3"
                    maxlength="30"
                  />
                  <has-error :form="form" field="email"></has-error>
                </div>
                <div class="form-group">
                  <label>Contraseña</label>
                  <input
                    v-model="form.password"
                    type="password"
                    name="password"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('password') }"
                    autocomplete="false"
                    required
                    placeholder="Escriba la contraseña"
                  />
                  <has-error :form="form" field="password"></has-error>
                </div>
                <div class="form-group">
                  <label>Rol de usuario</label>
                  <select
                    name="type"
                    v-model="form.type"
                    id="type"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('type') }"
                    required
                  >
                    <option value="">Seleccione el rol del usuario</option>
                    <option value="admin">Admin</option>
                    <option value="usuario">Usuario</option>
                  </select>
                  <has-error :form="form" field="type"></has-error>
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
              <h5 class="modal-title">Detalles del Usuario</h5>
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
                <label>Nombre del usuario</label>
                <input
                  v-model="form.name"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
              <div class="form-group">
                <label>Correo del usuario</label>
                <input
                  v-model="form.email"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
              <div class="form-group">
                <label>Rol del usuario</label>
                <input
                  v-model="form.type"
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
      editmode: false,
      usuarios: {},
      todoUsuarios: {},
      verDetalles: true,
      filtrarBusqueda: "",
      form: new Form({
        id: "",
        type: "",
        name: "",
        email: "",
        password: "",
        email_verified_at: "",
      }),
    };
  },
  methods: {
    filtrar() {
      if (this.filtrarBusqueda == "") {
        this.usuarios.data = this.todoUsuarios;
      } else if (this.filtrarBusqueda != "") {
        this.usuarios.data = this.usuarioFiltradas;
      }
    },
    editModal(usuario) {
      this.editmode = true;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(usuario);
      this.form.errors.clear();
    },
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.errors.clear();
    },
    detailsModal(usuario) {
      $("#exampleModal").modal("show");
      this.form.fill(usuario);
    },

    getResults(page = 1) {
      this.$Progress.start();

      axios
        .get("/api/usuarios?page=" + page)
        .then(({ data }) => (this.usuarios = data.data));
      this.$Progress.finish();
    },

    cargarUsuarios() {
      if (this.$gate.isAdmin()) {
        axios
          .get("/api/usuarios")
          .then(({ data }) => (this.usuarios = data.data));
        axios
          .get("/api/usuarios/listar")
          .then(({ data }) => (this.todoUsuarios = data.data));
      }
    },
    crearUsuario() {
      if (this.$gate.isAdmin()) {
        this.form
          .post("/api/usuarios")
          .then((response) => {
            $("#addNew").modal("hide");

            Toast.fire({
              icon: "success",
              title: response.data.message,
            });

            this.$Progress.finish();
            this.cargarUsuarios();
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
          title: "No eres admin!",
        });
      }
    },
    /*////////////////////////////////////////////////////////////*/

    actualizarUsuario() {
      this.$Progress.start();
      this.form
        .put("/api/usuarios/" + this.form.id)
        .then((response) => {
          // success
          $("#addNew").modal("hide");
          Toast.fire({
            icon: "success",
            title: response.data.message,
          });
          this.$Progress.finish();
          //  Fire.$emit('AfterCreate');

          this.cargarUsuarios();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },

    eliminarUsuario(id) {
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
            .delete("/api/usuarios/" + id)
            .then(() => {
              Swal.fire(
                "Eliminado!",
                "Se ha eliminado la información.",
                "success"
              );
              // Fire.$emit('AfterCreate');
              this.cargarUsuarios();
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
    this.cargarUsuarios();
    this.$Progress.finish();
  },
  filters: {
    truncate: function (text, length, suffix) {
      return text.substring(0, length) + suffix;
    },
  },
  computed: {
    usuarioFiltradas: function () {
      return this.todoUsuarios.filter((usuario) => {
        return (
          usuario.nombre
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) ||
          usuario.correo
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) 
        );
      });
    },
  },
};
</script>


<style scoped>
#inputOtros {
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
</style>
