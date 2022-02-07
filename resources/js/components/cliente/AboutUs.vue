<template>
  <div class="datos">
    <h1 style="text-align: center">
      Acerca de <span style="color: #38ab81">nosotros</span>
    </h1>
    <div class="row">
      <div
        class="col-6 col-sm-4 wow fadeInLeft"
        data-wow-delay="0.1s"
        style="
          visibility: visible;
          -webkit-animation-delay: 0.1s;
          -moz-animation-delay: 0.1s;
          animation-delay: 0.1s;
        "
      >
        <div class="mision" style="margin-left: 2px">
          <h2><i class="fas fa-crosshairs"></i>Misión</h2>
          <p>
            “Aprender de la naturaleza todos los días para forjar valores
            biocéntricos en todas las personas que conviven en el Campus
            Liberia”.
          </p>
        </div>
      </div>
      <div
        class="col-6 col-sm-4 wow fadeInLeft"
        data-wow-delay="0.2s"
        style="
          visibility: visible;
          -webkit-animation-delay: 0.2s;
          -moz-animation-delay: 0.2s;
          animation-delay: 0.2s;
        "
      >
        <div class="vision">
          <h2><i class="far fa-eye"></i>Visión</h2>
          <p>
            Colaborar para que el Campus Liberia sea el mejor en materia de
            Sostenibilidad en Latinoamérica.
          </p>
        </div>
      </div>
      <div
        class="col-6 col-sm-4 wow fadeInLeft"
        data-wow-delay="0.3s"
        style="
          visibility: visible;
          -webkit-animation-delay: 0.3s;
          -moz-animation-delay: 0.3s;
          animation-delay: 0.3s;
        "
      >
        <div class="valores" style="margin-right: 2px">
          <h2><i class="fas fa-balance-scale"></i> Valores</h2>
          <li>Familia</li>
          <li>Amor</li>
          <li>Compañerismo</li>
          <li>Calidad</li>
          <li>Solidaridad</li>
          <li>Respeto</li>
          <li>Libertad</li>
        </div>
      </div>
    </div>

    <NuestroEsquipo></NuestroEsquipo>
    <Nosotros></Nosotros>
  </div>
</template>

<script>
import NuestroEsquipo from "../cliente/NuestroEquipo.vue";
import Nosotros from "../cliente/Nosotros.vue";

export default {
  components: {
    NuestroEsquipo: NuestroEsquipo,
    Nosotros: Nosotros,
  },

  data() {
    return {};
  },
};
</script>

<style scoped>
.datos {
  margin-top: 40px;
  background: transparent;
  padding: 0;
  animation-name: desplazar;
  animation-duration: 2s;
  opacity: 0;
  animation-fill-mode: forwards;
}

@keyframes desplazar {
  /*Creacion de la animacion, se establece el orden en que va a ocurrir los cambios*/
  0% {
    margin-top: 80px;
    opacity: 0;
  }
  50% {
    opacity: 0.5;
  }
  100% {
    margin-top: 40px;
    opacity: 1;
  }
}

.mision {
  text-align: justify;
  padding: 5%;
  background-color: rgb(255 255 255 / 15%);
  border-radius: 10px;
  font-family: "Poppins", sans-serif;
  margin-bottom: 3px;
  height: 300px;
  border: 1px solid #0000003b;
  box-shadow: 1px 1px 1px 1px #38ab81;
}
.fas,
.far {
  color: #38ab81;
}

.mision:hover {
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
  border: 0;
}

.mision > h2 {
  text-align: center;
}
.vision {
  text-align: justify;
  padding: 5%;
  background-color: rgb(255 255 255 / 15%);
  border-radius: 10px;
  font-family: "Poppins", sans-serif;
  margin-bottom: 3px;
  height: 300px;
  border: 1px solid #0000003b;
  box-shadow: 1px 1px 1px 1px #38ab81;
}

.vision:hover {
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
  border: 0;
}

.vision > h2 {
  text-align: center;
}
.valores {
  text-align: justify;
  padding: 5%;
  background-color: rgb(255 255 255 / 15%);
  border-radius: 10px;
  font-family: "Poppins", sans-serif;
  margin-bottom: 3px;
  height: 300px;
  border: 1px solid #0000003b;
  box-shadow: 1px 1px 1px 1px #38ab81;
}

.valores:hover {
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
  border: 0;
}
.valores > h2 {
  text-align: center;
}

.encargados p {
  margin-top: 150px;
}

.row {
  margin-top: 25px;
  margin-right: 15px;
  margin-left: 15px;
  margin-block: 10px;
}

/*Encargados*/
.row.encabezado h2 {
  color: rgba(255, 255, 255, 0.794);
  font-size: 52.52px;
  line-height: 95px;
  font-weight: 400;
  text-align: center;
  margin: 0 0 40px;
  padding-bottom: 20px;
  text-transform: uppercase;
}
ul {
  margin: 0;
  padding: 0;
  list-style: none;
}
.padding-lg {
  display: block;
  padding-top: 60px;
  padding-bottom: 60px;
}

@media (max-width: 768px) {
  img {
    width: 100%;
    height: auto;
  }
  .datos {
    margin-top: 150px;
  }
  .row {
    display: flex;
    flex-direction: column;
  }
  .col-6 {
    width: 100%;
  }
}
</style>