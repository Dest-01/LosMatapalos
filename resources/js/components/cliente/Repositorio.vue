<template>
  <div class="principal">
    <div class="titulo">Repositorio de documentos</div>
    <div class="secundario">
        <h1 v-show="Mostrarmensaje"><i class="fas fa-tools"></i> Muy pronto... </h1>
    <table class="table align-middle">
      <thead>
        <tr>
          <th class="icono" scope="col"></th>
          <th class="nombre" scope="col">Nombre del documento</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row"><img src="images/PDFIcono.png" alt="" /></th>
          <td>nombre del documento</td>

          <td>
            <button @click="mostrar()" type="button" class="btn btn-info btn-sm px-3">
              DETALLES
            </button>
            </td>
            <td>
            <button @click="mostrar()" type="button" class="btn btn-success btn-sm px-3">
              DESCARGAR
            </button>
          </td>
        </tr>
        <tr>
          <th scope="row"><img src="images/PDFIcono.png" alt="" /></th>
           <td>nombre del documento</td>

         <td>
            <button @click="mostrar()" type="button" class="btn btn-info btn-sm px-3">
              DETALLES
            </button>
            </td>
            <td>
            <button @click="mostrar()" type="button" class="btn btn-success btn-sm px-3">
              DESCARGAR
            </button>
          </td>
        </tr>
        <tr>
           <th scope="row"><img src="images/PDFIcono.png" alt="" /></th>
          <td>nombre del documento</td>

          <td>
            <button @click="mostrar()" type="button" class="btn btn-info btn-sm px-3">
              DETALLES
            </button>
            </td>
            <td>
            <button @click="mostrar()" type="button" class="btn btn-success btn-sm px-3">
              DESCARGAR
            </button>
          </td>
        </tr>
        <tr>
          <th scope="row"><img src="images/PDFIcono.png" alt="" /></th>
          <td>nombre del documento</td>

          <td>
            <button @click="mostrar()" type="button" class="btn btn-info btn-sm px-3">
              DETALLES
            </button>
            </td>
            <td>
            <button @click="mostrar()" type="button" class="btn btn-success btn-sm px-3">
              DESCARGAR
            </button>
          </td>
        </tr>
        <tr>
          <th scope="row"><img src="images/PDFIcono.png" alt="" /></th>
          <td>nombre del documento</td>

          <td>
            <button @click="mostrar()" type="button" class="btn btn-info btn-sm px-3">
              DETALLES
            </button>
            </td>
            <td>
            <button @click="mostrar()" type="button" class="btn btn-success btn-sm px-3">
              DESCARGAR
            </button>
          </td>
        </tr>
      </tbody>
    </table>
    </div>
  </div>
</template>

<script>
export default {
    data() {
        return{
            Mostrarmensaje: false,
        }
        
    },
    methods: {
        mostrar(){
            this.Mostrarmensaje = true
        }
    }
}
</script>

<style scoped>
.principal {
  margin-top: 150px;
  margin-block: 100px;
  height: auto;
  margin-left: 120px;
  margin-right: 120px;
}
.secundario{
    width: 100%;
    margin: 40px;
}
.titulo {
  font-size: 2rem;
  font-family: "Poppins";
  text-align: center;
  font-weight: 600;
  margin: 50px;
  padding: 10px;
}
thead {
  font-size: 18px;
  font-family: "Poppins";
}
tr {
  font-size: 18px;
  font-family: "Poppins";
}
img {
  width: 50px;
  height: 50px;
}
.icono {
  width: 10px;
}

.btn {
  width: 150px;
  height: 40px;
  margin: 10px;
  font-size: 20px;
  padding: 5px;
}
.nombre {
  width: 100%;
}
tbody, td, tfoot, th, thead, tr {
border-color: #d9d9d970; 
    /* border-style: groove; */
    /* border-width: 1px; */
    border-bottom: groove;
    border-bottom-color: #b7b7b72e;
}
@media screen and (max-width: 1024px) {
    .secundario{
        width: 100%;
        margin-left: 1px;
    }
    .btn{
        width: 100px;
        font-size: 10px;
    }
    .table>:not(caption)>*>* {
    padding: 1px 1px;
}
}

@media screen and (max-width: 1023px) {
    .secundario{
        width: 100%;
        margin-left: 1px;
    }
    .btn{
        width: 100px;
        font-size: 10px;
    }
    .table>:not(caption)>*>* {
    padding: 1px 1px;
}
}

@media only screen and (max-device-width: 1024px){
        .secundario{
        width: 100%;
        margin-left: 1px;
    }
    .btn{
        width: 100px;
        font-size: 10px;
    }
    .table>:not(caption)>*>* {
    padding: 1px 1px;
}
}

</style>