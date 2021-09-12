<template>
  <div>
    <h1 class="text-center">Reservación</h1>
    <hr />

    <!-- The Modal -->
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
                v-model="form.cedula"
                type="text"
                name="id"
                class="form-control"
                :class="{ 'is-invalid': form.errors.has('id') }"
              />
              <has-error :form="form" field="id"></has-error>
            </div>

            <div class="form-group">
              <label>Nombre</label>
              <input
                v-model="form.nombre"
                type="text"
                name="nombre"
                class="form-control"
                :class="{ 'is-invalid': form.errors.has('nombre') }"
              />
              <has-error :form="form" field="nombre"></has-error>
            </div>

            <div class="form-group">
              <label>Primer Apellido</label>
              <input
                v-model="form.apellido1"
                type="text"
                name="apellido1"
                class="form-control"
                :class="{ 'is-invalid': form.errors.has('apellido1') }"
              />
              <has-error :form="form" field="apellido1"></has-error>
            </div>

            <div class="form-group">
              <label>Segundo Apellido</label>
              <input
                v-model="form.apellido2"
                type="text"
                name="apellido2"
                class="form-control"
                :class="{ 'is-invalid': form.errors.has('apellido2') }"
              />
              <has-error :form="form" field="apellido2"></has-error>
            </div>

            <div class="form-group">
              <label>Telefono</label>
              <input
                v-model="form.telefono"
                type="number"
                name="telefono"
                class="form-control"
                :class="{ 'is-invalid': form.errors.has('telefono') }"
              />
              <has-error :form="form" field="telefono"></has-error>
            </div>
            <div class="form-group">
              <label>Correo</label>
              <input
                v-model="form.correo"
                type="email"
                name="correo"
                class="form-control"
                :class="{ 'is-invalid': form.errors.has('correo') }"
              />
              <has-error :form="form" field="correo"></has-error>
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
              @click="guardar()"
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
    <!-- Button to Open the Modal 
    <button
      @click="
        modificar = false;
        abrirModal();
      "
      type="button"
      class="btn btn-primary my-4"
    >
      Registro
    </button>-->
    <!-- formulario de reserva campos-->
    <div class="container">
      <button @click="abrirModal()" type="button" class="btn btn-primary my-4">
        Registrar Persona
      </button>

      <button @click="abrirModal()" type="button" class="btn btn-primary my-4">
        Registrar Organizacion
      </button>

      <div class="form-group">
        <label>Cedula a consultar</label>
        <input
          v-model="buscador"
          type="text"
          name="buscador"
          class="form-control1"
        />
      </div>
      <div class="form-group">
        <button @click="ConsultaCedula()">Consultar cedula</button>

      </div>
      <div class="form-group">
        <label for="">Cantidad de visitantes</label>
        <input class="form-control1" type="text" />
      </div>
      <div class="form-group">
        <label for="">Fecha</label>
        <input class="form-control1" type="date" />
      </div>
      <div class="form-group">
        <label for="">Hora de entrada</label>
        <input class="form-control1" type="text" />
      </div>
      <div class="form-group">
        <label for="">Hora de salida</label>
        <input class="form-control1" type="text" />
      </div>
      <button type="button" class="btn btn-primary my-4">Reservar</button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    
    return {
      buscador : '',
      personas: {},
      form: new Form({
        identificacion: "",
        id: "",
        nombre: "",
        apellido1: "",
        apellido2: "",
        telefono: "",
        correo: "",
      }),
      articulo: {
        nombre: "",
        descripcion: "",
        stock: 1,
      },
      id: 0,
      modificar: true,
      modal: 0,
      tituloModal: "",
      articulos: [],
      errores: {},
    };
  },
  methods: {
    async guardar(id) {
      try {
        this.cerrarMmodal();
      } catch (error) {
        if (error.response.data) {
          this.errores = error.response.data.errors;
        }
      }
    },
    ConsultaCedula() {
      this.$Progress.start();
      this.form
        .get('/api/reservarCliente/verificar', { params: { buscador: this.buscador } })
        .then((response) => {
          // success
          $("#addNew").modal("hide");
          Toast.fire({
            icon: "success",
            title: response.data.message,
          });
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },

    abrirModal(data = {}) {
      this.modal = 1;
      (this.id = 0), (this.tituloModal = "Registrarse");
      //  this.articulo.nombre = "";
    },
    cerrarMmodal() {
      this.modal = 0;
      this.errores = {};
    },
  },
  created() {},
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