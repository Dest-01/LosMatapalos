<template>
  <div class="" style="margin-top: 85px">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <div class="intro" style="text-align: center">
      <h2>Reservación del sendero los Matapalos</h2>
    </div>
    <div class="contenedor-2">
      <div class="card mb-3">
        <div class="row g-0">
          <div class="col-md-5">
            <H2 style="text-align: center">Horario Sendero</H2>
            <div class="horas">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Hora Llegada</th>
                    <th scope="col">Hora Salida</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>8:00 a.m.</td>
                    <td>9:00 a.m.</td>
                    <td>
                      <button
                        style="height: 35px; width: 55px"
                        type="button"
                        class="btn btn-danger btn-sm px-3"
                        @click="opcionHora1()"
                        :disabled="bloquearCampos"
                      >
                        <i class="fas fa-plus"></i>
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td>9:00 a.m.</td>
                    <td>10:00 a.m.</td>
                    <td>
                      <button
                        style="height: 35px; width: 55px"
                        type="button"
                        class="btn btn-danger btn-sm px-3"
                        @click="opcionHora2()"
                        :disabled="bloquearCampos"
                      >
                        <i class="fas fa-plus"></i>
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td>10:00 a.m.</td>
                    <td>11:00 a.m.</td>
                    <td>
                      <button
                        style="height: 35px; width: 55px"
                        type="button"
                        class="btn btn-danger btn-sm px-3"
                        @click="opcionHora3()"
                        :disabled="bloquearCampos"
                      >
                        <i class="fas fa-plus"></i>
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td>11:00 a.m.</td>
                    <td>12:00 p.m.</td>
                    <td>
                      <button
                        style="height: 35px; width: 55px"
                        type="button"
                        class="btn btn-danger btn-sm px-3"
                        @click="opcionHora4()"
                        :disabled="bloquearCampos"
                      >
                        <i class="fas fa-plus"></i>
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td>01:00 p.m.</td>
                    <td>02:00 p.m.</td>
                    <td>
                      <button
                        style="height: 35px; width: 55px"
                        type="button"
                        class="btn btn-danger btn-sm px-3"
                        @click="opcionHora6()"
                        :disabled="bloquearCampos"
                      >
                        <i class="fas fa-plus"></i>
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td>02:00 p.m.</td>
                    <td>03:00 p.m.</td>
                    <td>
                      <button
                        style="height: 35px; width: 55px"
                        type="button"
                        class="btn btn-danger btn-sm px-3"
                        @click="opcionHora7()"
                        :disabled="bloquearCampos"
                      >
                        <i class="fas fa-plus"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card-body">
              <h5 class="card-title">Formulario de Reservación</h5>
              <i class="fas fa-info-circle"> Indicaciones</i><br />
              <i class="fas fa-angle-right"
                >Puede registrar cliente, organización o grupo.</i
              >
              <i class="fas fa-angle-right"
                >Es necesario comprobar que esta registrado.</i
              >
              <i class="fas fa-angle-right"
                >Se enviara un correo con la información de la reservación.</i
              >
              <button
                type="button"
                class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#addNew"
                @click="modalPersona()"
              >
                Persona
              </button>
              <button
                type="button"
                class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#addNew"
                @click="modalGrupo()"
              >
                Grupo
              </button>
              <button
                type="button"
                class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#addNew"
                @click="modalOrganizacion()"
              >
                Organización
              </button>
              <br />
              <br />
              <form class="material-form">
                <br />
                <div class="group">
                  <i class="fas fa-id-card iconoInput"></i>
                  <h3>Busqueda identificacion</h3>
                  <div class="campo1">
                    <input
                      style="width: 100%"
                      v-model="formReserva.identificacion"
                      name="identificacion"
                      type="text"
                      required
                      :disabled="bloquearConsulta"
                      maxlength="18"
                    />
                    <span style="width: 100%" class="highlight"></span>
                    <span style="width: 100%" class="bar"></span>
                  </div>
                  <div>
                    <h2
                      v-text="mensajeExistencia"
                      style="font-size: 15px; color: green"
                    >
                      {{ mensajeExistencia }}
                    </h2>
                    <h2
                      v-text="mensajeNoExistencia"
                      style="font-size: 15px; color: red"
                    >
                      {{ mensajeNoExistencia }}
                    </h2>
                  </div>
                  <button
                    type="button"
                    @click="consultarDatos()"
                    class="Posicionar btn btn-success"
                  >
                    Consulta
                  </button>
                </div>
                <div class="group2">
                  <div class="campo2">
                    <i class="fas fa-users iconoInput"></i>
                    <h3>Cantidad de visitantes</h3>
                    <input
                      style="width: 100%"
                      v-model="formReserva.cantidad"
                      type="number"
                      required
                      :disabled="bloquearCampos"
                    />
                    <span style="width: 100%" class="highlight"></span>
                    <span style="width: 100%" class="bar"></span>
                  </div>
                  <div class="campo2">
                    <i class="fas fa-calendar-check iconoInput2 icono"></i>
                    <h3 class="labelH3">Fecha de llegada</h3>
                    <input
                      style="width: 100%"
                      v-model="formReserva.fecha"
                      type="date"
                      value="Fecha"
                      required
                      :disabled="bloquearCampos"
                    />
                    <span style="width: 100%" class="highlight"></span>
                    <span style="width: 100%" class="bar"></span>
                  </div>
                </div>
                <div class="group2">
                  <div class="campo2">
                    <i class="fas fa-clock iconoInput2"></i>
                    <h3>Hora de llegada</h3>
                    <input
                      style="width: 100%"
                      v-model="formReserva.horaInicio"
                      type="time"
                      required
                      :disabled="bloqueraHoras"
                    />
                  </div>
                  <div class="campo2">
                    <i class="fas fa-clock iconoInput2 icono"></i>
                    <h3 class="labelH3">Hora de Salida</h3>
                    <input
                      style="width: 100%"
                      v-model="formReserva.horaFin"
                      type="time"
                      required
                      :disabled="bloqueraHoras"
                    />
                  </div>
                </div>
                <button
                  type="button"
                  class="btn btn-success btn-rounded"
                  @click="crearReserva()"
                  :disabled="bloquearCampos"
                >
                  Reservar
                </button>
                <button
                  type="button"
                  class="btn btn-danger btn-rounded"
                  @click="cancelarConsulta()"
                >
                  Cancelar
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal -->
    <div
      class="modal fade"
      id="addNew"
      tabindex="-1"
      role="dialog"
      aria-labelledby="addNew"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Registro de información</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <form>
            <div class="modal-body">
              <!-- MODAL DE PERSONA-->
              <div v-show="soloPersona" class="group">
                <i class="fas fa-id-card iconoInput"></i>
                <input
                style="text-transform: inherit"
                  name="id"
                  v-model="formPersona.id"
                  type="text"
                  :class="{ 'is-invalid': formPersona.errors.has('id') }"
                />
                <has-error
                  style="top: 60px"
                  :form="formPersona"
                  field="id"
                ></has-error>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Cedula persona</label>
              </div>
              <div v-show="soloPersona" class="group">
                <i class="fas fa-user-circle iconoInput"></i>
                <input
                  name="nombre"
                  v-model="formPersona.nombre"
                  type="text"
                  :class="{ 'is-invalid': formPersona.errors.has('nombre') }"
                />
                <has-error
                  style="top: 60px"
                  :form="formPersona"
                  field="nombre"
                ></has-error>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Nombre</label>
              </div>
              <div v-show="soloPersona" class="group">
                <i class="fas fa-user-circle iconoInput"></i>
                <input
                  name="apellido1"
                  v-model="formPersona.apellido1"
                  type="text"
                  :class="{ 'is-invalid': formPersona.errors.has('apellido1') }"
                />
                <has-error
                  style="top: 60px"
                  :form="formPersona"
                  field="apellido1"
                ></has-error>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Primer Apellido</label>
              </div>
              <div v-show="soloPersona" class="group">
                <i class="fas fa-user-circle iconoInput"></i>
                <input
                  name="apellido2"
                  v-model="formPersona.apellido2"
                  type="text"
                  :class="{ 'is-invalid': formPersona.errors.has('apellido2') }"
                />
                <has-error
                  style="top: 60px"
                  :form="formPersona"
                  field="apellido2"
                ></has-error>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Segundo Apellido</label>
              </div>
              <div v-show="soloPersona" class="group">
                <i class="fas fa-mobile-alt iconoInput"></i>
                <input
                  name="telefono"
                  v-model="formPersona.telefono"
                  type="number"
                  :class="{ 'is-invalid': formPersona.errors.has('telefono') }"
                />
                <has-error
                  style="top: 60px"
                  :form="formPersona"
                  field="telefono"
                ></has-error>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Telefono</label>
              </div>
              <div v-show="soloPersona" class="group">
                <i class="fas fa-at iconoInput"></i>
                <input
                style="text-transform: inherit"
                  name="correo"
                  v-model="formPersona.correo"
                  type="email"
                  :class="{ 'is-invalid': formPersona.errors.has('correo') }"
                />
                <has-error
                  style="top: 60px"
                  :form="formPersona"
                  field="correo"
                ></has-error>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Email</label>
              </div>
              <!-- FIN DE MODAL DE PERSONA -->
              <!-- MODAL DE ORGANIZACION -->
              <div v-show="soloOrganizacion" class="group">
                <i class="fas fa-id-card iconoInput"></i>
                <input
                  v-model="formOrganizacion.id"
                  name="id"
                  type="text"
                  :class="{ 'is-invalid': formOrganizacion.errors.has('id') }"
                />
                <has-error
                  style="top: 60px"
                  :form="formOrganizacion"
                  field="id"
                ></has-error>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Cedula organización</label>
              </div>
              <div v-show="soloOrganizacion" class="group">
                <i class="fas fa-user-circle iconoInput"></i>
                <input
                  v-model="formOrganizacion.nombre"
                  name="nombre"
                  type="text"
                  :class="{
                    'is-invalid': formOrganizacion.errors.has('nombre'),
                  }"
                />
                <has-error
                  style="top: 60px"
                  :form="formOrganizacion"
                  field="nombre"
                ></has-error>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Nombre de la organización</label>
              </div>
              <div v-show="soloOrganizacion" class="group">
                <i class="fas fa-mobile-alt iconoInput"></i>
                <input
                  v-model="formOrganizacion.telefono"
                  name="telefono"
                  type="number"
                  :class="{
                    'is-invalid': formOrganizacion.errors.has('telefono'),
                  }"
                />
                <has-error
                  style="top: 60px"
                  :form="formOrganizacion"
                  field="telefono"
                ></has-error>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Telefono de la organización</label>
              </div>
              <div v-show="soloOrganizacion" class="group">
                <i class="fas fa-at iconoInput"></i>
                <input
                  style="text-transform: inherit"
                  v-model="formOrganizacion.correo"
                  name="correo"
                  type="email"
                  :class="{
                    'is-invalid': formOrganizacion.errors.has('correo'),
                  }"
                />
                <has-error
                  style="top: 60px"
                  :form="formOrganizacion"
                  field="correo"
                ></has-error>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Email de la organización</label>
              </div>
              <!-- FIN DE MODAL DE ORGANIZACION -->
              <!-- MODAL DE GRUPO -->
              <div v-show="soloGrupo" class="group">
                <input type="text" required />
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Numero de grupo</label>
              </div>
              <!-- FIN DE MODAL DE GRUPO -->
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-danger"
                data-bs-target="#addNew"
                data-bs-dismiss="modal"
                @click="limpiarTodo()"
              >
                Cancelar
              </button>
              <button
                v-show="soloPersona"
                type="button"
                class="btn btn-success"
                data-bs-toggle="modal"
                data-bs-target="#addNew"
                @click="crearPersona()"
              >
                Guardar
              </button>
              <button
                v-show="soloOrganizacion"
                type="button"
                class="btn btn-success"
                data-bs-toggle="modal"
                data-bs-target="#addNew"
                @click="crearOrganizacion()"
              >
                Guardar
              </button>
              <button
                v-show="soloGrupo"
                type="button"
                class="btn btn-success"
                data-bs-toggle="modal"
                data-bs-target="#addNew"
              >
                Guardar
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Fin Modal -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      bloqueraHoras: true,
      bloquearCampos: true,
      bloquearConsulta: false,
      soloPersona: false,
      soloOrganizacion: false,
      soloGrupo: false,
      persona: {},
      organizacion: {},
      grupo: {},
      mensajeExistencia: "",
      mensajeNoExistencia: "",
      formReserva: new Form({
        id: "",
        identificacion: "",
        idPersona: "",
        idOrganizacion: "",
        cantidad: "",
        fecha: "",
        horaInicio: "",
        horaFin: "",
      }),
      formPersona: new Form({
        id: "",
        nombre: "",
        apellido1: "",
        apellido2: "",
        telefono: "",
        correo: "",
      }),
      formOrganizacion: new Form({
        id: "",
        nombre: "",
        telefono: "",
        correo: "",
      }),
      formGrupo: new Form({
        id: "",
        idPersona: "",
        photo: "",
      }),
      id: 0,
      tituloModal: "",
      modal: 0,
    };
  },
  methods: {
    modalPersona() {
      this.soloPersona = true;
      this.soloOrganizacion = false;
      this.soloGrupo = false;
    },
    modalOrganizacion() {
      this.soloPersona = false;
      this.soloOrganizacion = true;
      this.soloGrupo = false;
    },
    modalGrupo() {
      this.soloPersona = false;
      this.soloOrganizacion = false;
      this.soloGrupo = true;
    },
    cancelarConsulta() {
      this.formReserva.reset();
      this.formReserva.errors.clear();
      this.mensajeExistencia = "";
      this.mensajeNoExistencia = "";
      this.bloquearCampos = true;
      this.bloquearConsulta = false;
    },
    limpiarTodo() {
      this.formPersona.reset();
      this.formPersona.errors.clear();
      this.formOrganizacion.reset();
      this.formOrganizacion.errors.clear();
    },
    siExiste() {
      for (let i = 0; i < this.persona.length; i++) {
        if (this.persona[i].id == this.formReserva.identificacion) {
          this.mensajeExistencia = "Si esta registrado";
          this.mensajeNoExistencia = "";
          this.bloquearCampos = false;
          this.bloquearConsulta = true;
          this.formReserva.idPersona = this.formReserva.identificacion;
        }
      }
      for (let i = 0; i < this.organizacion.length; i++) {
        if (this.organizacion[i].id == this.formReserva.identificacion) {
          this.mensajeExistencia = "Si esta registrado";
          this.mensajeNoExistencia = "";
          this.bloquearCampos = false;
          this.bloquearConsulta = true;
          this.formReserva.idOrganizacion = this.formReserva.identificacion;
        }
      }
    },
    noExiste() {
      if (this.persona.length == 0 && this.organizacion.length == 0) {
        this.mensajeExistencia = "";
        this.mensajeNoExistencia = "No esta registrado";
        this.bloquearCampos = true;
        this.bloquearConsulta = false;
      }
      if (this.formReserva.identificacion.length == 0) {
        this.mensajeExistencia = "";
        this.mensajeNoExistencia =
          "Campo vacio, por favor digite la información";
        this.bloquearCampos = true;
        this.bloquearConsulta = false;
      }
    },
    consultarDatos() {
      this.formReserva
        .get("/api/reservarCliente/verificar", {
          params: { buscador: this.formReserva.identificacion },
        })
        .then(({ data }) => (this.persona = data.data))

        .then((response) => {
          this.siExiste();
          this.noExiste();
        });
      this.formReserva
        .get("/api/reservarCliente/verificarOrg", {
          params: { buscador: this.formReserva.identificacion },
        })
        .then(({ data }) => (this.organizacion = data.data))
        .then((response) => {
          this.siExiste();
          this.noExiste();
        });
    },
    async crearPersona() {
      await this.formPersona
        .post("/api/reservarCliente/persona", {
          params: { id: this.formPersona.id },
        })
        .then((response) => {
          if (response.data == true) {
            $("#addNew").modal("hide");
          }
          Swal.fire("Registrado!", response.data.message, "success");
          this.limpiarTodo();
        })
        .catch((error) => {
          Swal.fire(
            "Error!",
            "Ya existe en el registro o campos vacios!",
            "error"
          );
        });
    },

    async crearOrganizacion() {
      await this.formOrganizacion
        .post("/api/reservarCliente/organizacion", {
          params: { id: this.formOrganizacion.id },
        })
        .then((response) => {
          if (response.data == true) {
            $("#addNew").modal("hide");
          }
          Swal.fire("Registrado!", response.data.message, "success");
          this.limpiarTodo();
        })
        .catch((error) => {
          Swal.fire(
            "Error!",
            "Ya existe en el registro o campos vacios!",
            "error"
          );
        });
    },

    crearReserva() {
      this.formReserva
        .post("/api/reservarCliente")
        .then((response) => {
          Swal.fire("Reservación Realizada!", response.data.message, "success");
          this.formReserva.reset();
          this.formReserva.errors.clear();
          this.mensajeExistencia = "";
          this.bloquearCampos = true;
          this.bloquearConsulta = false;
          this.$Progress.finish();
        })
        .catch(() => {
          Swal.fire(
            "Error!",
            "No se realizo la reservación, revise los campos",
            "error"
          );
        });
    },

    opcionHora1() {
      this.formReserva.horaInicio = "08:00:00";
      this.formReserva.horaFin = "09:00";
    },
    opcionHora2() {
      this.formReserva.horaInicio = "09:00";
      this.formReserva.horaFin = "10:00";
    },
    opcionHora3() {
      this.formReserva.horaInicio = "10:00";
      this.formReserva.horaFin = "11:00";
    },
    opcionHora4() {
      this.formReserva.horaInicio = "11:00";
      this.formReserva.horaFin = "12:00";
    },
    opcionHora5() {
      this.formReserva.horaInicio = "12:00";
      this.formReserva.horaFin = "13:00";
    },
    opcionHora6() {
      this.formReserva.horaInicio = "13:00";
      this.formReserva.horaFin = "14:00";
    },
    opcionHora7() {
      this.formReserva.horaInicio = "14:00";
      this.formReserva.horaFin = "15:00";
    },
  },
  created() {
    this.$Progress.start();
    this.$Progress.finish();
  },
};
</script>

<style scoped>
.iconoInput {
  color: #e8e8e8;
  font-size: 26px;
  position: absolute;
  left: 10px;
  padding-top: 11px;
}

.Posicionar {
  position: absolute;
  left: 350px;
  top: 3px;
}

.iconoInput2 {
  color: #e8e8e8;
  font-size: 26px;
  position: absolute;
  left: 7px;
  padding-top: 11px;
}

input:focus ~ label[data-v-4bc2021a],
input:valid ~ label[data-v-4bc2021a] {
  top: -20px;
  font-size: 20px;
  color: #000000;
}

.modal-content {
  width: 540px;
  border: 0;
  -webkit-box-shadow: 0 10px 20px 0 rgb(0 0 0 / 5%);
  box-shadow: 0 10px 20px 0 rgb(0 0 0 / 5%);
}
.contenedor-2 {
  display: flex;
  margin: 10px;
  justify-content: space-evenly;
  margin: 10px;
}
.card {
  width: 1000px;
  height: auto;
  box-shadow: 3px 3px 3px 3px rgb(0 0 0 / 30%);
}

.intro {
  margin: auto auto 20px auto;
  background: #faf9f7;
  height: 45px;
  text-align: center;
  font-size: 25px;
  font-family: "Poppins";
  /* padding: 5px; */
  border-top: outset;
}
.col-md-5 {
  padding: 5px;
  background: #034991;
  background-image: url("/images/logo.png");
  background-position-x: -100px;
  background-position-y: 160px;
  background-repeat: no-repeat;
  background-blend-mode: lighten;
  background-size: 700px;
  color: white;
  font-family: "Poppins";
  padding-top: 20px;
}
td {
  font-weight: bold;
  font-size: 16px;
}
.btn {
  height: 40px;
  width: 140px;
  font-size: 19px;
  padding: 5px;
  text-transform: capitalize;
}

.horas {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  justify-content: space-around;
  align-content: center;
}
.table {
  color: white;
  font-size: 16px;
}

.card-title {
  font-size: 35px;
  text-align: center;
  font-weight: 900;
  padding: 5px;
}
h6 {
  font-family: "Poppins";
  font-size: 25px;
  padding: 5px;
  text-align: center;
}

/* form starting stylings ------------------------------- */
.group {
  position: relative;
  margin-bottom: 40px;
}
.group2 {
  position: relative;
  margin-bottom: 40px;
  position: relative;
  margin-bottom: 40px;
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  width: 500px;
}
input {
  font-size: 18px;
  padding: 10px 10px 10px 45px;
  display: block;
  width: 500px;
  border: none;
  border-bottom: 1px solid #757575;
  text-transform: capitalize;
}

.InputGroup {
  margin-right: 5px;
  margin-left: 5px;
}

.campo1 {
  width: 350px;
}
.campo2 {
  width: 500px;
  margin-right: 10px;
}

.labelH3 {
  left: 250px;
}

.icono {
  left: 255px;
}

input:focus {
  outline: none;
}

/* LABEL ======================================= */
label {
  color: #999;
  font-size: 18px;
  font-weight: normal;
  position: absolute;
  pointer-events: none;
  left: 5px;
  top: 10px;
  transition: 0.2s ease all;
  -moz-transition: 0.2s ease all;
  -webkit-transition: 0.2s ease all;
  padding: 1px 1px 1px 45px;
}
h3 {
  color: #999;
  font-size: 18px;
  font-weight: normal;
  position: absolute;
  pointer-events: none;
  left: 5px;
  top: -25px;
  transition: 0.2s ease all;
  -moz-transition: 0.2s ease all;
  -webkit-transition: 0.2s ease all;
}

/* active state */
input:focus ~ label,
input:valid ~ label {
  top: -20px;
  font-size: 14px;
  color: #5264ae;
}
.indicaciones {
  text-align: justify;
  margin-bottom: 1px;
  font-size: 14px;
  font-weight: 600;
}

/* BOTTOM BARS ================================= */
.bar {
  position: relative;
  display: block;
  width: 500px;
}
.bar:before,
.bar:after {
  content: "";
  height: 2px;
  width: 0;
  bottom: 1px;
  position: absolute;
  background: #5264ae;
  transition: 0.2s ease all;
  -moz-transition: 0.2s ease all;
  -webkit-transition: 0.2s ease all;
}
.bar:before {
  left: 50%;
}
.bar:after {
  right: 50%;
}

/* active state */
input:focus ~ .bar:before,
input:focus ~ .bar:after {
  width: 50%;
}

/* HIGHLIGHTER ================================== */
.highlight {
  position: absolute;
  height: 60%;
  width: 100px;
  top: 25%;
  left: 0;
  pointer-events: none;
  opacity: 0.5;
}

/* active state */
input:focus ~ .highlight {
  -webkit-animation: inputHighlighter 0.3s ease;
  -moz-animation: inputHighlighter 0.3s ease;
  animation: inputHighlighter 0.3s ease;
}

/* ANIMATIONS ================ */
@-webkit-keyframes inputHighlighter {
  from {
    background: #5264ae;
  }
  to {
    width: 0;
    background: transparent;
  }
}
@-moz-keyframes inputHighlighter {
  from {
    background: #5264ae;
  }
  to {
    width: 0;
    background: transparent;
  }
}
@keyframes inputHighlighter {
  from {
    background: #5264ae;
  }
  to {
    width: 0;
    background: transparent;
  }
}
/***********RESPONSIVE MODE***************************/
@media only screen and (min-device-width: 900px) and (max-device-width: 1365px) {
  .contenedor-2 {
    margin: 15px 10px 25% 10px;
  }
  .card {
    margin: 100px 10px 100px 10px;
  }
}
@media only screen and (min-device-width: 568px) and (max-device-width: 900px) {
  input {
    width: 100%;
  }
  .btn {
    margin-top: 5px;
  }
  .intro {
    margin-top: 80px;
  }
  .bar {
    width: 100%;
  }
  .Posicionar {
    width: 100px;
    left: 70%;
  }
  .InputGroup {
    display: block;
    margin-top: 20px;
  }
  .group2 {
    display: block;
    margin-top: 20px;
    width: 100%;
  }
  .campo1 {
    width: 235px;
  }
  .campo2 {
    width: 100%;
    margin-top: 30px;
  }
  .labelH3 {
    left: 1px;
    top: 50px;
  }
  .icono {
    left: 5px;
  }
  .modal-content {
    width: 100%;
    height: auto;
  }
}
@media only screen and (min-device-width: 412px) and (max-device-width: 567px) {
  input {
    width: 100%;
  }
  .btn {
    margin-top: 5px;
  }
  .intro {
    margin-top: 120px;
  }
  .bar {
    width: 100%;
  }
  .Posicionar {
    width: 100px;
    left: 70%;
  }
  .InputGroup {
    display: block;
    margin-top: 20px;
  }
  .group2 {
    display: block;
    margin-top: 20px;
    width: 100%;
  }
  .campo1 {
    width: 230px;
  }
  .campo2 {
    width: 100%;
    margin-top: 30px;
  }
  .labelH3 {
    left: 1px;
    top: 50px;
  }
  .icono {
    left: 5px;
  }
  .modal-content {
    width: 100%;
    height: auto;
  }
}
@media only screen and (min-device-width: 320px) and (max-device-width: 411px) {
  input {
    width: 100%;
  }
  .btn {
    margin-top: 5px;
  }
  .intro {
    margin-top: 120px;
  }
  .bar {
    width: 100%;
  }
  .Posicionar {
    width: 100px;
    left: 70%;
  }
  .InputGroup {
    display: block;
    margin-top: 20px;
  }
  .group2 {
    display: block;
    margin-top: 20px;
    width: 100%;
  }
  .campo1 {
    width: 200px;
  }
  .campo2 {
    width: 100%;
    margin-top: 30px;
  }
  .labelH3 {
    left: 1px;
    top: 50px;
  }
  .icono {
    left: 5px;
  }
  .modal-content {
    width: 100%;
    height: auto;
  }
}
@media only screen and (max-device-width: 320px) {
  input {
    width: 100%;
  }
  .btn {
    margin-top: 5px;
  }
  .intro {
    margin-top: 120px;
  }
  .bar {
    width: 100%;
  }
  .Posicionar {
    width: 100px;
    left: 65%;
  }
  .InputGroup {
    display: block;
    margin-top: 20px;
  }
  .group2 {
    display: block;
    margin-top: 20px;
    width: 100%;
  }
  .campo1 {
    width: 170px;
  }
  .campo2 {
    width: 100%;
    margin-top: 30px;
  }
  .labelH3 {
    left: 1px;
    top: 50px;
  }
  .icono {
    left: 5px;
  }
  .modal-content {
    margin: 5px;
    width: 100%;
    height: auto;
  }
}
@media only screen and (max-device-width: 280px) {
  input {
    width: 100%;
  }
  .Posicionar {
    width: 100px;
    left: 60%;
  }

  .campo1 {
    width: 130px;
  }
  .table > :not(caption) > * > * {
    padding: 0.1rem 0.1rem;
  }
}

@media only screen and (min-device-width: 640px) and (max-device-width: 736px) {
  input {
    width: 100%;
  }
  .campo1 {
    width: 480px;
  }
  .Posicionar {
    left: 85%;
  }
  .btn {
    display: block;
  }
}
</style>