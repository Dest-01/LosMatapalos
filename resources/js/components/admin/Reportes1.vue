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

            <!---------------------------------------------------------------------------------------------------->
            <div v-show="opcionOrganizacion" class="card-header">
              <h3 class="card-title">Reportes de las organizaciones</h3>
              <div class="card-tools">
                <button
                  type="button"
                  class="btn btn-sm btn-primary"
                  @click="verComponenteOrganizacionTabla(), habilitar()"
                >
                  <i class="far fa-file-pdf"></i>
                  Generar Reporte
                </button>
                <button
                  id="btnOrg"
                  @click="generateOrgPdf"
                  type="button"
                  class="btn btn-sm btn-success"
                  :disabled="bloquearDescarga"
                >
                  <i class="fas fa-download"></i>
                  Descargar Reporte
                </button>
                <button type="button" class="btn btn-sm btn-danger" @click="Cancelar()">
                  <i class="fas fa-window-close"></i>
                  Cancelar
                </button>
              </div>
            </div>
            <ReporteOrganizacion v-show="verComponenteOrganizacion"></ReporteOrganizacion>
           <!---------------------------------------------------------------------------------------------------->




           <div v-show="opcionCatDonativo" class="card-header">
              <h3 class="card-title">Reportes de los donativos requeridos</h3>
              <div class="card-tools">
                <button
                  type="button"
                  class="btn btn-sm btn-primary"
                  @click="verComponenteCatDonativoTabla(), habilitar()"
                >
                  <i class="far fa-file-pdf"></i>
                  Generar Reporte
                </button>
                <button
                  id="btnCatDonativo"
                  @click="generateCatDonativoPdf"
                  type="button"
                  class="btn btn-sm btn-success"
                  :disabled="bloquearDescarga"
                >
                  <i class="fas fa-download"></i>
                  Descargar Reporte
                </button>
                <button type="button" class="btn btn-sm btn-danger" @click="Cancelar()">
                  <i class="fas fa-window-close"></i>
                  Cancelar
                </button>
              </div>
            </div>
            <ReporteCatDonativo v-show="verComponenteCatDonativo"></ReporteCatDonativo>
           <!---------------------------------------------------------------------------------------------------->




           <div v-show="opcionDonativo" class="card-header">
              <h3 class="card-title">Reportes de los donativos recibidos</h3>
              <div class="card-tools">
                <button
                  type="button"
                  class="btn btn-sm btn-primary"
                  @click="verComponenteDonativoTabla(), habilitar()"
                >
                  <i class="far fa-file-pdf"></i>
                  Generar Reporte
                </button>
                <button
                  id="btnDonativo"
                  @click="generateDonativoPdf"
                  type="button"
                  class="btn btn-sm btn-success"
                  :disabled="bloquearDescarga"
                >
                  <i class="fas fa-download"></i>
                  Descargar Reporte
                </button>
                <button type="button" class="btn btn-sm btn-danger" @click="Cancelar()">
                  <i class="fas fa-window-close"></i>
                  Cancelar
                </button>
              </div>
            </div>
            <ReporteDonativo v-show="verComponentDonativo"></ReporteDonativo>
           <!---------------------------------------------------------------------------------------------------->








           <div v-show="opcionVolPer" class="card-header">
              <h3 class="card-title">Reportes de los Voluntarios particulares</h3>
              <div class="card-tools">
                <button
                  type="button"
                  class="btn btn-sm btn-primary"
                  @click="verComponenteVolunPerTabla(), habilitar()"
                >
                  <i class="far fa-file-pdf"></i>
                  Generar Reporte
                </button>
                <button
                  id="btnVolpers"
                  @click="generateVolPersPdf"
                  type="button"
                  class="btn btn-sm btn-success"
                  :disabled="bloquearDescarga"
                >
                  <i class="fas fa-download"></i>
                  Descargar Reporte
                </button>
                <button type="button" class="btn btn-sm btn-danger" @click="Cancelar()">
                  <i class="fas fa-window-close"></i>
                  Cancelar
                </button>
              </div>
            </div>
            <ReporteVolunPersona v-show="verComponentVolunPer"></ReporteVolunPersona>
           <!---------------------------------------------------------------------------------------------------->

           <div v-show="opcionVolEstud" class="card-header">
              <h3 class="card-title">Reportes de los Voluntarios estudiantes</h3>
              <div class="card-tools">
                <button
                  type="button"
                  class="btn btn-sm btn-primary"
                  @click="verComponenteVolunEstudTabla(), habilitar()"
                >
                  <i class="far fa-file-pdf"></i>
                  Generar Reporte
                </button>
                <button
                  id="btnVolEstu"
                  @click="generateVolEstuPdf"
                  type="button"
                  class="btn btn-sm btn-success"
                  :disabled="bloquearDescarga"
                >
                  <i class="fas fa-download"></i>
                  Descargar Reporte
                </button>
                <button type="button" class="btn btn-sm btn-danger" @click="Cancelar()">
                  <i class="fas fa-window-close"></i>
                  Cancelar
                </button>
              </div>
            </div>
            <ReporteVolEstudiante v-show="verComponentVolunEstud"></ReporteVolEstudiante>
           <!---------------------------------------------------------------------------------------------------->

           <div v-show="opcionActividad" class="card-header">
              <h3 class="card-title">Reportes de actividades</h3>
              <div class="card-tools">
                <button
                  type="button"
                  class="btn btn-sm btn-primary"
                  @click="verComponenteActividadTabla(), habilitar()"
                >
                  <i class="far fa-file-pdf"></i>
                  Generar Reporte
                </button>
                <button
                  id="btnActividad"
                  @click="generateActividadPdf"
                  type="button"
                  class="btn btn-sm btn-success"
                  :disabled="bloquearDescarga"
                >
                  <i class="fas fa-download"></i>
                  Descargar Reporte
                </button>
                <button type="button" class="btn btn-sm btn-danger" @click="Cancelar()">
                  <i class="fas fa-window-close"></i>
                  Cancelar
                </button>
              </div>
            </div>
            <ReporteActividades v-show="verComponentActividad"></ReporteActividades>
           <!---------------------------------------------------------------------------------------------------->

           <div v-show="opcionVolunActividad" class="card-header">
              <h3 class="card-title">Reportes de voluntarios de actividades</h3>
              <div class="card-tools">
                <button
                  type="button"
                  class="btn btn-sm btn-primary"
                  @click="verComponenteVolunActividadTabla(), habilitar()"
                >
                  <i class="far fa-file-pdf"></i>
                  Generar Reporte
                </button>
                <button
                  id="btnVoluntarioActividad"
                  @click="generateVoluntarioActividadPdf"
                  type="button"
                  class="btn btn-sm btn-success"
                  :disabled="bloquearDescarga"
                >
                  <i class="fas fa-download"></i>
                  Descargar Reporte
                </button>
                <button type="button" class="btn btn-sm btn-danger" @click="Cancelar()">
                  <i class="fas fa-window-close"></i>
                  Cancelar
                </button>
              </div>
            </div>
            <ReporteVoluntarioActividad v-show="verComponentVoluntActividad"></ReporteVoluntarioActividad>
           <!---------------------------------------------------------------------------------------------------->


           <div v-show="opcionReserva" class="card-header">
              <h3 class="card-title">Reportes de reservas</h3>
              <div class="card-tools">
                <button
                  type="button"
                  class="btn btn-sm btn-primary"
                  @click="verComponenteReservaTabla(), habilitar()"
                >
                  <i class="far fa-file-pdf"></i>
                  Generar Reporte
                </button>
                <button
                  id="btnReserva"
                  @click="generateReservaPdf"
                  type="button"
                  class="btn btn-sm btn-success"
                  :disabled="bloquearDescarga"
                >
                  <i class="fas fa-download"></i>
                  Descargar Reporte
                </button>
                <button type="button" class="btn btn-sm btn-danger" @click="Cancelar()">
                  <i class="fas fa-window-close"></i>
                  Cancelar
                </button>
              </div>
            </div>
            <ReporteReservas v-show="verComponentReserva"></ReporteReservas>
           <!---------------------------------------------------------------------------------------------------->


           <div v-show="opcionFauna" class="card-header">
              <h3 class="card-title">Reporte de la fauna del sendero </h3>
              <div class="card-tools">
                <button
                  type="button"
                  class="btn btn-sm btn-primary"
                  @click="verComponenteFaunaTabla(), habilitar()"
                >
                  <i class="far fa-file-pdf"></i>
                  Generar Reporte
                </button>
                <button
                  id="btnFauna"
                  @click="generateFaunaPdf"
                  type="button"
                  class="btn btn-sm btn-success"
                  :disabled="bloquearDescarga"
                >
                  <i class="fas fa-download"></i>
                  Descargar Reporte
                </button>
                <button type="button" class="btn btn-sm btn-danger" @click="Cancelar()">
                  <i class="fas fa-window-close"></i>
                  Cancelar
                </button>
              </div>
            </div>
            <ReporteFauna v-show="verComponentFauna"></ReporteFauna>
           <!---------------------------------------------------------------------------------------------------->


            <div v-show="opcionFlora" class="card-header">
              <h3 class="card-title">Reporte de la flora del sendero </h3>
              <div class="card-tools">
                <button
                  type="button"
                  class="btn btn-sm btn-primary"
                  @click="verComponenteFloraTabla(), habilitar()"
                >
                  <i class="far fa-file-pdf"></i>
                  Generar Reporte
                </button>
                <button
                  id="btnFlora"
                  @click="generateFloraPdf"
                  type="button"
                  class="btn btn-sm btn-success"
                  :disabled="bloquearDescarga"
                >
                  <i class="fas fa-download"></i>
                  Descargar Reporte
                </button>
                <button type="button" class="btn btn-sm btn-danger" @click="Cancelar()">
                  <i class="fas fa-window-close"></i>
                  Cancelar
                </button>
              </div>
            </div>
            <ReporteFlora v-show="verComponentFlora"></ReporteFlora>
           <!---------------------------------------------------------------------------------------------------->
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
import ReporteOrganizaciones from "../Reportes/ReporteOrganizacion.vue";
import ReporteVolunPersona from "../Reportes/ReporteVolunPersona.vue";
import ReporteVolEstudiante from "../Reportes/ReporteVolEstudiante.vue";
import ReporteActividades from "../Reportes/ReporteActividades.vue";
import ReporteVoluntarioActividad from "../Reportes/ReporteVoluntarioActividad.vue";
import ReporteReservas from "../Reportes/ReporteReservas.vue";
import ReporteFauna from "../Reportes/ReporteFauna.vue"
import ReporteFlora from "../Reportes/ReporteFlora.vue"
import ReporteCatDonativo from "../Reportes/ReporteCatDonativo.vue"
import ReporteDonativo from "../Reportes/ReporteDonativo.vue"

export default {
  components: {
    ReportePersona: ReportePersonas,
    ReporteOrganizacion: ReporteOrganizaciones,
    ReporteCatDonativo: ReporteCatDonativo,
    ReporteDonativo : ReporteDonativo,
    ReporteVolunPersona: ReporteVolunPersona,
    ReporteVolEstudiante: ReporteVolEstudiante,
    ReporteActividades: ReporteActividades,
    ReporteVoluntarioActividad: ReporteVoluntarioActividad,
    ReporteReservas: ReporteReservas,
    ReporteFauna: ReporteFauna,
    ReporteFlora: ReporteFlora,
  },
  data() {
    return {
      verComponentePersonas: false,
      opcionPersona: true,
      verComponenteOrganizacion: false,
      opcionCatDonativo:true,
      verComponenteCatDonativo:false,
      opcionDonativo:true,
      verComponentDonativo:false,
      opcionOrganizacion: true,
      verComponentVolunPer:false,
      opcionVolPer:true,
      verComponentVolunEstud:false,
      opcionVolEstud:true,
      opcionActividad:true,
      verComponentActividad:false,
      opcionVolunActividad:true,
      verComponentVoluntActividad:false,
      opcionReserva:true,
      verComponentReserva:false,
      opcionFauna:true,
      verComponentFauna:false,
      opcionFlora:true,
      verComponentFlora:false,
      bloquearDescarga: true,
      verComponenteVoluntario:false,
      fechaActual:'',
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
          output: `ReportePersonas.pdf`,
        });
      });
    },
    generateOrgPdf() {
      let btn = document.getElementById("btnOrg");
      let page = document.getElementById("pageOrg");
      btn.addEventListener("click", function () {
        html2PDF(page, {
          jsPDF: {
            format: "a4",
            width: 550 // was 7.5, max width of content on PDF
          },
          imageType: "image/jpeg",
          output: "ReporteOrganizaciones.pdf",
        });
      });
    },
    generateCatDonativoPdf() {
      let btn = document.getElementById("btnCatDonativo");
      let page = document.getElementById("pageCatDonativo");
      btn.addEventListener("click", function () {
        html2PDF(page, {
          jsPDF: {
            format: "a4",
            width: 550 // was 7.5, max width of content on PDF
          },
          imageType: "image/jpeg",
          output: "ReporteDonacionesNecesarias.pdf",
        });
      });
    },
    generateDonativoPdf() {
      let btn = document.getElementById("btnDonativo");
      let page = document.getElementById("pageDonativo");
      btn.addEventListener("click", function () {
        html2PDF(page, {
          jsPDF: {
            format: "a4",
            width: 550 // was 7.5, max width of content on PDF
          },
          imageType: "image/jpeg",
          output: "ReporteDonacionesRecibidas.pdf",
        });
      });
    },
    generateVolPersPdf() {
      let btn = document.getElementById("btnVolpers");
      let page = document.getElementById("pageVolper");
      btn.addEventListener("click", function () {
        html2PDF(page, {
          jsPDF: {
            format: "a4",
            width: 550 // was 7.5, max width of content on PDF
          },
          imageType: "image/jpeg",
          output: "ReporteVoluntarioPersona.pdf",
        });
      });
    },
    generateVolEstuPdf() {
      let btn = document.getElementById("btnVolEstu");
      let page = document.getElementById("pageVolEstu");
      btn.addEventListener("click", function () {
        html2PDF(page, {
          jsPDF: {
            format: "a4",
            width: 550 // was 7.5, max width of content on PDF
          },
          imageType: "image/jpeg",
          output: "ReporteVoluntarioEstudiante.pdf",
        });
      });
    },
    generateActividadPdf() {
      let btn = document.getElementById("btnActividad");
      let page = document.getElementById("pageActividad");
      btn.addEventListener("click", function () {
        html2PDF(page, {
          jsPDF: {
            format: "a4",
            width: 550 // was 7.5, max width of content on PDF
          },
          imageType: "image/jpeg",
          output: "ReporteActividades.pdf",
        });
      });
    },
    generateVoluntarioActividadPdf() {
      let btn = document.getElementById("btnVoluntarioActividad");
      let page = document.getElementById("pageVoluntarioActividad");
      btn.addEventListener("click", function () {
        html2PDF(page, {
          jsPDF: {
            format: "a4",
            width: 550 // was 7.5, max width of content on PDF
          },
          imageType: "image/jpeg",
          output: "ReporteVoluntarioActividad.pdf",
        });
      });
    },
    generateReservaPdf() {
      let btn = document.getElementById("btnReserva");
      let page = document.getElementById("pageReserva");
      btn.addEventListener("click", function () {
        html2PDF(page, {
          jsPDF: {
            format: "a4",
            width: 550 // was 7.5, max width of content on PDF
          },
          imageType: "image/jpeg",
          output: "ReporteReservas.pdf",
        });
      });
    },
    
    generateFaunaPdf() {
      let btn = document.getElementById("btnFauna");
      let page = document.getElementById("pageFauna");
      btn.addEventListener("click", function () {
        html2PDF(page, {
          jsPDF: {
            format: "a4",
            width: 550 // was 7.5, max width of content on PDF
          },
          imageType: "image/jpeg",
          output: "ReporteFauna.pdf",
        });
      });
    },
    generateFloraPdf() {
      let btn = document.getElementById("btnFlora");
      let page = document.getElementById("pageFlora");
      btn.addEventListener("click", function () {
        html2PDF(page, {
          jsPDF: {
            format: "a4",
            width: 550 // was 7.5, max width of content on PDF
          },
          imageType: "image/jpeg",
          output: "ReporteFlora.pdf",
        });
      });
    },
    //Muestra el componente de personas reporte
    verPersonasTabla() {
      this.verComponentePersonas = true;
      this.opcionOrganizacion = false;
      this.opcionVolPer=false;
      this.opcionVolEstud=false;
      this.verComponentReserva=false;
      this.opcionReserva=false;
      this.opcionFauna=false;
      this.opcionFlora=false;
      this.opcionVolunActividad=false;
      this.opcionActividad=false;
      this.opcionDonativo=false;
      this.opcionCatDonativo=false;
    },
    //Muestra el componente de personas reporte
    verComponenteOrganizacionTabla() {
      this.verComponenteOrganizacion = true;
      this.opcionPersona=false;
      this.opcionVolPer=false;
      this.opcionVolEstud=false;
      this.verComponentReserva=false;
      this.opcionReserva=false;
      this.opcionFauna=false;
      this.opcionFlora=false;
      this.opcionVolunActividad=false;
      this.opcionActividad=false;
      this.opcionDonativo=false;
      this.opcionCatDonativo=false;
    },

    // DONATIVOS REQUERIDOS
    verComponenteCatDonativoTabla(){
      this.verComponenteCatDonativo=true;
      this.opcionVolunActividad=false;
      this.opcionDonativo=false;
      this.opcionVolPer = false;
      this.opcionOrganizacion=false;
      this.opcionPersona=false;
      this.opcionVolEstud=false;
      this.opcionFlora=false;
      this.opcionActividad=false;
      this.opcionFauna=false;
      this.opcionReserva=false;
    },

    // DONATIVOS Recibidos
    verComponenteDonativoTabla(){
      this.verComponentDonativo=true;
      this.opcionCatDonativo=false;
      this.opcionVolPer = false;
      this.opcionOrganizacion=false;
      this.opcionPersona=false;
      this.opcionVolEstud=false;
      this.opcionFlora=false;
      this.opcionActividad=false;
      this.opcionFauna=false;
      this.opcionVolunActividad=false;
      this.opcionReserva=false;
    },


    verComponenteVolunPerTabla() {
      this.verComponentVolunPer = true;
      this.opcionVolPer = true;
      this.opcionOrganizacion=false;
      this.opcionPersona=false;
      this.opcionVolEstud=false;
      this.opcionCatDonativo=false;
      this.opcionOrganizacion=false;
      this.opcionPersona=false;
      this.opcionVolEstud=false;
      this.opcionFlora=false;
      this.opcionActividad=false;
      this.opcionFauna=false;
      this.opcionVolunActividad=false;
      this.opcionReserva=false;
      this.opcionDonativo=false;
    },
    verComponenteVolunEstudTabla() {
      this.verComponentVolunEstud=true;
      this.opcionVolPer = true;
      this.opcionOrganizacion=false;
      this.opcionPersona=false;
      this.opcionVolEstud=false;
      this.opcionCatDonativo=false;
      this.opcionOrganizacion=false;
      this.opcionPersona=false;
      this.opcionVolEstud=false;
      this.opcionFlora=false;
      this.opcionActividad=false;
      this.opcionFauna=false;
      this.opcionVolunActividad=false;
      this.opcionReserva=false;
      this.opcionDonativo=false;
    },
    verComponenteActividadTabla() {
      this.verComponentActividad=true;
      this.opcionVolPer = false;
      this.opcionOrganizacion=false;
      this.opcionPersona=false;
      this.opcionVolEstud=false;
      this.opcionCatDonativo=false;
      this.opcionOrganizacion=false;
      this.opcionPersona=false;
      this.opcionVolEstud=false;
      this.opcionFlora=false;
      this.opcionFauna=false;
      this.opcionVolunActividad=false;
      this.opcionReserva=false;
      this.opcionDonativo=false;
    },
    verComponenteVolunActividadTabla(){
      this.verComponentVoluntActividad=true;
      this.opcionVolPer = true;
      this.opcionOrganizacion=false;
      this.opcionPersona=false;
      this.opcionVolEstud=false;
      this.opcionCatDonativo=false;
      this.opcionOrganizacion=false;
      this.opcionPersona=false;
      this.opcionVolEstud=false;
      this.opcionFlora=false;
      this.opcionFauna=false;
      this.opcionReserva=false;
      this.opcionDonativo=false;
      this.opcionActividad=false;
      this.opcionVolPer=false;
    },
    verComponenteReservaTabla(){
      this.verComponentReserva=true;
      this.opcionVolPer = false;
      this.opcionOrganizacion=false;
      this.opcionPersona=false;
      this.opcionVolEstud=false;
      this.opcionCatDonativo=false;
      this.opcionOrganizacion=false;
      this.opcionPersona=false;
      this.opcionVolEstud=false;
      this.opcionFlora=false;
      this.opcionFauna=false;
      this.opcionDonativo=false;
      this.opcionActividad=false;
      this.opcionVolPer=false;
      this.opcionVolunActividad=false;
    },
    verComponenteFaunaTabla(){
      this.verComponentFauna=true;
      this.opcionVolPer = false;
      this.opcionOrganizacion=false;
      this.opcionPersona=false;
      this.opcionVolEstud=false;
      this.opcionCatDonativo=false;
      this.opcionOrganizacion=false;
      this.opcionPersona=false;
      this.opcionVolEstud=false;
      this.opcionFlora=false;
      this.opcionDonativo=false;
      this.opcionActividad=false;
      this.opcionVolPer=false;
      this.opcionReserva=false;
      this.opcionVolunActividad=false;
    },
    verComponenteFloraTabla(){
      this.verComponentFlora=true;
      this.opcionVolPer = false;
      this.opcionOrganizacion=false;
      this.opcionPersona=false;
      this.opcionVolEstud=false;
      this.opcionCatDonativo=false;
      this.opcionOrganizacion=false;
      this.opcionPersona=false;
      this.opcionVolEstud=false;
      this.opcionFauna=false;
      this.opcionDonativo=false;
      this.opcionActividad=false;
      this.opcionVolPer=false;
      this.opcionReserva=false;
      this.opcionVolunActividad=false;
    },
    //habilita el boton de descargar PDF
    habilitar() {
      this.bloquearDescarga = false;
    },
    Cancelar() {
      this.verComponentePersonas= false;
      this.opcionPersona= true;
      this.verComponenteOrganizacion= false;
      this.opcionCatDonativo=true;
      this.verComponenteCatDonativo=false;
      this.opcionDonativo=true;
      this.verComponentDonativo=false;
      this.opcionOrganizacion= true;
      this.verComponentVolunPer=false;
      this.opcionVolPer=true;
      this.verComponentVolunEstud=false;
      this.opcionVolEstud=true;
      this.opcionActividad=true;
      this.verComponentActividad=false;
      this.opcionVolunActividad=true;
      this.verComponentVoluntActividad=false;
      this.opcionReserva=true;
      this.verComponentReserva=false;
      this.opcionFauna=true;
      this.verComponentFauna=false;
      this.opcionFlora=true;
      this.verComponentFlora=false;
      this.bloquearDescarga= true;
      this.verComponenteVoluntario=false;
      
      this.bloquearDescarga = true;
      
      
    },

    ocultarTodo() {},
  },
  computed: {
    set: function () {
      var today = new Date();
      var strDate = "d-m-Y"
        .replace("Y", today.getFullYear())
        .replace("m", today.getMonth() + 1)
        .replace("d", today.getDate());
        this.fechaActual = strDate;
    },
  },
};
</script>
