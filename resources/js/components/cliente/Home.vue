<template>
  <div style="background: #fff">
    <header style="margin-top: 250px;">
      <section class="textos-header">
        <h1>Sendero Los Matapalos</h1>
        <h2>Estamos encantados de recibirle</h2>
        <img v-bind:key="image" v-for="image in image17" :src="image.url" />
      </section>
      <div class="wave" style="height: 150px; overflow: hidden">
        <svg
          viewBox="0 0 500 150"
          preserveAspectRatio="none"
          style="height: 100%; width: 100%"
        >
          <path
            d="M0.00,49.98 C150.00,150.00 349.20,-50.00 500.00,49.98 L500.00,150.00 L0.00,150.00 Z"
            style="stroke: none; fill: #fff"
          ></path>
        </svg>
      </div>
    </header>
    <main>
      <section class="contenedor sobre-nosotros">
        <h2 class="titulo">Titulo</h2>
        <div class="contenedor-sobre-nosotros">
          <!-- <img src="img/ilustracion2.svg" alt="" class="imagen-about-us">-->
          <img
            class="imagen-about-us"
            v-bind:key="image"
            v-for="image in image6"
            :src="image.url"
          />
          <div class="contenido-textos">
            <h3><span>1</span>Titulo texto</h3>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt
              veniam eius aspernatur ad consequuntur aperiam minima sed dicta
              odit numquam sapiente quam eum, architecto animi pariatur, velit
              doloribus laboriosam ut.
            </p>
            <h3><span>2</span>Titulo texto</h3>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt
              veniam eius aspernatur ad consequuntur aperiam minima sed dicta
              odit numquam sapiente quam eum, architecto animi pariatur, velit
              doloribus laboriosam ut.
            </p>
          </div>
        </div>
      </section>
      <section class="portafolio">
        <div class="contenedor">
          <h2 class="titulo">Portafolio</h2>
          <div class="galeria-port">
            <div class="imagen-port">
              <!--  <img src="img/img1.jpg" alt="">-->
              <img
                v-bind:key="image"
                v-for="image in image9"
                :src="image.url"
              />
              <div class="hover-galeria">
                <!-- <img src="img/icono1.png" alt="">-->
                <img
                  v-bind:key="image"
                  v-for="image in image4"
                  :src="image.url"
                />
                <p>Nuestro trabajo</p>
              </div>
            </div>
            <div class="imagen-port">
              <!-- <img src="img/img2.jpg" alt="">-->
              <img
                v-bind:key="image"
                v-for="image in image10"
                :src="image.url"
              />
              <div class="hover-galeria">
                <!-- <img src="img/icono1.png" alt="">-->
                <img
                  v-bind:key="image"
                  v-for="image in image4"
                  :src="image.url"
                />
                <p>Nuestro trabajo</p>
              </div>
            </div>
            <div class="imagen-port">
              <!-- <img src="img/img3.jpg" alt="">-->
              <img
                v-bind:key="image"
                v-for="image in image11"
                :src="image.url"
              />
              <div class="hover-galeria">
                <!--   <img src="img/icono1.png" alt="">-->
                <img
                  v-bind:key="image"
                  v-for="image in image4"
                  :src="image.url"
                />
                <p>Nuestro trabajo</p>
              </div>
            </div>
            <div class="imagen-port">
              <!--<img src="img/img1.jpg" alt="">-->
              <img
                v-bind:key="image"
                v-for="image in image9"
                :src="image.url"
              />
              <div class="hover-galeria">
                <!-- <img src="img/icono1.png" alt="">-->
                <img
                  v-bind:key="image"
                  v-for="image in image4"
                  :src="image.url"
                />
                <p>Nuestro trabajo</p>
              </div>
            </div>
            <div class="imagen-port">
              <!-- <img src="img/img4.jpg" alt="">-->
              <img
                v-bind:key="image"
                v-for="image in image12"
                :src="image.url"
              />
              <div class="hover-galeria">
                <!-- <img src="img/icono1.png" alt="">-->
                <img
                  v-bind:key="image"
                  v-for="image in image4"
                  :src="image.url"
                />
                <p>Nuestro trabajo</p>
              </div>
            </div>
            <div class="imagen-port">
              <!-- <img src="img/img5.jpg" alt="">-->
              <img
                v-bind:key="image"
                v-for="image in image13"
                :src="image.url"
              />
              <div class="hover-galeria">
                <!-- <img src="img/icono1.png" alt="">-->
                <img
                  v-bind:key="image"
                  v-for="image in image4"
                  :src="image.url"
                />
                <p>Nuestro trabajo</p>
              </div>
            </div>
            <div class="imagen-port">
              <!-- <img src="img/img6.jpg" alt="">-->
              <img
                v-bind:key="image"
                v-for="image in image14"
                :src="image.url"
              />
              <div class="hover-galeria">
                <!--  <img src="img/icono1.png" alt="">-->
                <img
                  v-bind:key="image"
                  v-for="image in image4"
                  :src="image.url"
                />
                <p>Nuestro trabajo</p>
              </div>
            </div>
            <div class="imagen-port">
              <!-- <img src="img/img7.jpg" alt="">-->
              <img
                v-bind:key="image"
                v-for="image in image15"
                :src="image.url"
              />
              <div class="hover-galeria">
                <!--  <img src="img/icono1.png" alt="">-->
                <img
                  v-bind:key="image"
                  v-for="image in image4"
                  :src="image.url"
                />
                <p>Nuestro trabajo</p>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="clientes contenedor">
        <h2 class="titulo">titulo</h2>
        <div class="cards">
          <div class="card">
            <!-- <img src="img/face1.jpg" alt="">-->
            <img v-bind:key="image" v-for="image in image2" :src="image.url" />
            <div class="contenido-texto-card">
              <h4>Name</h4>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae,
                sapiente!
              </p>
            </div>
          </div>
          <div class="card">
            <!-- <img src="img/face2.jpg" alt="">-->
            <img v-bind:key="image" v-for="image in image3" :src="image.url" />
            <div class="contenido-texto-card">
              <h4>Name</h4>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae,
                sapiente!
              </p>
            </div>
          </div>
        </div>
      </section>
      <section class="about-services">
        <div class="contenedor">
          <h2 class="titulo">Nuestros servicios</h2>
          <div class="servicio-cont">
            <div class="servicio-ind">
              <!--<img src="img/ilustracion1.svg" alt="">-->
              <img
                v-bind:key="image"
                v-for="image in image5"
                :src="image.url"
              />
              <h3>Name</h3>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore,
                qui?
              </p>
            </div>
            <div class="servicio-ind">
              <!-- <img src="img/ilustracion4.svg" alt="">-->
              <img
                v-bind:key="image"
                v-for="image in image8"
                :src="image.url"
              />
              <h3>Name</h3>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore,
                qui?
              </p>
            </div>
            <div class="servicio-ind">
              <!-- <img src="img/ilustracion3.svg" alt=""> -->
              <img
                v-bind:key="image"
                v-for="image in image7"
                :src="image.url"
              />
              <h3>Name</h3>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore,
                qui?
              </p>
            </div>
          </div>
        </div>
      </section>
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
    <footer>
      <div class="contenedor-footer">
        <div class="content-foo">
          <h4>Phone</h4>
          <p>0000-0000</p>
        </div>
        <div class="content-foo">
          <h4>Email</h4>
          <p>sendero@una.ac.cr</p>
        </div>
        <div class="content-foo">
          <h4>Location</h4>
          <p>
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fuga, cum?
          </p>
        </div>
      </div>
    </footer>
  </div>
</template>
<script>
export default {
  data() {
    return {
      image1: [
        {
          url: "../images/alexcgdesign.png",
        },
      ],
      image2: [
        {
          url: "../images/bird2.jpg",
        },
      ],
      image3: [
        {
          url: "../images/bird3.jpg",
        },
      ],
      image4: [
        {
          url: "../images/icono1.png",
        },
      ],
      image5: [
        {
          url: "../images/ilustracion1.svg",
        },
      ],
      image6: [
        {
          url: "../images/ilustracion2.svg",
        },
      ],
      image7: [
        {
          url: "../images/ilustracion3.svg",
        },
      ],
      image8: [
        {
          url: "../images/ilustracion4.svg",
        },
      ],
      image9: [
        {
          url: "../images/img1.jpg",
        },
      ],
      image10: [
        {
          url: "../images/img2.jpg",
        },
      ],
      image11: [
        {
          url: "../images/img3.jpg",
        },
      ],
      image12: [
        {
          url: "../images/img4.jpg",
        },
      ],
      image13: [
        {
          url: "../images/img5.jpg",
        },
      ],
      image14: [
        {
          url: "../images/img6.jpg",
        },
      ],
      image15: [
        {
          url: "../images/img7.jpg",
        },
      ],
      image16: [
        {
          url: "../images/img8.jpg",
        },
      ],
      image17: [
        {
          url: "../images/portada.jpg",
        },
      ],
    };
  },
};
</script>
<style scoped>
header {
  width: 100%;
  height: 300px;

  background: hsla(155, 95%, 50%, 0.459);
  /* fallback for old browsers */
  background: -webkit-linear-gradient(
    to right,
    hsla(155, 95%, 50%, 0.459),
    hsla(216, 45%, 52%, 0.664)
  );
  /* Chrome 10-25, Safari 5.1-6 */
  background: linear-gradient(
    to right,
    hsla(155, 95%, 50%, 0.459),
    hsla(216, 45%, 52%, 0.664)
  );
  /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
  background-size: cover;
  background-attachment: fixed;
  position: relative;
 
  margin-bottom: 0;
}
header .textos-header {
  display: flex;
  height: 100px;
  width: 100%;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  text-align: center;
  position: relative;
  top: -60px;
  margin-bottom: 0;
}

.textos-header h1 {
  font-size: 60px;
  color: #fff;
  text-shadow: 5px 5px 5px #000;
  z-index: 20;
}

.textos-header h2 {
  font-size: 30px;
  font-weight: 300;
  color: #fff;
  text-shadow: 5px 5px 5px #000;
  z-index: 20;
}

.wave {
  position: absolute;
  bottom: 0;
  width: 100%;
  z-index: 10;
}
.textos-header img {
  opacity: 0.5;
  position: absolute;
  z-index: 0;
  width: 100%;
  height: 500px;
  object-fit: cover;
}
.contenedor {
  padding: 60px 0;
  width: 90%;
  max-width: 1000px;
  margin: auto;
  overflow: hidden;
}

.titulo {
  color: #034991;
  font-size: 30px;
  text-align: center;
  margin-bottom: 60px;
}

/* Header */

/* About us */

main .sobre-nosotros {
  padding: 20px 0 60px 0;
}
.contenedor-sobre-nosotros {
  display: flex;
  justify-content: space-evenly;
  margin-top: 0;
}

.imagen-about-us {
  width: 48%;
}

.sobre-nosotros .contenido-textos {
  width: 48%;
}

.contenido-textos h3 {
  margin-bottom: 15px;
}

.contenido-textos h3 span {
  background: #034991;
  color: #fff;
  border-radius: 50%;
  display: inline-block;
  text-align: center;
  width: 30px;
  height: 30px;
  padding: 2px;
  box-shadow: 0 0 6px 0 rgba(0, 0, 0, 0.5);
  margin-right: 5px;
}

.contenido-textos p {
  padding: 0px 0px 30px 15px;
  font-weight: 300;
  text-align: justify;
}

/* Galeria */

.portafolio {
  background: #f2f2f2;
}

.galeria-port {
  display: flex;
  justify-content: space-evenly;
  flex-wrap: wrap;
}

.imagen-port {
  width: 24%;
  margin-bottom: 10px;
  overflow: hidden;
  position: relative;
  cursor: pointer;
  box-shadow: 0 0 6px 0 rgba(0, 0, 0, 0.5);
}

.imagen-port > img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}

.hover-galeria {
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  transform: scale(0);
  background: #034991;
  opacity: 0.7;
  transition: transform 0.5s;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}

.hover-galeria img {
  width: 50px;
}

.hover-galeria p {
  color: #fff;
}

.imagen-port:hover .hover-galeria {
  transform: scale(1);
}

/* Clients */

.cards {
  display: flex;
  justify-content: space-evenly;
}

.cards .card {
  background: #034991;
  display: flex;
  width: 46%;
  height: 400px;
  align-items: center;
  justify-content: space-evenly;
  border-radius: 5px;
  box-shadow: 0 0 6px 0 rgba(0, 0, 0, 0.6);
}

.cards .card img {
  width: 100px;
  height: 100px;
  object-fit: cover;
  border: 3px solid #fff;
  border-radius: 50%;
  display: block;
}

.cards .card > .contenido-texto-card {
  width: 60%;
  color: #fff;
}

.cards .card > .contenido-texto-card p {
  font-weight: 300;
  padding-top: 5px;
}

/*  Our team */

.about-services {
  background: #f2f2f2;
  padding-bottom: 30px;
}

.servicio-cont {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.servicio-ind {
  width: 28%;
  text-align: center;
}

.servicio-ind img {
  width: 90%;
}

.servicio-ind h3 {
  margin: 10px 0;
}

.servicio-ind p {
  font-weight: 300;
  text-align: justify;
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
/* footer */

footer {
  background: #034991;
  padding: 60px 0 30px 0;
  margin: auto;
  overflow: hidden;
}

.contenedor-footer {
  display: flex;
  width: 90%;
  justify-content: space-evenly;
  margin: auto;
  padding-bottom: 50px;
  border-bottom: 1px solid #ccc;
}

.content-foo {
  text-align: center;
}

.content-foo h4 {
  color: #fff;
  border-bottom: 3px solid #cd1719;
  padding-bottom: 5px;
  margin-bottom: 10px;
}

.content-foo p {
  color: #ccc;
}

.titulo-final {
  text-align: center;
  font-size: 24px;
  margin: 20px 0 0 0;
  color: #9e9797;
}

@media screen and (max-width: 900px) {
  header {
    background-position: center;
  }

  .contenedor-sobre-nosotros {
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }

  .sobre-nosotros .contenido-textos {
    width: 90%;
  }

  .imagen-about-us {
    width: 90%;
  }

  /* Galeria */

  .imagen-port {
    width: 44%;
  }

  /* Clientes */

  .cards {
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }

  .cards .card {
    width: 90%;
  }

  .cards .card:first-child {
    margin-bottom: 30px;
  }

  /* servicios */

  .servicio-cont {
    justify-content: center;
    flex-direction: column;
  }

  .servicio-ind {
    width: 100%;
    text-align: center;
  }

  .servicio-ind:nth-child(1),
  .servicio-ind:nth-child(2) {
    margin-bottom: 60px;
  }

  .servicio-ind img {
    width: 90%;
  }
}
@media screen and (max-width: 500px) {
  .textos-header h1 {
    font-size: 35px;
  }

  .textos-header h2 {
    font-size: 20px;
  }

  /* ABOUT US */

  .imagen-about-us {
    margin-bottom: 60px;
    width: 99%;
  }

  .sobre-nosotros .contenido-textos {
    width: 95%;
  }

  /* Galeria */

  .imagen-port {
    width: 95%;
  }

  /* Clients */

  .cards .card {
    height: 450px;
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .cards .card img {
    width: 90px;
    height: 90px;
  }

  /* Footer */

  .contenedor-footer {
    flex-direction: column;
    border: none;
  }

  .content-foo {
    margin-bottom: 20px;
    text-align: center;
  }

  .content-foo h4 {
    border: none;
  }

  .content-foo p {
    color: #ccc;
    border-bottom: 1px solid #f2f2f2;
    padding-bottom: 20px;
  }

  .titulo-final {
    font-size: 20px;
  }
}
</style>