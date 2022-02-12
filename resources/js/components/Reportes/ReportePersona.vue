<template>
  <div>
    <pagination
      :data="personas"
      @pagination-change-page="getResults"
    ></pagination>
    <div
      id="page"
      class="card-body table-responsive p-0"
      style="width: 1000px; color: black; background: white"
    >
      <div class="Encabezado">
        <h1>Sendero los Matapalos</h1>
        <img src="/images/MarcaAgua.jpeg" width="85px" height="50px" alt="" />
      </div>
      <div class="titulo">
        <h3>Reporte de personas</h3>
      </div>
      <h3 style="margin: 5px; color: #354942" class="Datos">
        Fecha: {{ fechaActual }}
      </h3>
      <div class="Hoja">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Cédula</th>
              <th>Nombre</th>
              <th>Primer Apellido</th>
              <th>Segundo Apellido</th>
              <th>Teléfono</th>
              <th>Correo</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="persona in personas.data" :key="persona.id">
              <td>{{ persona.identificacion }}</td>
              <td>{{ persona.nombre }}</td>
              <td>{{ persona.apellido1 }}</td>
              <td>{{ persona.apellido2 }}</td>
              <td>{{ persona.telefono }}</td>
              <td>{{ persona.correo }}</td>
            </tr>
          </tbody>
        </table>
        <h2 class="total">Total: {{ total }}</h2>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      personas: {},
      total: 0,
      fechaActual: "",
      contarArray: "",
    };
  },
  methods: {
    getResults(page = 1) {
      this.$Progress.start();

      axios
        .get("/api/persona?page=" + page)
        .then(({ data }) => (this.personas = data.data));
      this.$Progress.finish();
    },
    cargarPersona() {
      if (this.$gate.isAdmin() || this.$gate.isUser()) {
        axios
          .get("/api/persona")
          .then(({ data }) => (this.personas = data.data));
      }
    },
  },
  created() {
    this.$Progress.start();
    this.cargarPersona();
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
td {
  padding: 5px;
  padding-left: 5px;
}
</style>
