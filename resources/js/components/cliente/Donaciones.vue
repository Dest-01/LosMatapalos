<template>
  <div>
    <div class="portada">
      <img v-bind:src="portada" v-bind:alt="text" width="100%" height="500px" />
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
          <!-- Carousel wrapper -->
          <div
            id="carouselDarkVariant"
            class="carousel slide carousel-fade carousel-dark"
            data-mdb-ride="carousel"
          >
            <!-- Indicators -->
            <div class="carousel-indicators">
              <button
                data-mdb-target="#carouselDarkVariant"
                data-mdb-slide-to="0"
                class="active"
                aria-current="true"
                aria-label="Slide 1"
              ></button>
              <button
                data-mdb-target="#carouselDarkVariant"
                data-mdb-slide-to="1"
                aria-label="Slide 1"
              ></button>
              <button
                data-mdb-target="#carouselDarkVariant"
                data-mdb-slide-to="2"
                aria-label="Slide 1"
              ></button>
            </div>

            <!-- Inner -->
            <div class="carousel-inner">
              <!-- Single item -->
              <div class="carousel-item active">
                <img
                  src="https://mdbootstrap.com/img/Photos/Slides/img%20(19).jpg"
                  class="d-block w-100"
                  alt="..."
                />
                <div class="carousel-caption d-none d-md-block">
                  <h5>First slide label</h5>
                  <p>
                    Nulla vitae elit libero, a pharetra augue mollis interdum.
                  </p>
                </div>
              </div>

              <!-- Single item -->
              <div class="carousel-item">
                <img
                  src="https://mdbootstrap.com/img/Photos/Slides/img%20(35).jpg"
                  class="d-block w-100"
                  alt="..."
                />
                <div class="carousel-caption d-none d-md-block">
                  <h5>Second slide label</h5>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                  </p>
                </div>
              </div>

              <!-- Single item -->
              <div class="carousel-item">
                <img
                  src="https://mdbootstrap.com/img/Photos/Slides/img%20(40).jpg"
                  class="d-block w-100"
                  alt="..."
                />
                <div class="carousel-caption d-none d-md-block">
                  <h5>Third slide label</h5>
                  <p>
                    Praesent commodo cursus magna, vel scelerisque nisl
                    consectetur.
                  </p>
                </div>
              </div>
            </div>
            <!-- Inner -->

            <!-- Controls -->
            <button
              class="carousel-control-prev"
              type="button"
              data-mdb-target="#carouselDarkVariant"
              data-mdb-slide="prev"
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
              data-mdb-target="#carouselDarkVariant"
              data-mdb-slide="next"
            >
              <span
                class="carousel-control-next-icon"
                aria-hidden="true"
              ></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
          <!-- Carousel wrapper -->
        </div>
      </div>
    </div>
    <div class="contenedor-donadores">
      <h2 class="titles"><span class="pull-right"></span>Donadores</h2>
      <div class="row">
        <ul class="scroll-box">
          <li>
            <a href="">
              <h3>Nombre</h3>
              <h1>Informacion</h1>
              <h4></h4>
              <h5>
                Description Description Description Description Description
              </h5>
            </a>
          </li>
          <li>
            <a href="">
              <h3>Nombre</h3>
              <h1>Informacion</h1>
              <h4></h4>
              <h5>
                Description Description Description Description Description
              </h5>
            </a>
          </li>
          <li>
            <a href="">
              <h3>Nombre</h3>
              <h1>Informacion</h1>
              <h4></h4>
              <h5>
                Description Description Description Description Description
              </h5>
            </a>
          </li>
          <li>
            <a href="">
              <h3>Nombre</h3>
              <h1>Informacion</h1>
              <h4></h4>
              <h5>
                Description Description Description Description Description
              </h5>
            </a>
          </li>
          <li>
            <a href="">
              <h3>Nombre</h3>
              <h1>Informacion</h1>
              <h4></h4>
              <h5>
                Description Description Description Description Description
              </h5>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="contenedor-donaciones">
      <h2 class="titles">
        <span class="pull-right"></span>Donaciones Recibidas
      </h2>
      <div class="row donation">
        <div
          v-for="donativo in donativos.data"
          :key="donativo.id"
          class="col-sm-3"
        >
          <a href="" class="card">
            <h3 style="text-align: center">{{ donativo.tipo }}</h3>
            <img
              class="imagenes"
              v-bind:src="'/images/donativos/' + donativo.photo"
              width="300px"
              height="200px"
              alt=""
            />
            <h4>{{ donativo.fecha }}</h4>
            <h5 style="text-align: center">{{ donativo.detalle }}</h5>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      portada: "../images/PortadaDonaciones.jpg",
      text: "Portada",
      donativos: {},
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
        .get("/api/donacionesCliente/")
        .then(({ data }) => (this.donativos = data.data));
    },
  },
  created() {
    this.$Progress.start();
    this.cargarDonativos();
    this.$Progress.finish();
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
  width: 510px;
}
.contenedor2 {
  height: auto;
  width: 1150px;
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

@media screen and (max-width: 900px) {
  .portada {
    width: 200px;
    height: 250px;
    margin-top: 5px;
  }
  img {
width: 768px;
    height: 300px;
  }
  .intro {
    font-size: 15px;
    margin: 55px 5px 5px 5px;
  }
  .centrado {
    font-size: 2rem;
    margin-top: 70px;
    /* margin: auto; */
    margin-left: 145%;
  }
  .necesarios {
    margin: 10px 40px 10px 10px;
    width: auto;
    display: flex;
    flex-direction: column;
  }
  .contenedor1 {
    width: 750px;
    height: auto;
    margin: auto;
  }
  .contenedor2 {
    width: 750px;
    height: auto;
    margin: 10px auto auto auto;
  }

  .contenedor-donadores {
    margin: auto auto 40px auto;
    background: #faf9f7;
    height: 400px;
    text-align: center;
    font-size: 25px;
    font-family: "Poppins";
    padding: 20px;
    border-top: outset;
  }
  .imagenes {
    width: 130px;
    height: auto;
  }
  .row {
    margin: 15px 40px 40px 20px;
  }
}

@media screen and (max-width: 500px) {
  .portada {
    width: 200px;
    height: 250px;
    margin-top: 5px;
  }
  img {
    width: 375px;
    height: 200px;
  }
  .intro {
    font-size: 15px;
    margin: 47px 5px 5px 5px;
  }
  .centrado {
    font-size: 2rem;
    margin-top: 70px;
    /* margin: auto; */
    margin-left: 75px;
  }
  .necesarios {
    margin: 10px 40px 10px 10px;
    width: auto;
    display: flex;
    flex-direction: column;
  }
  .contenedor1 {
    width: 300px;
    height: auto;
  }
  .contenedor2 {
    width: 300px;
    height: auto;
  }

  .contenedor-donadores {
    margin: auto auto 40px auto;
    background: #faf9f7;
    height: 400px;
    text-align: center;
    font-size: 25px;
    font-family: "Poppins";
    padding: 20px;
    border-top: outset;
  }
  .imagenes {
    width: 200px;
    height: auto;
  }
  .row[data-v-40bca711] {
    margin: 15px 40px 40px 20px;
  }
}
</style>