<template>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item">
                  <a class="nav-link" href="#historial" data-toggle="tab"
                    >Historial</a
                  >
                </li>
                <li class="nav-item">
                  <a
                    class="nav-link active show"
                    href="#usuario"
                    data-toggle="tab"
                    >Usuario</a
                  >
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#cambiar-password" data-toggle="tab"
                    >Cambiar Contraseña</a
                  >
                </li>
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <!--Div que contiene la vista de historial-->
                <div class="tab-pane" id="historial">
                  <h3 class="text-center">Historial de usuarios</h3>
                  <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Usuario Activo</th>
                          <th>Usuario Agregado</th>
                          <th>Usuario Modficado</th>
                          <th>Usuario Eliminado</th>
                          <th>Acción Realizada</th>
                          <th>Fecha</th>
                          <th>Hora</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr
                          v-for="historiales in historial.data"
                          :key="historiales.id"
                        >
                          <td>{{ historiales.usuarioActivo }}</td>
                          <td>{{ historiales.usuarioAgregado }}</td>
                          <td>
                            {{ historiales.usuarioModificadoAntes }} -
                            {{ historiales.usuarioModificadoNuevo }}
                          </td>
                          <td>{{ historiales.usuarioEliminado }}</td>
                          <td>{{ historiales.accion }}</td>
                          <td>{{ historiales.fecha }}</td>
                          <td>{{ historiales.hora }}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="card-footer">
                    <pagination
                      :data="historial"
                      :limit="5"
                      @pagination-change-page="getResults"
                    ></pagination>
                  </div>
                </div>
                <!--FIN Div que contiene la vista de historial-->

                <!--DIV que contiener la vista de usuario-->
                <div class="tab-pane" id="activity">
                  <h3 class="text-center">Historial de usuarios</h3>
                  <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Usuario Activo</th>
                          <th>Usuario Agregado</th>
                          <th>Usuario Modficado</th>
                          <th>Usuario Eliminado</th>
                          <th>Acción Realizada</th>
                          <th>Fecha</th>
                          <th>Hora</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr
                          v-for="historiales in historial.data"
                          :key="historiales.id"
                        >
                          <td>{{ historiales.usuarioActivo }}</td>
                          <td>{{ historiales.usuarioAgregado }}</td>
                          <td>
                            {{ historiales.usuarioModificadoAntes }} -
                            {{ historiales.usuarioModificadoNuevo }}
                          </td>
                          <td>{{ historiales.usuarioEliminado }}</td>
                          <td>{{ historiales.accion }}</td>
                          <td>{{ historiales.fecha }}</td>
                          <td>{{ historiales.hora }}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="card-footer">
                    <pagination
                      :data="historial"
                      :limit="5"
                      @pagination-change-page="getResults"
                    ></pagination>
                  </div>
                </div>
                <!-- Setting Tab -->
                <div class="tab-pane active show" id="usuario">
                  <form
                    class="form-horizontal"
                  >
                    <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label"
                        >Nombre</label
                      >
                      <div class="col-sm-12">
                        <input
                          type=""
                          v-model="form.name"
                          class="form-control"
                          id="inputName"
                          placeholder="Nombre"
                          :class="{ 'is-invalid': form.errors.has('name') }"
                        />
                        <has-error :form="form" field="name"></has-error>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail" class="col-sm-2 control-label"
                        >Correo</label
                      >
                      <div class="col-sm-12">
                        <input
                          type="email"
                          v-model="form.email"
                          class="form-control"
                          id="inputEmail"
                          placeholder="Correo"
                          :class="{ 'is-invalid': form.errors.has('email') }"
                        />
                        <has-error :form="form" field="email"></has-error>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12">
                        <button type="submit" @click.prevent="actualizarPerfil" class="btn btn-success">
                          Actualizar Usuario
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
                                <div class="tab-pane" id="cambiar-password">
                  <form class="form-horizontal">
                    <div class="form-group">
                      <label
                        for="current_password"
                        class="col-sm-2 control-label"
                        >Contraseña Anterior</label
                      >

                      <div class="col-sm-12">
                        <input
                          type="password"
                          v-model="form.current_password"
                          class="form-control"
                          id="current_password"
                          placeholder="Contraseña anterior"
                          :class="{
                            'is-invalid': form.errors.has('current_password'),
                          }"
                        />
                        <has-error
                          :form="form"
                          field="current_password"
                        ></has-error>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="new_password" class="col-sm-2 control-label"
                        >Nueva Contraseña</label
                      >

                      <div class="col-sm-12">
                        <input
                          type="password"
                          v-model="form.new_password"
                          class="form-control"
                          id="new_password"
                          placeholder="Nueva contraseña"
                          :class="{
                            'is-invalid': form.errors.has('new_password'),
                          }"
                        />
                        <has-error
                          :form="form"
                          field="new_password"
                        ></has-error>
                      </div>
                    </div>

                    <div class="form-group">
                      <label
                        for="confirm_password"
                        class="col-sm-2 control-label"
                        >Confirmar Contraseña</label
                      >

                      <div class="col-sm-12">
                        <input
                          type="password"
                          v-model="form.confirm_password"
                          class="form-control"
                          id="confirm_password"
                          placeholder="Confirmar contraseña"
                          :class="{
                            'is-invalid': form.errors.has('confirm_password'),
                          }"
                        />
                        <has-error
                          :form="form"
                          field="confirm_password"
                        ></has-error>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-12">
                        <button
                          @click.prevent="actualizarPassword"
                          type="submit"
                          class="btn btn-success"
                        >
                          Actualizar Contraseña
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      historial: {},
      form: new Form({
        id: "",
        name: "",
        email: "",
        password: "",
        created_at: "",
      }),
    };
  },
  methods: {
    getResults(page = 1) {
      this.$Progress.start();
      axios
        .get("/api/historial?page=" + page)
        .then(({ data }) => (this.historial = data.data));
      this.$Progress.finish();
    },
    cargarTrigger() {
      if (this.$gate.isAdmin() || this.$gate.isUser()) {
        axios
          .get("/api/historial")
          .then(({ data }) => (this.historial = data.data));
      }
    },
    actualizarPerfil() {
        console.log(this.$gate.getIdUser());
      this.$Progress.start();
      if (this.form.password == "") {
        this.form.password = undefined;
      }
      this.form
        .put("/api/perfil/actualizar")
        .then((data) => {
            this.form.reset();
            this.form.errors.clear();
          this.$Progress.finish();
          Toast.fire({
            icon: "success",
            title: data.data.message,
          });
        })
        .catch((data) => {
          this.$Progress.fail();

          Toast.fire({
            icon: "error",
            title: "Ocurrio un problema!",
          });
        });
    },
        actualizarPassword() {
      this.$Progress.start();
      this.form
        .post("/api/perfil/cambiar")
        .then((data) => {
          //  Fire.$emit('AfterCreate');
          this.$Progress.finish();
          this.form.current_password = "";
          this.form.new_password = "";
          this.form.confirm_password = "";

          Toast.fire({
            icon: "success",
            title: data.data.message,
          });
        })
        .catch(() => {
          this.$Progress.fail();

          Toast.fire({
            icon: "error",
            title: "Ocurrio un problema",
          });
        });
    },
  },
  created() {
    this.$Progress.start();
    this.cargarTrigger();
    this.$Progress.finish();
  },
};
</script>
