<template>
  <div>
    <pagination
      :data="actividadVoluntarios"
      @pagination-change-page="getResults"
    ></pagination>
    <div
      id="pageVoluntarioActividad"
      class="card-body table-responsive p-0"
      style="width: 850px; color: black; background: white"
    >
      <div class="Encabezado">
        <h1>Sendero los Matapalos</h1>
        <img src="/images/MarcaAgua.jpeg" width="85px" height="50px" alt="" />
      </div>
      <div class="titulo">
        <h3>Reporte de Voluntarios de actividades</h3>
      </div>
      <h3 style="margin: 5px; color: #354942" class="Datos">
        Fecha: {{ fechaActual }}
      </h3>
      <div class="Hoja">
        <table class="table table-hover">
                <thead>
                  <tr>
                    <th>ID Voluntariado Actividad</th>
                    <th>Nombre de Actividad</th>
                    <th>Nombre de Persona Voluntaria</th>
                    <th>Nombre de Estudiante Voluntario</th>
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
                  </tr>
                </tbody>
              </table>
        <!-- <h2 class="total">Total: {{ organizaciones.data.length }}</h2> -->
      </div>
    </div>
  </div>
</template>
<script>
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
    cargarActividadVoluntariado() {
      if (this.$gate.isAdmin()) {
        axios
          .get("/api/voluntarioActividad")
          .then(({ data }) => (this.actividadVoluntarios = data.data));
      }
    },
  },
   mounted() {
    console.log("Component mounted.");
    this.cargarActividades();
    this.cargarVoluntarioPersona();
    this.cargarVoluntarioEstudiante();
  },
  created() {
    this.$Progress.start();
    this.cargarActividadVoluntariado();
    this.$Progress.finish();
    window.onload = this.set;
  },
  computed: {
    set: function () {
      var today = new Date();
      var strDate = "d-m-Y"
        .replace("Y", today.getFullYear())
        .replace("m", today.getMonth() + 1)
        .replace("d", today.getDate());
        this.fechaActual = strDate;
    },
  },
};
</script>

<style scoped>
.card-body {
  font-size: 1.2rem;
  margin: 5px 5px 5px 45px;
  font-family: system-ui;
  margin-left: 18%;
}

.btn {
  margin: 5px;
}
.Encabezado {
  display: flex;
  flex-direction: row;
  flex-wrap: nowrap;
  justify-content: space-around;
  padding: 5px;
  border-bottom: 1px solid #14c514;
  background: #bababb8c;
}
h1,
.h1 {
  width: 90%;
  font-size: 2.25rem;
}
thead {
  background: #3bd99f;
  color: #343434de;
}
.titulo {
  text-align: center;
  margin: 15px;
  background: #3bd99f;
  color: #354942;
}
.table {
  border-bottom: 2px solid #f2f2f2;
}
.Hoja {
  height: 980px;
}

h3 {
  padding: 10px;
}
.total {
  text-align: end;
  margin: 5px;
  font-size: 1.2rem;
  background: #f2f2f2;
  padding: 10px;
  color: #354942;
}
.Pie-Datos {
  text-align: start;
  margin: 5px;
  font-size: 1.2rem;
  padding: 10px;
  color: #354942;
}
</style>
