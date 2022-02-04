<template>
  <div id="container" class="contenedor">
    <div class="wow fadeInUp" data-wow-duration="2s">
      <div class="col-md-12">
        <div class="site-heading text-center">
          <h1 style="text-align: center">
            Nuestros <span style="color: #38ab81">Productos</span>
          </h1>
        </div>
      </div>
    </div>

    <section>
      <div class="Marca" id="main">
        <div
          class="section--yellow wow fadeInLeft"
          data-wow-delay="0.1s"
          style="
            visibility: visible;
            -webkit-animation-delay: 0.1s;
            -moz-animation-delay: 0.1s;
            animation-delay: 0.1s;
          "
        >
          <div
            v-for="producto in Productos.data"
            :key="producto.id"
            class="contenenedor-productos"
          >
            <div class="card">
              <div class="imagen">
                <img
                  v-bind:src="'/images/Articulos/' + producto.Image"
                  width="100%"
                  height="100%"
                  alt=""
                />
              </div>
              <div class="detalles">
                <div class="Nombre">
                  <h3>Nombre: {{ producto.Nombre }}</h3>
                </div>
                <div class="tipo">
                  <h5>Tipo: {{ producto.Tipo }}</h5>
                </div>
                <div class="Descripcion">
                  <h6>Descripción: {{ producto.Descripcion }}</h6>
                </div>
                <button id="boton" class="material-bubble">
                  ¿Como conseguir?
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <div class="paginacion">
      <pagination
        style="font-family: fantasy; color: black"
        :data="Productos"
        @pagination-change-page="getResults"
      ></pagination>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      Productos: {},
    };
  },
  methods: {
    getResults(page = 1) {
      this.$Progress.start();
      axios
        .get("/api/articulosCliente?page=" + page)
        .then(({ data }) => (this.Productos = data.data));
      this.$Progress.finish();
    },
    cargarProductos() {
      axios
        .get("/api/articulosCliente")
        .then(({ data }) => (this.Productos = data.data));
    },
  },
  mounted() {
    const plugin = document.createElement("script");
    plugin.setAttribute("src", "/js/cliente.js");
    plugin.async = true;
    document.head.appendChild(plugin);
  },
  created() {
    this.$Progress.start();
    this.cargarProductos();
    this.$Progress.finish();
  },
};
</script>
<style scoped>
.contenedor {
  margin-top: 100px;
  min-height: 800px;
  max-height: 100%;
}
.Marca {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  align-content: center;
  justify-content: center;
}
.contenenedor-productos {
  margin: 50px;
}
.card {
  width: 300px;
  height: 400px;
  border-radius: 10px;
  box-shadow: 1px 1px 11px 0px;
  padding-bottom: 10px;
}
.imagen {
  width: 100%;
  padding-bottom: 5px;
}
img {
  width: 100%;
  height: 230px;
  border-top-right-radius: 10px;
  border-top-left-radius: 10px;
}
.card:hover {
  box-shadow: 2px 2px 5px #38ab81, 2px 2px 5px #38ab81, 2px 2px 5px #38ab81;
  -webkit-transform: translateX(-3px);
  transform: translateX(-3px);
}
.detalles {
  text-align: center;
}
h1 h2 h3 {
  font-size: 35px;
  font-weight: 600;
}

button {
  text-transform: uppercase;
}

button {
  position: relative;
  border: none;
  font-size: 18px;
  transition: all 1.2s;
  outline: none;
  border-radius: 3px;
  margin: 0 10px;
  padding: 5px 5px;
  border-radius: 20px;
}


.material-bubble {
  background-color: #3bc19000;
  color: black;
  border: none;
  overflow: hidden;
  box-shadow: none;
  font-weight: inherit;
  text-transform: capitalize;
}
.material-bubble:hover {
  color: #ffffff;
  background: #16bce1;
  -webkit-transition: background 3000ms linear;
  -ms-transition: background 3000ms linear;
  transition: background 3000ms linear;
}
.material-bubble::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  border: 3px solid #3bc190db;
  transition: opacity 0.3s, border 0.3s;
}
.material-bubble:hover::before {
  opacity: 0;
}
.material-bubble::after {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 200px;
  height: 200px;
  background-color: #389eb4;
  border-color: transparent;
  border-radius: 50%;
  transform: translate(-10px, -70px) scale(0.1);
  opacity: 0;
  z-index: -1;
  transition: transform 0.3s, opacity 0.3s, background-color 0.3s;
}
.material-bubble:hover::after {
  opacity: 1;
  transform-origin: 100px 100px;
  transform: scale(2) translate(-10px, -70px);
}
.paginacion {
  margin: auto;
  padding: 1em;
  width: 300px;
  justify-content: center;
}
.pagination {
  justify-content: center;
  font-family: fantasy;
  color: black;
  background: #f0f0f0;
  padding: 5px;

  border-radius: 30px;
}
ol,
ul {
  /* left: 45%; */
  padding-left: 50%;
}

.section--yellow {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
}
</style>