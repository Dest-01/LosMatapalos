<template>
  <div class="Principal">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid"  v-if="$gate.isAdmin() || $gate.isUser()">
        <div class="block-header">
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <ul class="breadcrumb breadcrumb-style">
                <li class="breadcrumb-item">
                  <h4 class="page-title">Dashboard</h4>
                </li>
                <li class="breadcrumb-item bcrumb-1">
                  <a href="">
                    <i class="fas fa-home"></i>
                    Inicio
                  </a>
                </li>
                  <li class="breadcrumb-item active">
                    Dashboard
                  </li>
              </ul>
            </div>
          </div>
        </div>
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"
                ><i class="fas fa-people-carry"></i
              ></span>

              <div class="info-box-content">
                <span class="info-box-text">Donaciones</span>
                <span class="info-box-number">{{ totalDonaciones }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"
                ><i class="fas fa-edit"></i
              ></span>

              <div class="info-box-content">
                <span class="info-box-text">Reservaciones</span>
                <span class="info-box-number">{{ totalReservaciones }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"
                ><i class="fas fa-calendar-check"></i
              ></span>

              <div class="info-box-content">
                <span class="info-box-text">Actividades</span>
                <span class="info-box-number">{{ totalActividades }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"
                ><i class="fas fa-users"></i
              ></span>

              <div class="info-box-content">
                <span class="info-box-text">Personas</span>
                <span class="info-box-number">{{ totalPersonas }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        
      </div>
      <!-- /.container-fluid -->
      <!-- TABLE: LATEST ORDERS -->
      <div class="contenedor-tablas"  v-if="$gate.isAdmin() || $gate.isUser()">
        <div class="card">
          <div class="card-header border-transparent">
            <h3 class="card-title">Últimas Reservaciones</h3>

            <div class="card-tools">
              <button
                type="button"
                class="btn btn-tool"
                data-card-widget="collapse"
              >
                <i style="color: white" class="fas fa-minus"></i>
              </button>
              <button
                type="button"
                class="btn btn-tool"
                data-card-widget="remove"
              >
                <i style="color: white" class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->

          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table m-0">
                <thead>
                  <tr>
                    <th>Identificación</th>
                    <th>Fecha</th>
                    <th>Cantidad Visitantes</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="reserva in reservaciones.data" :key="reserva.id">
                    <td>
                      <a href="pages/examples/invoice.html"
                        >{{ reserva.identificacionPersona }} {{ reserva.identificacionOrganizacion }}</a
                      >
                    </td>
                    <td>{{ reserva.fecha }}</td>
                    <td>
                      <span class="badge badge-info">{{
                        reserva.cantidad
                      }}</span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer clearfix">
            <a
              href="/admin/reservar"
              class="btn btn-sm btn-secondary float-right"
              >Ver todas las reservaciones</a
            >
          </div>
          <!-- /.card-footer -->
        </div>

        <div class="card">
          <div class="card-header border-transparent">
            <h3 class="card-title">Últimas Donaciones</h3>

            <div class="card-tools">
              <button
                type="button"
                class="btn btn-tool"
                data-card-widget="collapse"
              >
                <i style="color: white" class="fas fa-minus"></i>
              </button>
              <button
                type="button"
                class="btn btn-tool"
                data-card-widget="remove"
              >
                <i style="color: white" class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->

          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table m-0">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th>Tipo</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="donacion in donaciones.data" :key="donacion.id">
                    <td>
                      <a href="pages/examples/invoice.html"
                        >{{ donacion.identificacionPersona }}
                        {{ donacion.identificacionOrganizacion }}</a
                      >
                    </td>
                    <td>{{ donacion.fecha }}</td>
                    <td>
                      <span class="badge badge-success">{{
                        donacion.tipo
                      }}</span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer clearfix">
            <a
              href="/admin/donativos"
              class="btn btn-sm btn-secondary float-right"
              >Ver todas las donaciones</a
            >
          </div>
          <!-- /.card-footer -->
        </div>
        <!--/.card -->
        <div class="card">
          <div class="card-header border-transparent">
            <h3 class="card-title">Últimas Actividades</h3>

            <div class="card-tools">
              <button
                type="button"
                class="btn btn-tool"
                data-card-widget="collapse"
              >
                <i style="color: white" class="fas fa-minus"></i>
              </button>
              <button
                type="button"
                class="btn btn-tool"
                data-card-widget="remove"
              >
                <i style="color: white" class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->

          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table m-0">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th>Tipo</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="actividad in actividades.data" :key="actividad.id">
                    <td>
                      <a href="pages/examples/invoice.html">{{
                        actividad.nombre
                      }}</a>
                    </td>
                    <td>{{ actividad.fecha }}</td>
                    <td>
                      <span class="badge badge-success">{{
                        actividad.tipo
                      }}</span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer clearfix">
            <a
              href="/admin/actividad"
              class="btn btn-sm btn-secondary float-right"
              >Ver todas las actividades</a
            >
          </div>
          <!-- /.card-footer -->
        </div>

        <!-- /.col -->
      </div>
    </section>
    <!-- /.content -->
    <div v-if="!$gate.isAdmin() && !$gate.isUser()">
        <not-found></not-found>
      </div>
  </div>
</template>


<script>
export default {
  data() {
    return {
      personas: {},
      totalPersonas: "0",
      totalActividades: "0",
      totalDonaciones: "0",
      totalReservaciones: "0",
      reservaciones: {},
      donaciones: {},
      actividades: {},
    };
  },
  methods: {
     TotalDatos() {
     if (this.$gate.isAdmin() || (this.$gate.isUser())) {
         axios
          .get("/api/dashboard/TotalPersonas")
          .then(({ data }) => (this.totalPersonas = data.data));
         axios
          .get("/api/dashboard/TotalActividades")
          .then(({ data }) => (this.totalActividades = data.data));
         axios
          .get("/api/dashboard/TotalDonaciones")
          .then(({ data }) => (this.totalDonaciones = data.data));
         axios
          .get("/api/dashboard/TotalReservaciones")
          .then(({ data }) => (this.totalReservaciones = data.data));
      }
    },
    cargarReservas() {
      if (this.$gate.isAdmin() || (this.$gate.isUser())) {
        axios
          .get("/api/dashboard/ultimasReservaciones")
          .then(({ data }) => (this.reservaciones = data.data));
        axios
          .get("/api/dashboard/ultimasDonaciones")
          .then(({ data }) => (this.donaciones = data.data));
        axios
          .get("/api/dashboard/ultimasActividades")
          .then(({ data }) => (this.actividades = data.data));
      }
    },
  },

  created() {
    this.$Progress.start();
    this.TotalDatos();
    this.cargarReservas();
    this.$Progress.finish();
  },
};
</script>

<style scoped>
.Principal{
  background: #e9ecef;
  height: 100%;
}
.Navegador {
  display: flex;
}

.content-header {
  padding: 10px 0.1rem;
}
.contenedor-tablas {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  align-content: center;
  align-items: flex-start;
  justify-content: space-evenly;
  font-size: 1.1rem;
}
.users-list > li img {
  border-radius: 50%;
  /* height: auto; */
  max-width: 100%;
}

img {
  width: 75px;
  height: 75px;
}

.card {
  position: relative;
  display: flex;
  flex-direction: column;
  min-width: 0;
  word-wrap: break-word;
  background-color: #fff;
  background-clip: border-box;
  border: 1px solid rgba(0, 0, 0, 0.125);
  border-radius: 0.25rem;
  width: 30%;
  margin: 10px;
  border-radius: 1rem;
}

.card-header {
  padding: 0.75rem 1.25rem;
  margin-bottom: 0;
  background-color: rgb(56 193 114);
  border-bottom: 1px solid rgba(0, 0, 0, 0.125);
  color: white;
  border-radius: 1rem 1rem 1px 1px;
      font-size: 1.1rem;
  font-weight: 900;
}

.info-box {
  box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);
  border-radius: 1rem;
  background-color: #fff;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  margin-bottom: 1rem;
  min-height: 100px;
  padding: 0.5rem;
  position: relative;
  width: 100%;
    font-size: 1.1rem;
  font-weight: 900;
}

.info-box .info-box-icon {
  border-radius: 0.25rem;
  -webkit-align-items: center;
  -ms-flex-align: center;
  align-items: center;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  font-size: 1.875rem;
  -webkit-justify-content: center;
  -ms-flex-pack: center;
  justify-content: center;
  text-align: center;
  width: 50px;
  height: 50px;
}


@media only screen and (max-device-width: 768px) {
  .contenedor-tablas {
    margin-right: 20px;
  }
  .card {
    width: 100%;
  }
}
</style>