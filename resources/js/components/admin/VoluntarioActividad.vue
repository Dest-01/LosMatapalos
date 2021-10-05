 <template>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card" v-if="$gate.isAdmin()">
            <div class="card-header">
              <h3 class="card-title">Lista de Voluntario Actividades</h3>

              <div class="card-tools">
                <button
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
                    <th>ID Voluntariado Actividad</th>
                    <th>Nombre de Actividad</th>
                    <th>Nombre de Persona Voluntaria</th>
                    <th>Nombre de Estudainte Voluntario</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="actividadVoluntario in actividadVoluntarios.data"
                    :key="actividadVoluntario.id"
                  >
                    <td>{{ actividadVoluntario.id }}</td>
                    <td class="text-capitalize">{{ actividadVoluntario.idActividad }}</td>
                    <td class="text-capitalize">{{ actividadVoluntario.idVoluntario_Persona }}</td>
                    <td class="text-capitalize">{{ actividadVoluntario.idVoluntario_Estudiante }}</td>
                    <td>
                      <a href="#" @click="editModal(actividadVoluntario)">
                        <i class="fa fa-edit blue"></i>
                      </a>
                      /
                      <a href="#" @click="eliminarActividadVoluntario(actividadVoluntario.id)">
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
                :data="actividadVoluntarios"
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
                Crear nueva Actividad de Voluntario
              </h5>
              <h5 class="modal-title" v-show="editmode">
                Actualizar la  Actividad del  Voluntario
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
              @submit.prevent="
                editmode ? actualizarActividadVoluntario() : crearActividadVoluntariado()
              "
            >
              <div class="modal-body">
                <div class="form-group">
                 <label>Seleccione el Nombre de la actividad</label> 
                 <select  class="form-control" v-model="form.idActividad" data-live-search="true">
                    <option  v-for="actividad in actividades" :key="actividad.id" :value='actividad.id'>{{actividad.nombre}}</option>
                 </select>
                </div>

                <div class="form-group">
                  <label>Seleccione el Nombre del Voluntario Persona</label>
                  <div class="search_select_box">
                      <select data-live-search="true" class="form-control" v-model="form.idVoluntario_Persona">
                          <option v-for="voluntarioPersona in voluntarioPersonas" :key="voluntarioPersona.id" :value='voluntarioPersona.id'>{{voluntarioPersona.identificacion}}</option>
                      </select>
                  </div>  
                
                </div>
                <div class="form-group">
                  <label>Seleccione el Nombre del Voluntario Estudiante</label>  
                  <select class="form-control" v-model="form.idVoluntario_Estudiante">
                      <option v-for="voluntarioEstudiante in voluntarioEstudiantes" :key="voluntarioEstudiante.id" :value='voluntarioEstudiante.id'>{{voluntarioEstudiante.identificacion}}</option>
                  </select>
                </div>
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-dismiss="modal"
                >
                  Cerrar
                </button>
                <button v-show="editmode" type="submit" class="btn btn-success">
                  Actualizar
                </button>
                <button
                  v-show="!editmode"
                  type="submit"
                  class="btn btn-primary"
                >
                  Crear
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
//Vue.component('v-select', VueSelect.VueSelect)
export default {
  data() {
    return {
      editmode: false,
      actividadVoluntarios: {},
      actividad : '',
      actividades : {},
      voluntarioPersona: '',
      voluntarioPersonas: {},
      voluntarioEstudiante: '',
      voluntarioEstudiantes: {},
      setTimeoutBuscador: '',
      form: new Form({
        id: "",
        idActividad: "",
        idVoluntario_Persona: "",
        idVoluntario_Estudiante: "",
      }),
    };
  },

  methods: {
    cargarActividades(){
           axios.get('/api/voluntarioActividad/GetActividades').then(response=>{
             this.actividades = response.data;
           });
    },
    
    cargarVoluntarioPersona(){
       axios.get('/api/voluntarioActividad/GetVoluntarioPersona').then(response=>{
             this.voluntarioPersonas = response.data;
       });
    },
    cargarVoluntarioEstudiante(){
       axios.get('/api/voluntarioActividad/GetVoluntarioEstudiantes').then(response=>{
          this.voluntarioEstudiantes = response.data;
       });
    },
    getResults(page = 1) {
      this.$Progress.start();
      axios
        .get("/api/voluntarioActividad?page=" + page)
        .then(({ data }) => (this.actividadVoluntarios = data.data));
      this.$Progress.finish();
    },
    editModal(actividadVoluntario) {
      this.editmode = true;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(actividadVoluntario);
    },
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#addNew").modal("show");
    },

    cargarActividadVoluntariado() {
      if (this.$gate.isAdmin()) {
        axios
          .get("/api/voluntarioActividad")
          .then(({ data }) => (this.actividadVoluntarios = data.data));
      }
    },
    crearActividadVoluntariado() {
      this.$Progress.start();
      this.form
        .post("/api/voluntarioActividad")
        .then((response) => {
          $("#addNew").modal("hide");

          Toast.fire({
            icon: "success",
            title: response.data.message,
          });
          this.$Progress.finish();
          this.cargarActividadVoluntariado();
        })
        .catch(() => {
          Toast.fire({
            icon: "error",
            title: "Ocurrio un error!",
          });
        });
    },
    actualizarActividadVoluntario() {
      this.$Progress.start();
      this.form
        .put("/api/voluntarioActividad/" + this.form.id)
        .then((response) => {
          // success
          $("#addNew").modal("hide");
          Toast.fire({
            icon: "success",
            title: response.data.message,
          });
          this.$Progress.finish();
          //  Fire.$emit('AfterCreate');

          this.cargarActividadVoluntariado();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    eliminarActividadVoluntario(id) {
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
            .delete("/api/voluntarioActividad/" + id)
            .then(() => {
              Swal.fire(
                "Eliminado!",
                "Se ha eliminado la información.",
                "success"
              );
              // Fire.$emit('AfterCreate');
              this.cargarActividadVoluntariado();
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
    this.cargarActividades();
    this.cargarVoluntarioPersona();
    this.cargarVoluntarioEstudiante();
  },
  eliminarVoluntarioActividad(id) {},

  created() {
    this.$Progress.start();
    this.cargarActividadVoluntariado();
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

            <style>
</style>