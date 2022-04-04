<template>
  <div v-if="voluntarioEstudiante.data != 0" class="container">
    <div class="titulo">
     <h1>{{$t('Vol_T1')}} <span>{{$t('Vol_T2')}}</span></h1>
    </div>
    <div class="contenedor_voluntarios">
      <div
        v-for="voluntarios in voluntarioEstudiante.data"
        :key="voluntarios.id"
        class="card"
      >
        <div class="foto_estudiante">
          <img
            v-bind:src="'/images/voluntariado/' + voluntarios.imagen"
            alt=""
            width="100%"
            height="100%"
          />
        </div>
        <div class="info">
        <h3>{{ voluntarios.nombre }}</h3>
        <h3>{{ voluntarios.apellido1 }}</h3>
        <h3>{{ voluntarios.apellido2 }}</h3>
        <h4>{{$t('Carrera')}}: {{ voluntarios.carrera }}</h4>
        </div>
      </div>
    </div>
    <div class="paginacion">
        <pagination
          style="color: black"
          :data="voluntarioEstudiante"
          :limit="5"
          @pagination-change-page="getResults"
        ></pagination>
      </div>
  </div>
</template>


<script>
export default {
  data() {
    return {
      voluntarioEstudiante: {},
    };
  },
  methods: {
      getResults(page = 1) {
      this.$Progress.start();
      axios
        .get("/api/voluntariosCliente?page=" + page)
        .then(({ data }) => (this.voluntarioEstudiante = data.data));
      this.$Progress.finish();
    },
    cargarVoluntarios() {
      axios
        .get("/api/voluntariosCliente")
        .then(({ data }) => (this.voluntarioEstudiante = data.data));
    },
  },
  created() {
    this.$Progress.start();
    this.cargarVoluntarios();
    this.$Progress.finish();
  },
};
</script>

<style scoped>
.titulo {
  text-align: center;
}
span {
  color: #38ab81;
}
.card {
  width: 282px;
  height: 380px;
  margin: 10px;
  padding: 5px;
  border: 2px solid #7fa6cd8a;
  box-shadow: 2px 3px 10px 0 #798b9d;
  text-align: center;
  border-radius: 10px;
  transition: all 0.4s ease;
}
.card:hover{
     transform: translateY(-15px);
}
.foto_estudiante {
  width: 250px;
    height: 245px;
  box-sizing: border-box;
  
}
.foto_estudiante img {
  box-sizing: content-box;
  border: 2px solid #346da7;
	border-radius: 50%;
	padding: 7px;
}
.card h3 {
  display: contents;
  color: rgba(8, 8, 8, 0.753);
  font-weight: 400;
}
.card h4 {
  color: #346da7;
  font-weight: 400;
}
.info{
    margin-top: 35px;
}
.paginacion {
  margin: 10px auto;
  padding: 1.5em;
  display: flex;
  justify-content: center;
  align-content: center;
  flex-direction: row-reverse;
}

.pagination {
  justify-content: center;
  font-family: fantasy;
  color: black;
  background: #f0f0f0;
  padding: 10px;
  border-radius: 10px;
  font-weight: 900;
}
.contenedor_voluntarios{
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: center;
}
</style>