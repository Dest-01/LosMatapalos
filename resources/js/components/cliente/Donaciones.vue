<template>
  <div>
    <div class="portada">
      <img class="portadaImagen" v-bind:src="portada" v-bind:alt="text" />
      <div class="centrado">HAZ UNA DONACIÓN</div>
    </div>
    <div class="intro">
      <span
        >Su generosa donación y su continuo apoyo marcan una gran ayuda al
        Sendero Los Matapalos.<br />
        Su aporte logra una gran contribución con la mejora y el mantenimiento
        del sendero.</span
      >

    </div>
    <div class="necesarios">
      <div class="contenedor1 card">
        <div class="card-body">
          <h1>Donaciones Necesarias</h1>
          <h5>
            Si desea realizar una donacion de tipo material, puede ser de los
            siguientes que se muestran en las imagenes de la derecha.
          </h5>
          <br />
          <h5>
            Si desea realizar otra donación distinta a las que se necesitan, se
            puede poner en contacto con los administradores.
          </h5>
          <br />
          <h5 style="text-align: center">
            Telefono: 0000-0000 - Email: sendero@una.ac.cr
          </h5>
        </div>
      </div>
      <div class="contenedor2 card">
        <div class="card-body">
          <div
            id="carouselExampleControls"
            class="carousel slide"
            data-bs-ride="carousel"
          >
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img
                  v-bind:src="'/images/PortadaDonaciones2.jpg'"
                  class="d-block w-100"
                  width="350px"
                  height="500px"
                  alt=""
                />
                <div class="carousel-caption d-none d-md-block">
                  <h1>¿Que se necesita?</h1>
                  <p>
                    Las siguentes son algunas de las cosas necesarias para el
                    progreso del sendero.
                  </p>
                </div>
              </div>
              <div
                v-for="donativosNecesario in donativosNecesarios.data"
                :key="donativosNecesario.id"
                class="carousel-item"
              >
                <img
                  v-bind:src="
                    '/images/CatDonativos/' + donativosNecesario.photo
                  "
                  class="d-block w-100"
                  width="100%"
                  height="100"
                  alt=""
                />
                <div class="carousel-caption d-none d-md-block">
                  <h1>{{ donativosNecesario.nombre }}</h1>
                </div>
              </div>
            </div>
            <button
              class="carousel-control-prev"
              type="button"
              data-bs-target="#carouselExampleControls"
              data-bs-slide="prev"
            >
              <span
                class="carousel-control-prev-icon"
                aria-hidden="true"
              ></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button
              class="carousel-control-next"
              type="button"
              data-bs-target="#carouselExampleControls"
              data-bs-slide="next"
            >
              <span
                class="carousel-control-next-icon"
                aria-hidden="true"
              ></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
      </div>
    </div>
<section class="secCard">
  <div class="container">
  <div class="card">
    <div class="imgBx">
      <img src="https://dl.dropbox.com/s/qyw1fm7xcumr1ad/20210827_152101.jpg?dl=0" alt="">
    </div>
    <div class="content">
      <h2>Card one</h2>
      <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vel, consequuntur! Repudiandae laudantium maxime doloribus. Fugit porro in a beatae. Quo atque a quod accusamus inventore? Velit voluptatum rerum voluptates nostrum.</p>
    </div>
  </div>
</div>

  <div class="container">
  <div class="card">
    <div class="imgBx">
      <img src="https://dl.dropbox.com/s/qyw1fm7xcumr1ad/20210827_152101.jpg?dl=0" alt="">
    </div>
    <div class="content">
      <h2>Card one</h2>
      <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vel, consequuntur! Repudiandae laudantium maxime doloribus. Fugit porro in a beatae. Quo atque a quod accusamus inventore? Velit voluptatum rerum voluptates nostrum.</p>
    </div>
  </div>
</div>

  <div class="container">
  <div class="card">
    <div class="imgBx">
      <img src="https://dl.dropbox.com/s/qyw1fm7xcumr1ad/20210827_152101.jpg?dl=0" alt="">
    </div>
    <div class="content">
      <h2>Card one</h2>
      <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vel, consequuntur! Repudiandae laudantium maxime doloribus. Fugit porro in a beatae. Quo atque a quod accusamus inventore? Velit voluptatum rerum voluptates nostrum.</p>
    </div>
  </div>
</div>
  <div class="container">
  <div class="card">
    <div class="imgBx">
      <img src="https://dl.dropbox.com/s/qyw1fm7xcumr1ad/20210827_152101.jpg?dl=0" alt="">
    </div>
    <div class="content">
      <h2>Card one</h2>
      <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vel, consequuntur! Repudiandae laudantium maxime doloribus. Fugit porro in a beatae. Quo atque a quod accusamus inventore? Velit voluptatum rerum voluptates nostrum.</p>
    </div>
  </div>
</div>
  <div class="container">
  <div class="card">
    <div class="imgBx">
      <img src="https://dl.dropbox.com/s/qyw1fm7xcumr1ad/20210827_152101.jpg?dl=0" alt="">
    </div>
    <div class="content">
      <h2>Card one</h2>
      <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vel, consequuntur! Repudiandae laudantium maxime doloribus. Fugit porro in a beatae. Quo atque a quod accusamus inventore? Velit voluptatum rerum voluptates nostrum.</p>
    </div>
  </div>
</div>
</section>
  </div>
</template>

<script>

export default {

  data() {
    return {
      portada: "../images/PortadaDonaciones.jpg",
      text: "Portada",
      donativos: {},
      donativosNecesarios: {},
      donadores: {},
    };
  },
  methods: {
    getResults(page = 1) {
      this.$Progress.start();
      axios
        .get("/api/donacionesCliente?page=" + page)
        .then(({ data }) => (this.donativos = data.data));
      this.$Progress.finish();
    },
    cargarDonativos() {
      axios
        .get("/api/donacionesCliente")
        .then(({ data }) => (this.donativos = data.data));
      axios
        .get("/api/donacionesCliente/donacionesNecesarias")
        .then(({ data }) => (this.donativosNecesarios = data.data));
        axios
        .get("/api/donacionesCliente/Donadores")
        .then(({ data }) => (this.donadores = data.data));
    },
  },
  created() {
    this.$Progress.start();
    this.cargarDonativos();
    this.$Progress.finish();
  },
  computed:{
    soloDonadores: function () {
    return this.donadores.filter(function (donador) {
      return this.donadores.id == this.donativos.idPersonas
    })
  }
  },
};
</script>

<style scoped>
.portada {
  margin: auto auto 1px auto;
  position: relative;
  display: inline-block;
  text-align: center;
  width: 100%;
}
.card-body {
  -webkit-box-flex: 1;
  -ms-flex: 1 1 auto;
  flex: 1 1 auto;
  padding: 5px;
}
img {
  width: 100%;
  height: auto;
}
.centrado {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  font-size: 3rem;
  color: white;
  font-family: "Poppins";
  font-weight: 600;
}

.portadaImagen {
  width: 100%;
  height: 500px;
}
.intro {
  margin: auto auto 40px auto;
  background: #faf9f7;
  height: 300px;
  text-align: center;
  font-size: 25px;
  font-family: "Poppins";
  padding: 80px;
  border-top: outset;
}
.contenedor-donadores {
  margin: auto auto 40px auto;
  background: #faf9f7;
  height: 400px;
  text-align: center;
  font-size: 25px;
  font-family: "Poppins";
  padding: 80px;
  border-top: outset;
}
.titulo {
  margin-top: 100px;
  font-size: 3rem;
}
.necesarios {
  display: flex;
  flex-direction: column;
  flex-flow: row;
  margin: 40px 90px 40px 90px;
  justify-content: space-around;
  align-items: center;
}
.contenedor1 {
  height: 400px;
  background: #dbd8d873;
  margin-right: 10px;
  box-shadow: 2px 2px 2px 1px rgb(0 0 0 / 20%);
  width: 625px;
}
.contenedor2 {
  height: auto;
  width: 950px;
  background: #034991;
  box-shadow: 2px 2px 2px 1px rgb(0 0 0 / 20%);
}
h1 {
  text-align: center;
}
h5 {
  font-size: 20px;
  text-align: justify;
}

.row {
  margin: 20px 50px 20px 50px;
}
/* Type-2 */
.scroll-box {
  display: flex;
  widows: 100%;
  overflow: hidden;
}
.scroll-box:hover {
  overflow: auto;
  overflow-y: hidden;
}
.scroll-box li {
  display: inline-block;
}
.scroll-box a {
  display: block;
  width: 300px;
  background: #f5f5f5;
  border: 1px solid #e5e5e5;
  padding: 10px;
  text-align: center;
  margin: 10px;
  color: #282828;
}
.scroll-box a:hover {
  text-decoration: none;
}
.scroll-box a h3 {
  margin-top: 10px;
}
.scroll-box a h1 {
  margin-top: 10px;
  color: orange;
}
.scroll-box a h4 {
  color: #aaa;
  margin-bottom: 15px;
}
.scroll-box a h5 {
  line-height: 20px;
}

/* Type-3 */
.donation a.card {
  display: block;
  width: 100%;
  background: #f5f5f5;
  border: 1px solid #e5e5e5;
  padding: 10px;
  text-align: center;
  margin: 10px;
  color: #282828;
}
.donation a.card:hover {
  text-decoration: none;
}
.donation a.card h3 {
  margin-top: 10px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 200px;
}
.donation a.card h1 {
  margin-top: 10px;
  color: orange;
}
.donation a.card h4 {
  color: #aaa;
  margin-bottom: 15px;
}
.donation a.card h5 {
  line-height: 20px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 400px;
}
/* Heading */
.titles {
  padding: 10px;
  text-align: center;
}
.titles span {
  color: rgba(255, 255, 255, 0.6);
}


.secCard{
  
  width: 100%;
  height: 50vh;
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: rgb(239 237 237);
  }
.contenedor-donaciones{
  background-color: rgb(239 237 237);
}

  .container{
    position: relative;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    padding: 30px;
  }

  .container .card{
    position: relative;
    max-width: 300px;
    height: 150px;
    background: #fff;
    margin: 30px 10px;
    padding: 20px 15px;
    display: flex;
    flex-direction: column;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.5);
    transition: 0.3s ease-in-out;
  }
  .container .card:hover{
    height: 420px;
  }

.container .card .imgBx{
  position: relative;
width: 260px;
height: 260px;
top: -60px;
left: 5px;
z-index: 5;
box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
}

.container .card .imgBx img{
  max-width: 100%;
  border-radius: 5px;
}

.container .card .content{
  position: relative;
  margin-top: -140px;
  padding: 10px 15px;
  text-align: center;
  color: #111;
  visibility: hidden;
  opacity: 0;
  transition: 0.3s ease-in-out;
}

.container .card:hover .content{
  visibility: visible;
  opacity: 1;
  margin-top: -40px;

}
.site-heading h2 {
  display: block;
  font-weight: 700;
  margin-bottom: 10px;
  text-transform: uppercase;
}

.site-heading h2 span {
  color: #00a01d;
}

@media (max-width: 639px) {
  img {
    width: 100%;
    height: 200px;
  }
  .portada {
    margin: 100px auto auto auto;
  }
  .portadaImagen {
    width: 100%;
    height: 200px;
  }
  .centrado {
    font-size: 35px;
  }
  .intro {
    width: 100%;
    padding: 50px;
    font-size: 15px;
  }
  .necesarios {
    display: flex;
    flex-direction: column;
    flex-flow: row;
    margin: 10px 5px 5px 10px;
    flex-wrap: wrap;
  }
  .contenedor1 {
    height: 450px;
    width: 100%;
    margin-right: 5px;
    margin-left: 2px;
  }
  .contenedor2 {
    top: 20px;
  }
  .row {
    margin: 10px 11px 1px 1px;
  }
  .contenedor-donadores {
    padding: 10px;
    margin-top: 30px;
  }
}

@media only screen and (min-device-width: 640px) and (max-device-width: 767px) {
  img {
    width: 100%;
    height: 100%;
  }
  .portadaImagen {
    width: 100%;
    height: 230px;
  }
  .centrado {
    font-size: 30px;
    top: 60%;
  }
  .intro {
    font-size: 20px;
    margin-top: 1px;
  }
  .necesarios {
    display: flex;
    flex-direction: column;
    flex-flow: row;
    margin: 10px 10px 10px 10px;
    justify-content: space-around;
    align-items: center;
    flex-wrap: wrap;
  }
  .contenedor1 {
    height: auto;
    width: 100%;
  }
  .contenedor2 {
    top: 10px;
  }
  .row {
    margin: 1px 15px 1px 1px;
  }
  .col-sm-3 {
    width: 50%;
  }
}

@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) {
  img {
    width: 100%;
    height: 100%;
  }
  .portadaImagen {
    width: 100%;
    height: 300px;
  }
  .centrado {
    font-size: 2.6rem;
    top: 65%;
  }
  .necesarios {
    display: flex;
    flex-wrap: wrap;
    margin: 10px 20px 20px 10px;
    height: 600px;
  }
  .contenedor1 {
    height: auto;
    width: 100%;
    margin: 1px 1px 1px 1px;
  }
  .contenedor2 {
    top: 10px;
    width: 100%;
    height: auto;
  }
  .contenedor-donadores {
    margin-top: 200px;
  }
  .row {
    margin: 20px 10px 20px 10px;
    display: flex;
    flex-direction: row;
    justify-content: flex-start;
    align-content: space-around;
    align-items: center;
    flex-wrap: wrap;
  }
  .col-sm-3 {
    width: 50%;
  }
  .donation a.card {
    width: 100%;
  }
}

@media only screen and (min-device-width: 1025px) and (max-device-width: 1284px) {
  img {
    width: 100%;
    height: 100%;
  }
}
</style>