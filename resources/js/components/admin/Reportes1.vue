<template>
  <section class="content">
    <div class="container-fluid">
      <div class="block-header" v-if="$gate.isAdmin() || $gate.isUser()">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <ul class="breadcrumb breadcrumb-style">
              <li class="breadcrumb-item">
                <h4 class="page-title">Reportes</h4>
              </li>
              <li class="breadcrumb-item bcrumb-1">
                <a href="/dashboard">
                  <i class="fas fa-home"></i>
                  Inicio
                </a>
              </li>
              <li class="breadcrumb-item active">Reportes</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card" v-if="$gate.isAdmin() || $gate.isUser()">
            <div v-show="opcionPersona" class="card-header">
              <h3 class="card-title">
                Reportes de las personas
              </h3>

              <div class="card-tools">
                <button
                  type="button"
                  class="btn btn-sm btn-primary"
                  @click="verPersonasTabla(), habilitar()"
                >
                  <i class="far fa-file-pdf"></i>
                  Generar Reporte
                </button>
                <button
                  id="btn"
                  @click="generatePdf"
                  type="button"
                  class="btn btn-sm btn-success"
                  :disabled="bloquearDescarga"
                >
                  <i class="fas fa-download"></i>
                  Descargar Reporte
                </button>
                <button @click="Cancelar()" type="button" class="btn btn-sm btn-danger">
                  <i class="fas fa-window-close"></i>
                  Cancelar
                </button>
              </div>
            </div>
            <ReportePersona v-show="verComponentePersonas"></ReportePersona>
            <div v-show="opcionOrganizacion" class="card-header">
              <h3 class="card-title">Reportes de las organizaciones</h3>

              <div class="card-tools">
                <button
                  type="button"
                  class="btn btn-sm btn-primary"
                  
                >
                  <i class="far fa-file-pdf"></i>
                  Generar Reporte
                </button>
                <button
                  id="btn"
                  @click="generatePdf"
                  type="button"
                  class="btn btn-sm btn-success"
                  :disabled="bloquearDescarga"
                >
                  <i class="fas fa-download"></i>
                  Descargar Reporte
                </button>
                <button type="button" class="btn btn-sm btn-danger">
                  <i class="fas fa-window-close"></i>
                  Cancelar
                </button>
              </div>
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import html2PDF from "jspdf-html2canvas";
import ReportePersonas from "../Reportes/ReportePersona.vue";

export default {
  components: {
    ReportePersona: ReportePersonas,
  },
  data() {
    return {
      verComponentePersonas: false,
      opcionPersona: true,
      verComponenteOrganizacion: false,
       opcionOrganizacion: true,
      bloquearDescarga: true,
    };
  },
  methods: {
    generatePdf() {
      let btn = document.getElementById("btn");
      let page = document.getElementById("page");
      btn.addEventListener("click", function () {
        html2PDF(page, {
          jsPDF: {
            format: "a4",
            width: 550 // was 7.5, max width of content on PDF
          },
          imageType: "image/jpeg",
          output: "ReportePersonas.pdf",
        });
      });
    },
    //Muestra el componente de personas reporte
    verPersonasTabla() {
      this.verComponentePersonas = true;
      this.opcionOrganizacion = false;
    },
    //habilita el boton de descargar PDF
    habilitar() {
      this.bloquearDescarga = false;
    },
    Cancelar() {
      this.verComponentePersonas = false;
       this.opcionOrganizacion = true;
      this.bloquearDescarga = true;
    },

    ocultarTodo() {},
  },
};
</script>
