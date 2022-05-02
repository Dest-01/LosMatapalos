<template>
  <section class="content">
    <div class="container-fluid">
      <div class="block-header">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <ul class="breadcrumb breadcrumb-style">
              <li class="breadcrumb-item">
                <h4 class="page-title">Voluntario de Actividades</h4>
              </li>
              <li class="breadcrumb-item bcrumb-1">
                <a href="/admin/dashboard">
                  <i class="fas fa-home"></i>
                  Inicio
                </a>
              </li>
              <li class="breadcrumb-item active">Voluntario de Actividades</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <div class="card" v-if="$gate.isAdmin()">
            <div class="card-header">
              <h3 class="card-title">Lista de Voluntariado con Actividades</h3>

              <div class="card-tools">
                <div>
                  <select
                    style="height: calc(1.6em + 0.75rem + 2px)"
                    class="form-control"
                    v-model="valorMostrar"
                    @change="mostrar()"
                  >
                    <option value="10">Mostrar 10</option>
                    <option value="25">Mostrar 25</option>
                    <option value="50">Mostrar 50</option>
                  </select>
                </div>
                <div>
                  <input
                    v-on:keyup="filtrar()"
                    v-model="filtrarBusqueda"
                    class="form-control"
                    type="text"
                    name="buscar"
                    placeholder="Buscar..."
                    style="height: calc(1.6em + 0.75rem + 2px)"
                  />
                </div>
                <div>
                  <button
                    type="button"
                    class="btn btn-sm btn-primary"
                    @click="newModal"
                  >
                    <i class="fa fa-plus-square"></i>
                    agregar nuevo
                  </button>
                </div>
              </div>
            </div>
            <div class="card-body table-responsive p-0">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>ID Voluntariado Actividad</th>
                    <th>Nombre de Actividad</th>
                    <th>Nombre de Persona Voluntario</th>
                    <th>Nombre de Estudiante Voluntario</th>
                    <th>Funciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="actividadVoluntario in actividadVoluntarios.data"
                    :key="actividadVoluntario.id"
                  >
                    <td>{{ actividadVoluntario.id }}</td>
                    <td>{{ actividadVoluntario.ActNombre }}</td>
                    <td>
                      {{ actividadVoluntario.VolPerCedula }} -
                      {{ actividadVoluntario.NombrePersona }}
                      {{ actividadVoluntario.ApellidoPersona }}
                    </td>
                    <td>
                      {{ actividadVoluntario.volEstCedula }} -
                      {{ actividadVoluntario.NombreEstudiante }}
                      {{ actividadVoluntario.ApellidoEstudiante }}
                    </td>
                    <td>
                      <a
                        href="#"
                        @click="
                          editModal(actividadVoluntario),
                            guardarDatosActualizar(actividadVoluntario)
                        "
                      >
                        <i id="icono" class="fa fa-edit blue"></i>
                      </a>
                      /
                      <a
                        href="#"
                        @click="
                          eliminarActividadVoluntario(actividadVoluntario.id),
                            reiniciar(
                              actividadVoluntario.idActividad,
                              actividadVoluntario.ActCupos,
                              actividadVoluntario.idVoluntario_Estudiante,
                              actividadVoluntario.VoluntarioEstCantidad,
                              actividadVoluntario.idVoluntario_Persona,
                              actividadVoluntario.VoluntarioPerCantidad
                            )
                        "
                      >
                        <i id="icono" class="fa fa-trash red"></i>
                      </a>
                      /
                      <a href="#" @click="detailsModal(actividadVoluntario)">
                        <i id="icono" class="fa fa-eye green"></i>
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="card-footer">
              <pagination
                :data="actividadVoluntarios"
                :limit="5"
                @pagination-change-page="getResults"
              ></pagination>
            </div>
          </div>
          <div v-if="!$gate.isAdmin()">
            <not-found></not-found>
          </div>
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
                  <h5 class="modal-title" v-show="!editmode">
                    Crear nueva Actividad de Voluntario
                  </h5>
                  <h5 class="modal-title" v-show="editmode">
                    Actualizar la Actividad del Voluntario
                  </h5>
                  <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                  >
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form
                  @submit.prevent="
                    editmode
                      ? actualizarActividadVoluntario()
                      : crearActividadVoluntariado()
                  "
                >
                  <div class="modal-body">
                    <div class="form-group">
                      <model-list-select
                        :list="actividades"
                        v-model="actividadItem"
                        option-value="id"
                        :custom-text="DateAndName"
                        placeholder="Seleccione la actividad"
                      >
                      </model-list-select>
                    </div>
                    <div class="form-group">
                      <model-list-select
                        :list="volEstudiante"
                        v-model="estudianteItem"
                        option-value="id"
                        :custom-text="DNIAndName"
                        placeholder="Seleccione al estudiante voluntariado"
                      >
                      </model-list-select>
                    </div>
                    <div class="form-group">
                      <model-list-select
                        :list="volPersonas"
                        v-model="PersonaItem"
                        option-value="id"
                        :custom-text="DNIAndName"
                        placeholder="Seleccione la persona voluntariada"
                      >
                      </model-list-select>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button
                      type="button"
                      class="btn btn-secondary"
                      data-dismiss="modal"
                    >
                      Cerrar
                    </button>
                    <button
                      v-show="editmode"
                      type="submit"
                      class="btn btn-success"
                    >
                      Actualizar
                    </button>
                    <button
                      v-show="!editmode"
                      type="submit"
                      class="btn btn-primary"
                    >
                      Crear
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!--Modal de ver detalles-->
          <div
            class="modal fade"
            id="ModalVer"
            tabindex="-1"
            role="dialog"
            aria-labelledby="ModalVer"
            aria-hidden="true"
          >
            <div class="modal-dialog" role="document">
              <div id="modal-contentino" class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">
                    Detalles del voluntariado actividad
                  </h5>
                  <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                  >
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>

                <div id="modal-body" class="modal-body">
                  <div id="inputsModal" class="form-group">
                    <label>Id Voluntariado Actividad</label>
                    <input
                      v-model="formDetails.id"
                      type="text"
                      class="form-control"
                      :disabled="verDetalles"
                    />
                  </div>
                  <div id="inputsModal" class="form-group">
                    <label>Id Actividad</label>
                    <input
                      v-model="formDetails.idActividad"
                      type="text"
                      class="form-control"
                      :disabled="verDetalles"
                    />
                  </div>
                  <div id="inputsModal" class="form-group">
                    <label>Nombre de la Actividad</label>
                    <input
                      v-model="formDetails.ActNombre"
                      type="text"
                      class="form-control"
                      :disabled="verDetalles"
                    />
                  </div>
                  <div id="inputsModal" class="form-group">
                    <label>Persona Voluntariada</label>
                    <input
                      v-model="DNINombrePersona"
                      type="text"
                      class="form-control"
                      :disabled="verDetalles"
                    />
                  </div>
                  <div id="inputsModal" class="form-group">
                    <label>Estudiante Voluntariado</label>
                    <input
                      v-model="DNINombreEstudiante"
                      type="text"
                      class="form-control"
                      :disabled="verDetalles"
                    />
                  </div>
                </div>
                <div class="modal-footer">
                  <button
                    type="button"
                    class="btn btn-danger"
                    data-dismiss="modal"
                  >
                    Cerrar
                  </button>
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
import { ModelListSelect } from "vue-search-select";
import "vue-search-select/dist/VueSearchSelect.css";
export default {
  components: {
    ModelListSelect,
  },
  data() {
    return {
      verDetalles: true,
      idVolEstCupos: "",
      idVolPerCupos: "",
      idActivAnt: "", //Guardamos la actividad anterior
      ActiCuposAnt: "", //Guardamos los cupos anterior
      idVolEstAnt: "", //Guardamos el id vol estudiante anterior
      idVolEstNuv: "", //Guardamos el id del vol estudiante nuevo
      VolEstCantNuv: "", //Guardamos la cantidad de actividades del estudiante nuevo
      VolEstCantAnt: "", //Guardamos la cantidad de actividades de la persona anterior
      idVolPertAnt: "", //Guardamos el id vol persona anterior
      idVolPertNuv: "",
      VolperCantAnt: "", //Guardamos la cantidad de actividades de la persona anterior
      VolperCantNuv: "",
      CuposSi: false,
      DNINombrePersona: "",
      DNINombreEstudiante: "",
      CuposRebajo: 0,
      valorMostrar: 10,
      filtrarBusqueda: "",
      editmode: false,
      actividades: [{}],
      volEstudiante: [{}],
      volPersonas: [{}],
      actividadItem: {},
      estudianteItem: {},
      PersonaItem: {},
      actividadVoluntarios: {},
      form: new Form({
        id: "",
        idActividad: "",
        idVoluntario_Persona: "",
        idVoluntario_Estudiante: "",
      }),
      formActividad: new Form({
        id: "",
        nombre: "",
        fecha: "",
        hora: "",
        descripcion: "",
        cantParticipantes: "",
        imagen: "",
        tipo: "",
      }),
      formDetails: new Form({
        id: "",
        idActividad: "",
        ActNombre: "",
      }),
    };
  },
  methods: {
    //Metodo para filtrar las busquedas
    filtrar() {
      if (!this.filtrarBusqueda) {
        this.cargarActividadVoluntariado();
      } else if (this.filtrarBusqueda.length > 2) {
        this.actividadVoluntarios.data = this.voluntarioActividadesFiltros;
      }
    },
    /////Metodo para la paginacion
    mostrar() {
      if (this.$gate.isAdmin() || this.$gate.isUser()) {
        axios
          .get("/api/voluntarioActividad/mostrar/", {
            params: { valor: this.valorMostrar },
          })
          .then(({ data }) => (this.actividadVoluntarios = data.data));
      }
    },
    //metodo para limpar los combo box
    limpiarComboBox() {
      (this.actividadItem = {}),
        (this.estudianteItem = {}),
        (this.PersonaItem = {});
    },
    //Metodo para ver detalles
    detailsModal(actividadVoluntario) {
      $("#ModalVer").modal("show");
      this.formDetails.fill(actividadVoluntario);
      this.DNINombrePersona =
        "Identificación: " +
        actividadVoluntario.VolPerCedula +
        " - " +
        "Nombre: " +
        actividadVoluntario.NombrePersona +
        " " +
        actividadVoluntario.ApellidoPersona;
      this.DNINombreEstudiante =
        "Identificación: " +
        actividadVoluntario.volEstCedula +
        " - " +
        "Nombre: " +
        actividadVoluntario.NombreEstudiante +
        " " +
        actividadVoluntario.ApellidoEstudiante;
    },
    //Metodo para abrir un nuevo modal
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.errors.clear();
    },
    //Metodo para editar el modal
    editModal(actividadVoluntario) {
      this.editmode = true;
      this.form.reset();
      const { idActividad, idVoluntario_Persona, idVoluntario_Estudiante } =
        actividadVoluntario;
      this.actividadItem = this.actividades.find(
        (actividad) => actividad.id === idActividad
      );
      this.estudianteItem = this.volEstudiante.find(
        (voluntarioEstu) => voluntarioEstu.VolEstID === idVoluntario_Estudiante
      );
      this.PersonaItem = this.volPersonas.find(
        (voluntario) => voluntario.VolPerID === idVoluntario_Persona
      );

      $("#addNew").modal("show");
      this.form = new Form({ ...actividadVoluntario });
    },
    //Metodo para realizar la paginacion
    getResults(page = 1) {
      this.$Progress.start();
      axios
        .get(`/api/voluntarioActividad?page=` + page)
        .then(({ data }) => (this.actividadVoluntarios = data.data));
      this.$Progress.finish();
    },
    //Metodo para cargar las actividades con los voluntariados
    async cargarActividadVoluntariado() {
      if (this.$gate.isAdmin()) {
        await axios
          .get(`/api/voluntarioActividad`)
          .then(({ data }) => (this.actividadVoluntarios = data.data));
        axios
          .get(`/api/voluntarioActividad/listar`)
          .then(({ data }) => (this.nuevoactividadVoluntarios = data.data));
      }
    },
    //Metodos para llenar los combobox de actividad y voluntarios personas y estudiantes
    async cargarDatosVoluntarioActividad() {
      if (this.$gate.isAdmin() || this.$gate.isUser()) {
        await axios
          .get("/api/actividad/listar")
          .then(({ data }) => (this.actividades = data.data));
        await axios
          .get("/api/voluntarioActividad/voluntarioEst/")
          .then(({ data }) => (this.volEstudiante = data.data));
        await axios
          .get("/api/voluntarioActividad/voluntarioPer/")
          .then(({ data }) => (this.volPersonas = data.data));
      }
    },
    DateAndName(item) {
      return `${item.nombre} - ${
        "Cupos disponibles: " + item.cantParticipantes
      }`;
    },
    DNIAndName(item) {
      return `${item.identificacion} - ${item.nombre} ${item.apellido1} ${item.apellido2}`;
    },
    ////////////////////////////////////////////////////////////
    CuposDisponibleCrear() {
      this.idVolPerCupos = this.PersonaItem.VolPerID;
      this.idVolEstCupos = this.estudianteItem.VolEstID;

      if (this.idVolPerCupos != 0 && this.idVolEstCupos != 0) {
        this.CuposRebajo = 2;
      }
      if (this.idVolPerCupos != 0 && !this.idVolEstCupos) {
        this.CuposRebajo = 1;
      }
      if (!this.idVolPerCupos && this.idVolEstCupos != 0) {
        this.CuposRebajo = 1;
      }
      if (this.actividadItem.cantParticipantes >= this.CuposRebajo) {
        this.CuposSi = true;
      } else {
        this.CuposSi = false;
      }
    },

    ///////////////////////////////////////////////////////////
    Llenarforms() {
      this.form.idActividad = this.actividadItem.id;
      this.form.idVoluntario_Persona = this.PersonaItem.VolPerID;
      this.form.idVoluntario_Estudiante = this.estudianteItem.VolEstID;
      this.CuposDisponibleCrear();
    },

    async CrearDatos() {
      try {
        this.$Progress.start();
        await axios.get("/api/voluntarioActividad/datos/", {
          params: {
            //Pasamos el id de la actividad
            idAct: this.actividadItem.id,
            //Pasamos la cantidad de los cupos
            Cupos: this.actividadItem.cantParticipantes - this.CuposRebajo,
            //pasamos el id del estudiante voluntariado
            idVoluntarioEst: this.estudianteItem.voluntariadoID,
            //Pasamos la cantidad de actividades para sumarle 1
            CantidadEst: this.estudianteItem.cantidadActividad + 1,
            //Le sumamos los datos a la persona voluntariada
            idVoluntarioPer: this.PersonaItem.voluntariadoID,
            CantidadPer: this.PersonaItem.cantidadActividad + 1,
          },
        });
        this.form.post(`/api/voluntarioActividad`).then((response) => {
          $("#addNew").modal("hide");
          Toast.fire({
            icon: "success",
            title: response.data.message,
          });
          this.$Progress.finish();
          this.form.reset();
          this.limpiarComboBox();
          this.cargarDatosVoluntarioActividad();
          this.cargarActividadVoluntariado();
        });
      } catch (error) {
        Toast.fire({
          icon: "error",
          title: "Ocurrio un error!",
        });
      }
    },
    ///metodo para crear registrar el voluntario de actividad
    crearActividadVoluntariado() {
      this.Llenarforms();
      //Comparamos para que la cantidad de cupos sea mayor o igual a la cantidad de cupos a restar
      if (this.CuposSi == true) {
        //Enviamos los datos a la rutas para actualizar la informacion
        this.CrearDatos();
      } else {
        //Mensaje en caso de no contar con los cupos disponibles
        Swal.fire("Fallo!", "No cuenta con cupos disponibles", "warning");
      }
    },
    //////////////////////////////////////////////////////////
    ///////////METODO PARA APLICAR RESTAS Y SUMAS AL ELIMINAR /////////////
    async reiniciar(idAct, Cupos, idEstVol, cantEstAct, idPerVol, cantPerAct) {
      if (idEstVol != 0 && idPerVol != 0) {
        this.CuposRebajo = 2;
      }
      if (idEstVol != 0 && !idPerVol) {
        this.CuposRebajo = 1;
      }
      if (!idEstVol && idPerVol != 0) {
        this.CuposRebajo = 1;
      }
      await axios.get("/api/voluntarioActividad/datos/", {
        params: {
          idAct: idAct,
          Cupos: Cupos + this.CuposRebajo,
          idVoluntarioEst: idEstVol,
          CantidadEst: cantEstAct - 1,
          idVoluntarioPer: idPerVol,
          CantidadPer: cantPerAct - 1,
        },
      });
    },
    /////////////////////////////////////////////////////
    ///////METODO PARA ELIMINAR ////////////////////
    eliminarActividadVoluntario(id) {
      Swal.fire({
        title: "Seguro que lo desea eliminar?",
        text: "Esta acción no puede revertirse!",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Si, Eliminar!",
      }).then((result) => {
        if (result.value) {
          this.reiniciar(); //Metodo para pasar los datos a modificar al momento de eliminar
          this.form
            .delete(`/api/voluntarioActividad/${id}`)
            .then(() => {
              Swal.fire(
                "Eliminado!",
                "Se ha eliminado la información.",
                "success"
              );
              this.cargarDatosVoluntarioActividad();
              this.cargarActividadVoluntariado();
            })
            .catch((data) => {
              Swal.fire("Fallo!", data.message, "warning");
            });
        }
      });
    },
    //Guardamos los datos para comparar en caso de que cambie algun dato
    guardarDatosActualizar(actividadVoluntario) {
      (this.idActivAnt = actividadVoluntario.ActId),
        (this.ActiCuposAnt = actividadVoluntario.ActCupos),
        (this.idVolEstAnt = actividadVoluntario.idVoluntario_Estudiante),
        (this.VolEstCantAnt = actividadVoluntario.VoluntarioEstCantidad),
        (this.idVolPertAnt = actividadVoluntario.idVoluntario_Persona),
        (this.VolperCantAnt = actividadVoluntario.VoluntarioPerCantidad);
    },
    //Comparamos y modificamos los datos anterior
    async compararDatosActualizar() {
      if (!this.idVolPertAnt || !this.idVolEstAnt) {
        this.CuposRebajo = 1;
      } else {
        this.CuposRebajo = 2;
      }
      if (this.estudianteItem !== undefined) {
        this.form.idVoluntario_Estudiante = this.estudianteItem.VolEstID;
        this.idVolEstNuv = this.estudianteItem.voluntariadoID;
        this.VolEstCantNuv = this.estudianteItem.cantidadActividad;
      }
      if (this.PersonaItem !== undefined) {
        this.form.idVoluntario_Persona = this.PersonaItem.VolPerID;
        this.idVolPertNuv = this.PersonaItem.voluntariadoID;
        this.VolperCantNuv = this.PersonaItem.cantidadActividad;
      }
      if (this.actividadItem.cantParticipantes >= this.CuposRebajo) {
        this.CuposSi = true;
      } else {
        this.CuposSi = false;
      }

      await axios.get("/api/voluntarioActividad/datosAnterior/", {
        params: {
          //Pasamos el id de la actividad
          idAct: this.idActivAnt,
          //Pasamos la cantidad de los cupos
          Cupos: this.ActiCuposAnt + this.CuposRebajo,
          //pasamos el id del estudiante voluntariado
          idVoluntarioEst: this.idVolEstAnt,
          //Pasamos la cantidad de actividades para sumarle 1
          CantidadEst: this.VolEstCantAnt - 1,
          //Le sumamos los datos a la persona voluntariada
          idVoluntarioPer: this.idVolPertAnt,
          CantidadPer: this.VolperCantAnt - 1,
        },
      });
    },

    async actualizarActividadVoluntario() {
      this.compararDatosActualizar();
      //Le pasamos los datos nuevo a la actividad
      this.form.idActividad = this.actividadItem.id;
      if (this.CuposSi == true) {
        this.$Progress.start();
        await axios.get("/api/voluntarioActividad/datos/", {
          params: {
            //Pasamos el id de la actividad
            idAct: this.actividadItem.id,
            //Pasamos la cantidad de los cupos
            Cupos: this.actividadItem.cantParticipantes - this.CuposRebajo,
            //pasamos el id del estudiante voluntariado
            idVoluntarioEst: this.idVolEstNuv,
            //Pasamos la cantidad de actividades para sumarle 1
            CantidadEst: this.VolEstCantNuv + 1,
            //Le sumamos los datos a la persona voluntariada
            idVoluntarioPer: this.idVolPertNuv,
            CantidadPer: this.VolperCantNuv + 1,
          },
        });
        this.form
          .put(`/api/voluntarioActividad/${this.form.id}`)
          .then((response) => {
            $("#addNew").modal("hide");
            Toast.fire({
              icon: "success",
              title: response.data.message,
            });
            this.$Progress.finish();
            this.cargarDatosVoluntarioActividad();
            this.cargarActividadVoluntariado();
          })
          .catch(() => {
            this.$Progress.fail();
          });
      } else {
        //Mensaje en caso de no contar con los cupos disponibles
        Swal.fire("Fallo!", "No cuenta con cupos disponibles", "warning");
      }
    },
  },

  created() {
    this.$Progress.start();
    this.cargarActividadVoluntariado();
    this.cargarDatosVoluntarioActividad();
    this.$Progress.finish();
  },
  computed: {
    voluntarioActividadesFiltros: function () {
      return this.nuevoactividadVoluntarios.filter((activVoluntario) => {
        return (
          activVoluntario.ActNombre.toLowerCase().includes(
            this.filtrarBusqueda.toLowerCase()
          ) ||
          activVoluntario.VolPerCedula.toLowerCase().includes(
            this.filtrarBusqueda.toLowerCase()
          ) ||
          activVoluntario.NombrePersona.toLowerCase().includes(
            this.filtrarBusqueda.toLowerCase()
          ) ||
          activVoluntario.ApellidoPersona.toLowerCase().includes(
            this.filtrarBusqueda.toLowerCase()
          ) ||
          activVoluntario.volEstCedula
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) ||
          activVoluntario.NombreEstudiante.toLowerCase().includes(
            this.filtrarBusqueda.toLowerCase()
          ) ||
          activVoluntario.ApellidoEstudiante.toLowerCase().includes(
            this.filtrarBusqueda.toLowerCase()
          )
        );
      });
    },
  },
};
</script>


<style scoped>
.mostrar {
  display: list-item;
  opacity: 1;
  background: rgba(121, 120, 120, 0.623);
}
#btnCancelar {
  padding: 1px 5px;
  margin: 1px 1px 1px 10px;
}

#icono {
  font-size: 20px;
}
.card-tools {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
}
.card-tools div {
  padding: 10px;
}
.card-tools div button {
  height: 36px;
  font-size: 15px;
}
.card-title {
  margin: 1px;
  line-height: inherit;
  float: left;
  font-size: 1.8rem;
  font-weight: 400;
}
.identitad {
  display: flex;
  flex-direction: row;
  flex-wrap: nowrap;
}
.modal-content {
  width: 100%;
}
.modal-body {
  display: flex;
  flex-direction: column;
  flex-wrap: nowrap;
  justify-content: space-between;
}
.form-group {
  margin: 10px;
}

.table th,
.table td {
  padding: 0.75rem;
  vertical-align: baseline;
  border-top: 1px solid #dee2e6;
}
@media only screen and (min-device-width: 300px) and (max-device-width: 1199px) {
  .modal-content {
    width: 100%;
  }

  @media only screen and (min-device-width: 100px) and (max-device-width: 900px) {
    .pagination {
      display: flex;
      padding-left: 0;
      list-style: none;
      border-radius: 0.25rem;
      flex-wrap: wrap;
    }
  }
}
</style>