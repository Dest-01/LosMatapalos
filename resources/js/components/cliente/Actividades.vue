<template>
  <div style="margin-top: 100px">
    <h1>Actividades del Sendero los Matapalos</h1>
    <ul class="contenedor-todo">
      <div v-for="actividad in actividades.data" :key="actividad.id">
        <li
          class="booking-card"
         :style="{ 'background-image': 'url(images/actividades/' + actividad.imagen + ')' }"
        >
          <div class="book-container">
            <div class="content">
              <button class="btn">Actividad</button>
            </div>
          </div>
          <div class="informations-container">
            <h2 class="title">{{actividad.nombre}}</h2>
            <p class="sub-title">Para: {{actividad.tipo}}</p>
            <p class="sub-title">

            Hora: {{actividad.hora}}
            </p>
            <div class="more-information">
              <div class="info-and-date-container">
                <div class="box info">
                  <svg
                    class="icon"
                    style="width: 24px; height: 24px"
                    viewBox="0 0 24 24"
                  >
                    <path
                      fill="currentColor"
                      d="M11,9H13V7H11M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M11,17H13V11H11V17Z"
                    />
                  </svg>
                   <p>Cantidad de participantes</p>
                  <p>{{actividad.cantParticipantes}}</p>
                </div>
                <div class="box date">
                  <svg
                    class="icon"
                    style="width: 24px; height: 24px"
                    viewBox="0 0 24 24"
                  >
                    <path
                      fill="currentColor"
                      d="M19,19H5V8H19M16,1V3H8V1H6V3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3H18V1M17,12H12V17H17V12Z"
                    />
                  </svg>
                  <p>Fecha de actividad</p>
                  <p>{{actividad.fecha}}</p>
                </div>
              </div>
              <p class="disclaimer">
                {{actividad.descripcion}}
              </p>
            </div>
          </div>
        </li>
      </div>
    </ul>
    <div class="paginacion">
      <pagination
        style="font-family: fantasy; color: black"
        :data="actividades"
        @pagination-change-page="getResults"
      ></pagination>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      actividades: {},
      form: new Form({
        id: "",
      }),
    };
  },
  methods: {
    getResults(page = 1) {
      this.$Progress.start();
      axios
        .get("/api/actividadCliente?page=" + page)
        .then(({ data }) => (this.actividades = data.data));
      this.$Progress.finish();
    },
    cargarActividades() {
      axios
        .get("/api/actividadCliente/")
        .then(({ data }) => (this.actividades = data.data));
    },
  },
  created() {
    this.$Progress.start();
    this.cargarActividades();
    this.$Progress.finish();
  },
  filters: {
    truncate: function (text, length, suffix) {
      return text.substring(0, length) + suffix;
    },
  },
};
</script>
<style scoped>
.contenedor-todo {
display: flex;
    /* padding-block: 20px; */
    flex-direction: row;
    justify-content: center;
    flex-wrap: wrap;
    align-items: flex-start;
    align-content: space-around;
    margin: 1px 10px 5px 10px;

}

.paginacion {
  margin: 5px 70px 5px 70px;
  padding: 1em;
padding-left: 40%;
}

* {
  margin: 0;
  padding: 0;
  font-family: 'Poppins';
}

.sub-title{
      font-family: 'Poppins';
    font-weight: 600;
}

h2 {
  color: #0a4870;
  font-weight: 500;
}

ul {
  display: flex;
  flex-wrap: wrap;
  list-style: none;
  padding: 0;
}
ul .booking-card {
  position: relative;
  width: 300px;
  display: flex;
  flex: 0 0 300px;
  flex-direction: column;
  margin: 20px;
  margin-bottom: 30px;
  -webkit-border-radius: 10px;
  -moz-border-radius: 10px;
  border-radius: 10px;
  overflow: hidden;
  background-position: center center;
  background-size: cover;
  text-align: center;
  color: #0a4870;
  transition: 0.3s;
  height: 500px;
}
ul .booking-card::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(10, 72, 112, 0);
  transition: 0.3s;
}
ul .booking-card .book-container {
  height: 200px;
}
ul .booking-card .book-container .content {
  position: relative;
  opacity: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100%;
  width: 100%;
  transform: translateY(-200px);
  transition: 0.3s;
}
ul .booking-card .book-container .content .btn {
  border: 3px solid white;
  padding: 10px 15px;
  background: none;
  text-transform: uppercase;
  font-weight: bold;
  font-size: 1.3em;
  color: white;
  cursor: pointer;
  transition: 0.3s;
}
ul .booking-card .book-container .content .btn:hover {
  background: none;
   border: 3px solid white;
 color: white;
 cursor: pointer;
}
ul .booking-card .informations-container {
  flex: 1 0 auto;
  padding: 20px;
  background: #f0f0f0;
  transform: translateY(206px);
  transition: 0.3s;
}
ul .booking-card .informations-container .title {
  position: relative;
  padding-bottom: 10px;
  margin-bottom: 10px;
  font-weight: bold;
  font-size: 1.2em;
}
ul .booking-card .informations-container .title::after {
  content: "";
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  height: 3px;
  width: 100%;
  margin: auto;
  background: #0a4870;
}
ul .booking-card .informations-container .price {
  display: flex;
  align-items: center;
  justify-content: center;
  margin-top: 10px;
}
ul .booking-card .informations-container .price .icon {
  margin-right: 10px;
}
ul .booking-card .informations-container .more-information {
  opacity: 0;
  transition: 0.3s;
}
ul
  .booking-card
  .informations-container
  .more-information
  .info-and-date-container {
  display: flex;
}
ul
  .booking-card
  .informations-container
  .more-information
  .info-and-date-container
  .box {
  flex: 1 0;
  padding: 15px;
  margin-top: 20px;
  -webkit-border-radius: 10px;
  -moz-border-radius: 10px;
  border-radius: 10px;
  background: white;
  font-weight: bold;
  font-size: 0.9em;
}
ul
  .booking-card
  .informations-container
  .more-information
  .info-and-date-container
  .box
  .icon {
  margin-bottom: 5px;
}
ul
  .booking-card
  .informations-container
  .more-information
  .info-and-date-container
  .box.info {
  color: #ec992c;
  margin-right: 10px;
}
ul .booking-card .informations-container .more-information .disclaimer {
  margin-top: 20px;
  font-size: 0.8em;
  color: #7d7d7d;
  font-weight: 600;
}
ul .booking-card:hover::before {
  background: rgba(10, 72, 112, 0.6);
}
ul .booking-card:hover .book-container .content {
  opacity: 1;
  transform: translateY(0px);
}
ul .booking-card:hover .informations-container {
  transform: translateY(0px);
}
ul .booking-card:hover .informations-container .more-information {
  opacity: 1;
}

@media (max-width: 768px) {
  ul .booking-card::before {
    background: rgba(10, 72, 112, 0.6);
  }
  ul .booking-card .book-container .content {
    opacity: 1;
    transform: translateY(0px);
  }
  ul .booking-card .informations-container {
    transform: translateY(0px);
  }
  ul .booking-card .informations-container .more-information {
    opacity: 1;
  }
}

h1 {
  margin: 10px 20px;
      text-align: center;
}
</style>