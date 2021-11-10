<template>
  <div>
    <pagination
      :data="flora"
       @pagination-change-page="getResults"
    ></pagination>
    <div
      id="pageFlora"
      class="card-body table-responsive p-0"
      style="width: 850px; color: black; background: white"
    >
      <div class="Encabezado">
        <h1>Sendero los Matapalos</h1>
        <img src="/images/MarcaAgua.jpeg" width="85px" height="50px" alt="" />
      </div>
      <div class="titulo">
        <h3>Reporte de la Fauna del sendero</h3>
      </div>
      <h3 style="margin: 5px; color: #354942" class="Datos">
        Fecha: {{ fechaActual }}
      </h3>
      <div class="Hoja">
            <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Id Flora</th>
                    <th>Nombre común</th>
                    <th>Nombre científico</th>
                    <th>Descripción</th>
                    <th>Tipo</th>
                    <th>Imagen</th>
                    <th>Familia científico</th>
                    <th>Fecha registro</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="Flora in flora.data" :key="Flora.id">
                    <td>{{ Flora.id }}</td>
                    <td class="text-capitalize">{{ Flora.nom_comun }}</td>
                    <td class="text-capitalize">{{ Flora.nom_cientifico }}</td>
                    <td>{{ Flora.descripcion | truncate(30, "...") }}</td>
                    <td class="text-capitalize">{{ Flora.tipo }}</td>
                    <td>
                      <img
                        v-bind:src="'/images/flora/' + Flora.photo"
                        width="50px"
                        height="50px"
                      />
                    </td>
                    <td class="text-capitalize">{{ Flora.fam_cientifica }}</td>
                    <td class="text-capitalize">{{ Flora.fecha_registro }}</td>
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
      flora: {},
      form: new Form({
        id: "",
        nom_comun: "",
        nom_cientifico: "",
        fecha_registro: "",
        descripcion: "",
        photo: "",
        tipo: "",
        fam_cientifica: "",
      }),
    };
  },
  methods: {
   getResults(page = 1) {
      this.$Progress.start();
      axios
        .get("/api/flora?page=" + page)
        .then(({ data }) => (this.flora = data.data));
      this.$Progress.finish();
    },

    cargarFlora() {
      if (this.$gate.isAdmin() || this.$gate.isUser()) {
        axios.get("/api/flora").then(({ data }) => (this.flora = data.data));
      }
    },
  },
  created() {
    this.$Progress.start();
    this.cargarFlora();
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
