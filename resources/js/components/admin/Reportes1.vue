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
            <div class="card-header">
              <h3 class="card-title">Reportes de las personas</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-sm btn-primary" @click="verReportePersona()">
                  <i class="far fa-file-pdf"></i>
                  Generar Reporte
                </button>
                <button type="button" class="btn btn-sm btn-danger" @click="cancerlar()">
                  <i class="fas fa-window-close"></i>
                  Cancelar
                </button>
              </div>
            </div>
            <ReportePersona v-show="verPersonas"></ReportePersona>

            <!---------------------------------------------------------------------------------------------------->
            <div class="card-header">
              <h3 class="card-title">Reportes de las organizaciones</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-sm btn-primary" @click="verReporteOrganizacion()" >
                  <i class="far fa-file-pdf"></i>
                  Generar Reporte
                </button>
                <button type="button" class="btn btn-sm btn-danger" @click="cancerlar()">
                  <i class="fas fa-window-close"></i>
                  Cancelar
                </button>
              </div>
            </div>
            <ReporteOrganizacion
              v-show="verOrganizaciones"
            ></ReporteOrganizacion>
            <!---------------------------------------------------------------------------------------------------->

            <!---------------------------------------------------------------------------------------------------->
            <div class="card-header">
              <h3 class="card-title">Reportes de los grupo</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-sm btn-primary" @click="verGrupo()">
                  <i class="far fa-file-pdf"></i>
                  Generar Reporte
                </button>
                <button type="button" class="btn btn-sm btn-danger" @click="cancerlar()">
                  <i class="fas fa-window-close"></i>
                  Cancelar
                </button>
              </div>
            </div>
            <ReporteGrupo v-show="verGrupos"></ReporteGrupo>
            <!---------------------------------------------------------------------------------------------------->

            <div class="card-header">
              <h3 class="card-title">Reportes de los donativos</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-sm btn-primary" @click="verDonativo()">
                  <i class="far fa-file-pdf"></i>
                  Generar Reporte
                </button>
                <button type="button" class="btn btn-sm btn-danger" @click="cancerlar()">
                  <i class="fas fa-window-close"></i>
                  Cancelar
                </button>
              </div>
            </div>
            <ReporteDonativo v-show="verDonativos"></ReporteDonativo>
            <!---------------------------------------------------------------------------------------------------->

            <div class="card-header">
              <h3 class="card-title">
                Reportes de los Voluntarios particulares
              </h3>
              <div class="card-tools">
                <button type="button" class="btn btn-sm btn-primary" @click="verVoluntarioParticular()">
                  <i class="far fa-file-pdf"></i>
                  Generar Reporte
                </button>
                <button type="button" class="btn btn-sm btn-danger" @click="cancerlar()">
                  <i class="fas fa-window-close"></i>
                  Cancelar
                </button>
              </div>
            </div>
            <ReporteVolunPersona
              v-show="verVoluntarioParticulares"
            ></ReporteVolunPersona>
            <!---------------------------------------------------------------------------------------------------->

            <div class="card-header">
              <h3 class="card-title">
                Reportes de los Voluntarios estudiantes
              </h3>
              <div class="card-tools">
                <button type="button" class="btn btn-sm btn-primary" @click="verVoluntarioEstudiantes()">
                  <i class="far fa-file-pdf"></i>
                  Generar Reporte
                </button>
                <button type="button" class="btn btn-sm btn-danger" @click="cancerlar()">
                  <i class="fas fa-window-close"></i>
                  Cancelar
                </button>
              </div>
            </div>
            <ReporteVolEstudiante
              v-show="verVoluntarioEstudiante"
            ></ReporteVolEstudiante>
            <!---------------------------------------------------------------------------------------------------->

            <div class="card-header">
              <h3 class="card-title">Reportes de actividades</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-sm btn-primary" @click="verActividad()">
                  <i class="far fa-file-pdf"></i>
                  Generar Reporte
                </button>
                <button type="button" class="btn btn-sm btn-danger" @click="cancerlar()">
                  <i class="fas fa-window-close"></i>
                  Cancelar
                </button>
              </div>
            </div>
            <ReporteActividades v-show="verActividades"></ReporteActividades>
            <!---------------------------------------------------------------------------------------------------->

            <div class="card-header">
              <h3 class="card-title">Reportes de voluntarios de actividades</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-sm btn-primary" @click="verVoluntarioActividades()">
                  <i class="far fa-file-pdf"></i>
                  Generar Reporte
                </button>
                <button type="button" class="btn btn-sm btn-danger" @click="cancerlar()">
                  <i class="fas fa-window-close"></i>
                  Cancelar
                </button>
              </div>
            </div>
            <ReporteVoluntarioActividad
              v-show="verVoluntarioActividad"
            ></ReporteVoluntarioActividad>
            <!---------------------------------------------------------------------------------------------------->

            <div class="card-header">
              <h3 class="card-title">Reportes de reservas</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-sm btn-primary" @click="verReservas()">
                  <i class="far fa-file-pdf"></i>
                  Generar Reporte
                </button>
                <button type="button" class="btn btn-sm btn-danger" @click="cancerlar()">
                  <i class="fas fa-window-close"></i>
                  Cancelar
                </button>
              </div>
            </div>
            <ReporteReservas v-show="verReservar"></ReporteReservas>
            <!---------------------------------------------------------------------------------------------------->

            <div class="card-header">
              <h3 class="card-title">Reporte de la fauna del sendero</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-sm btn-primary" @click="verFaunas()">
                  <i class="far fa-file-pdf"></i>
                  Generar Reporte
                </button>
                <button type="button" class="btn btn-sm btn-danger" @click="cancerlar()">
                  <i class="fas fa-window-close"></i>
                  Cancelar
                </button>
              </div>
            </div>
            <ReporteFauna v-show="verFauna"></ReporteFauna>
            <!---------------------------------------------------------------------------------------------------->

            <div class="card-header">
              <h3 class="card-title">Reporte de la flora del sendero</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-sm btn-primary" @click="verFloras()">
                  <i class="far fa-file-pdf"></i>
                  Generar Reporte
                </button>
                <button type="button" class="btn btn-sm btn-danger" @click="cancerlar()">
                  <i class="fas fa-window-close"></i>
                  Cancelar
                </button>
              </div>
            </div>
            <ReporteFlora v-show="verFlora"></ReporteFlora>
            <!---------------------------------------------------------------------------------------------------->
            <div class="card-header">
              <h3 class="card-title">Reportes de los participantes</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-sm btn-primary" @click="verParticipante()">
                  <i class="far fa-file-pdf"></i>
                  Generar Reporte
                </button>
                <button type="button" class="btn btn-sm btn-danger" @click="cancerlar()">
                  <i class="fas fa-window-close"></i>
                  Cancelar
                </button>
              </div>
            </div>
            <ReporteParticipantes  v-show="verParticipantes"></ReporteParticipantes>
            <!---------------------------------------------------------------------------------------------------->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import ReportePersonas from "../Reportes/ReportePersona.vue";
import ReporteGrupo from "../Reportes/ReporteGrupo.vue";
import ReporteOrganizaciones from "../Reportes/ReporteOrganizacion.vue";
import ReporteVolunPersona from "../Reportes/ReporteVolunPersona.vue";
import ReporteVolEstudiante from "../Reportes/ReporteVolEstudiante.vue";
import ReporteActividades from "../Reportes/ReporteActividades.vue";
import ReporteVoluntarioActividad from "../Reportes/ReporteVoluntarioActividad.vue";
import ReporteReservas from "../Reportes/ReporteReservas.vue";
import ReporteFauna from "../Reportes/ReporteFauna.vue";
import ReporteFlora from "../Reportes/ReporteFlora.vue";
import ReporteDonativo from "../Reportes/ReporteDonativo.vue";
import ReporteParticipantes from "../Reportes/ReporteParticipantes.vue";

export default {
  components: {
    ReportePersona: ReportePersonas,
    ReporteGrupo: ReporteGrupo,
    ReporteOrganizacion: ReporteOrganizaciones,
    ReporteDonativo: ReporteDonativo,
    ReporteVolunPersona: ReporteVolunPersona,
    ReporteVolEstudiante: ReporteVolEstudiante,
    ReporteActividades: ReporteActividades,
    ReporteVoluntarioActividad: ReporteVoluntarioActividad,
    ReporteReservas: ReporteReservas,
    ReporteFauna: ReporteFauna,
    ReporteFlora: ReporteFlora,
    ReporteParticipantes: ReporteParticipantes,
  },
  data() {
    return {
      verPersonas: false,
      verOrganizaciones: false,
      verGrupos: false,
      verDonativos: false,
      verVoluntarioParticulares: false,
      verVoluntarioEstudiante: false,
      verActividades: false,
      verVoluntarioActividad: false,
      verReservar: false,
      verFauna: false,
      verFlora: false,
      verParticipantes: false,
    };
  },
  methods: {
    verReportePersona() {
      this.verPersonas = true;
      this.verOrganizaciones = false;
      this.verGrupos = false;
      this.verDonativos = false;
      this.verVoluntarioParticulares = false;
      this.verVoluntarioEstudiante = false;
      this.verActividades = false;
      this.verVoluntarioActividad = false;
      this.verReservar = false;
      this.verFauna = false;
      this.verFlora = false;
      this.verParticipantes = false;
    },
    verReporteOrganizacion() {
      this.verPersonas = false;
      this.verOrganizaciones = true;
      this.verGrupos = false;
      this.verDonativos = false;
      this.verVoluntarioParticulares = false;
      this.verVoluntarioEstudiante = false;
      this.verActividades = false;
      this.verVoluntarioActividad = false;
      this.verReservar = false;
      this.verFauna = false;
      this.verFlora = false;
      this.verParticipantes = false;
    },
    verGrupo() {
      this.verPersonas = false;
      this.verOrganizaciones = false;
      this.verGrupos = true;
      this.verDonativos = false;
      this.verVoluntarioParticulares = false;
      this.verVoluntarioEstudiante = false;
      this.verActividades = false;
      this.verVoluntarioActividad = false;
      this.verReservar = false;
      this.verFauna = false;
      this.verFlora = false;
      this.verParticipantes = false;
    },
    verDonativo() {
      this.verPersonas = false;
      this.verOrganizaciones = false;
      this.verGrupos = false;
      this.verDonativos = true;
      this.verVoluntarioParticulares = false;
      this.verVoluntarioEstudiante = false;
      this.verActividades = false;
      this.verVoluntarioActividad = false;
      this.verReservar = false;
      this.verFauna = false;
      this.verFlora = false;
      this.verParticipantes = false;
    },
    verVoluntarioParticular() {
      this.verPersonas = false;
      this.verOrganizaciones = false;
      this.verGrupos = false;
      this.verDonativos = false;
      this.verVoluntarioParticulares = true;
      this.verVoluntarioEstudiante = false;
      this.verActividades = false;
      this.verVoluntarioActividad = false;
      this.verReservar = false;
      this.verFauna = false;
      this.verFlora = false;
      this.verParticipantes = false;
    },
    verVoluntarioEstudiantes() {
      this.verPersonas = false;
      this.verOrganizaciones = false;
      this.verGrupos = false;
      this.verDonativos = false;
      this.verVoluntarioParticulares = false;
      this.verVoluntarioEstudiante = true;
      this.verActividades = false;
      this.verVoluntarioActividad = false;
      this.verReservar = false;
      this.verFauna = false;
      this.verFlora = false;
      this.verParticipantes = false;
    },
    verActividad() {
      this.verPersonas = false;
      this.verOrganizaciones = false;
      this.verGrupos = false;
      this.verDonativos = false;
      this.verVoluntarioParticulares = false;
      this.verVoluntarioEstudiante = false;
      this.verActividades = true;
      this.verVoluntarioActividad = false;
      this.verReservar = false;
      this.verFauna = false;
      this.verFlora = false;
      this.verParticipantes = false;
    },
    verVoluntarioActividades() {
      this.verPersonas = false;
      this.verOrganizaciones = false;
      this.verGrupos = false;
      this.verDonativos = false;
      this.verVoluntarioParticulares = false;
      this.verVoluntarioEstudiante = false;
      this.verActividades = false;
      this.verVoluntarioActividad = true;
      this.verReservar = false;
      this.verFauna = false;
      this.verFlora = false;
      this.verParticipantes = false;
    },
    verReservas() {
      this.verPersonas = false;
      this.verOrganizaciones = false;
      this.verGrupos = false;
      this.verDonativos = false;
      this.verVoluntarioParticulares = false;
      this.verVoluntarioEstudiante = false;
      this.verActividades = false;
      this.verVoluntarioActividad = false;
      this.verReservar = true;
      this.verFauna = false;
      this.verFlora = false;
      this.verParticipantes = false;
    },
    verFaunas() {
      this.verPersonas = false;
      this.verOrganizaciones = false;
      this.verGrupos = false;
      this.verDonativos = false;
      this.verVoluntarioParticulares = false;
      this.verVoluntarioEstudiante = false;
      this.verActividades = false;
      this.verVoluntarioActividad = false;
      this.verReservar = false;
      this.verFauna = true;
      this.verFlora = false;
      this.verParticipantes = false;
    },
    verFloras() {
      this.verPersonas = false;
      this.verOrganizaciones = false;
      this.verGrupos = false;
      this.verDonativos = false;
      this.verVoluntarioParticulares = false;
      this.verVoluntarioEstudiante = false;
      this.verActividades = false;
      this.verVoluntarioActividad = false;
      this.verReservar = false;
      this.verFauna = false;
      this.verFlora = true;
      this.verParticipantes = false;
    },
        verParticipante() {
      this.verPersonas = false;
      this.verOrganizaciones = false;
      this.verGrupos = false;
      this.verDonativos = false;
      this.verVoluntarioParticulares = false;
      this.verVoluntarioEstudiante = false;
      this.verActividades = false;
      this.verVoluntarioActividad = false;
      this.verReservar = false;
      this.verFauna = false;
      this.verFlora = false;
      this.verParticipantes = true;
    },
    cancerlar(){
      this.verPersonas = false;
      this.verOrganizaciones = false;
      this.verGrupos = false;
      this.verDonativos = false;
      this.verVoluntarioParticulares = false;
      this.verVoluntarioEstudiante = false;
      this.verActividades = false;
      this.verVoluntarioActividad = false;
      this.verReservar = false;
      this.verFauna = false;
      this.verFlora = false;
      this.verParticipantes = false;
    }
  },

};
</script>
<style scoped>
h3 {
  font-weight: 600;
}
.btn-primary{
  background: linear-gradient(359deg, #3490dc, #3490dc70);
}
.btn-danger {
  background: linear-gradient(359deg, #e73838, #c70d0d8f);
}

@media only screen and (min-width: 192px) and (max-width: 1192px) {
  .card-tools button{
    margin: 5px 0;

  }
  
}

</style>