<template>
  <div class="">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
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
                <span class="info-box-text">Ususarios</span>
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
      <div class="contenedor-tablas">
        <div class="card">
          <div class="card-header border-transparent">
            <h3 class="card-title">Ultimas Reservaciones</h3>

            <div class="card-tools">
              <button
                type="button"
                class="btn btn-tool"
                data-card-widget="collapse"
              >
                <i class="fas fa-minus"></i>
              </button>
              <button
                type="button"
                class="btn btn-tool"
                data-card-widget="remove"
              >
                <i class="fas fa-times"></i>
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
                  <tr>
                    <td><a href="pages/examples/invoice.html">132312132</a></td>
                    <td>2021-10-18</td>
                    <td><span class="badge badge-info">Total: 20</span></td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">132312132</a></td>
                    <td>2021-10-18</td>
                    <td><span class="badge badge-info">Total: 20</span></td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">132312132</a></td>
                    <td>iPhone 6 Plus</td>
                    <td><span class="badge badge-info">Total: 20</span></td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">132312132</a></td>
                    <td>2021-10-18</td>
                    <td><span class="badge badge-info">Total: 20</span></td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">132312132</a></td>
                    <td>2021-10-18</td>
                    <td><span class="badge badge-info">Total: 20</span></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer clearfix">
            <a
              href="javascript:void(0)"
              class="btn btn-sm btn-secondary float-right"
              >Ver todas las reservas</a
            >
          </div>
          <!-- /.card-footer -->
        </div>
        <!-- USERS LIST -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Ultimas Donaciones</h3>

            <div class="card-tools">
              <button
                type="button"
                class="btn btn-tool"
                data-card-widget="collapse"
              >
                <i class="fas fa-minus"></i>
              </button>
              <button
                type="button"
                class="btn btn-tool"
                data-card-widget="remove"
              >
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <ul class="users-list clearfix">
              <li>
                <img v-bind:src="'/images/profile.png'" alt="User Image" />
                <a class="users-list-name" href="#">Alexander Pierce</a>
                <span class="users-list-date">Today</span>
              </li>
              <li>
                <img v-bind:src="'/images/profile.png'" alt="User Image" />
                <a class="users-list-name" href="#">Norman</a>
                <span class="users-list-date">Yesterday</span>
              </li>
              <li>
                <img v-bind:src="'/images/profile.png'" alt="User Image" />
                <a class="users-list-name" href="#">Jane</a>
                <span class="users-list-date">12 Jan</span>
              </li>
              <li>
                <img v-bind:src="'/images/profile.png'" alt="User Image" />
                <a class="users-list-name" href="#">John</a>
                <span class="users-list-date">12 Jan</span>
              </li>
              <li>
                <img v-bind:src="'/images/profile.png'" alt="User Image" />
                <a class="users-list-name" href="#">Alexander</a>
                <span class="users-list-date">13 Jan</span>
              </li>
            </ul>
            <!-- /.users-list -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer text-center">
            <a
              href="javascript:void(0)"
              class="btn btn-sm btn-secondary float-right"
              >Ver todas las donaciones</a
            >
          </div>
          <!-- /.card-footer -->
        </div>
        <!--/.card -->
        <div class="card">
          <div class="card-header border-transparent">
            <h3 class="card-title">Ultimas Actividades</h3>

            <div class="card-tools">
              <button
                type="button"
                class="btn btn-tool"
                data-card-widget="collapse"
              >
                <i class="fas fa-minus"></i>
              </button>
              <button
                type="button"
                class="btn btn-tool"
                data-card-widget="remove"
              >
                <i class="fas fa-times"></i>
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
                  <tr>
                    <td><a href="pages/examples/invoice.html">Caminata</a></td>
                    <td>2021-10-18</td>
                    <td><span class="badge badge-success">Publico</span></td>
                  </tr>
                  <tr>
                    <td>
                      <a href="pages/examples/invoice.html">Recolección</a>
                    </td>
                    <td>2021-10-18</td>
                    <td>
                      <span class="badge badge-warning">Voluntarios</span>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">Caminta</a></td>
                    <td>2021-10-18</td>
                    <td><span class="badge badge-success">Publico</span></td>
                  </tr>
                  <tr>
                    <td>
                      <a href="pages/examples/invoice.html">Recolección</a>
                    </td>
                    <td>2021-10-18</td>
                    <td>
                      <span class="badge badge-warning">Voluntarios</span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <a href="pages/examples/invoice.html">Recolección</a>
                    </td>
                    <td>2021-10-18</td>
                    <td>
                      <span class="badge badge-warning">Voluntarios</span>
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
              href="javascript:void(0)"
              class="btn btn-sm btn-secondary float-right"
              >Ver todas las actividades</a
            >
          </div>
          <!-- /.card-footer -->
        </div>

        <!-- /.col -->
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
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
    };
  },
  methods: {
   async TotalDatos() {
      if (this.$gate.isAdmin()) {
       await axios
          .get("/api/dashboard/TotalPersonas")
          .then(({ data }) => (this.totalPersonas = data.data));
      await  axios
          .get("/api/dashboard/TotalActividades")
          .then(({ data }) => (this.totalActividades = data.data));
      await  axios
          .get("/api/dashboard/TotalDonaciones")
          .then(({ data }) => (this.totalDonaciones = data.data));
      await  axios
          .get("/api/dashboard/TotalReservaciones")
          .then(({ data }) => (this.totalReservaciones = data.data));
      }
    },
  },

  created() {
    this.$Progress.start();
    this.TotalDatos();
    this.$Progress.finish();
  },
};
</script>

<style scoped>
.contenedor-tablas {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  align-content: center;
  align-items: flex-start;
  justify-content: center;
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
  width: 400px;
  margin-left: 15px;
}

@media only screen and (max-device-width: 768px) {
  .contenedor-tablas {
    margin-right: 15px;
  }
}
</style>