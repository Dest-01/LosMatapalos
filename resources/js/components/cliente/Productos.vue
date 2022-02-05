<template>
  <div class="contenedor">
    <div class="site-heading text-center">
      <h1>Nuestros <span style="color: #38ab81">Productos</span></h1>
    </div>

    <div class="todo_productos">
      <div
        v-for="producto in Productos.data"
        :key="producto.id"
        class="contenenedor-productos"
      >
        <div class="productos">
          <div class="imagen">
            <img
              v-bind:src="'/images/Articulos/' + producto.Image"
              alt="producto"
              data-toggle="modal"
              @click="verImagen(producto)"
              data-target="#exampleModalLong"
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
            <button type="button"  data-toggle="modal" data-target="#modalConseguir" class="">¿Como conseguir?</button>
          </div>
        </div>
      </div>
    </div>

    <!-- MODAL PARA VER IMAGEN -->
    <div
      class="modal fade"
      id="exampleModalLong"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLongTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Nombre Producto: {{form.Nombre}}</h5>
            <button type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <img
              v-bind:src="'/images/Articulos/' + form.Image"
              alt="producto"
              width="100%"
              height="100%"
            />
          </div>
        </div>
      </div>
    </div>

    <!--MODAL  PARA VER MENSAJE DE COMO CONSEGUIR-->
    <div
      class="modal modal_info fade"
      id="modalConseguir"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLongTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content_info">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Información</h5>
            <button type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body_info">
            <p>Para conseguir este producto es necesario contactar con miembros del sendero.</p>
            <p>Correo: sendero.una.ac.cr</p>
            <p>Número (506) 0000-0000</p>
            <p>Dirección: 600 m al sur del Colegio Técnico de Liberia, Campus Liberia, Sede Regional Chorotega, Universidad Nacional.</p>
          </div>
        </div>
      </div>
    </div>

    <div class="paginacion">
      <pagination
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
      form: new Form({
        id: "",
        Descripcion: "",
        Image: "",
        Nombre: "",
        Tipo: "",
      }),
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
    verImagen(producto) {
      this.form.fill(producto);
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
  margin: 50px 0;
  padding: 0;
}

.todo_productos {
  margin: 10px;
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  justify-content: center;
}

.productos img {
  width: 400px;
  height: 350px;
  object-fit: cover;
  border: 1px solid #fff;
  border-radius: 15px;
  box-shadow: 1px 1px 10px 0 black;
  transition: border 0.2s;
}
img:hover {
  border: 3px solid #38ab81;
  cursor: pointer;
}
.productos > img:hover {
  border: 3px solid #38ab81;
}
.productos {
  width: 400px;
  height: 350px;
  margin: 10px;
  box-sizing: content-box;
}

.detalles {
  position: relative;
  text-align: center;
  font-weight: 700;
  top: -40%;
  background: #fff;
  box-sizing: border-box;
  font-size: 20px;
  height: 150px;
  border-bottom-left-radius: 15px;
  border-bottom-right-radius: 15px;
  opacity: 0;
  transition: all 0.5s;
  color: #fff;
}

button {
  border: 1px solid #119263;
  border-radius: 5px;
  background: linear-gradient(1deg, #119263, #1cc185);
  color: #fff;
  font-weight: 500;
  transition: all 0.2s;
}

button:hover{
  background: linear-gradient(1deg, #0a5f40, #159b6a);
}

.productos > .detalles:hover {
  opacity: 1;
  top: -43%;
  background: #101010a8;
}

.paginacion {
  margin: 10px auto;
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
  font-weight: 900;
}
/*MODAL ESTILO*/
.modal{
  left: -12%;
}
.modal-content {
  width: 55vw;
  height: 65vh;
}

.modal-body{
  padding: 0;
  box-sizing: content-box;
  width: 55vw;
  height: 65vh;
} 
.modal-body img{
  object-fit: cover;
  box-sizing: border-box;
  width: 100%;
  height: 100%;
}
.modal-body > img:hover{
  border: none;
  cursor: default;
}
.modal-header button{
  font-weight: 600;
  background: none;
  color: #111;
  border: none;
  font-size: 1.25rem;
}
.modal-content_info{
  width: 420px;
  height: 400px;
  background: #ffffff;
}

.modal-body_info{
  width: 420px;
  height: 400px;
  padding: 5px;
  font-size: 1.25rem;
}
.modal_info{
   width: 100%;
   left: 4%;
   top: 18%;
}

</style>