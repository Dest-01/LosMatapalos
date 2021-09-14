<template>
  <div>
    <h1 class="text-center">Reservación</h1>
    <hr />

    <!-- Modal de persona -->
    <div class="modal" :class="{ mostrar: modal }">
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
    <div class="modal" :class="{ mostrar: modalOrg }">
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
    <div class="container">
      <button @click="abrirModal()" type="button" class="btn btn-primary my-4">
        Registrar Persona
      </button>

      <button
        @click="abrirModalOrg()"
        type="button"
        class="btn btn-primary my-4"
      >
        Registrar Organizacion
      </button>

      <div class="form-group">
        <label>Cedula a consultar</label>
        <input
          v-model="buscador"
          type="text"
          name="buscador"
          class="form-control1"
          :disabled="CedulaBloqueo"
        />
      </div>
      <div></div>
      <div class="form-group">
        <span
          class="mensajeCedula"
          v-if="cedulas.length === 0 && cedulasOrg.length === 0"
          >Cedula no registrada o campo vacio!</span
        >
        <span class="mensajeCedula" v-else></span>
      </div>
      <div class="form-group">
        <button
          type="submit"
          class="btn btn-success my-4"
          @click="ConsultaCedula(), habilitarCampos()"
        >
          Consultar cedula
        </button>
      </div>

      <div class="form-group">
        <label for="">Cantidad de visitantes</label>
        <input
          v-model="formReserva.cantidad"
          :disabled="isDisabled"
          class="form-control1"
          type="text"
          :class="{ 'is-invalid': formReserva.errors.has('cantidad') }"
        />
        <has-error :form="formReserva" field="cantidad"></has-error>
      </div>
      <div class="form-group">
        <label for="">Fecha</label>
        <input
          v-model="formReserva.fecha"
          :disabled="isDisabled"
          class="form-control1"
          type="date"
          :class="{ 'is-invalid': formReserva.errors.has('fecha') }"
        />
        <has-error :form="formReserva" field="fecha"></has-error>
      </div>
      <div class="form-group">
        <label for="">Hora de entrada</label>
        <input
          v-model="formReserva.horaInicio"
          :disabled="isDisabled"
          class="form-control1"
          type="time"
          :class="{ 'is-invalid': formReserva.errors.has('horaInicio') }"
        />
      </div>
      <has-error :form="formReserva" field="horaInicio"></has-error>
      <div class="form-group">
        <label for="">Hora de salida</label>
        <input
          v-model="formReserva.horaFin"
          :disabled="isDisabled"
          class="form-control1"
          type="time"
          :class="{ 'is-invalid': formReserva.errors.has('horaFin') }"
        />
        <has-error :form="formReserva" field="horaFin"></has-error>
      </div>
      <button
        :disabled="isDisabled"
        @click="crearReserva()"
        type="button"
        class="btn btn-primary my-4"
      >
        Reservar
      </button>
      <button
        type="button"
        @click="reiniciarCampos()"
        class="btn btn-danger my-4"
      >
        Cancelar
      </button>
    </div>
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


<style>
.mostrar {
  display: list-item;
  opacity: 1;
  background: rgba(121, 120, 120, 0.623);
}
</style>

<style>
.mensajeCedula {
  color: red;
}
.form-control1 {
  display: block;
  width: 500px;
  height: 34px;
  padding: 6px 12px;
  font-size: 14px;
  line-height: 1.42857143;
  color: #555;
  background-color: #fff;
  background-image: none;
  border: 1px solid #ccc;
  border-radius: 4px;
  -webkit-box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
  box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
  -webkit-transition: border-color ease-in-out 0.15s,
    box-shadow ease-in-out 0.15s;
  -o-transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
  -webkit-transition: border-color ease-in-out 0.15s,
    -webkit-box-shadow ease-in-out 0.15s;
  transition: border-color ease-in-out 0.15s,
    -webkit-box-shadow ease-in-out 0.15s;
  transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
  transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s,
    -webkit-box-shadow ease-in-out 0.15s;
}
</style>