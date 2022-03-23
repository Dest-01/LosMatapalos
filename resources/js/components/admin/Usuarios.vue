<template>
  <section class="content">
    <div class="container-fluid">
      <div class="block-header" v-if="$gate.isAdmin() || $gate.isUser()">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <ul class="breadcrumb breadcrumb-style">
              <li class="breadcrumb-item">
                <h4 class="page-title">Usuarios</h4>
              </li>
              <li class="breadcrumb-item bcrumb-1">
                <a href="/dashboard">
                  <i class="fas fa-home"></i>
                  Inicio
                </a>
              </li>
              <li class="breadcrumb-item active">Usuarios</li>
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
                    <th>Imagen</th>
                    <th>Rol</th>
                    <th>Funciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="usuario in usuarios.data" :key="usuario.id">
                    <td>{{ usuario.id }}</td>
                    <td>{{ usuario.name }}</td>
                    <td>{{ usuario.email }}</td>
                    <td>
                      <img
                        v-bind:src="'/images/usuarios/' + usuario.image"
                        width="50px"
                        height="50px"
                      />
                    </td>
                    <td v-if="usuario.type == 'user'">usuario</td>
                    <td v-else>{{ usuario.type }}</td>
                    <td>
                      <a href="#" @click="editModal(usuario), usuarioAnterior(usuario.name)">
                        <i id="icono" class="fa fa-edit blue"></i>
                      </a>
                      /
                      <a
                        href="#"
                        @click="eliminarUsuario(usuario.id, usuario.name)"
                      >
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
                :limit="5"
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
                  <label>Contraseña</label>
                  <input
                    v-model="form.password"
                    type="password"
                    name="password"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('password') }"
                    autocomplete="false"
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
                    <option value="user">Usuario</option>
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
                v-if="form.type == 'user'"
                  v-model="usuarioNormal"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
                <input
                v-else
                  v-model="form.type"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
              <div class="form-group">
                <label>Imagen Perfil</label>
                <img
                  v-bind:src="'/images/usuarios/' + form.image"
                  width="100%"
                  height="100%"
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
      currentImage: undefined,
      previewImage: undefined,
      progress: 0,
      message: "",
      imageInfos: [],
      /*Funcionan con el selec para ocultar y mostrar los campos*/
      editmode: false,
      usuarios: {},
      todoUsuarios: {},
      verDetalles: true,
      usuarioNormal: "usuario",
      filtrarBusqueda: "",
      form: new Form({
        id: "",
        type: "",
        image: "",
        name: "",
        email: "",
        password: "",
        email_verified_at: "",
      }),
      formTrigger: new Form({
        usuarioActivo: this.$gate.nameUser(),
        usuarioAgregado: "",
        usuarioModificadoAntes: "",
        usuarioModificadoNuevo: "",
        usuarioEliminado: "",
        accion: "",
        fecha: "",
        hora: "",
      }),
    };
  },
  methods: {
    updatePhoto(e) {
      let file = e.target.files[0];
      this.previewImage = URL.createObjectURL(file);
      this.currentImage = file;
      let reader = new FileReader();

      if (file["size"] < 9111775) {
        reader.onloadend = (file) => {
          //console.log('RESULT', reader.result)
          this.form.image = reader.result;
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
        this.usuarios.data = this.todoUsuarios;
      } else if (this.filtrarBusqueda != "") {
        this.usuarios.data = this.usuarioFiltradas;
      }
    },
    editModal(usuario) {
      this.editmode = true;
      this.form.reset();
      $("#addNew").modal("show");
      $("#SubirImagen").val("");
      this.previewImage = "";
      this.form.fill(usuario);
      this.form.errors.clear();
    },
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#SubirImagen").val("");
      this.previewImage = "";
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
      this.formTrigger.usuarioAgregado = this.form.name;
      this.formTrigger.accion = "Agregar";
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
            this.triggerHistorial();
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
      this.formTrigger.accion = "Modificar";
      this.formTrigger.usuarioModificadoNuevo = this.form.name;
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
          this.triggerHistorial();
          this.cargarUsuarios();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },

    triggerHistorial() {
      this.formTrigger
        .post("/api/historial")
        .then(() => {
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.finish();
        });
    },
    usuarioAnterior(usuarioAnterior){
      this.formTrigger.usuarioModificadoAntes = usuarioAnterior;
    },

    eliminarUsuario(id, usuario) {
      this.formTrigger.accion = "Eliminar";
      this.formTrigger.usuarioEliminado = usuario;

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
              this.triggerHistorial();
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
    window.onload = this.getNow;
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
    getNow: function () {
      const today = new Date();
      const date =
        today.getFullYear() +
        "-" +
        (today.getMonth() + 1) +
        "-" +
        today.getDate();
      const time =
        today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
      const dateTime = date + " " + time;
      this.formTrigger.hora = time;
      this.formTrigger.fecha = date;
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
