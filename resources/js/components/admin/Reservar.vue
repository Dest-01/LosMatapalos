<template>
  <section class="content">
    <div class="container-fluid">
      <div class="block-header" v-if="$gate.isAdmin() || $gate.isUser()">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <ul class="breadcrumb breadcrumb-style">
              <li class="breadcrumb-item">
                <h4 class="page-title">Reservas</h4>
              </li>
              <li class="breadcrumb-item bcrumb-1">
                <a href="/admin/dashboard">
                  <i class="fas fa-home"></i>
                  Inicio
                </a>
              </li>
              <li class="breadcrumb-item active">Reservas</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card" v-if="$gate.isAdmin() || $gate.isUser()">
            <div class="card-header">
              <h3 class="card-title">Lista de reservas</h3>

              <div class="card-tools">
                <div>
                  <select
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
                  />
                </div>
                <div>
                  <button
                    type="button"
                    class="btn btn-sm btn-primary"
                    @click="newModal"
                  >
                    <i class="fa fa-plus-square"></i>
                    agregar reservación
                  </button>
                </div>
                <div>
                  <button
                    type="button"
                    class="btn btn-sm btn-primary"
                    @click="modalPersona()"
                    onclick="limpiarCampo()"
                  >
                    <i class="fa fa-plus-square"></i>

                    Registrar persona
                  </button>
                </div>
                <div>
                  <button
                    type="button"
                    class="btn btn-sm btn-primary"
                    @click="modalOrganizacion()"
                  >
                    <i class="fa fa-plus-square"></i>
                    Registrar organización
                  </button>
                </div>
                <div>
                  <button
                    type="button"
                    class="btn btn-sm btn-primary"
                    @click="modalGrupo()"
                  >
                    <i class="fa fa-plus-square"></i>
                    Registrar grupo
                  </button>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover">
                <thead>
                  <tr>

                    <th>Identificación</th>
                    <th>Cédula jurídica</th>
                    <th>Nombre Grupo</th>
                    <th>Cantidad de visitantes</th>
                    <th>Fecha de reservación</th>
                    <th>Hora inicial de reservación</th>
                    <th>Hora final de reservación</th>
                    <th>Funciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="reserva in reservas.data" :key="reserva.id">
                    <td>{{ reserva.identificacionPersona }}</td>
                    <td>{{ reserva.identificacionOrganizacion }}</td>
                    <td>{{ reserva.nombreGrupo }}</td>
                    <td>{{ reserva.cantidad }}</td>
                    <td>{{ reserva.fecha }}</td>
                    <td>{{ reserva.horaInicio }}</td>
                    <td>{{ reserva.horaFin }}</td>
                    <td>
                      <a id="icono" href="#" @click="editModal(reserva)">
                        <i class="fa fa-edit blue"></i>
                      </a>
                      /
                      <a
                        id="icono"
                        href="#"
                        @click="eliminarReserva(reserva.id)"
                      >
                        <i class="fa fa-trash red"></i>
                      </a>
                      /
                      <a href="#" @click="detailsModal(reserva)">
                        <i id="icono" class="fa fa-eye green"></i>
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <pagination
                :data="reservas"
                :limit="5"
                @pagination-change-page="getResults"
              ></pagination>
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
      <div v-if="!$gate.isAdmin() && !$gate.isUser()">
        <not-found></not-found>
      </div>
      <!-- MODAL DE RESERVAS-->
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
                Crear nueva reservación
              </h5>
              <h5 class="modal-title" v-show="editmode">Actualizar reserva</h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <!-- <form @submit.prevent="createUser"> -->

            <form
              @submit.prevent="editmode ? actualizarReserva() : crearReserva()"
            >
              <div class="modal-body">
                <div v-show="verCamposdeConsulta" class="form-group">
                  <label>Consultar identificación:</label>
                  <input
                    v-model="buscador"
                    type="text"
                    name="buscador"
                    class="form-control"
                    :disabled="bloquearCampoConsulta"
                    placeholder="Escriba la identificación a consultar..."
                  />
                </div>
                <div v-show="verCamposdeConsulta">
                  <label
                    v-show="VermensajeSiExiste"
                    v-text="mensajeDeExistencia"
                    style="color: green"
                  ></label>
                  <label
                    v-show="VermensajeNoExiste"
                    v-text="mensajeDeExistencia"
                    style="color: red"
                  ></label>
                </div>
                <div v-show="verCamposdeConsulta" class="form-group">
                  <button
                    type="button"
                    class="btn btn-success my-4"
                    @click="ConsultaCedula()"
                  >
                    Consultar
                  </button>
                  <button
                    type="button"
                    class="btn btn-danger my-4"
                    @click="cancelarbusqueda()"
                  >
                    Cancelar
                  </button>
                </div>
                <div v-show="verCampoDeIdentificacionEdit" class="form-group">
                  <label>Identificación Donante</label>
                  <input
                    v-model="form.identificacionPersona"
                    type="text"
                    name="identificacionPersona"
                    class="form-control"
                    :disabled="bloquearSiempre"
                  />
                </div>
                <div v-show="verCampoDeIdentificacionEdit" class="form-group">
                  <label>Identificación Organización</label>
                  <input
                    v-model="form.identificacionOrganizacion"
                    type="text"
                    name="identificacionOrganizacion"
                    class="form-control"
                    :disabled="bloquearSiempre"
                  />
                </div>
                <div class="form-group">
                  <label>Cantidad de visitantes</label>
                  <input
                    v-model="form.cantidad"
                    type="number"
                    name="cantidad"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('cantidad') }"
                    :disabled="bloquearCamposReservacion"
                    min="1"
                    max="100"
                    placeholder="Cantidad de visitantes que asistirán"
                    required
                    v-mask="'###'"
                  />
                  <has-error :form="form" field="cantidad"></has-error>
                </div>

                <div class="form-group">
                  <label>Fecha de reservación</label>
                  <input
                    v-model="form.fecha"
                    type="date"
                    name="fecha"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('fecha') }"
                    :disabled="bloquearCamposReservacion"
                    min="2022-01-01"
                    required
                  />
                  <has-error :form="form" field="fecha"></has-error>
                </div>

                <div class="form-group">
                  <label>Hora incial de reservación</label>
                  <input
                    v-model="form.horaInicio"
                    type="time"
                    name="horaInicio"
                    id="horaInicio"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('horaInicio') }"
                    required
                    onchange="validarHora()"
                    :disabled="bloquearCamposReservacion"
                    min="08:00:00"
                    max="14:00:00"
                  />
                  <has-error :form="form" field="horaInicio"></has-error>
                </div>
                <div class="form-group">
                  <label>Hora final de reservación</label>
                  <input
                    v-model="form.horaFin"
                    type="time"
                    name="horaFin"
                    id="horaFin"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('horaFin') }"
                    required
                    onchange="validarHora()"
                    :disabled="bloquearCamposReservacion"
                    min="09:00:00"
                    max="15:00:00"
                  />
                  <has-error :form="form" field="horaFin"></has-error>
                </div>
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-dismiss="modal"
                >
                  Cancelar
                </button>
                <button v-show="editmode" type="submit" class="btn btn-success">
                  Actualizar
                </button>
                <button
                  v-show="!editmode"
                  type="submit"
                  class="btn btn-primary"
                  id="reservar"
                  :disabled="bloquearCamposReservacion"
                >
                  Reservar
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>

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
              <h5 class="modal-title">Detalles del donativo</h5>
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
                <label>Identificación persona</label>
                <input
                  v-model="form.identificacionPersona"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
              <div id="inputsModal" class="form-group">
                <label>Identificación organización</label>
                <input
                  v-model="form.identificacionOrganizacion"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
              <div id="inputsModal" class="form-group">
                <label>Nombre de grupo</label>
                <input
                  v-model="form.nombreGrupo"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
              <div id="inputsModal" class="form-group">
                <label>Cantidad de visitantes</label>
                <input
                  v-model="form.cantidad"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
              <div id="inputsModal" class="form-group">
                <label>Fecha de reservación</label>
                <input
                  v-model="form.fecha"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
              <div class="form-group">
                <label>Hora inicial de reservación</label>
                <input
                  v-model="form.horaInicio"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
              <div id="inputsModal" class="form-group">
                <label>Hora final de reservación</label>
                <input
                  v-model="form.horaFin"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">
                Cerrar
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal DE Personas-->
      <div
        class="modal fade"
        id="modalPersona"
        tabindex="-1"
        role="dialog"
        aria-labelledby="modalPersona"
        aria-hidden="true"
      >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Registrar persona</h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form @submit.prevent="crearPersona()">
            <div class="modal-body">
              <div class="form-group">
                <label>Tipo de identificación</label>
                <select
                  class="form-control"
                  v-model="tipoIndenteficacion"
                  :class="{ 'is-invalid': form.errors.has('identificacion') }"
                  @change="tiposDeIndentificacon()"
                  required
                >
                  <option disabled value="">Seleccione un tipo</option>
                  <option value="Cedula Nacional">Cédula Nacional</option>
                  <option value="Cedula Residencial">Cedula Residencial</option>
                  <option value="Pasaporte">Pasaporte</option>
                </select>
              </div>
              <!---------------------------------------------------------->
              <!-------------INPUTS DE IDENTIFICACION----------------------------------------------->
              <!---------------------------------------------------------->
              <div class="form-group">
                <div v-show="CedulaNacional" class="form-group identitad">
                  <input
                    v-model="DNINacional"
                    type="text"
                    name="identificacion"
                    class="form-control"
                    :class="{
                      'is-invalid': formPer.errors.has('identificacion'),
                    }"
                    placeholder="Formato #-####-####"
                    id="nacional"
                    onchange="validarCedulaN()"
                    v-mask="[/[1-9]/, '-####-####']"
                  />

                  <has-error :form="formPer" field="identificacion"></has-error>
                </div>

                <div v-show="CedulaResidencial" class="form-group">
                  <input
                    v-model="DNIResidencial"
                    id="residencial"
                    type="text"
                    name="identificacion"
                    class="form-control"
                    :class="{
                      'is-invalid': formPer.errors.has('identificacion'),
                    }"
                    placeholder="Formato de 10 dígitos"
                    onchange="validateResidencial()"
                    pattern="[0-9]{10}"
                    v-mask="'##########'"
                  />
                  <has-error :form="formPer" field="identificacion"></has-error>
                </div>

                <div v-show="Pasaporte" class="form-group identitad">
                  <input
                    id="pasaporte"
                    v-model="DNIPasaporte"
                    type="text"
                    name="identificacion"
                    class="form-control"
                    :class="{
                      'is-invalid': formPer.errors.has('identificacion'),
                    }"
                    placeholder="Formato de 11 a 12 dígitos"
                    onchange="validatePasaporte()"
                    pattern="[0-9]{11,12}"
                    v-mask="'############'"
                  />
                  <has-error :form="formPer" field="identificacion"></has-error>
                </div>
              </div>
              <!-------FIN DE LOS INPUTS DE IDENTIFICACION-------->
              <div class="form-group">
                <label>Nombre</label>
                <input
                  v-model="formPer.nombre"
                  type="text"
                  name="nombre"
                  class="form-control"
                  :class="{ 'is-invalid': formPer.errors.has('nombre') }"
                  placeholder="Escriba el nombre del donante"
                  required
                  minlength="2"
                  maxlength="30"
                  pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]{1,30}"
                  title="Escriba su nombre."
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
                  placeholder="Primer apellido del donante"
                  minlength="3"
                  maxlength="30"
                  required
                  pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ]{1,30}"
                  title="Digite el primer apellido."
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
                  placeholder="Segundo apellido del donante"
                  minlength="3"
                  maxlength="30"
                  pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ]{1,30}"
                  title="Digite el segundo apellido."
                  required
                />
                <has-error :form="formPer" field="apellido2"></has-error>
              </div>

              <div class="form-group">
                <label>Teléfono</label>
                <input
                  v-model="formPer.telefono"
                  type="number"
                  name="telefono"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('telefono') }"
                  min="1"
                  placeholder="Formato: #### ####"
                  required
                  pattern="[0-9]{8}"
                  title="Digite un número de teléfono"
                  v-mask="[/[2-9]/, '#######']"
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
                  placeholder="ejemplo@gmail.com"
                  minlength="3"
                  maxlength="64"
                  pattern="[a-zA-Z0-9.-_]{1,}@[a-zA-Z.-]{2,}[.]{1}[a-zA-Z]{2,}"
                  required
                />
                <has-error :form="formPer" field="correo"></has-error>
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
              >
                Cancelar
              </button>
              <button
                type="submit"
                class="btn btn-primary"
              >
                Registrar
              </button>
            </div>
            </form>
          </div>
        </div>
      </div>
      <!--Modal Organizacion-->
      <div
        class="modal fade"
        id="modalOrganizacion"
        tabindex="-1"
        role="dialog"
        aria-labelledby="modalOrganizacion"
        aria-hidden="true"
      >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Registrar organización</h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form @submit.prevent="crearOrganizacion()">
            <div class="modal-body">
              <div class="form-group">
                <label>Cedula Jurídica</label>
                <input
                  v-model="formOrg.identificacion"
                  type="text"
                  name="identificacion"
                  class="form-control"
                  :class="{
                    'is-invalid': formOrg.errors.has('identificacion'),
                  }"
                  placeholder="Formato: #-###-######"
                  required
                  pattern="[1-9]{1}-[0-9]{3}-[0-9]{6}"
                  v-mask="'#-###-######'"
                />
                <has-error :form="formOrg" field="identificacion"></has-error>
              </div>

              <div class="form-group">
                <label>Nombre organización</label>
                <input
                  v-model="formOrg.nombre"
                  type="text"
                  name="nombre"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('nombre') }"
                  placeholder="Nombre de organización"
                  required
                  minlength="3"
                  maxlength="50"
                  pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]{3,50}"
                />
                <has-error :form="formOrg" field="nombre"></has-error>
              </div>

              <div class="form-group">
                <label>Teléfono organización</label>
                <input
                  v-model="formOrg.telefono"
                  type="number"
                  name="telefono"
                  class="form-control"
                  :class="{ 'is-invalid': formOrg.errors.has('telefono') }"
                  placeholder="#### ####"
                  v-mask="[/[2-9]/, '#######']"
                  required
                />
                <has-error :form="formOrg" field="telefono"></has-error>
              </div>
              <div class="form-group">
                <label>Correo organización</label>
                <input
                  v-model="formOrg.correo"
                  type="email"
                  name="correo"
                  class="form-control"
                  :class="{ 'is-invalid': formOrg.errors.has('correo') }"
                  placeholder="ejemplo@gmail.com"
                  minlength="3"
                  maxlength="64"
                  pattern="[a-zA-Z0-9.-_]{1,}@[a-zA-Z.-]{2,}[.]{1}[a-zA-Z]{2,}"
                  required
                />

                <has-error :form="formOrg" field="correo"></has-error>
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
              >
                Cancelar
              </button>
              <button
                type="submit"
                class="btn btn-primary"
              >
                Registrar
              </button>
            </div>
            </form>
          </div>
        </div>
      </div>
      <!--MODAL DE GRUPO-->
      <div
        class="modal fade"
        id="modalGrupo"
        tabindex="-1"
        role="dialog"
        aria-labelledby="modalGrupo"
        aria-hidden="true"
      >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Registrar grupo</h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form @submit.prevent="crearGrupo()">
            <div class="modal-body">
              <div class="form-group">
                <label>Nombre del grupo</label>
                <input
                  v-model="formGrupo.nombre"
                  type="text"
                  name="nombre"
                  class="form-control"
                  :class="{
                    'is-invalid': formGrupo.errors.has('nombre'),
                  }"
                  placeholder="Nombre del grupo, G-####"
                  required
                  v-mask="[/[G]/, '-####']"
                  title="Registra un nombre de grupo válido, no se acepta caracteres especiales"
                />
                <has-error :form="formGrupo" field="nombre"></has-error>
              </div>

              <div class="form-group">
                <label>Correo</label>
                <input
                  v-model="formGrupo.correo"
                  type="text"
                  name="nombre"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('correo') }"
                  placeholder="Escriba el correo del grupo"
                  minlength="3"
                  maxlength="64"
                  pattern="[a-zA-Z0-9.-_]{1,}@[a-zA-Z.-]{2,}[.]{1}[a-zA-Z]{2,}"
                  required
                />
                <has-error :form="formGrupo" field="correo"></has-error>
              </div>

              <div class="form-group">
                <label>Cantidad del grupo</label>
                <input
                  v-model="formGrupo.cantidad"
                  type="number"
                  name="cantidad"
                  class="form-control"
                  :class="{ 'is-invalid': formGrupo.errors.has('cantidad') }"
                  placeholder="####"
                  min="1"
                  max="100"
                  required
                  pattern="[1-9]{1,100}"
                  v-mask="'###'"
                />
                <has-error :form="formGrupo" field="cantidad"></has-error>
              </div>
              <div class="form-group">
                <label>Rango de edades</label>
                <input
                  v-model="formGrupo.edades"
                  type="range"
                  name="edades"
                  class="form-control"
                  :class="{ 'is-invalid': formGrupo.errors.has('edades') }"
                  required
                  min="5"
                  max="109"
                  step="1"
                  v-mask="'###'"
                />
                <label for="">Rango: {{ formGrupo.edades }}</label>
                <has-error :form="formGrupo" field="edades"></has-error>
              </div>
              <div class="form-group">
                <label>Lugar de procedencia</label>
                <input
                  v-model="formGrupo.lugar"
                  type="text"
                  name="lugar"
                  class="form-control"
                  :class="{ 'is-invalid': formGrupo.errors.has('lugar') }"
                  id="phone"
                  min="1"
                  placeholder="Escriba el lugar de procedencia"
                  required
                />
                <has-error :form="formGrupo" field="lugar"></has-error>
              </div>
              <div class="form-group">
                <div style="margin-bottom: 10px">
                  <label>Tematica</label>
                  <select
                    class="form-control"
                    v-model="formGrupo.tematica"
                    :class="{ 'is-invalid': formGrupo.errors.has('tematica') }"
                    required
                    @change="verInputOtraTematica()"
                  >
                    <option disabled value="">Seleccione una tematica</option>
                    <option value="Todas las tematicas">
                      Todas las tematicas
                    </option>
                    <option value="Biodiversidad">Biodiversidad</option>
                    <option value="Cultura">Cultura</option>
                    <option value="Otros">Otros</option>
                  </select>
                </div>
                <div id="inputOtros" v-show="VerOtraTematica">
                  <input
                    type="text"
                    v-model="formGrupo.tematica"
                    name="lugar"
                    class="form-control"
                    :class="{ 'is-invalid': formGrupo.errors.has('tematica') }"
                    placeholder="Escriba la otra tematica de interes..."
                    required
                  />
                </div>
                <has-error :form="form" field="tematica"></has-error>
              </div>
              <div class="form-group">
                <label>Detalles a considerar</label>
                <textarea
                  name="detalles"
                  v-model="formGrupo.detalles"
                  class="form-control"
                  :class="{ 'is-invalid': formGrupo.errors.has('detalles') }"
                  cols="5"
                  rows="5"
                  placeholder="Algunas notas a considerar, por ejemplos alergias..."
                ></textarea>
                <has-error :form="formGrupo" field="detalles"></has-error>
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
              >
                Cancelar
              </button>
              <button
                type="submit"
                class="btn btn-primary"
              >
                Registrar
              </button>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import emailjs from "@emailjs/browser";

export default {
  data() {
    return {
      valorMostrar: "10",
      buscador: "", //v-model de buscar en el input de consulta
      reservas: {}, //Se llena con ultimos 10 donativos
      personaIdArray: {}, //Array para guardar la identificacion encontrada en persona
      organizacionIdArray: {}, //Array para guardar la identificacion encontrada en organizacion
      grupoIdArray: {},
      nuevoReservaciones: {}, //Para hacer el filtro en computed
      mensajeDeExistencia: "", //Vamos a mostrar un mensaje que valide si existe la identificacion
      VermensajeSiExiste: false, //ver mensaje si existe
      VermensajeNoExiste: false, //ver mensaje si no existe
      bloquearCamposReservacion: true, //Bloqueamos los campos de reservacion
      bloquearCampoConsulta: false, //Bloqueamos el input de la consulta para evitar que se modifique
      verCamposdeConsulta: true, //Ver campo de consulta
      verCampoDeIdentificacionEdit: false, //Sirve para mostrar un campo con la identificacion
      bloquearSiempre: true, //Bloqueamos los inputs donde pintamos los ver
      message: "",
      filtrarBusqueda: "", //va en el input de buscar en la tabla
      /*Funcionan con el selec para ocultar y mostrar los campos*/
      tipoIndenteficacion: "",
      CedulaResidencial: false,
      CedulaNacional: false,
      Pasaporte: false,
      verDetalles: true,
      editmode: false,
      DNINacional: "",
      DNIResidencial: "",
      DNIPasaporte: "",
      VerOtraTematica: false,
      valorParallenar: 0,
      form: new Form({
        id: "",
        idPersona: "",
        identificacionPersona: "",
        idOrganizacion: "",
        identificacionOrganizacion: "",
        idGrupo: "",
        nombreGrupo: "",
        cantidad: "",
        fecha: "",
        horaInicio: "",
        horaFin: "",
      }),
      formPer: new Form({
        id: "",
        identificacion: "",
        nombre: "",
        apellido1: "",
        apellido2: "",
        telefono: "",
        correo: "",
      }),
      formOrg: new Form({
        id: "",
        identificacion: "",
        nombre: "",
        telefono: "",
        correo: "",
      }),
      formGrupo: new Form({
        id: "",
        nombre: "",
        cantidad: "",
        correo: "",
        edades: "",
        lugar: "",
        tematica: "",
        detalles: "",
      }),
      formCorreo: new Form({
        cedulaReservacion: "",
        fechaReservacion: "",
        cantidaPersonasReservacion: "",
        horaInicio: "",
        horaFin: "",
        correo: "",
      }),
    };
  },
  methods: {
    verInputOtraTematica() {
      if (this.formGrupo.tematica == "Otros") {
        this.VerOtraTematica = true;
        this.formGrupo.tematica = "Escriba la tematica...";
      } else {
        this.VerOtraTematica = false;
      }
    },
    /*////////////////////////////////////////////////////////////*/
    tiposDeIndentificacon() {
      if (this.tipoIndenteficacion == "Cedula Nacional") {
        this.CedulaNacional = true;
        this.Pasaporte = false;
        this.CedulaResidencial = false;
        this.formPer.identificacion = "";
        this.DNINacional = "";
        this.DNIResidencial = "";
        this.DNIPasaporte = "";
      }
      if (this.tipoIndenteficacion == "Cedula Residencial") {
        this.CedulaNacional = false;
        this.Pasaporte = false;
        this.CedulaResidencial = true;
        this.formPer.identificacion = "";
        this.DNINacional = "";
        this.DNIResidencial = "";
        this.DNIPasaporte = "";
      } else if (this.tipoIndenteficacion == "Pasaporte") {
        this.CedulaNacional = false;
        this.Pasaporte = true;
        this.CedulaResidencial = false;
        this.formPer.identificacion = "";
        this.DNINacional = "";
        this.DNIResidencial = "";
        this.DNIPasaporte = "";
      }
    },
    /*////////////////////////////////////////////////////////////*/
    ConsultaCedula() {
      if (this.buscador.length != 0) {
        if (
          /^[1-9]-\d{4}-\d{4}$/.test(this.buscador) ||
          /^[1-9]\d{9}$/.test(this.buscador) ||
          /^\d{11,12}$/.test(this.buscador)
        ) {
          this.form
            .get("/api/reserva/verificar", {
              params: { buscador: this.buscador },
            })
            .then(({ data }) => (this.personaIdArray = data.data)),
            (this.valorParallenar = 1);
          this.HabilitarMostrarMensaje();
        } else if (/^[1-9]-\d{3}-\d{6}$/.test(this.buscador)) {
          this.form
            .get("/api/reserva/verificarOrg", {
              params: { buscador: this.buscador },
            })
            .then(({ data }) => (this.organizacionIdArray = data.data));
          this.valorParallenar = 2;
          this.HabilitarMostrarMensaje();
        } else if (/^[G]{1}-\d{1,4}$/.test(this.buscador)) {
          this.form
            .get("/api/reserva/verificarGrupo", {
              params: { buscador: this.buscador },
            })
            .then(({ data }) => (this.grupoIdArray = data.data));
          this.valorParallenar = 3;
          this.HabilitarMostrarMensaje();
        } else {
          this.VermensajeSiExiste = false;
          this.VermensajeNoExiste = true;
          this.mensajeDeExistencia = "No existe!";
        }
      } else {
        this.VermensajeSiExiste = false;
        this.VermensajeNoExiste = true;
        this.mensajeDeExistencia =
          "Campo vacío, por favor digite una identificación";
      }
    },
    cancelarbusqueda() {
      //vamos a cancelar la busqueda bloqueando los input de reservacion
      this.bloquearCampoConsulta = false;
      this.bloquearCamposReservacion = true;
      this.VermensajeSiExiste = false;
      this.VermensajeNoExiste = false;
      this.mensajeDeExistencia = "";
      this.valorParallenar = 0;
    },
    llenarPersonaForm() {
      this.personaIdArray.forEach((element) => {
        this.form.idPersona = element.id;
        this.form.identificacionPersona = element.identificacion;
        this.formCorreo.cedulaReservacion = element.identificacion;
        this.formCorreo.correo = element.correo;
      });
    },
    llenarOrgaForm() {
      this.organizacionIdArray.forEach((element) => {
        this.form.idOrganizacion = element.id;
        this.form.identificacionOrganizacion = element.identificacion;
        this.formCorreo.cedulaReservacion = element.identificacion;
        this.formCorreo.correo = element.correo;
      });
    },
    llenarGrupoForm() {
      this.grupoIdArray.forEach((element) => {
        this.form.idGrupo = element.id;
        this.form.nombreGrupo = element.nombre;
        this.formCorreo.cedulaReservacion = element.nombre;
        this.formCorreo.correo = element.correo;
      });
    },
    enviaEmail() {
      this.formCorreo.horaFin = this.form.horaFin;
      this.formCorreo.horaInicio = this.form.horaInicio;
      this.formCorreo.cantidaPersonasReservacion = this.form.cantidad;
      this.formCorreo.fechaReservacion = this.form.fecha;

      const templateParams = {
        cedulaReservacion: this.formCorreo.cedulaReservacion,
        fechaReservacion: this.formCorreo.fechaReservacion,
        cantidaPersonasReservacion: this.formCorreo.cantidaPersonasReservacion,
        horaInicio: this.formCorreo.horaInicio,
        horaFin: this.formCorreo.horaFin,
        correo: this.formCorreo.correo,
      };
      emailjs
        .send(
          "service_xf6d5cg",
          "template_kgy3kx2",
          templateParams,
          "user_GMf53dmaF0FI8RLY0cj3V"
        )
        .then((res) => {
          console.log(res.json());
        })
        .catch((err) => {
          console.log(err.json());
        });
    },
    HabilitarMostrarMensaje() {
      this.VermensajeSiExiste = true;
      this.VermensajeNoExiste = false;
      this.mensajeDeExistencia = "Si existe!";
      this.bloquearCampoConsulta = true;
      this.bloquearCamposReservacion = false;
    },

    crearReserva() {
      if (this.buscador.length != "") {
        if(this.valorParallenar == 1){
          this.llenarPersonaForm();
        }
        if(this.valorParallenar == 2){
          this.llenarOrgaForm();
        }
        if(this.valorParallenar == 3){
          this.llenarGrupoForm();
        }
        if (
          /^[1-9]-\d{4}-\d{4}$/.test(this.form.identificacionPersona) ||
          /^[1-9]\d{9}$/.test(this.form.identificacionPersona) ||
          (/^\d{11,12}$/.test(this.form.identificacionPersona) &&
            this.form.idPersona != 0)
        ) {
          this.reservar();
        } else if (
          /^[1-9]-\d{3}-\d{6}$/.test(this.form.identificacionOrganizacion) &&
          this.form.idOrganizacion != 0
        ) {
          this.reservar();
        } else if (
          /^[G]{1}-\d{1,4}$/.test(this.form.nombreGrupo) &&
          this.form.idGrupo != 0
        ) {
          this.reservar();
        } else {
          Swal.fire(
            "Error!",
            "Identificación o nombre de grupo esta en formato incorrecto!",
            "error"
          );
        }
      } else {
        Swal.fire("Error!", "Primero verifique que este registrado!", "error");
      }
    },
    reservar() {
      this.$Progress.start();
      this.form
        .post("/api/reserva")
        .then((response) => {
          $("#addNew").modal("hide");
          Toast.fire({
            icon: "success",
            title: response.data.message,
          });
          this.valorParallenar = 0;
          this.$Progress.finish();
          this.cargarReservas();
          this.enviaEmail();
        })
        .catch(() => {
          Toast.fire({
            icon: "error",
            title: "Ocurrio un error!",
          });
        });
    },

    async cargarReservas() {
      if (this.$gate.isAdmin() || this.$gate.isUser()) {
        await axios
          .get("/api/reserva")
          .then(({ data }) => (this.reservas = data.data));
        await axios
          .get("/api/reserva/listar")
          .then(({ data }) => (this.nuevoReservaciones = data.data));
      }
    },
    mostrar() {
      if (this.$gate.isAdmin() || this.$gate.isUser()) {
        this.form
          .get("/api/reserva/mostrar/", {
            params: { valor: this.valorMostrar },
          })
          .then(({ data }) => (this.reservas = data.data));
      }
    },
    getResults(page = 1) {
      this.$Progress.start();
      axios
        .get("/api/reserva?page=" + page, {
          params: { valor: this.valorMostrar },
        })
        .then(({ data }) => (this.reservas = data.data));
      this.$Progress.finish();
    },

    actualizarReserva() {
      this.$Progress.start();
      this.form
        .put("/api/reserva/" + this.form.id)
        .then((response) => {
          // success
          $("#addNew").modal("hide");
          Toast.fire({
            icon: "success",
            title: response.data.message,
          });
          this.$Progress.finish();
          //  Fire.$emit('AfterCreate');

          this.cargarReservas();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    eliminarReserva(id) {
      Swal.fire({
        title: "Seguro que lo desea eliminar?",
        text: "Esta acción no puede revertirse!",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Si, Eliminar!",
      }).then((result) => {
        // Send request to the server
        if (result.value) {
          this.form
            .delete("/api/reserva/" + id)
            .then(() => {
              Swal.fire(
                "Eliminado!",
                "Se ha eliminado la información.",
                "success"
              );
              // Fire.$emit('AfterCreate');
              this.cargarReservas();
            })
            .catch((data) => {
              Swal.fire("Fallo!", data.message, "warning");
            });
        }
      });
    },
    modalPersona() {
      $("#modalPersona").modal("show");
      this.formPer.reset();
      this.formPer.errors.clear();
    },
    modalOrganizacion() {
      $("#modalOrganizacion").modal("show");
      this.formOrg.reset();
      this.formOrg.errors.clear();
    },
    modalGrupo() {
      $("#modalGrupo").modal("show");
      this.formGrupo.reset();
      this.formGrupo.errors.clear();
    },
    editModal(reserva) {
      this.editmode = true;
      (this.verCamposdeConsulta = false),
        (this.verCampoDeIdentificacionEdit = true),
        (this.bloquearCamposReservacion = false),
        $("#addNew").modal("show");
      this.form.fill(reserva);
      this.form.errors.clear();
    },
    newModal() {
      this.cancelarbusqueda();
      (this.verCamposdeConsulta = true),
        (this.verCampoDeIdentificacionEdit = false),
        (this.editmode = false);
      this.form.reset();
      this.form.errors.clear();
      $("#addNew").modal("show");
    },
    detailsModal(reserva) {
      $("#ModalVer").modal("show");
      this.form.fill(reserva);
    },
    asignarDNI() {
      if (this.DNINacional != "") {
        this.formPer.identificacion = this.DNINacional;
      } else if (this.DNIResidencial != "") {
        this.formPer.identificacion = this.DNIResidencial;
      } else if (this.DNIPasaporte) {
        this.formPer.identificacion = this.DNIPasaporte;
      }
    },
    crearPersona() {
      if (
        this.DNINacional != "" ||
        this.DNIResidencial != "" ||
        this.DNIPasaporte != ""
      ) {
        this.asignarDNI();
        if (
          /^[1-9]-\d{4}-\d{4}$/.test(this.formPer.identificacion) ||
          /^[1-9]\d{9}$/.test(this.formPer.identificacion) ||
          /^\d{11,12}$/.test(this.formPer.identificacion)
        ) {
          this.formPer
            .post("/api/reserva/guardarPersona", {
              params: { identificacion: this.formPer.identificacion },
            })
            .then((response) => {
              if (response.data.success == false) {
                Toast.fire({
                  icon: "error",
                  title: "Cedula ya existe!",
                });
              } else {
                $("#modalPersona").modal("hide");

                Toast.fire({
                  icon: "success",
                  title: response.data.message,
                });
                this.$Progress.finish();
              }
            })
            .catch(() => {
              Toast.fire({
                icon: "error",
                title: "Campos vacios!",
              });
            });
        } else {
          Swal.fire("Error!", "Formato de identificación incorrecto!", "error");
        }
      } else {
        Swal.fire("Error!", "Campo de identificación esta vacio!", "error");
      }
    },
    crearOrganizacion() {
      if (this.formOrg.identificacion != "") {
        if (/^[1-9]-\d{3}-\d{6}$/.test(this.formOrg.identificacion)) {
          this.formOrg
            .post("/api/reserva/guardarOrganizacion", {
              params: { identificacion: this.formOrg.identificacion },
            })
            .then((response) => {
              if (response.data.success == false) {
                Toast.fire({
                  icon: "error",
                  title: "Cedula ya existe!",
                });
              } else {
                $("#modalOrganizacion").modal("hide");

                Toast.fire({
                  icon: "success",
                  title: response.data.message,
                });
                this.$Progress.finish();
              }
            })
            .catch(() => {
              Toast.fire({
                icon: "error",
                title: "Campos vacios!",
              });
            });
        } else {
          Swal.fire(
            "Error!",
            "Formato de cédula juridica incorrecto!",
            "error"
          );
        }
      } else {
        Swal.fire("Error!", "Campo de cédula juridica esta vacio!", "error");
      }
    },
    crearGrupo() {
      if (this.formGrupo.nombre != "") {
        if (/^[G]{1}-\d{1,4}$/.test(this.formGrupo.nombre)) {
          this.formGrupo
            .post("/api/reserva/guardarGrupo", {
              params: { nombre: this.formGrupo.nombre },
            })
            .then((response) => {
              if (response.data.success == false) {
                Swal.fire("Error!", "El nombre ya existe!", "error");
              } else {
                Swal.fire("Registrado!", response.data.message, "success");
                $("#modalGrupo").modal("hide");
              }
            })
            .catch((error) => {
              Swal.fire("Error!", "Complete los campos!", "error");
            });
        } else {
          Swal.fire(
            "Error!",
            "Formato de nombre del grupo incorrecto!",
            "error"
          );
        }
      } else {
        Swal.fire("Error!", "Campo de nombre del grupo vacio!", "error");
      }
    },
    filtrar() {
      if (this.filtrarBusqueda == "") {
        this.reservas.data = this.nuevoReservaciones;
      } else if (this.filtrarBusqueda != "") {
        this.reservas.data = this.reservasFiltros;
      }
    },
  },
  mounted() {
    console.log("Component mounted.");
  },

  created() {
    this.$Progress.start();
    this.cargarReservas();
    this.$Progress.finish();
  },
  filters: {
    truncate: function (text, length, suffix) {
      return text.substring(0, length) + suffix;
    },
  },
  computed: {
    reservasFiltros: function () {
      return this.nuevoReservaciones.filter((reserva) => {
        return (
          reserva.fecha
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) ||
          reserva.horaInicio
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) ||
          reserva.horaFin
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase())
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
  justify-content: center;
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

#modal-body {
  display: flex;
  flex-direction: column;
  flex-wrap: wrap;
  justify-content: space-around;
}
#inputsModal {
  width: 100%;
  margin: 10px 0px;
}

.table th,
.table td {
  padding: 0.75rem;
  vertical-align: baseline;
  border-top: 1px solid #dee2e6;
}
@media screen and (min-width: 900px) {
  .modal-content {
    width: 100%;
  }
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
</style>