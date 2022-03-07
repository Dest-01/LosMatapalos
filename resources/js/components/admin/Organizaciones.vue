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
                    class="btn btn-sm btn-primary addBtn"
                    @click="newModal"
                  >
                    <i class="fa fa-plus-square"></i>
                    Agregar Organización
                  </button>
                </div>
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
                    <td>{{ organizacion.identificacion }}</td>
                    <td class="text-capitalize">{{ organizacion.nombre }}</td>
                    <td>{{ organizacion.telefono }}</td>
                    <td>{{ organizacion.correo }}</td>
                    <td>
                      <a href="#" @click="editModal(organizacion)">
                        <i id="icono" class="fa fa-edit blue"></i>
                      </a>
                      /
                      <a
                        href="#"
                        @click="eliminarOrganizacion(organizacion.id)"
                      >
                        <i id="icono" class="fa fa-trash red"></i>
                      </a>
                      /
                      <a
                        data-mdb-toggle="modal"
                        data-mdb-target="#exampleModal"
                        href="#"
                        @click="detailsModal(organizacion)"
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
                :data="organizaciones"
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

      <!-- Modal de registrar y actualizar-->
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
                Actualización de la organización
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
                    v-model="form.identificacion"
                    type="text"
                    name="identificacion"
                    class="form-control"
                    :disabled="CedulaBloqueo"
                    :class="{ 'is-invalid': form.errors.has('identificacion') }"
                    placeholder="Formato: #-###-######"
                    required
                    pattern="[1-9]{1}-[0-9]{3}-[0-9]{6}"
                  />
                  <has-error :form="form" field="identificacion"></has-error>
                </div>

                <div class="form-group">
                  <label>Nombre organización</label>
                  <input
                    v-model="form.nombre"
                    type="text"
                    name="nombre"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('nombre') }"
                    placeholder="Nombre de organización"
                    required
                    minlength="3"
                    maxlength="60"

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
                    placeholder="#### ####"
                    required
                    pattern="[2-9]\d{3}\d{4}"
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
                    placeholder="ejemplo@gmail.com"
                    minlength="3"
                    maxlength="64"
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
              <h5 class="modal-title">Detalles de la Organización</h5>
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
                <label>Cedula Jurídica</label>
                <input
                  v-model="form.identificacion"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
              <div class="form-group">
                <label>Nombre organización</label>
                <input
                  v-model="form.nombre"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
              <div class="form-group">
                <label>Teléfono organización</label>
                <input
                  v-model="form.telefono"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
              <div class="form-group">
                <label>Correo organización</label>
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
      <!--FIN DEL MODAL DE INFORMACION-->
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      CedulaBloqueo: false,
      editmode: false,
      verDetalles: true,
      filtrarBusqueda: "",
      errores: {},
      organizaciones: {},
      nuevoOrganaciones: {},
      form: new Form({
        id: "",
        identificacion: "",
        nombre: "",
        telefono: "",
        correo: "",
      }),
    };
  },
  methods: {
    filtrar() {
      if (this.filtrarBusqueda == "") {
        this.organizaciones.data = this.nuevoOrganaciones;
      } else if (this.filtrarBusqueda != "") {
        this.organizaciones.data = this.organizacionesFiltradas;
      }
    },
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
    detailsModal(organizacion) {
      $("#exampleModal").modal("show");
      this.form.fill(organizacion);
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
        axios
          .get("/api/organizacion/listar")
          .then(({ data }) => (this.nuevoOrganaciones = data.data));
      }
    },

    crearOrganizacion() {
      if(this.form.identificacion !=""){
        if(/^[1-9]-\d{3}-\d{6}$/.test(this.form.identificacion)){
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
        }else{
           Swal.fire(
            "Error!",
            "Formato de cédula juridica incorrecto!",
            "error"
          );
        }
      }else{
         Swal.fire("Error!", "Campo de cédula juridica esta vacio!", "error");
      }
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

  created() {
    this.$Progress.start();
    this.cargarOrganizacion();
    this.$Progress.finish();
  },
  computed: {
    organizacionesFiltradas: function () {
      return this.nuevoOrganaciones.filter((organizacion) => {
        return (
          organizacion.identificacion
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) ||
          organizacion.nombre
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) ||
          organizacion.telefono
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) ||
          organizacion.correo
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase())
        );
      });
    },
  },
};
</script>


<style scoped>
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
