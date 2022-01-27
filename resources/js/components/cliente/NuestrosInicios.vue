<template>
  <div class="container">
    <section class="section--purple wow fadeInLeft" data-wow-duration="2s">
      <figure class="snip0057 blue">
        <figcaption>
          <h2>Nuestros <span>Inicios</span></h2>
          <p>
            La Universidad Nacional en su Campus Liberia, ha tenido una
            significativa regeneración y enriquecimiento biológico que se ha
            aprovechado para desarrollar un proyecto de sendero universitario
            llamado “Los Matapalos”, nombre que se deriva de la abundancia de
            esta especie y por los frondosos ejemplares que están en la entrada
            del sendero.
          </p>
          <p>
            El sendero Los Matapalos tuvo sus inicios alrededor del 2017 cuando
            a través de diferentes grupos y carreras que asumieron el reto de
            reforestar y comenzar a hacer estudios que permitieran un manejo
            adecuado y que a través de ellos se decidiera cual era el paso a
            seguir.
          </p>
          <p>
            El sendero Los Matapalos abrió oficialmente sus puertas desde el
            2019, y a la fecha le han visitado diferentes grupos de la comunidad
            e instituciones como el Colegio Agropecuario, Escuela Adventista,
            UCR de la provincia de Limón, adultos mayores, grupo de maestros
            pensionados de ADEP Liberia, entre otros. Este sendero surgió como
            un espacio de convivencia donde se le permitiera a la población
            estudiantil ser los intérpretes del sendero y mostrar a sus
            visitantes la importancia ambiental, cultural e histórica que éste
            tiene.
          </p>
          <!--<div class="icons">
          <a href="#"><i class="ion-ios-home"></i></a
          ><a href="#"><i class="ion-ios-email"></i></a
          ><a href="#"><i class="ion-ios-telephone"></i></a>
        </div>-->
        </figcaption>
        <div class="image">
          <img v-bind:src="'/images/aerea liberia.jpg'" alt="sample3" />
        </div>
        <div class="position">Sendero los Mataplos</div>
      </figure>
    </section>
  </div>
</template>


<style scoped>
@import url(https://fonts.googleapis.com/css?family=Raleway:400,200,300,800);
@import url(https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css);

.container {
  display: flex;
  margin-top: 10px;
  margin-block: 10px;
  flex-direction: row;
  flex-wrap: wrap;
  align-content: center;
  justify-content: center;
}
h2 {
  color: #4f4f4f;
  font-weight: 700;
}
span {
  color: #38ab81;
}
figure.snip0057 {
  position: relative;
  overflow: hidden;
  margin: 10px;
  width: 100%;
  background: #ffffff;
  color: #000000;
  min-height: 670px;
  max-height: 100%;
  border: 2px solid #38ab81;
  border-radius: 20px;
}
figure.snip0057 * {
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  -webkit-transition: all 0.35s ease-in-out;
  transition: all 0.35s ease-in-out;
}
figure.snip0057 .image {
  width: 50%;
  overflow: hidden;
  z-index: 1;
  -webkit-transform: skewX(-15deg);
  transform: skewX(5deg) translateX(-25px);
  min-height: 670px;
  max-height: 100%;
}
figure.snip0057 .image img {
  position: relative;
  display: block;
  left: -15%;
  z-index: 1;
  /* transform: skew(
15deg); */
  min-height: 670px;
  max-height: 100%;
  width: 107%;
}
figure.snip0057:before {
  position: absolute;
  content: "";
  height: 100%;
  width: 45%;
  background: rgba(0, 0, 0, 0.2);
  -webkit-transform: skewX(-17deg);
  transform: skewX(5deg) translateX(-25px);
  -webkit-box-shadow: 15px 0px 25px rgba(0, 0, 0, 0.7);
  box-shadow: 15px 0px 25px rgba(0, 0, 0, 0.7);
}
figure.snip0057 figcaption {
  padding: 20px 30px 20px 20px;
  position: absolute;
  right: 0;
  width: 50%;
}
figure.snip0057 figcaption h2,
figure.snip0057 figcaption p {
  margin: 0;
  text-align: justify;
  padding: 10px 0;
  width: 100%;
}
figure.snip0057 figcaption h2 {
  font-weight: 700;
  border-bottom: 1px solid rgba(0, 0, 0, 0.2);
}
figure.snip0057 figcaption h2 span {
  font-weight: 800;
}
figure.snip0057 figcaption p {
  font-size: 0.9em;
  opacity: 0.8;
}
figure.snip0057 figcaption .icons {
  width: 100%;
  text-align: right;
}
figure.snip0057 figcaption .icons i {
  font-size: 26px;
  padding: 5px;
  top: 50%;
  color: #000000;
  opacity: 0;
}
figure.snip0057 figcaption a {
  opacity: 0.3;
}
figure.snip0057 figcaption a:hover {
  opacity: 0.8;
}
figure.snip0057 .position {
  position: absolute;
  bottom: 0;
  width: 100%;
  text-align: right;
  padding: 15px 30px;
  font-size: 0.9em;
  opacity: 1;
  font-style: italic;
  color: #ffffff;
  background: #000000;
}
figure.snip0057.blue .position {
  background: #38ab81;
}
figure.snip0057.red .position {
  background: #962d22;
}
figure.snip0057.yellow .position {
  background: #bf6516;
}

figure.snip0057:hover .icons i,
figure.snip0057.hover .icons i {
  opacity: 1;
  -webkit-transition-delay: 0.2s;
  transition-delay: 0.2s;
}
figure.snip0057:hover:before,
figure.snip0057.hover:before {
  -webkit-animation: shadow 0.6s ease-in-out;
  animation: shadow 0.6s ease-in-out;
}
@-webkit-keyframes shadow {
  0% {
    left: 0px;
  }
  50% {
    left: -5px;
  }
  100% {
    left: 0px;
  }
}
@keyframes shadow {
  0% {
    left: 0px;
  }
  50% {
    left: -5px;
  }
  100% {
    left: 0px;
  }
}
@media only screen and (min-device-width: 375px) and (max-device-width: 900px) {
  figure.snip0057{
    margin: 0px;
        height: 1100px;
  }
  figure.snip0057::before {
    width: 0%;
  }
  figure.snip0057 .image {
    transform: skewX(0deg) translateX(0px);
    width: 100%;
  }
  figure.snip0057 figcaption {
    padding: 10px 10px 10px 10px;
    position: relative;
    /* right: 0; */
    width: 100%;
  }
  figure.snip0057 .image img {
    left: 0%;
    width: 100%;
    min-height: 400px;
  }
}
</style>