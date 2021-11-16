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
      <Inicios></Inicios>
      
      <section class="we-offer-area text-center bg-gray">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="site-heading text-center">
                <h2>¿Que ofrece nuestro <span>Sendero</span>?</h2>
              </div>
            </div>
          </div>
          <div class="row our-offer-items less-carousel">
            <div class="col-md-4 col-sm-6 equal-height">
              <div class="item">
                <i class="fas fa-chalkboard-teacher"></i>
                <h4>Capacitaciones y Cursos</h4>
                <p>
                  El Sendero Los Matapalos cuenta con una amplia variedad de
                  cursos referentes al ambiente y su cuidado al igual que una
                  amplia lista de capacitaciones ambientales
                </p>
              </div>
            </div>

            <div class="col-md-4 col-sm-6 equal-height">
              <div class="item">
                <i class="fas fa-walking"></i>
                <h4>Tours</h4>
                <p>
                  El Sendero Los Matapalos cuenta con una amplia variedad de
                  cursos referentes al ambiente y su cuidado al igual que una
                  amplia lista de capacitaciones ambientales
                </p>
              </div>
            </div>

            <div class="col-md-4 col-sm-6 equal-height">
              <div class="item">
                <i class="fas fa-book"></i>
                <h4>Educacion ambiental</h4>
                <p>
                  El Sendero Los Matapalos cuenta con una amplia variedad de
                  cursos referentes al ambiente y su cuidado al igual que una
                  amplia lista de capacitaciones ambientales
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>
      <Proyectos></Proyectos>
      <Actividades></Actividades>
      <div style="margin-top: 30px">
        <Contacto></Contacto>
      </div>
      <section class="map">
        <div class="contenedor">
          <h2 style="text-align: center" class="titulo">Encuentranos</h2>
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
import Inicios from "../cliente/NuestrosInicios.vue";
import Proyectos from "../cliente/Proyectos.vue";

export default {
  components: {
    Actividades: Actividades,
    Contacto: Contacto,
    Inicios: Inicios,
    Proyectos: Proyectos,
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
#hero {
  min-height: 60vh;
  position: relative;
}
video {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.capa {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: #0500059a;
  opacity: 0.8;
  mix-blend-mode: overlay;
}
.marko {
  min-height: 70vh;
  height: 70vh;
  width: 100%;
}
.promo {
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
.promo h1 {
  font-size: 2rem;
  text-align: center;
  color: #f3f3f3;
  font-weight: 500;
}
.promo p {
  font-size: 1.5rem;
  text-align: center;
  color: #fcfcfc;
  font-weight: 500;
}
span {
  color: #920b0b;

  font-weight: 700;
}
.marcont {
  background-color: rgba(0, 0, 0, 0.7);
  position: relative;
  z-index: 15;
  padding: 30px;
  border-radius: 30px;
}

.wave {
  position: absolute;
  bottom: -10;
  width: 100%;
  z-index: 10;
}
section {
  padding: 60px 0;
  /* min-height: 100vh;*/
}
section {
  padding: 60px 0;
}
a,
a:hover,
a:focus,
a:active {
  text-decoration: none;
  outline: none;
}
ul {
  margin: 0;
  padding: 0;
  list-style: none;
}
.bg-gray {
  background-color: #f9f9f9;
}

.site-heading h2 {
  display: block;
  font-weight: 700;
  margin-bottom: 10px;
}

.site-heading h2 span {
  color: #38ab81;
}

.site-heading h4 {
  display: inline-block;
  padding-bottom: 20px;
  position: relative;
  text-transform: capitalize;
  z-index: 1;
}

.site-heading h4::before {
  background: #38ab81 none repeat scroll 0 0;
  bottom: 0;
  content: "";
  height: 2px;
  left: 50%;
  margin-left: -25px;
  position: absolute;
  width: 50px;
}

.site-heading {
  margin-bottom: 60px;
  overflow: hidden;
  margin-top: -5px;
}

.carousel-shadow .owl-stage-outer {
  margin: -15px -15px 0;
  padding: 15px;
}

.we-offer-area .our-offer-carousel .owl-dots .owl-dot span {
  background: #ffffff none repeat scroll 0 0;
  border: 2px solid;
  height: 15px;
  margin: 0 5px;
  width: 15px;
}

.we-offer-area .our-offer-carousel .owl-dots .owl-dot.active span {
  background: #38ab81 none repeat scroll 0 0;
  border-color: #38ab81;
}

.we-offer-area .item {
  background: #ffffff none repeat scroll 0 0;
  border-left: 2px solid #38ab81;
  -moz-box-shadow: 0 0 10px #cccccc;
  -webkit-box-shadow: 0 0 10px #cccccc;
  -o-box-shadow: 0 0 10px #cccccc;
  box-shadow: 0 0 10px #cccccc;
  overflow: hidden;
  padding: 30px;
  position: relative;
  z-index: 1;
}

.we-offer-area.text-center .item {
  background: #ffffff none repeat scroll 0 0;
  border: medium none;
  padding: 67px 40px 64px;
  border-radius: 20px;
}

p {
  text-align: justify;
}

.we-offer-area.text-center .item i {
  background: #38ab81 none repeat scroll 0 0;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  border-radius: 50%;
  color: #ffffff;
  font-size: 40px;
  height: 80px;
  line-height: 80px;
  position: relative;
  text-align: center;
  width: 80px;
  z-index: 1;
  transition: all 0.35s ease-in-out;
  -webkit-transition: all 0.35s ease-in-out;
  -moz-transition: all 0.35s ease-in-out;
  -ms-transition: all 0.35s ease-in-out;
  -o-transition: all 0.35s ease-in-out;
  margin-bottom: 25px;
}

.we-offer-area.text-center .item i::after {
  border: 2px solid #38ab81;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  border-radius: 50%;
  content: "";
  height: 90px;
  left: -5px;
  position: absolute;
  top: -5px;
  width: 90px;
  z-index: -1;
  transition: all 0.35s ease-in-out;
  -webkit-transition: all 0.35s ease-in-out;
  -moz-transition: all 0.35s ease-in-out;
  -ms-transition: all 0.35s ease-in-out;
  -o-transition: all 0.35s ease-in-out;
}

.we-offer-area.item-border-less .item {
  border: medium none;
}

.we-offer-area .our-offer-items.less-carousel .equal-height {
  margin-bottom: 30px;
}

.we-offer-area.item-border-less .item .number {
  font-family: "Poppins", sans-serif;
  font-size: 50px;
  font-weight: 900;
  opacity: 0.1;
  position: absolute;
  right: 30px;
  top: 30px;
}

.our-offer-carousel.center-active .owl-item:nth-child(2n) .item,
.we-offer-area.center-active .single-item:nth-child(2n) .item {
  background: #38ab81 none repeat scroll 0 0;
}

.our-offer-carousel.center-active .owl-item:nth-child(2n) .item i,
.our-offer-carousel.center-active .owl-item:nth-child(2n) .item h4,
.our-offer-carousel.center-active .owl-item:nth-child(2n) .item p,
.we-offer-area.center-active .single-item:nth-child(2n) .item i,
.we-offer-area.center-active .single-item:nth-child(2n) .item h4,
.we-offer-area.center-active .single-item:nth-child(2n) .item p {
  color: #ffffff;
}

.we-offer-area .item i {
  color: #38ab81;
  display: inline-block;
  font-size: 60px;
  margin-bottom: 20px;
}

.we-offer-area .item h4 {
  font-weight: 600;
  text-transform: capitalize;
}

.we-offer-area .item p {
  margin: 0;
}

.we-offer-area .item i,
.we-offer-area .item h4,
.we-offer-area .item p {
  transition: all 0.35s ease-in-out;
  -webkit-transition: all 0.35s ease-in-out;
  -moz-transition: all 0.35s ease-in-out;
  -ms-transition: all 0.35s ease-in-out;
  -o-transition: all 0.35s ease-in-out;
}

.we-offer-area .item::after {
  background: #38ab81 none repeat scroll 0 0;
  content: "";
  height: 100%;
  left: -100%;
  position: absolute;
  top: 0;
  transition: all 0.35s ease-in-out;
  -webkit-transition: all 0.35s ease-in-out;
  -moz-transition: all 0.35s ease-in-out;
  -ms-transition: all 0.35s ease-in-out;
  -o-transition: all 0.35s ease-in-out;
  width: 100%;
  z-index: -1;
}

.we-offer-area .item:hover::after {
  left: 0;
}

.we-offer-area .item:hover i,
.we-offer-area .item:hover h4,
.we-offer-area .item:hover p {
  color: #ffffff !important;
}

.we-offer-area.text-center .item:hover i::after {
  border-color: #ffffff !important;
}

.we-offer-area.text-center .item:hover i {
  background-color: #ffffff !important;
  color: #38ab81 !important;
}

.we-offer-area.text-left .item i {
  background: #38ab81 none repeat scroll 0 0;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  border-radius: 50%;
  color: #ffffff;
  display: inline-block;
  font-size: 60px;
  height: 100px;
  line-height: 100px;
  margin-bottom: 30px;
  position: relative;
  width: 100px;
  z-index: 1;
  text-align: center;
}

.we-offer-area.text-left .item i::after {
  border: 2px solid #38ab81;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  border-radius: 50%;
  content: "";
  height: 120px;
  left: -10px;
  position: absolute;
  top: -10px;
  width: 120px;
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

.map {
  background: #fff;
  padding-bottom: 30px;
}
.map-cont {
  display: flex;
  justify-content: space-evenly;
  align-items: center;
}
.map-box {
  display: flex;
  width: 100%;
  border: 3px solid #034991;
  align-items: center;
  border-radius: 10px;
}
.map-box iframe {
  width: 100%;
  border-radius: 10px;
}
</style>