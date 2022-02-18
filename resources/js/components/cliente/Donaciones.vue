<template>
<div class="wrapper">
 
  <section class="hero vertical-center">
    <div class="container text-center">
      <h1>Haz una donación.!</h1>
    </div>
    <div class="optional-rainbow"></div>
  </section>
  <section class="content">
    <div class="container">
      <article>
         <div class="intro" style="text-align:center;margin-bottom:50px;">
      <span class="glad">
        Su generosa donación y su continuo apoyo marcan una gran ayuda al<span class="matapalos">
        Sendero Los Matapalos</span>,<br />
        su aporte logra una gran contribución con la mejora y el mantenimiento
        del <span class="matapalos">sendero</span>.
        </span>
    </div>
        <div class="necesarios">
      <div class="contenedor1 card">
        <div class="card-body">
        <div class="site-heading text-center">
          
               <h2> <span>¿</span>Cómo Aportar<span>?</span></h2>
                
              </div>
          <h5 class="site-heading" style="line-height:32px">
            En la siguiente imagen puede observar algunas de las cosas que necesita el <span class="matapalos">sendero</span>, 
            puede colaborar donando ya sea un articulo de los que se muestan o 
            algo que usted crea que puede servir para el crecimiento del <span class="matapalos">sendero</span>.
          </h5>      
          <br /> 
          <h5 class="site-heading" style="line-height:32px">
            Si desea realizar otra donación distinta a las que se necesitan, se
            puede poner en contacto con los administradores.
          </h5>
          <br />  
          <h5 class="site-heading" style="text-align: center">
           <span class="matapalos"> Telefono</span>: 0000-0000 - <span class="matapalos"> Email</span>: sendero@una.ac.cr      
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
                  class=""
                   object-fit="cover" 
                  width="100%"
                  height="430px"
                  alt=""
                />
                <div class="carousel-caption d-none d-md-block">
                  <h1>¿Que se necesita?</h1>
                  <p>
                 Podés contribuir con algunas de las siguientes cosas.!
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
                  class=""
                   object-fit="cover" 
                  width="100%"
                 height="430px"
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
      </article>
    </div>
  </section>  
  <div class="container text-center">
      <h1>Haz una donación.!</h1>
    </div>

    <br>
<div class="contt">
 
<div class="carda" v-for="donativo in donativos.data" :key="donativo.id">

          <div class="content">
            <div class="img">
              <img
                  v-bind:src="
                    '/images/donativos/' + donativo.photo
                  "
                  class=""
                   object-fit="cover" 
                  width="100%"
                 height="100%"
                  alt=""
                />
              
            </div>
            <div class="details">
           
              <div class="job" >{{donativo.detalle}}</div>
            </div>
         
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
      donativosNecesarios: {},
      modDonativos:{},
    };
  },
  methods: {
  getResults(page = 1) {
      this.$Progress.start();
      axios
        .get("/api/donacionesCliente" + page)
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
@import url(https://fonts.googleapis.com/css?family=Work+Sans:400,300,200,700);
html, body {
  display: block;
  width: 100%;
  height: 100%;
}

h1, h2, p {
  font-family: "Work Sans", serif;
}

.wrapper {
  display: block;
  height: auto;
  position: relative;
  padding-bottom: 3em;
}

.fotoCar{
  width: 100%;
}

.hero {
  position: relative;
  height: 100%;
  width: 100%;
  background: url(https://dl.dropbox.com/s/9u786zwyehzuvam/cliffSide_mini.jpg?dl=1) no-repeat 50% 50% fixed;
  background-size: 200%;
  overflow: hidden;
}
.hero h1 {
  position: relative;
  z-index: 50;
  color: white;
  font-size: 80px;
  font-weight: 200;
}
.hero.fadeout .optional-rainbow {
  display: block;
}
.hero.fadeout:before {
  display: none;
}
.hero:before {
  display: block;
  position: absolute;
  height: 100%;
  width: 100%;
  z-index: 5;
  content: "";
  background: -webkit-linear-gradient(#fc5e9d, #352ce6, #30f89c);
  background: -moz-linear-gradient(left, #fc5e9d, #352ce6, #30f89c);
  background: linear-gradient(#fc5e9d, #352ce6, #30f89c);
  opacity: 0.4;
}
.hero:after {
  display: block;
  position: absolute;
  bottom: 0;
  left: 0;
  content: "";
  width: 100%;
  height: 3px;
  background: -webkit-linear-gradient(to left, #fc5e9d, #352ce6, #30f89c);
  background: -moz-linear-gradient(to left, #fc5e9d, #352ce6, #30f89c);
  background: linear-gradient(to left, #fc5e9d, #352ce6, #30f89c);
}
.hero .optional-rainbow {
  display: none;
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: -webkit-linear-gradient(#0f13df, #30ebf8, #30f89c);
  background: -moz-linear-gradient(#0f13df, #30ebf8, #30f89c);
  background: linear-gradient(#0f13df, #30ebf8, #30f89c); 
  opacity: 0.4;
  z-index: 4;
}

nav {
  position: absolute;
  top: 0;
  z-index: 20;
  width: 100%;
  color: white;
}
nav > .container {
  position: relative;
}
nav .navbar-brand {
  color: white;
  font-size: 26px;
}
nav .navbar-right {
  margin-right: 1em;
  position: absolute;
  right: 0;
}
nav > div {
  border-bottom: 1px solid rgba(255, 255, 255, 0.4);
}

article {
  padding: 3em 0;
  color: #545454;
  font-size: 18px;
}
article .article-right {
  max-width: 400px;
  margin: 0 auto;
}
@media (max-width: 767px) {
  article {
    text-align: center;
  }
  article img {
    margin-bottom: 2em;
   
  }
}
article p {
  margin: 2em 0;
}
article h2 {
  font-size: 54px;
  font-weight: 200;
  margin-top: 0;
  text-transform: uppercase;
}
article img {

   border-radius: 30 px;
}

.control {
  width: 100%;
  padding: 0.5em 1em;
  background: #e6e6e6;
  border-radius: 10px;
}

.selectable {
  display: block;
  position: relative;
  width: 40px;
  height: 20px;
  background: rgba(255, 44, 44, 0.6);
  border-radius: 10px;
  box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.2);
  transition: all 0.2s linear;
}
.selectable:before {
  display: block;
  position: absolute;
  content: "";
  width: 20px;
  height: 20px;
  border-radius: 50%;
  background: white;
  box-shadow: 0 2px 1px rgba(0, 0, 0, 0.2);
  top: 0;
  left: 0;
  transition: all 0.2s linear;
}
.selectable.on {
  background: rgba(44, 255, 44, 0.5);
}
.selectable.on:before {
  left: calc(100% - 20px);
}

.vertical-center {
  min-height: 50%;
  /* Fallback for browsers do NOT support vh unit */
  min-height: 50vh;
  /* These two lines are counted as one      */
  display: flex;
  align-items: center;
}


/*     AQUI EMPIEZA LAS CARD ANTIGUAS       */
.content{
  width: 100%;
}
.necesarios{
  display: flex;
  gap: 35px;
}
.contenedor1 {
  border-radius: 20px;
  margin-top: 30px;

  height: auto;

  margin: auto;
 object-fit: cover;
  width: 1200px;
}
.contenedor2 {
  border: 1.5px solid #1ece7c;
  border-radius: 20px;
  height: 800;
  width: 1500px;
 
  box-shadow: 2px 2px 2px 1px rgb(0 0 0 / 20%);
}
.site-heading h2  {
  display: block;
  font-weight: 510;
  font-size: 30px;
  margin-bottom: 10px;
  text-transform: uppercase;
}

.site-heading h2 span {
  color: #00a01d;
}
.matapalos{
  color: #00a01d;
}

.glad{
  font-size: 25px ;
  
}




/*-----------------------------------------*/

.contt{
  display: flex;
  justify-content: space-around;
}

 .carda .content .img {
  height: 130px;
  width: 130px;
  border-radius: 30px;
  padding: 3px;
  background: #034991d1;
  margin-bottom: 14px;
}

.carda .content .img img {
  height: 100%;
  width: 100%;
  border: 3px solid #ffff;
  border-radius:30px;
  object-fit: cover;
}

.carda .content .name {
  font-size: 20px;
  font-weight: 500;
}
.carda .content .job {
  font-size: 20px;
  color: #034991d1;
}


.carda .content .media-icons {
  margin-top: 10px;
  display: flex;
}


.contenedor .button {
  width: 100%;
  display: flex;
  justify-content: center;
  margin: 20px;
}
.job{

  text-align: center;
}
</style>