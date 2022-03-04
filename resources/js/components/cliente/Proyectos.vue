<template>
  <div>
    <div class="col-md-12">
      <div class="site-heading text-center">
        <h2>
          {{ $t("Nuestros") }} <span>{{ $t("Proyectos") }}</span>
        </h2>
      </div>
    </div>
    <!-- Slider -->
    <div id="slider">
      <div class="slides">
        <div class="slider">
          <div class="legend"></div>
          <div class="content">
            <div class="content-txt">
              <h1>{{ $t("Vivero") }}</h1>
              <h2>
                Nam ultrices pellentesque facilisis. In semper tellus mollis
                nisl pulvinar vitae vulputate lorem consequat. Fusce odio
                tortor, pretium sit amet auctor ut, ultrices vel nibh.
              </h2>
            </div>
          </div>
          <div class="image">
            <img src="images/vivero.jpg" />
          </div>
        </div>
        <div class="slider">
          <div class="legend"></div>
          <div class="content">
            <div class="content-txt">
              <h1>Arboretum</h1>
              <h2>
                Nam ultrices pellentesque facilisis. In semper tellus mollis
                nisl pulvinar vitae vulputate lorem consequat. Fusce odio
                tortor, pretium sit amet auctor ut, ultrices vel nibh.
              </h2>
            </div>
          </div>
          <div class="image">
            <img src="images/Arboretum.JPG" />
          </div>
        </div>
        <div class="slider">
          <div class="legend"></div>
          <div class="content">
            <div class="content-txt">
              <h1>{{ $t("Melipo") }}</h1>
              <h2>
               El proyecto de abejas inició en el 2016 con un Hotel de Abejas sin Aguijón (consolidado el 15 de octubre del 2016), por parte de la carrera Arte y Comunicación Visual como un proyecto de graduación. Al ser una carrera que se promocionó sólo una única vez como plan piloto, decide trasladar este proyecto al grupo de voluntariado del Campus, UNA Cultura Ambiental.
              </h2>
            </div>
          </div>
          <div class="image">
            <img src="images/Melipo.jpg" />
          </div>
        </div>
        <div class="slider">
          <div class="legend"></div>
          <div class="content">
            <div class="content-txt">
              <h1>{{ $t("Reservorio") }}</h1>
              <h2>
               El campus fue construido en un terreno con relieves topográficos relativamente planos y por lo general en la época lluviosa el agua tiende a estancarse muy poco, sin embargo al construir toda la infraestructura de techos el flujo de agua incrementaría, convirtiéndose en problemas de inundación, que para evitarse, se instaló un sistema de manejo de agua residual tipo pluvial que consta de un sistema de captación de aguas de lluvia  (techos), conducción (drenajes), almacenamiento  (tanques subsuperficiales) y evacuación (sistema de bombeo). Las aguas son desviadas a un drenaje natural tipo acequia que drena hacia la calle pública. 
              </h2>
            </div>
          </div>
          <div class="image">
            <img src="images/Reservorio.JPG" />
          </div>
        </div>
      </div>
      <div class="switch">
        <ul>
          <li>
            <div class="on"></div>
          </li>
          <li></li>
          <li></li>
          <li></li>
        </ul>
      </div>
    </div>
  </div>
</template>

<style scoped>
.site-heading h2 span {
  color: #00a01d;
}
#slider {
  width: 85%;
  height: 600px;
  position: relative;
  overflow: hidden;
  margin: auto;
}
@keyframes load {
  from {
    left: -100%;
  }
  to {
    left: 0;
  }
}
.slides {
  width: 400%;
  height: 100%;
  position: relative;
  -webkit-animation: slide 30s infinite;
  -moz-animation: slide 30s infinite;
  animation: slide 30s infinite;
  border-radius: 30px;
}
.slider {
  width: 25%;
  height: 100%;
  float: left;
  position: relative;
  z-index: 1;
  overflow: hidden;
}
.slide img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.slide img {
  width: 100%;
  height: 100%;
}
.image {
  width: 100%;
  height: 100%;
}
.image img {
  top: 15px;
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 30px;
}

/* Legend */
.legend {
  border: 500px solid transparent;
  border-left: 800px solid rgba(52, 73, 94, 0.7);
  border-bottom: 0;
  position: absolute;
  bottom: 0;
}

/* Contents */
.content {
  width: 100%;
  height: 100%;
  position: absolute;
  overflow: hidden;
}
.content-txt {
  width: 400px;
  height: 150px;
  float: left;
  position: relative;
  top: 300px;
  -webkit-animation: content-s 7.5s infinite;
  -moz-animation: content-s 7.5s infinite;
  animation: content-s 7.5s infinite;
}
.content-txt h1 {
  font-family: Arial;
  text-transform: uppercase;
  font-size: 24px;
  color: #fff;
  text-align: left;
  margin-left: 30px;
  padding-bottom: 10px;
}
.content-txt h2 {
  font-family: arial;
  font-weight: normal;
  font-size: 14px;
  font-style: italic;
  color: #fff;
  text-align: left;
  margin-left: 30px;
}

/* Switch */
.switch {
  width: 120px;
  height: 10px;
  position: absolute;
  bottom: 50px;
  z-index: 99;
  left: 30px;
}
.switch > ul {
  list-style: none;
}
.switch > ul > li {
  width: 10px;
  height: 10px;
  border-radius: 50%;
  background: #333;
  float: left;
  margin-right: 5px;
  cursor: pointer;
}
.switch ul {
  overflow: hidden;
}
.on {
  width: 100%;
  height: 100%;
  border-radius: 50%;
  background: #f39c12;
  position: relative;
  -webkit-animation: on 30s infinite;
  -moz-animation: on 30s infinite;
  animation: on 30s infinite;
}

/* Animation */
@-webkit-keyframes slide {
  0%,
  100% {
    margin-left: 0%;
  }
  21% {
    margin-left: 0%;
  }
  25% {
    margin-left: -100%;
  }
  46% {
    margin-left: -100%;
  }
  50% {
    margin-left: -200%;
  }
  71% {
    margin-left: -200%;
  }
  75% {
    margin-left: -300%;
  }
  96% {
    margin-left: -300%;
  }
}
@-moz-keyframes slide {
  0%,
  100% {
    margin-left: 0%;
  }
  21% {
    margin-left: 0%;
  }
  25% {
    margin-left: -100%;
  }
  46% {
    margin-left: -100%;
  }
  50% {
    margin-left: -200%;
  }
  71% {
    margin-left: -200%;
  }
  75% {
    margin-left: -300%;
  }
  96% {
    margin-left: -300%;
  }
}
@keyframes slide {
  0%,
  100% {
    margin-left: 0%;
  }
  21% {
    margin-left: 0%;
  }
  25% {
    margin-left: -100%;
  }
  46% {
    margin-left: -100%;
  }
  50% {
    margin-left: -200%;
  }
  71% {
    margin-left: -200%;
  }
  75% {
    margin-left: -300%;
  }
  96% {
    margin-left: -300%;
  }
}

@-webkit-keyframes content-s {
  0% {
    left: -420px;
  }
  10% {
    left: 0px;
  }
  30% {
    left: 0px;
  }
  40% {
    left: 0px;
  }
  50% {
    left: 0px;
  }
  60% {
    left: 0px;
  }
  70% {
    left: 0;
  }
  80% {
    left: -420px;
  }
  90% {
    left: -420px;
  }
  100% {
    left: -420px;
  }
}
@-moz-keyframes content-s {
  0% {
    left: -420px;
  }
  10% {
    left: 0px;
  }
  30% {
    left: 0px;
  }
  40% {
    left: 0px;
  }
  50% {
    left: 0px;
  }
  60% {
    left: 0px;
  }
  70% {
    left: 0;
  }
  80% {
    left: -420px;
  }
  90% {
    left: -420px;
  }
  100% {
    left: -420px;
  }
}
@keyframes content-s {
  0% {
    left: -420px;
  }
  10% {
    left: 20px;
  }
  15% {
    left: 0px;
  }
  30% {
    left: 0px;
  }
  40% {
    left: 0px;
  }
  50% {
    left: 0px;
  }
  60% {
    left: 0px;
  }
  70% {
    left: 0;
  }
  80% {
    left: -420px;
  }
  90% {
    left: -420px;
  }
  100% {
    left: -420px;
  }
}

@-webkit-keyframes on {
  0%,
  100% {
    margin-left: 0%;
  }
  21% {
    margin-left: 0%;
  }
  25% {
    margin-left: 15px;
  }
  46% {
    margin-left: 15px;
  }
  50% {
    margin-left: 30px;
  }
  71% {
    margin-left: 30px;
  }
  75% {
    margin-left: 45px;
  }
  96% {
    margin-left: 45px;
  }
}

@-moz-keyframes on {
  0%,
  100% {
    margin-left: 0%;
  }
  21% {
    margin-left: 0%;
  }
  25% {
    margin-left: 15px;
  }
  46% {
    margin-left: 15px;
  }
  50% {
    margin-left: 30px;
  }
  71% {
    margin-left: 30px;
  }
  75% {
    margin-left: 45px;
  }
  96% {
    margin-left: 45px;
  }
}

@keyframes on {
  0%,
  100% {
    margin-left: 0%;
  }
  21% {
    margin-left: 0%;
  }
  25% {
    margin-left: 15px;
  }
  46% {
    margin-left: 15px;
  }
  50% {
    margin-left: 30px;
  }
  71% {
    margin-left: 30px;
  }
  75% {
    margin-left: 45px;
  }
  96% {
    margin-left: 45px;
  }
}
@media screen and (max-width: 900px) {
  .content-txt {
    width: 300px;
  }
}
</style>