<template>
  <div style="background: #fff">
    <section class="marko" id="hero">
      <div class="promo">
        <dir class="marcont">
          <h1>#AprendemosDeLaNaturaleza</h1>
          <p>Sello <span>UNA</span></p>
        </dir>
      </div>

      <video muted autoplay loop>
        <source
          src="https://dl.dropbox.com/s/qajc97uh3rlzdn2/video.mp4?dl=0"
          type="Video/mp4"
        />
      </video>
      <div class="wave" style="height: 150px; bottom: -10px; overflow: hidden">
        <svg
          viewBox="0 0 500 150"
          preserveAspectRatio="none"
          style="height: 100%; width: 100%"
        >
          <path
            d="M0.00,49.98 C150.00,150.00 349.20,-50.00 500.00,49.98 L500.00,150.00 L0.00,150.00 Z"
            style="stroke: none; fill: rgb(255, 255, 255)"
          ></path>
        </svg>
      </div>

      <div class="capa"></div>
    </section>

    <main>
      <Actividades></Actividades>
      <section style="background: #f0f0f0; border-top: 2px solid #91aff3d1;" class="services-area section-padding">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-7 col-md-12 wow fadeInUp" data-wow-delay="0.3s">
              <div class="section-title text-center">
                <h2>Nuestros Servicios</h2>
                <p>
                  Nuestro sendero cuenta con diferentes servicios para el
                  publico general.
                </p>
              </div>
            </div>
          </div>
          <div class="row">
            <div
              class="col-lg-4 col-md-6 col-sm-6 wow fadeInUp"
              data-wow-delay="0.4s"
            >
              <div class="single-serviecs-block">
                <i class="fas fa-graduation-cap"></i>
                <h3>
                  <a href="services-details.html">Capacitaciones y Cursos</a>
                </h3>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                  do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
              </div>
            </div>
            <div
              class="col-lg-4 col-md-6 col-sm-6 wow fadeInUp"
              data-wow-delay="0.5s"
            >
              <div class="single-serviecs-block">
                <i class="fas fa-walking"></i>
                <h3><a href="services-details.html">Tours</a></h3>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                  do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
              </div>
            </div>
            <div
              class="col-lg-4 col-md-6 col-sm-6 wow fadeInUp"
              data-wow-delay="0.6s"
            >
              <div class="single-serviecs-block">
                <i class="fas fa-book"></i>
                <h3>
                  <a href="services-details.html"
                    >Educacion Ambiental a escuelas y colegios</a
                  >
                </h3>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                  do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>
      <div style="margin-top:30px">
      <Contacto></Contacto>
      </div>
      <section class="map">
        <div class="contenedor">
          <h2 class="titulo">Encuentranos</h2>
          <div class="map-cont">
            <div class="map-box">
              <!-- <img src="img/ilustracion4.svg" alt="">-->
              <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4697.277481346486!2d-85.45376162258393!3d10.617667351742492!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f757d3b9e5cff01%3A0x4139935881accb02!2sUniversidad%20Nacional!5e0!3m2!1sen!2scr!4v1631573581299!5m2!1sen!2scr"
                width="600"
                height="450"
                style="border: 0"
                allowfullscreen=""
                loading="lazy"
              ></iframe>
            </div>
          </div>
        </div>
      </section>
    </main>
  </div>
</template>
<script>
import Actividades from "../cliente/Actividades.vue";
import Contacto from "../cliente/Contacto.vue";

export default {
  components: {
    Actividades: Actividades,
    Contacto: Contacto,
  },
  data() {
    return {};
  },
};
</script>


<style scoped>
.contenedor {
    padding: 60px 0;
    width: 90%;
    max-width: 1000px;
    margin: auto;
    overflow: hidden;
    margin-top: 20px;
}
#hero{
    min-height: 60vh;
    position: relative;
   
}
video{
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.capa{
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: #0500059a ;
    opacity: 0.8;
    mix-blend-mode: overlay;
}
.marko{
  min-height: 70vh;
  height: 70vh;
  width: 100vw;

}
.promo{
padding-top: 10vh;
display: flex;
flex-direction: column;
justify-content: center;
align-items: center;
width: 50%;
margin: auto;

position: relative;
z-index: 15;
}
.promo h1{
  font-size: 2.0rem;
  text-align: center;
  color: #f3f3f3;
  font-weight: 500;
}
.promo p{
  font-size: 1.5rem;
  text-align: center;
  color: #fcfcfc;
  font-weight:500 ;
}
span{
  color: #920b0b;
  
  font-weight:700 ;
}
.marcont{
  background-color:rgba(0, 0, 0, 0.7) ;
position: relative;
z-index: 15;
padding: 30px;
border-radius: 30px;
}

.wave{
    position: absolute;
    bottom:-10;
    width: 100%;
    z-index: 10;
}
section {
            padding: 60px 0;
           /* min-height: 100vh;*/
        }

.section-padding {
    padding: 120px 0;
}

.section-title {
    margin-bottom: 50px;
}


.section-title h2 {
    font-size: 40px;
    line-height: 45px;
    position: relative;
    margin-bottom: 20px;
  color: #333333;
  text-transform: capitalize;
}

.services-area {
  margin-bottom: -30px;
}
.serviecs-block .single-serviecs-block {
    margin: 30px 0;
}
.single-serviecs-block {
    padding: 30px 40px;
    background-color: rgb(255, 255, 255);
    box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
    text-align: center;
    overflow: hidden;
    position: relative;
    display: block;
    height: 320px;
    margin-bottom: 30px;
}


.single-serviecs-block:hover {
    background: #1d54cc;
    color: #fff;
}
.single-serviecs-block:hover h3 a {
    color: #fff;
    margin-top: 180px;
}
.single-serviecs-block:hover p {
    display: none;
}
.single-serviecs-block:hover i {
    top: 50%;
    left: 50%;
    transform: translate(-50%, -90%);
    background: #fff;
    color: #007f9b;
    height: 100px;
    width: 100px;
    font-size: 40px;
    line-height: 100px; 
}
.single-serviecs-block h3 a {
    color: #333333;
    margin-bottom: 15px;
    margin-top: 80px;
    display: block;
    overflow: hidden;
    transition: 0.5s;
}

.single-serviecs-block i {
    color: #fff;
    font-size: 50px;
    height: 140px;
    width: 140px;
    line-height: 170px;
    text-align: center;
    background: #1d54cc;
    border-radius: 50%;
    position: absolute;
    top: -50px;
    left: 50%;
    transform: translateX(-50%);
    transition: 0.6s;
}

.map{
    background: #fff;
    padding-bottom: 30px;
}
.map-cont{
    display:flex;
    justify-content: space-evenly;
    align-items: center;
}
.map-box{
    display: flex;
    width:100%;
    border: 3px solid #034991;
    align-items: center;
    border-radius: 10px;
}
.map-box iframe{
    width: 100%;
    border-radius: 10px;
}

</style>