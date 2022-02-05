<template>
  <div class="contenedor">
    <div class="intro" style="text-align: center">
      <h2>
        Reservación del
        <span style="color: #38ab81">Sendero los Matapalos</span>
      </h2>
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
              <div class="reservar_indicaciones">
                <h5 class="card-title">Formulario de Reservación</h5>
                <i class="fas fa-info-circle"> Indicaciones</i>
                <i class="fas fa-angle-right"
                  >Puede registrar cliente, organización o grupo.</i
                >
                <i class="fas fa-angle-right"
                  >Es necesario comprobar que esta registrado.</i
                >
                <i class="fas fa-angle-right"
                  >Se enviara un correo con la información de la reservación.</i
                >
                <div class="botones_opciones">
                  <button
                    type="button"
                    class="btn btn-primary"
                    @click="modalPersona()"
                  >
                    Persona
                  </button>
                  <button
                    type="button"
                    class="btn btn-primary"
                    @click="modalGrupo()"
                  >
                    Grupo
                  </button>
                  <button
                    type="button"
                    class="btn btn-primary"
                    @click="modalOrganizacion()"
                  >
                    Organización
                  </button>
                </div>
              </div>
              <form class="material-form">
                <div class="group">
                  <h3>Busqueda identificación</h3>
                  <div class="campo">
                    <i class="fas fa-id-card iconoInput"></i>
                    <input
                      v-model="formReserva.identificacion"
                      name="identificacion"
                      type="text"
                      required
                      :disabled="bloquearConsulta"
                      maxlength="18"
                    />
                    <button
                      type="button"
                      @click="consultarDatos()"
                      class="Posicionar btn btn-success"
                      :disabled="bloquearConsulta"
                    >
                      Consulta
                    </button>
                  </div>
                  <!--div de alerta-->
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
                <div class="group">
                  <div class="campo">
                    <h3>Cantidad de visitantes</h3>

                    <h3 class="labelH3">Fecha de llegada</h3>
                  </div>
                  <div class="campo">
                    <i class="fas fa-users iconoInput"></i>
                    <input
                      v-model="formReserva.cantidad"
                      type="number"
                      required
                      :disabled="bloquearCampos"
                      min="1"
                      max="30"
                      :class="{
                        'is-invalid': formReserva.errors.has('cantidad'),
                      }"
                    />
                    <has-error class="error2" :form="formReserva" field="cantidad"></has-error>
  
                    <i class="fas fa-calendar-check iconoInput icono"></i>
                    <input
                      v-model="formReserva.fecha"
                      type="date"
                      value="Fecha"
                      required
                      :disabled="bloquearCampos"
                      :class="{
                        'is-invalid': formReserva.errors.has('fecha'),
                      }"
                    />
       
                    <has-error class="error" :form="formReserva" field="fecha"></has-error>

                  </div>
                </div>

                <div class="group">
                  <div class="campo">
                    <h3>Hora de llegada</h3>
                    <h3 class="labelH3">Hora de Salida</h3>
                  </div>
                  <div class="campo">
                    <i class="fas fa-clock iconoInput"></i>
                    <input
                      v-model="formReserva.horaInicio"
                      type="time"
                      required
                      :disabled="bloqueraHoras"
                      :class="{
                        'is-invalid': formReserva.errors.has('horaInicio'),
                      }"
                    />
                    <has-error
                    class="error2"
                      :form="formReserva"
                      field="horaInicio"
                    ></has-error>
                    <i class="fas fa-clock iconoInput icono"></i>
                    <input
                      v-model="formReserva.horaFin"
                      type="time"
                      required
                      :disabled="bloqueraHoras"
                      :class="{
                        'is-invalid': formReserva.errors.has('horaFin'),
                      }"
                    />
                    <has-error class="error" :form="formReserva" field="horaFin"></has-error>
                  </div>
                </div>
                <div class="aceptar">
                  <input type="checkbox" v-model="AceptarTerminos" @click="aceptoTerminos()" :disabled="bloquearterminos" name="field name" value="Initial value">    
                  <span>Acepta todo los <a href="">terminos y condicones</a></span>
                </div>
                <div class="campo">
                  <button
                    type="button"
                    class="btn btn-success btn-rounded"
                    @click="crearReserva()"
                    :disabled="bloquearReservar"
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
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div
      class="modal fade"
      id="modal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              {{ tituloModal }}
            </h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
              @click="limpiarTodo()"
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
                  type="text"
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
                data-bs-dismiss="modal"
                @click="limpiarTodo()"
              >
                Cancelar
              </button>
              <button
                type="button"
                v-show="soloPersona"
                class="btn btn-success"
                data-bs-dismiss="modal"
                @click="crearPersona"
              >
                Registrar
              </button>
              <button
                type="button"
                v-show="soloOrganizacion"
                class="btn btn-success"
                data-bs-dismiss="modal"
                @click="crearOrganizacion"
              >
                Registrar
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "ContactUs",
  data() {
    return {
      bloqueraHoras: true,
      bloquearCampos: true,
      bloquearConsulta: false,
      bloquearReservar: true,
      bloquearterminos: true,
      soloPersona: false,
      soloOrganizacion: false,
      soloGrupo: false,
      AceptarTerminos: false,
      tituloModal: "",
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
      var modal = document.getElementById("modal");
      new bootstrap.Modal(modal).show();
      this.soloPersona = true;
      this.soloOrganizacion = false;
      this.soloGrupo = false;
      this.tituloModal = "Registro de persona";
    },
    modalOrganizacion() {
      var modal = document.getElementById("modal");
      new bootstrap.Modal(modal).show();
      this.soloPersona = false;
      this.soloOrganizacion = true;
      this.soloGrupo = false;
      this.tituloModal = "Registro de organizacion";
    },
    modalGrupo() {
      var modal = document.getElementById("modal");
      new bootstrap.Modal(modal).show();
      this.soloPersona = false;
      this.soloOrganizacion = false;
      this.soloGrupo = true;
      this.tituloModal = "Registro de grupo";
    },
    cancelarConsulta() {
      this.formReserva.reset();
      this.formReserva.errors.clear();
      this.mensajeExistencia = "";
      this.mensajeNoExistencia = "";
      this.bloquearCampos = true;
      this.bloquearConsulta = false;
      this.bloquearterminos = true;
      this.AceptarTerminos = false;
    },
    aceptoTerminos(){
      if(this.AceptarTerminos == true){
        this.bloquearReservar = true;
      }else{
        this.bloquearReservar = false;

      }
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
          this.bloquearterminos = false;
        }
      }
      for (let i = 0; i < this.organizacion.length; i++) {
        if (this.organizacion[i].id == this.formReserva.identificacion) {
          this.mensajeExistencia = "Si esta registrado";
          this.mensajeNoExistencia = "";
          this.bloquearCampos = false;
          this.bloquearConsulta = true;
          this.formReserva.idOrganizacion = this.formReserva.identificacion;
          this.bloquearterminos = false;
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
    crearPersona() {
      this.formPersona
        .post("/api/reservarCliente/persona", {
          params: { id: this.formPersona.id },
        })
        .then((response) => {
          if (response.data.success == false) {
            Swal.fire("Error!", "Cedula ya existe!", "error");
          } else {
            Swal.fire("Registrado!", response.data.message, "success");
            this.limpiarTodo();
          }
        })
        .catch((error) => {
          Swal.fire("Error!", "Complete los campos!", "error");
        });
    },

    crearOrganizacion() {
      this.formOrganizacion
        .post("/api/reservarCliente/organizacion", {
          params: { id: this.formOrganizacion.id },
        })
        .then((response) => {
          if (response.data.success == false) {
            Swal.fire("Error!", "Cedula ya existe!", "error");
          } else {
            $("#addNew").modal("hide");
            Swal.fire("Registrado!", response.data.message, "success");
            this.limpiarTodo();
          }
        })
        .catch((error) => {
          Swal.fire("Error!", "Complete los campos!", "error");
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
.contenedor {
  margin: 40px auto;
}

.intro {
  margin: auto auto 20px auto;
  height: 45px;
  text-align: center;
  font-size: 25px;
  color: #000000ad;
}

.contenedor-2 {
  display: flex;
  margin: 10px;
  justify-content: space-evenly;
  margin: 10px;
}
/*CARD QUE CONTIENE HORARIO Y FORMULARIO */
.card {
  width: 1000px;
  height: auto;
  box-shadow: 3px 3px 3px 3px rgb(0 0 0 / 30%);
  border-radius: 20px;
}
.card-body{
  padding: 10px;
}
/*COLUMNA DE LOS HORARIOS*/
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
  border-top-left-radius: 20px;
  border-bottom-left-radius: 20px;
  width: 42%;
}
tr,
td {
  color: #fff;
  font-size: 20px;
  font-weight: 500;
  padding: 20px 5px;
  text-align: center;
}
.col-md-6 {
  width: 58%;
}
.reservar_indicaciones {
  display: flex;
  flex-direction: column;

  align-items: flex-start;
  align-content: center;
}
.reservar_indicaciones i {
  padding: 5px;
}
.botones_opciones {
  padding: 10px;
  width: 100%;
  text-align: center;
}
.card-title {
  font-size: 30px;
  font-weight: 900;
}
.group {
  display: flex;
  flex-direction: column;
  flex-wrap: nowrap;
  align-content: center;
  justify-content: center;
  position: relative;
  padding: 10px;
}
.campo {
  display: flex;
}
.aceptar{
      margin: 10px 5px 10px 15px;
}
.aceptar span, span a {
  font-size: 20px;
}

.campo h3 {
  width: 50%;
  padding: 5px 15px;
}
.campo input {
  width: 40%;
  padding: 5px 1px;
  margin: 1px 20px 1px 4px;
  border: none;
  border-bottom: 1px solid #757575;
  text-transform: capitalize;
  border-bottom: 2px solid rgb(204, 200, 200);
  transition: border 0.5s;
}

.campo input:focus {
  outline: none;
  border-bottom: 2px solid rgb(14, 14, 170);

}

h3 {
  color: #000000ad;
  font-size: 20px;
  font-weight: normal;
  pointer-events: none;
 
  transition: 0.2s ease all;
  -moz-transition: 0.2s ease all;
  -webkit-transition: 0.2s ease all;
}

.iconoInput {
  color: #e8e8e8;
  font-size: 26px;
  margin-top: 2%;
}


.Posicionar {
  margin: 5px 1px 5px 10px;
  width: 30%;
}

.modal-content {
  width: 540px;
  border: 0;
  -webkit-box-shadow: 0 10px 20px 0 rgb(0 0 0 / 5%);
  box-shadow: 0 10px 20px 0 rgb(0 0 0 / 5%);
  height: auto;
}

.btn {
  font-size: 15px;
  text-transform: capitalize;
}

.help-block, .invalid-feedback{
  top: 100%;
  
}

.error2 {
left: 8%;
}
.error{
  left: 55%;
}

@media only screen and (max-width: 800px ) {
  .row{
    display: flex;
    flex-direction: column;
    
  }
  .col-md-5, .col-md-6{
    width: 100%;
  }
  .col-md-5 {
    border-bottom-left-radius: 0;
  }
  .botones_opciones{
        display: flex;
    flex-direction: column;
    justify-content: center;
    align-content: center;
    align-items: center;

  }
  .botones_opciones button{
    width: 200px;
    margin: 10px auto;
  }
  .Posicionar{
    width: 38%;
    margin: 0;
  }
  .campo input{
    margin: 2px;
  }
}

/***********RESPONSIVE MODE***************************/
</style>

