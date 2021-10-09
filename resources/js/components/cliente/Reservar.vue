<template>
  <div class="" style="margin-top: 85px">
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
                      >
                        <i class="fas fa-plus"></i>
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td>12:00 p.m.</td>
                    <td>01:00 p.m.</td>
                    <td>
                      <button
                        style="height: 35px; width: 55px"
                        type="button"
                        class="btn btn-danger btn-sm px-3"
                        @click="opcionHora5()"
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
              <h6 style="text-align: center; font-size: 20px">
                Si no esta registrado, puede realizarlo con la siguientes
                opciones.<br />
                Si ya esta registrado, puede comprobar su Registro.
              </h6>
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
                <div class="group">
                  <input
                    v-model="formReserva.identificacion"
                    name="identificacion"
                    type="text"
                    required
                  />
                  <span class="highlight"></span>
                  <span class="bar"></span>
                  <label>Cedula o Numero</label>
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
                </div>
                <button
                  type="button"
                  @click="consultarDatos()"
                  class="btn btn-success"
                >
                  Consultar
                </button>
                <br />
                <br />
                <div class="group">
                  <input
                    v-model="formReserva.cantidad"
                    type="number"
                    required
                    :disabled="bloquearCampos"
                  />
                  <span class="highlight"></span>
                  <span class="bar"></span>
                  <label>Cantidad de visitantes</label>
                </div>
                <div class="group">
                  <h3>Fecha de llegada</h3>
                  <br />
                  <input
                    v-model="formReserva.fecha"
                    type="date"
                    value="Fecha"
                    required
                    :disabled="bloquearCampos"
                  />
                  <span class="highlight"></span>
                  <span class="bar"></span>
                </div>
                <div class="group">
                  <h3>Hora de llegada</h3>
                  <br />
                  <input
                    v-model="formReserva.horaInicio"
                    type="time"
                    required
                    :disabled="bloqueraHoras"
                  />
                  <span class="highlight"></span>
                  <span class="bar"></span>
                  <label></label>
                </div>
                <div class="group">
                  <h3>Hora de Salida</h3>
                  <br />
                  <input v-model="formReserva.horaFin" type="time" required :disabled="bloqueraHoras" />
                  <span class="highlight"></span>
                  <span class="bar"></span>
                  <label></label>
                </div>

                <button
                  type="button"
                  class="btn btn-success btn-rounded"
                  @click="crearReserva()"
                  :disabled="bloquearCampos"
                >
                  RESERVAR
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
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Registro</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="crearPersona">
            <div class="modal-body">
              <!-- MODAL DE PERSONA-->
              <div v-show="soloPersona" class="group">
                <input
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
                <input
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
                <input
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
                data-bs-dismiss="modal"
                @click="limpiarTodo()"
              >
                Cancelar
              </button>
              <button
                v-show="soloPersona"
                type="button"
                @click="crearPersona()"
                class="btn btn-success"
              >
                Guardar
              </button>
              <button
                v-show="soloOrganizacion"
                type="button"
                class="btn btn-success"
              >
                Guardar
              </button>
              <button v-show="soloGrupo" type="button" class="btn btn-success">
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
          this.formReserva.idPersona = this.formReserva.identificacion;
        }
      }
      for (let i = 0; i < this.organizacion.length; i++) {
        if (this.organizacion[i].id == this.formReserva.identificacion) {
          this.mensajeExistencia = "Si esta registrado";
          this.mensajeNoExistencia = "";
          this.bloquearCampos = false;
          this.formReserva.idOrganizacion = this.formReserva.identificacion;
        }
      }
    },
    noExiste() {
      if (this.persona.length == 0 && this.organizacion.length == 0) {
        this.mensajeExistencia = "";
        this.mensajeNoExistencia = "No esta registrado";
        this.bloquearCampos = true;
      }
      if (this.formReserva.identificacion.length == 0) {
        this.mensajeExistencia = "";
        this.mensajeNoExistencia =
          "Campo vacio, por favor digite la información";
        this.bloquearCampos = true;
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
    crearPersona() {
      this.formPersona
        .post("/api/reservarCliente/persona/", {
          params: { id: this.formPersona.id },
        })
        .then((response) => {
          $("#addNew").modal("hide");
          Toast.fire({
            icon: "success",
            title: response.data.message,
          });

          this.$Progress.finish();
        })
        .catch(() => {
          Toast.fire({
            icon: "error",
            title: "Cedula existente o campos vacios",
          });
        });
    },

    crearReserva() {
      this.formReserva
        .post("/api/reservarCliente")
        .then((response) => {
          Toast.fire({
            icon: "success",
            title: response.data.message,
          });
          this.formReserva.reset();
          this.formReserva.errors.clear();
          this.mensajeExistencia = "";
          this.$Progress.finish();
        })
        .catch(() => {
          Toast.fire({
            icon: "error",
            title: "No se realizo la reservacion",
          });
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
  background-image: url("https://dl.dropbox.com/s/28bvugb6fnxzrhp/logo.png");
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
  /* margin-bottom: .5rem; */
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
  margin-bottom: 45px;
}
input[data-v-4bc2021a] {
  font-size: 18px;
  padding: 10px 10px 10px 5px;
  display: block;
  width: 500px;
  border: none;
  border-bottom: 1px solid #757575;
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
}
h3 {
  color: #999;
  font-size: 18px;
  font-weight: normal;
  position: absolute;
  pointer-events: none;
  left: 5px;
  top: 0px;
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
</style>