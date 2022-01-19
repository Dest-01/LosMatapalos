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
            <div class="card-body table-responsive p-0">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>ID Voluntariado Actividad</th>
                    <th>Nombre de Actividad</th>
                    <th>Nombre de Persona Voluntario</th>
                    <th>Nombre de Estudiante Voluntario</th>
                    <th>Funciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="actividadVoluntario in actividadVoluntarios.data"
                    :key="actividadVoluntario.id"
                  >
                    <td>{{ actividadVoluntario.id }}</td>
                    <td class="text-capitalize">{{  actividadVoluntario.ActNombre }}</td>
                    <td class="text-capitalize">{{  actividadVoluntario.VolPerCedula }} - {{  actividadVoluntario.NombrePersona }}</td>
                    <td class="text-capitalize">{{  actividadVoluntario.volEstCedula }} - {{actividadVoluntario.NombreEstudiante}}</td>
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
            <div class="card-footer">
              <pagination
                :data="actividadVoluntarios"
                @pagination-change-page="getResults"
              ></pagination>
            </div>
          </div>
        </div>
      </div>

      <div v-if="!$gate.isAdmin()">
        <not-found></not-found>
      </div>
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
            <form
              @submit.prevent="
                editmode ? actualizarActividadVoluntario() : crearActividadVoluntariado()
              "
            >
              <div class="modal-body">            
                        <div class="form-group">
                            <section class="dropdown-wrapper">
                              <div @click="esVisibleActividad = !esVisibleActividad" class="selected-item">
                                  <span v-if="seleccionarActividad" id="actividades">{{seleccionarActividad.nombre}}</span>
                                  <span id="seleccionarAc"  v-else>Seleccione una Actividad</span>
                                  <svg
                                      :class="esVisibleActividad ? 'dropdown':''" 
                                      class="drop-down-icon"
                                      xmlns="http://www.w3.org/2000/svg"
                                      viewBox="0 0 24 24"
                                      width="24"
                                      height="24">
                                  <path fill="none" d="M0 0h24v24H0z"/>
                                  <path d="M12 10.828l-4.95 4.95-1.414-1.414L12 8l6.364 6.364-1.414 1.414z"/>
                                  </svg>
                              </div>
                              <div v-if="esVisibleActividad" class="dropdown-powered">
                                <input  v-model="buscarActividad"   type="text" placeholder="Buscar">
                                <div class="options_uno">
                                    <ul>
                                      <li            
                                          @click="seleccionarAActividad(actividad)"
                                          v-for="(actividad) in filtrarActividades"
                                          name="idActividad" 
                                          :key="actividad.id"
                                          :value="actividad.id"
                                          :class="{ 'is-invalid': form.errors.has('idActividad') }"  
                                      >
                                          {{actividad.nombre}}
                                      </li>
                                      <has-error :form="form" field="idActividad"></has-error>
                                    </ul>
                                </div>
                              </div>
                            </section> 
                          </div>

                          <div  class="form-group">
                            <section class="dropdown-wrapper">
                              <div  @click="esVisiblePersona = !esVisiblePersona" class="selected-item">
                                  <span v-if="seleccionaVPersona" id="voluntariospersonas">{{seleccionaVPersona.identificacion}}</span>
                                  <span id="seleccionarVP" v-else>Seleccione una Persona</span>
                                  <span id="error"></span>  
                                  <svg 
                                      :class="esVisiblePersona ? 'dropdown':''" 
                                      class="drop-down-icon"
                                      xmlns="http://www.w3.org/2000/svg"
                                      viewBox="0 0 24 24" 
                                      width="24"
                                      height="24">
                                  <path fill="none" d="M0 0h24v24H0z"/>
                                  <path d="M12 10.828l-4.95 4.95-1.414-1.414L12 8l6.364 6.364-1.414 1.414z"/>
                                  </svg>
                              </div>
                              <div  v-if="esVisiblePersona" class="dropdown-powered">
                                <input v-model="buscarVoluntarioPersona"  type="text" placeholder="buscar">
                                <div class="options_dos">
                                    <ul>
                                      <li
                                          @click="seleccionarVPersona(voluntarioPersona)"
                                          v-for="(voluntarioPersona) in filtrarVoluntarioPersona" 
                                           name="idVoluntario_Persona" 
                                          :key="voluntarioPersona.id"
                                          :value="voluntarioPersona.id"
                                          :class="{ 'is-invalid': form.errors.has('idVoluntario_Persona') }"
                                      >
                                          {{voluntarioPersona.identificacionPersona}}
                                      </li>
                                      <has-error :form="form" field="idVoluntario_Persona"></has-error>
                                    </ul>
                                </div>
                              </div>
                            </section>
                          </div>     
                          <div class="form-group">
                            <section class="dropdown-wrapper">
                              <div @click="esVisibleEstudiante = !esVisibleEstudiante" class="selected-item">
                                  <span v-if="seleccionaVEstudiante" id="voluntariosestudiantes">{{seleccionaVEstudiante.identificacion}}</span>
                                  <span id="seleccionarVE" v-else>Seleccione un Estudiante</span>
                                  <svg 
                                      :class="esVisibleEstudiante ? 'dropdown':''" 
                                      class="drop-down-icon"
                                      xmlns="http://www.w3.org/2000/svg"
                                      viewBox="0 0 24 24"
                                      width="24"
                                      height="24">

                                  <path fill="none" d="M0 0h24v24H0z"/>
                                  <path d="M12 10.828l-4.95 4.95-1.414-1.414L12 8l6.364 6.364-1.414 1.414z"/>
                                  </svg>
                              </div>
                              <div v-if="esVisibleEstudiante" class="dropdown-powered">
                                <input v-model="buscarVoluntarioEstudiante"   type="text" placeholder="buscar">
                                <div class="options_tres">
                                    <ul>
                                      <li 
                                          @click="seleccionarVEstudiante(voluntarioEstudiante)"
                                          v-for="(voluntarioEstudiante) in filtrarVoluntarioEstudiante"
                                          name="idVoluntario_Estudiante" 
                                          :key="voluntarioEstudiante.id"
                                          :value="voluntarioEstudiante.id"
                                          :class="{ 'is-invalid': form.errors.has('idVoluntario_Estudiante') }"
                                      >
                                          {{voluntarioEstudiante.identificacionPersona}}
                                      </li>
                                      <has-error :form="form" field="idVoluntario_Estudiante"></has-error>
                                    </ul>
                                </div>
                              </div>
                            </section>  
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
                  @click="validaciones()"
                >
                  Crear
                </button>
              </div>
            </form>
            <div id="errores">
                <div style="margin-left:30%;" id="errorUno"></div>
                <div style="margin-left:24%;"  id="errorDos"></div>
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
      editmode: false,
      buscarActividad: '',
      buscarVoluntarioPersona: '',
      buscarVoluntarioEstudiante: '',
      seleccionarActividad: null,
      seleccionaVPersona: null,
      seleccionaVEstudiante: null,
      esVisibleActividad: false,
      esVisiblePersona: false,
      esVisibleEstudiante: false,
      actividadVoluntarios: {},
      actividad : '',
      actividades : [],
      voluntarioPersona: '',
      voluntarioPersonas: [],
      voluntarioEstudiante: '',
      voluntarioEstudiantes: [],
      mensajeErrorUno: [],
      mensajeErrorDos: [],
      form: new Form({
        id: "",
        idActividad: "",
        idVoluntario_Persona: "",
        idVoluntario_Estudiante: "",
      }),
    };
  },
  methods: {
    removerValidaciones(){
      errorUno.innerHTML = this.mensajeErrorUno = [];
      errorDos.innerHTML = this.mensajeErrorDos = [];
    },
    validaciones(){
      let actividades = document.getElementById("actividades");
      let voluntariosPersonas = document.getElementById("voluntariospersonas");
      let voluntarioEstudiantes = document.getElementById("voluntariosestudiantes");
      let errorUno = document.getElementById('errorUno');
      let errorDos = document.getElementById('errorDos');
      errorUno.style.color = 'red';
      errorDos.style.color = 'red';

      if(actividades === null || actividades === ''){
        this.mensajeErrorUno = 'Ingresa Una Actividad Por Favor';
      }
      if((voluntariosPersonas === null || voluntariosPersonas === '') && (voluntarioEstudiantes === null || voluntarioEstudiantes === '')){
         this.mensajeErrorDos = "Ingresa Un Voluntario Persona/Estudiante";
      }
      errorUno.innerHTML = this.mensajeErrorUno;
      errorDos.innerHTML = this.mensajeErrorDos;
    },
    limpiar(){
       this.seleccionarActividad = "";
       this.seleccionaVEstudiante = "";
       this.seleccionaVPersona = "";
    },
    seleccionarAActividad(actividad){
        this.seleccionarActividad = actividad;
        this.form.idActividad = actividad.id;
        this.esVisibleActividad = false;
    },
    seleccionarVPersona(voluntarioPersona){
         this.seleccionaVPersona = voluntarioPersona;
         this.form.idVoluntario_Persona = voluntarioPersona.id;
         this.esVisiblePersona = false;
    },
    seleccionarVEstudiante(voluntarioEstudiante){
        this.seleccionaVEstudiante = voluntarioEstudiante;
        this.form.idVoluntario_Estudiante = voluntarioEstudiante.id;
        this.esVisibleEstudiante = false;
    },
    cargarVoluntarioPersona(){
       axios.get(`/api/voluntarioActividad/GetVoluntarioPersona`).then(response=>{
             this.voluntarioPersonas = response.data;
       });
    },
    cargarVoluntarioEstudiante(){
       axios.get(`/api/voluntarioActividad/GetVoluntarioEstudiantes`).then(response=>{
          this.voluntarioEstudiantes = response.data;
       });
    },
    cargarActividades(){
      axios.get(`/api/voluntarioActividad/GetActividades`).then(response=>{
        this.actividades = response.data;
      });
    },
    getResults(page = 1) {
      this.$Progress.start();
      axios
        .get(`/api/voluntarioActividad?page=` + page)
        .then(({ data }) => (this.actividadVoluntarios = data.data));
      this.$Progress.finish();
    },
    editModal(actividadVoluntario) {
      this.editmode = true;
      this.form.reset();
      const { idActividad, idVoluntario_Persona, idVoluntario_Estudiante } = actividadVoluntario
      this.seleccionarActividad = this.actividades.find(actividad => actividad.id === idActividad)
      this.seleccionaVPersona = this.voluntarioPersonas.find(voluntario => voluntario.id === idVoluntario_Persona)
      this.seleccionaVEstudiante = this.voluntarioEstudiantes.find(voluntarioEstu => voluntarioEstu.id === idVoluntario_Estudiante)
      $("#addNew").modal("show");
      this.form = new Form({ ...actividadVoluntario })
    },
    newModal() {
      this.editmode = false;
      this.form.reset();
      this.limpiar();
      $("#addNew").modal("show");
      this.form.errors.clear();
      this.removerValidaciones();
    },

    cargarActividadVoluntariado() {
      if (this.$gate.isAdmin()) {
        axios
          .get(`/api/voluntarioActividad`)
          .then(({ data }) => (this.actividadVoluntarios = data.data));
      }
    },
    crearActividadVoluntariado() {
      this.$Progress.start();
      this.form
        .post(`/api/voluntarioActividad`)
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
        .put(`/api/voluntarioActividad/${this.form.id}`)
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
        if (result.value) {
          this.form
            .delete(`/api/voluntarioActividad/${id}`)
            .then(() => {
              Swal.fire(
                "Eliminado!",
                "Se ha eliminado la información.",
                "success"
              );
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
    filtrarActividades(){
       const filtro = this.buscarActividad.toLowerCase();
       if(this.buscarActividad === ''){
          return this.actividades;
       }
       return this.actividades.filter((actividad)=>{
          return Object.values(actividad).some((word)=> String(word).toLowerCase().includes(filtro));
       })
    },
    filtrarVoluntarioPersona(){
      const filtro = this.buscarVoluntarioPersona.toLowerCase();
      if(this.buscarVoluntarioPersona === ''){
         return this.voluntarioPersonas;
      }
      return this.voluntarioPersonas.filter((voluntarioPersona)=>{
           return Object.values(voluntarioPersona).some((word)=> String(word).toLowerCase().includes(filtro));
      })
    },

    filtrarVoluntarioEstudiante(){
      const filtro = this.buscarVoluntarioEstudiante.toLowerCase();
      if(this.buscarVoluntarioEstudiante === ''){
        return this.voluntarioEstudiantes;
      }
      return this.voluntarioEstudiantes.filter((voluntarioPersona)=>{
           return Object.values(voluntarioPersona).some((word)=> String(word).toLowerCase().includes(filtro));
      })
    }
  },
};

</script>
<style scoped>
 .dropdown-wrapper{
   max-width: 350px;
   position: relative;
   margin: 0 auto;
 }
 .selected-item{
   height: 40px;
   border: 2px solid lightgray;
   border-radius: 5px;
   padding: 5px 10px;
   display: flex;
   justify-content: space-between;
   align-items: center;
   font-size: 15px;
   font-weight: 500;
 }
 .dropdown-powered{
   position: absolute;
   border: 2px solid lightgray;
   top: 46px;
   left: 0;
   right: 0;
   background-color: #fff;
   max-width: 100%;
   padding: 10px;
   z-index: 2;
 }
 .options_uno{
   width: 100%;
 }
 .options_dos{
   width: 100%;
 }
 .options_tres{
   width: 100%;
 }
 .options_uno ul{
   list-style: none;
   text-align: left;
   padding-left: 8px;
   max-height: 180px;
   overflow-y: scroll;
   overflow-x:hidden;
 }
 .options_uno ul, li{
   width: 100%;
   border-bottom: 1px solid lightgray;
   padding: 10px;
   background-color: #f1f1f1;
   cursor: pointer;
 }

 .options_dos ul{
   list-style: none;
   text-align: left;
   padding-left: 8px;
   max-height: 180px;
   overflow-y: scroll;
   overflow-x:hidden;
 }
 .options_dos ul, li{
    width: 100%;
   border-bottom: 1px solid lightgray;
   padding: 10px;
   background-color: #f1f1f1;
   cursor: pointer;
 }
 .options_tres ul{
   list-style: none;
   text-align: left;
   padding-left: 8px;
   max-height: 180px;
   overflow-y: scroll;
   overflow-x:hidden;
 }
 .options_tres ul, li{
   width: 100%;
   border-bottom: 1px solid lightgray;
   padding: 10px;
   background-color: #f1f1f1;
   cursor: pointer;
 }
 li:hover{
   background: #70878a;
   color: #fff;
   font-weight: bold;
 }
 input{
  width: 100%;
  height: 30px;
  border: 2px solid lightgray;
  font-size: 15px;
  padding-left: 8px;
 }
 #seleccionarAc{
    font-size: 15px;
 }
 #seleccionarVE{
    font-size: 15px;
 }
 #seleccionarVP{
    font-size: 15px;
 }
 .modal-content{
    height: 100%;
 }
 .modal-footer{
  	display: flex;
    justify-content: center;
 }
 .drop-down-icon{
   transform: rotate(0deg);
   transition: all 0.5s ease;
 }
 .drop-down-icon.dropdown{
    transform: rotate(180deg);
 }
</style>
