<template>
  <section class="content">
    <div class="container-fluid">
      <div class="block-header" v-if="$gate.isAdmin() || $gate.isUser()">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <ul class="breadcrumb breadcrumb-style">
              <li class="breadcrumb-item">
                <h4 class="page-title">Organizaciones</h4>
              </li>
              <li class="breadcrumb-item bcrumb-1">
                <a href="/dashboard">
                  <i class="fas fa-home"></i>
                  Inicio
                </a>
              </li>
              <li class="breadcrumb-item active">Organizaciones</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card" v-if="$gate.isAdmin() || $gate.isUser()">
            <div class="card-header">
              <h3 class="card-title">Listado de organizaciones</h3>

              <div class="card-tools">
                <button
                  type="button"
                  class="btn btn-sm btn-primary"
                  @click="newModal"
                >
                  <i class="fa fa-plus-square"></i>
                  Agregar Nuevo
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Cédula Jurídica</th>
                    <th>Nombre organización</th>
                    <th>Teléfono organización</th>
                    <th>Correo organización</th>
                    <th>Funciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="organizacion in organizaciones.data"
                    :key="organizacion.id"
                  >
                    <td>{{ organizacion.id }}</td>
                    <td class="text-capitalize">{{ organizacion.nombre }}</td>
                    <td>{{ organizacion.telefono }}</td>
                    <td>{{ organizacion.correo }}</td>
                    <td>
                      <a href="#" @click="editModal(organizacion)">
                        <i class="fa fa-edit blue"></i>
                      </a>
                      /
                      <a
                        href="#"
                        @click="eliminarOrganizacion(organizacion.id)"
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
                :data="organizaciones"
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
                Registrar nueva organización
              </h5>
              <h5 class="modal-title" v-show="editmode">
                Actualizar datos de la organización
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
                editmode ? actualizarOrganizacion() : crearOrganizacion()
              "
            >
              <div class="modal-body">
                <div class="form-group">
                  <label>Cedula Jurídica</label>
                  <input
                    v-model="form.id"
                    type="number"
                    name="id"
                    class="form-control"
                    :disabled="CedulaBloqueo"
                    :class="{ 'is-invalid': form.errors.has('id') }"
                    placeholder="Cedula Jurídica"
                    required
                    minlength="8"
                    maxlength="20"
                  />
                  <has-error :form="form" field="id"></has-error>
                </div>

                <div class="form-group">
                  <label>Nombre organización</label>
                  <input
                    style="text-transform: capitalize"
                    v-model="form.nombre"
                    type="text"
                    name="nombre"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('nombre') }"
                    placeholder="Nombre de organización"
                    required
                    minlength="3"
                    maxlength="30"
                    pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ'-'\s]*"
                  />
                  <has-error :form="form" field="nombre"></has-error>
                </div>

                <div class="form-group">
                  <label>Teléfono organización</label>
                  <input
                    v-model="form.telefono"
                    type="number"
                    name="telefono"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('telefono') }"
                    min="10000000"
                    placeholder="12345678"
                    pattern="[0-9]{8,}"
                    required
                  />
                  <has-error :form="form" field="telefono"></has-error>
                </div>
                <div class="form-group">
                  <label>Correo organización</label>
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
      CedulaBloqueo: false,
      editmode: false,
      errores: {},
      organizaciones: {},
      form: new Form({
        id: "",
        nombre: "",
        telefono: "",
        correo: "",
      }),
    };
  },
  methods: {
    getResults(page = 1) {
      this.$Progress.start();

      axios
        .get("/api/organizacion?page=" + page)
        .then(({ data }) => (this.organizaciones = data.data));

      this.$Progress.finish();
    },
    actualizarOrganizacion() {
      this.$Progress.start();
      this.form
        .put("/api/organizacion/" + this.form.id)
        .then((response) => {
          // success
          $("#addNew").modal("hide");
          Toast.fire({
            icon: "success",
            title: response.data.message,
          });
          this.$Progress.finish();
          //  Fire.$emit('AfterCreate');

          this.cargarOrganizacion();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    editModal(organizacion) {
      this.editmode = true;
      this.form.reset();
      this.CedulaBloqueo = true;
      $("#addNew").modal("show");
      this.form.fill(organizacion);
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

    cargarOrganizacion() {
      if (this.$gate.isAdmin() || this.$gate.isUser()) {
        axios
          .get("/api/organizacion")
          .then(({ data }) => (this.organizaciones = data.data));
      }
    },

    crearOrganizacion() {
      this.form
        .post("/api/organizacion", {
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
            this.cargarOrganizacion();
          }
        })
        .catch((error) => {
          Toast.fire({
            icon: "error",
            title: "Complete los campos!",
          });
          console.log(error.message);
        });
    },

    eliminarOrganizacion(id) {
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
            .delete("/api/organizacion/" + id)
            .then(() => {
              Swal.fire(
                "Eliminado!",
                "Se ha eliminado la información.",
                "success"
              );
              // Fire.$emit('AfterCreate');
              this.cargarOrganizacion();
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
  eliminarOrganizacion(id) {},

  created() {
    this.$Progress.start();
    this.cargarOrganizacion();
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
