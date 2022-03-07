<template>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card" v-if="$gate.isAdmin()">
            <div class="card-header">
              <h3 class="card-title">Listado de Voluntarios</h3>
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
                    
                    <th>idVoluntario</th>
                    <th>idActividad</th>
                    <th>Funciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="voluntario in voluntarios.data"
                    :key="voluntario.id"
                  >
                    
                    <td>{{ voluntario.idVoluntario }}</td>
                    <td>{{ voluntario.idActividad }}</td>
                    <td>
                      <a href="#" @click="editModal(voluntario)">
                        <i class="fa fa-edit blue"></i>
                      </a>
                      /
                      <a href="#" @click="eliminarVoluntario(voluntario.id)">
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
                :data="voluntarios"
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
              @submit.prevent="
                editmode ? actualizarVoluntario() : crearVoluntario()
              "
              >
              <div class="modal-body">
                <div class="form-group">
                    <label>Select:</label>
                    <select class='form-control' v-model='form.idVoluntario' @change='getVoluntarios()'>
                        <option value='0' >Selecc Voluntario</option>
                        <option v-for='voluuntario in voluuntarios' :key="voluuntario.id" :value='voluuntario.id'>{{ voluuntario.nombre }}</option>
                    </select>
                </div>

                <div class="form-group">
                  <label>idActividad</label>
                  <input
                    v-model="form.idActividad"
                    type="text"
                    name="cantidad"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('idActividad') }"
                  />
                  <has-error :form="form" field="idActividad"></has-error>
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
      voluuntarios:{},
      voluuntario:'',
      editmode: false,
      errors: {},
      voluntarios: {},
      form: new Form({
        id: "",
        idVoluntario:"",
        idActividad: "",
      }),
    };
  },
  methods: {


    getVoluntarios(){
      axios.get('/api/GetVoluntarios')
          .then(function (response) {
              this.voluuntarios = response.data;
          }.bind(this));
    },

    getResults(page = 1) {
      this.$Progress.start();
      axios
        .get("/api/actividadesparticipantes?page=" + page)
        .then(({ data }) => (this.voluntarios = data.data));
 
      this.$Progress.finish();
    },
    editModal(voluntario) {
      this.editmode = true;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(voluntario);
    },
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#addNew").modal("show");
    },
    limpiar() {
      this.form.idVoluntario = "";
      this.form.idActividad = "";
      this.form.errors.clear();
    },
    cargarVoluntario() {
      if (this.$gate.isAdmin()) {
        axios
          .get("/api/actividadesparticipantes")
          .then(({ data }) => (this.voluntarios = data.data));
          console.log("hola", this.voluntarios);
      }
    },
    crearVoluntario() {
      this.form
        .post("/api/actividadesparticipantes")
        .then((response) => {
          $("#addNew").modal("hide");
          Toast.fire({
            icon: "success",
            title: response.data.message,
          });

          this.$Progress.finish();
          this.cargarVoluntario();
        })
        .catch(() => {
          Toast.fire({
            icon: "error",
            title: "Ocurrio un problema!",
          });
        });
    },
    actualizarVoluntario() {
      this.$Progress.start();
      this.form
        .put("/api/actividadesparticipantes/" + this.form.id)
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
    eliminarVoluntario(id) {
      Swal.fire({
        title: "Seguro que lo desea eliminar?",
        text: "Esta acción no puede revertirse!",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Si, Eliminar!",
      }).then((result) => {
        // Send request to the server
        if (result.value){
          this.form
            .delete("/api/actividadesparticipantes/"+id)
            .then(() => {
              Swal.fire(
                "Eliminado!",
                "Se ha eliminado la información.",
                "success"
              );
              // Fire.$emit('AfterCreate');
              this.cargarVoluntario();
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
  created(){
    this.$Progress.start();
    this.cargarVoluntario();
    this.$Progress.finish();
  },
};
</script>

<style scoped>


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