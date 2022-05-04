<template>
  <div class="contenedor">
    <div class="site-heading text-center">
      <h1>{{ $t("nuestros") }} <span style="color: #38ab81">{{ $t("productos") }}</span></h1>
    </div>
    <div v-if="Productos.data == 0" class="row">
      <div class="mensaje">
        <i class="far fa-folder-open"></i>
        <h1>Oops!</h1>
        <h3>{{ $t("productos_nada") }}</h3>
        <h4>Muy pronto...</h4>
      </div>
    </div>
    <div v-else class="todo_productos wow fadeInUp" data-wow-duration="2s">
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
              <h3>{{ $t("nombre") }}: {{ producto.Nombre }}</h3>
            </div>
            <div class="tipo">
              <h5>{{ $t("tipo") }}: {{ producto.Tipo }}</h5>
            </div>
            <div class="Descripcion">
              <h6>{{ $t("descripcion") }}: {{ producto.Descripcion }}</h6>
            </div>
            <button
              type="button"
              data-toggle="modal"
              data-target="#modalConseguir"
              class=""
            >
             {{$t("informacion")}}
            </button>
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
            <h5 class="modal-title" id="exampleModalLongTitle">
              {{$t("nombre_Producto")}}: {{ form.Nombre }}
            </h5>
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
          <div class="modal-header info_header">
            <h5 class="modal-title" id="exampleModalLongTitle">{{$t("informacion_titulo")}}</h5>
            <button type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body_info">
            <p>
              {{$t("obtener")}}
            </p>
            <p>{{$t("correo")}}: sendero.una.ac.cr</p>
            <p>{{$t("celular")}} (506) 2562-6253</p>
            <p>
              {{$t("direccion")}}: 600 m al sur del Colegio Técnico de Liberia, Campus
              Liberia, Sede Regional Chorotega, Universidad Nacional.
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class="paginacion">
      <pagination
        :data="Productos"
        :limit="5"
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
.row {
  width: 100%;
}
.contenedor {
  margin: 50px 0;
  padding: 0;
}

.site-heading {
  animation-name: desplazar;
  animation-duration: 2s;
  opacity: 0;
  animation-fill-mode: forwards;
}

.todo_productos {
  margin: 15px;
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
  transition: transform 0.5s;
}
img:hover {
  border: 3px solid #38ab81;
  cursor: pointer;
  transform: scale(1.05);
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

button:hover {
  background: linear-gradient(1deg, #0a5f40, #159b6a);
}

.productos > .detalles:hover {
  opacity: 1;
  top: -43%;
  background: #101010a8;
}

.paginacion {
  margin: 10px auto;
  padding: 1.5em;
  display: flex;
  justify-content: center;
  align-content: center;
  flex-direction: row-reverse;
}

.pagination {
  justify-content: center;
  font-family: fantasy;
  color: black;
  background: #f0f0f0;
  padding: 10px;
  border-radius: 10px;
  font-weight: 900;
}
/*MODAL ESTILO*/
.modal {
  left: -12%;
}
.modal-content {
  width: 55vw;
  height: 65vh;
}

.modal-body {
  padding: 0;
  box-sizing: content-box;
  width: 55vw;
  height: 65vh;
}
.modal-body img {
  object-fit: cover;
  box-sizing: border-box;
  width: 100%;
  height: 100%;
}
.modal-body > img:hover {
  border: none;
  cursor: default;
  transform: none;
}
.modal-header button {
  font-weight: 600;
  background: none;
  color: #111;
  border: none;
  font-size: 1.25rem;
  
}
.info_header{
  background: #1cc185;
  border-top-left-radius: 10px;
}
.modal-content_info {
  width: 420px;
  height: auto;
  border-top-left-radius: 10px;
  border-bottom-right-radius: 10px;
  box-shadow: 1px 1px 12px 1px #000;
}

.modal-body_info {
  background: #fff;
  width: 420px;
  height: auto;
  padding: 5px;
  font-size: 1.25rem;
  border-radius: 0px 0px 10px 0px;
}
.modal_info {
  width: 100%;
  left: 4%;
  top: 18%;
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
.mensaje {
  width: 100%;
  margin-top: 100px;
  margin-block: 100px;
  text-align: center;
}

.far {
  font-size: 8rem;
  color: #39ab81;
}
@media only screen and (min-device-width: 335px) and (max-device-width: 1199px) {
  .contenedor {
    margin: 50px 5px 130px 5px;
  }
  .todo_productos {
    margin: 15px 25px 15px 5px;
  }
  .modal {
    left: 0%;
  }
  .modal-content,
  .modal-body {
    width: 100%;
  }
}
@media only screen and (min-device-width: 280px) and (max-device-width: 453px) {
  .productos {
    width: 100%;
  }
  .productos img {
    width: 100%;
  }
}
@media only screen and (max-device-width: 334px){
  .contenedor {
    margin: 50px 5px 160px 5px;
  }
    .todo_productos {
    margin: 15px 25px 15px 5px;
  }
  .modal {
    left: 0%;
  }
  .modal-content,
  .modal-body {
    width: 100%;
  }
}

</style>