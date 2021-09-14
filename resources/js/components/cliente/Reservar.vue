<template>
  <div style="background: #fff">

    <!-- Modal de persona -->
    <div class="modalReserva" :class="{ mostrar: modal }" style="background: rgb(253 253 253 / 0%);">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">{{ tituloModal }}</h4>
            <button
              @click="cerrarMmodal()"
              type="button"
              class="close"
              data-dismiss="modal"
            >
              &times;
            </button>
          </div>
          <!-- Modal body -->
          <div class="modal-body">
            <div class="form-group">
              <label>Cedula</label>
              <input
                v-model="formPer.id"
                type="text"
                name="id"
                class="form-control"
                :class="{ 'is-invalid': formPer.errors.has('id') }"
              />
              <has-error :form="formPer" field="id"></has-error>
            </div>
            <div class="form-group">
              <label>Nombre</label>
              <input
                v-model="formPer.nombre"
                type="text"
                name="nombre"
                class="form-control"
                :class="{ 'is-invalid': formPer.errors.has('nombre') }"
              />
              <has-error :form="formPer" field="nombre"></has-error>
            </div>
            <div class="form-group">
              <label>Primer Apellido</label>
              <input
                v-model="formPer.apellido1"
                type="text"
                name="apellido1"
                class="form-control"
                :class="{ 'is-invalid': formPer.errors.has('apellido1') }"
              />
              <has-error :form="formPer" field="apellido1"></has-error>
            </div>
            <div class="form-group">
              <label>Segundo Apellido</label>
              <input
                v-model="formPer.apellido2"
                type="text"
                name="apellido2"
                class="form-control"
                :class="{ 'is-invalid': formPer.errors.has('apellido2') }"
              />
              <has-error :form="formPer" field="apellido2"></has-error>
            </div>
            <div class="form-group">
              <label>Telefono</label>
              <input
                v-model="formPer.telefono"
                type="number"
                name="telefono"
                class="form-control"
                :class="{ 'is-invalid': formPer.errors.has('telefono') }"
              />
              <has-error :form="formPer" field="telefono"></has-error>
            </div>
            <div class="form-group">
              <label>Correo</label>
              <input
                v-model="formPer.correo"
                type="email"
                name="correo"
                class="form-control"
                :class="{ 'is-invalid': formPer.errors.has('correo') }"
              />
              <has-error :form="formPer" field="correo"></has-error>
            </div>
          </div>
          <!-- Modal footer -->
          <div class="modal-footer">
            <button
              @click="cerrarMmodal()"
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Cancelar
            </button>
            <button
              @click="crearPersona()"
              type="button"
              class="btn btn-success"
              data-dismiss="modal"
            >
              Guardar
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal de organizacion-->
    <!-- The Modal -->
    <div class="modalReserva" :class="{ mostrar: modalOrg }" style="background: rgb(253 253 253 / 0%);">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">{{ tituloModal }}</h4>
            <button
              @click="cerrarMmodalOrg()"
              type="button"
              class="close"
              data-dismiss="modal"
            >
              &times;
            </button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <div class="form-group">
              <label>Cedula Juridica</label>
              <input
                v-model="formOrg.id"
                type="text"
                name="id"
                class="form-control"
                :class="{ 'is-invalid': formOrg.errors.has('id') }"
              />
              <has-error :form="formOrg" field="id"></has-error>
            </div>
            <div class="form-group">
              <label>Nombre de Organizacion</label>
              <input
                v-model="formOrg.nombre"
                type="text"
                name="nombre"
                class="form-control"
                :class="{ 'is-invalid': formOrg.errors.has('nombre') }"
              />
              <has-error :form="formOrg" field="nombre"></has-error>
            </div>
            <div class="form-group">
              <label>Telefono</label>
              <input
                v-model="formOrg.telefono"
                type="number"
                name="telefono"
                class="form-control"
                :class="{ 'is-invalid': formOrg.errors.has('telefono') }"
              />
              <has-error :form="formOrg" field="telefono"></has-error>
            </div>
            <div class="form-group">
              <label>Correo</label>
              <input
                v-model="formOrg.correo"
                type="email"
                name="correo"
                class="form-control"
                :class="{ 'is-invalid': formOrg.errors.has('correo') }"
              />
              <has-error :form="formOrg" field="correo"></has-error>
            </div>
          </div>
          <!-- Modal footer -->
          <div class="modal-footer">
            <button
              @click="cerrarMmodalOrg()"
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Cancelar
            </button>
            <button
              @click="crearOrganizacion()"
              type="button"
              class="btn btn-success"
              data-dismiss="modal"
            >
              Guardar
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- formulario de reserva campos-->
    <main>
      <div class="form">
        <div class="title">Reservas</div>
        <div class="subtitle">Registre su reserva!</div>

        <button @click="abrirModal()" type="button" class="registrarP my-4">
          Registrar Persona
        </button>

        <button @click="abrirModalOrg()" type="button" class="registrarP my-4">
          Registrar Organizacion
        </button>

        <div class="input-container ic1">
          <label for="Cedula" class="placeholder">Cedula</label>
          <input
            id="Cedula"
            class="input"
            type="text"
            v-model="buscador"
            name="buscador"
            :disabled="CedulaBloqueo"
          />
          <div class="cut"></div>
          <!-- <label for="Cedula" class="placeholder">Cedula</label> -->
        </div>
        <button
          id="consultabtn"
          type="submit"
          class="registrarP my-4"
          @click="ConsultaCedula(), habilitarCampos()"
        >
          Consultar cedula
        </button>
        <div class="form-group">
          <!-- <span class="mensajeCedula" v-if="personas.length == 0">Cedula no registrada o campo vacio!</span> </span>-->
        </div>
        <div class="input-container ic2">
          <label for="">Cantidad de visitantes</label>
          <input
            v-model="formReserva.cantidad"
            :disabled="isDisabled"
            class="input"
            type="text"
            :class="{ 'is-invalid': formReserva.errors.has('cantidad') }"
          />
          <has-error :form="formReserva" field="cantidad"></has-error>
          <div class="cut"></div>
          <!-- <label for="CantVisitantes" class="placeholder">Cantidad Visitantes</label> -->
        </div>
        <div class="input-container ic2">
          <label for="">Fecha</label>
          <input
            v-model="formReserva.fecha"
            :disabled="isDisabled"
            class="input"
            type="date"
            :class="{ 'is-invalid': formReserva.errors.has('fecha') }"
          />
          <has-error :form="formReserva" field="fecha"></has-error>
          <div class="cut"></div>
          <!-- <label for="" class="placeholder" ></label> -->
        </div>
        <div class="input-container ic2">
          <label for="">Hora de entrada</label>
          <input
            v-model="formReserva.horaInicio"
            :disabled="isDisabled"
            class="input"
            type="time"
            :class="{ 'is-invalid': formReserva.errors.has('horaInicio') }"
          />
          <div class="cut"></div>
          <!-- <label for="HoraEntrada" class="placeholder">Hora entrada</label> -->
        </div>
        <has-error :form="formReserva" field="horaInicio"></has-error>
        <div class="input-container ic2">
          <label for="">Hora de salida</label>
          <input
            v-model="formReserva.horaFin"
            :disabled="isDisabled"
            class="input"
            type="time"
            :class="{ 'is-invalid': formReserva.errors.has('horaFin') }"
          />
          <has-error :form="formReserva" field="horaFin"></has-error>
          <div class="cut"></div>
          <!-- <label for="HoraSalida" class="placeholder">Hora Salida</label> -->
        </div>
        <button
          :disabled="isDisabled"
          @click="crearReserva()"
          type="button"
          class="submit"
        >
          Reservar
        </button>
        <button type="button" @click="reiniciarCampos(), limpiar()" class="cancel">
          Cancelar
        </button>
      </div>
    </main>
      <footer style="background: rgba(0,0,0,.3);">
   
    <div class="float-right d-none d-sm-block">
    
    </div>
   
    <strong>Copyright &copy; 2021-2022 <a href="">Los Matapalos</a>.</strong> All rights reserved.
  </footer>
  </div>
</template>

<script>
export default {
  data() {
    return {
      CedulaBloqueo: false,
      isDisabled: true,
      buscador: "",
      cedulas: {},
      cedulasOrg: {},
      formReserva: new Form({
        identificacion: "",
        cantidad: "",
        fecha: "",
        horaInicio: "",
        horaFin: "",
      }),
      formPer: new Form({
        id: "",
        nombre: "",
        apellido1: "",
        apellido2: "",
        telefono: "",
        correo: "",
      }),
      formOrg: new Form({
        id: "",
        nombre: "",
        telefono: "",
        correo: "",
      }),
      id: 0,
      modificar: true,
      modal: 0,
      modalOrg: 0,
      tituloModal: "",
      image17: [
        {
          url: "../images/portada.jpg",
        },
      ],
    };
  },
  methods: {
    reiniciarCampos() {
      this.CedulaBloqueo = false;
      this.isDisabled = true;
      this.buscador = "";
      this.formReserva.cantidad = "";
      this.formReserva.fecha = "";
      this.formReserva.horaInicio = "";
      this.formReserva.horaFin = "";
      this.formReserva.identificacion = "";
    },
    habilitarCampos() {
      for (let i = 0; i < this.cedulas.length; i++) {
        if (this.cedulas[i].id == this.buscador) {
          this.isDisabled = false;
          this.CedulaBloqueo = true;
          this.formReserva.identificacion = this.buscador;
        }
      }
    },
    habilitarCamposOrg() {
      for (let i = 0; i < this.cedulasOrg.length; i++) {
        if (this.cedulasOrg[i].id == this.buscador) {
          this.isDisabled = false;
          this.CedulaBloqueo = true;
          this.formReserva.identificacion = this.buscador;
        }
      }
    },
    limpiar() {
      this.formPer.nombre = ""
      this.formPer.apellido1 = ""
      this.formPer.apellido2 = ""
      this.formPer.telefono = ""
      this.formPer.correo = ""
      this.formPer.errors.clear();
    },

    ConsultaCedula() {
      this.$Progress.start();
      this.formReserva
        .get("/api/reservarCliente/verificar", {
          params: { buscador: this.buscador },
        })
        .then(({ data }) => (this.cedulas = data.data))
        .then((response) => {
          this.habilitarCampos();
          this.$Progress.finish();
        });
      this.formReserva
        .get("/api/reservarCliente/verificarOrg", {
          params: { buscador: this.buscador },
        })
        .then(({ data }) => (this.cedulasOrg = data.data))
        .then((response) => {
          this.habilitarCamposOrg();
          this.$Progress.finish();
        });
    },

    abrirModal(data = {}) {
      this.modal = 1;
      (this.id = 0), (this.tituloModal = "Registro cliente");
      //  this.articulo.nombre = "";
    },
    abrirModalOrg(data = {}) {
      this.modalOrg = 1;
      (this.id = 0), (this.tituloModal = "Registro Organizacion");
      //  this.articulo.nombre = "";
    },
    cerrarMmodal() {
      this.modal = 0;
      this.errores = {};
    },
    cerrarMmodalOrg() {
      this.modalOrg = 0;
      this.errores = {};
    },
    crearReserva() {
      this.formReserva
        .post("/api/reservarCliente")
        .then((response) => {
          $("#addNew").modal("hide");

          Toast.fire({
            icon: "success",
            title: response.data.message,
          });
          this.reiniciarCampos();
          //this.cerrarMmodal();
          //  this.$Progress.finish();
        })
        .catch(() => {
          Toast.fire({
            icon: "error",
            title: "Ocurrio un problema",
          });
        });
    },
    crearPersona() {
      this.formPer
        .post("/api/reservarCliente/persona")
        .then((response) => {
          $("#addNew").modal("hide");

          Toast.fire({
            icon: "success",
            title: response.data.message,
          });
          this.cerrarMmodal();
          //  this.$Progress.finish();
        })
        .catch(() => {
          Toast.fire({
            icon: "error",
            title: "Ocurrio un problema",
          });
        });
    },
    crearOrganizacion() {
      this.formOrg
        .post("/api/reservarCliente/organizacion")
        .then((response) => {
          $("#addNew").modal("hide");

          Toast.fire({
            icon: "success",
            title: response.data.message,
          });
          this.cerrarMmodalOrg();
          //  this.$Progress.finish();
        })
        .catch(() => {
          Toast.fire({
            icon: "error",
            title: "Ocurrio un problema",
          });
        });
    },
  },
  mounted() {
    console.log("Component mounted.");
  },
  created() {
    this.$Progress.start();
    this.$Progress.finish();
  },
};
</script>


<style scoped>
header {
  width: 100%;

  background: hsla(155, 95%, 50%, 0.459);
  /* fallback for old browsers */
  background: -webkit-linear-gradient(
    to right,
    hsla(155, 95%, 50%, 0.459),
    hsla(216, 45%, 52%, 0.664)
  );
  /* Chrome 10-25, Safari 5.1-6 */
  background: linear-gradient(
    to right,
    hsla(155, 95%, 50%, 0.459),
    hsla(216, 45%, 52%, 0.664)
  );
  /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
  background-size: cover;
  background-attachment: fixed;
  position: relative;
  top: -50px;
  margin-bottom: 0;
}

.form {
  margin-left: 35%;
  background-color: #034991;
  border-radius: 20px;
  box-sizing: border-box;
  height: 700px;
  padding: 20px;
  width: 600px;
  box-shadow: 5px 10px whitesmoke;
  margin-block: 70px;
  color: white;
  margin-top: -50px;
}
#consultabtn {
  margin-top: 30px;
}
.title {
  color: white;
  font-family: sans-serif;
  font-size: 25px;
  font-weight: 600;
  margin-top: 15px;
}

.subtitle {
  color: white;
  font-family: sans-serif;
  font-size: 20px;
  font-weight: 600;
  margin-top: 10px;
}

.input-container {
  height: 40px;
  position: relative;
  width: 100%;
  padding-top: 5px;
}

.ic1 {
  margin-top: 30px;
}

.ic2 {
  margin-top: 20px;
}

.input {
  font-weight: bold;
  background-color: #cececed7;
  color: black;
  border-radius: 12px;
  border: 0;
  box-sizing: border-box;
  font-size: 18px;
  height: 100%;
  padding: 4px 10px 0;
  width: 100%;
}

.submit {
  background-color: #08d;
  border-radius: 12px;
  border: 0;
  box-sizing: border-box;
  color: #eee;
  cursor: pointer;
  font-size: 18px;
  height: 50px;
  margin-top: 38px;
  margin-right: 15px;
  margin-bottom: 10px;
  /* // outline: 0; */
  text-align: center;
  width: 40%;
}

.registrarP {
  font-weight: bolder;
  margin-top: 4px;
  background-color: #08d;
  border-radius: 12px;
  padding: 5px;
  border: 0;
  box-sizing: border-box;
  color: #eee;
  cursor: pointer;
}

.cancel {
  background-color: rgba(255, 0, 0, 0.829);
  border-radius: 12px;
  border: 0;
  box-sizing: border-box;
  color: #eee;
  cursor: pointer;
  font-size: 18px;
  height: 50px;
  margin-top: 38px;
  margin-left: 15px;
  margin-bottom: 10px;
  /* // outline: 0; */
  text-align: center;
  width: 40%;
}

.cancel:active {
  background-color: rgba(255, 0, 0, 0.589);
}

.submit:active {
  background-color: #06b;
}

.modalReserva {
    position: fixed;
    top: 150px;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 1050;
    display: none;
    overflow: hidden;
    -webkit-overflow-scrolling: touch;
    outline: 0;
}
</style>
