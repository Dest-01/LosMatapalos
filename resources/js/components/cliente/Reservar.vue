<template>
  <div class="contenedor">
    <div class="intro" style="text-align: center">
      <h2>
        {{ $t("Reserva_") }}
        <span style="color: #38ab81">{{ $t("Los_MP") }}</span>
      </h2>
    </div>
    <div class="contenedor-2">
      <div class="card mb-3">
        <div class="row g-0">
          <div class="col-md-5">
            <H2 style="text-align: center">{{ $t("Horario_") }}</H2>
            <div class="horas">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">
                      {{ $t("Hora_llegada") }}
                    </th>
                    <th scope="col">
                      {{ $t("Hora_salida") }}
                    </th>
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
                      >
                        <i class="fas fa-plus"></i>
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td>03:00 p.m.</td>
                    <td>04:00 p.m.</td>
                    <td>
                      <button
                        type="button"
                        class="btn btn-danger btn-sm px-3"
                        @click="opcionHora8()"
                      >
                        <i class="fas fa-plus"></i>
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td>04:00 p.m.</td>
                    <td>05:00 p.m.</td>
                    <td>
                      <button
                        type="button"
                        class="btn btn-danger btn-sm px-3"
                        @click="opcionHora9()"
                      >
                        <i class="fas fa-plus"></i>
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td>05:00 p.m.</td>
                    <td>06:00 p.m.</td>
                    <td>
                      <button
                        type="button"
                        class="btn btn-danger btn-sm px-3"
                        @click="opcionHora10()"
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
                <h2 class="card-title">
                  {{ $t("Formulario_R") }}
                </h2>
                <div class="indicaciones_posicion">
                  <i class="fas fa-info-circle">{{ $t("Indicaciones") }}</i>
                  <i class="fas fa-angle-right">{{ $t("Indicacion1") }}</i>
                  <i class="fas fa-angle-right">{{ $t("Indicacion2") }}</i>
                  <i class="fas fa-angle-right">{{ $t("Indicacion3") }}</i>
                </div>
                <div class="botones_opciones">
                  <button
                    type="button"
                    class="btn btn-primary"
                    @click="modalPersona()"
                  >
                    {{ $t("Persona") }}
                  </button>
                  <button
                    type="button"
                    class="btn btn-primary"
                    @click="modalGrupo()"
                  >
                    {{ $t("Grupo") }}
                  </button>
                  <button
                    type="button"
                    class="btn btn-primary"
                    @click="modalOrganizacion()"
                  >
                    {{ $t("Organizacion") }}
                  </button>
                </div>
              </div>
              <!--CONTENEDOR DE TODO EL FORMULARIO DE RESERVACION-->
              <form id="contact-form" class="material-form">
                <input type="hidden" name="contact_number" />
                <div class="group group_reservacion">
                  <div>
                    <h3>{{ $t("Busqueda_") }}</h3>
                  </div>
                  <div class="campo_consulta">
                    <div class="input_buscador">
                      <i class="fas fa-id-card iconoInput"></i>
                      <input
                        v-model="buscador"
                        name="cedulaReservacion"
                        id="cedulaReservacion"
                        type="text"
                        required
                        :disabled="bloquearConsulta"
                        v-bind:placeholder="$t('EscribaElIDCOnsultar')"
                      />
                    </div>
                    <div class="btn_consultar">
                      <button
                        type="button"
                        @click="consultarDatos()"
                        class="Posicionar btn btn-success"
                        :disabled="bloquearConsulta"
                      >
                        {{ $t("Consulta") }}
                      </button>
                    </div>
                  </div>
                  <!--div de alerta-->
                  <div style="height: 20px">
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
                </div>
                <!--fin de div que contiene la consulta y boton-->
                <!--div de cantidad de visitantes y fecha-->
                <div class="group group_reservacion">
                  <div class="contenedor_inputs">
                    <div class="input_titulos">
                      <h3>{{ $t("Cantidad_Visita") }}</h3>
                    </div>
                    <div class="input_titulos">
                      <h3>{{ $t("Fecha_llegada") }}</h3>
                    </div>
                  </div>
                  <div class="contenedor_inputs">
                    <div class="input_titulos">
                      <i class="fas fa-users iconoInput"></i>
                      <input
                        id="cantidaPersonasReservacion"
                        name="cantidaPersonasReservacion"
                        v-model="formReserva.cantidad"
                        placeholder="0"
                        type="number"
                        required
                        min="1"
                        max="30"
                        :class="{
                          'is-invalid': formReserva.errors.has('cantidad'),
                        }"
                      />
                      <has-error
                        class="error"
                        :form="formReserva"
                        field="cantidad"
                      ></has-error>
                    </div>
                    <div class="input_titulos">
                      <i class="fas fa-calendar-check iconoInput icono"></i>
                      <input
                        id="fechaReservacion"
                        name="fechaReservacion"
                        v-model="formReserva.fecha"
                        type="date"
                        value="Fecha"
                        required
                        :class="{
                          'is-invalid': formReserva.errors.has('fecha'),
                        }"
                      />

                      <has-error
                        class="error"
                        :form="formReserva"
                        field="fecha"
                      ></has-error>
                    </div>
                  </div>
                </div>
                <!--Div que contiene hora inicio y fin-->
                <div class="group group_reservacion">
                  <div class="contenedor_inputs">
                    <div class="input_titulos">
                      <h3>{{ $t("Hora_llegada") }}</h3>
                    </div>
                    <div class="input_titulos">
                      <h3 class="labelH3">
                        {{ $t("Hora_salida") }}
                      </h3>
                    </div>
                  </div>
                  <div class="contenedor_inputs">
                    <div class="input_titulos">
                      <i class="fas fa-clock iconoInput"></i>
                      <input
                        id="horaLLegaReservacion"
                        name="horaLLegaReservacion"
                        v-model="formReserva.horaInicio"
                        type="time"
                        required
                        :disabled="bloqueraHoras"
                        :class="{
                          'is-invalid': formReserva.errors.has('horaInicio'),
                        }"
                      />
                      <has-error
                        class="error"
                        :form="formReserva"
                        field="horaInicio"
                      ></has-error>
                    </div>
                    <div class="input_titulos">
                      <i class="fas fa-clock iconoInput icono"></i>
                      <input
                        id="horaFinReservacion"
                        name="horaFinReservacion"
                        v-model="formReserva.horaFin"
                        placeholder="09:00"
                        type="time"
                        required
                        :disabled="bloqueraHoras"
                        :class="{
                          'is-invalid': formReserva.errors.has('horaFin'),
                        }"
                      />
                      <has-error
                        class="error"
                        :form="formReserva"
                        field="horaFin"
                      ></has-error>
                    </div>
                  </div>
                </div>
                <!--fin del div que contines hora fin y inicio-->
                <!--DIV QUE CONTIENE EL ACEPTAR TERMINOS Y CONDIDICIONES-->
                <div class="aceptar">
                  <input
                    type="checkbox"
                    v-model="AceptarTerminos"
                    @click="aceptoTerminos()"
                    name="field name"
                    value="Initial value"
                  />
                  <span
                    >{{ $t("Acepta_los") }}
                    <a href="/documentos/Terminos y Condiciones.pdf" target="_BLANK">{{ $t("Terminos") }}</a></span
                  >
                </div>
                <!--fin del div de terminos y condicones-->
                <!--Div de los botones -->
                <div class="botones_finales">
                  <button
                    type="button"
                    class="btn btn-success btn-rounded"
                    @click="crearReserva()"
                    :disabled="bloquearReservar"
                  >
                    {{ $t("Reservar") }}
                  </button>
                  <button
                    type="button"
                    class="btn btn-danger btn-rounded"
                    @click="cancelarConsulta()"
                  >
                    {{ $t("Cancelar") }}
                  </button>
                </div>
                <!--FIN DEL DIV DE LOS BOTONES-->
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--MODAL DE PERSONA------------------------------------------------------------------------------->
    <div
      class="modal fade"
      id="modalPersona"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              {{ $t("Registro_Persona") }}
            </h5>
            <button
              type="button"
              class="btn-close"
              data-mdb-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <div class="group">
              <label>{{ $t("Type_of_identity") }}</label>
              <i class="fas fa-bars iconoInput_modal"></i>
              <select
                class="input_modal"
                v-model="tipoIndenteficacion"
                :class="{
                  'is-invalid': formPersona.errors.has('identificacion'),
                }"
                @change="tiposDeIndentificacon()"
              >
                <option disabled value="">{{ $t("Seleccione_tipo") }}</option>
                <option value="Cedula Nacional">
                  {{ $t("Cedula_Nacional") }}
                </option>
                <option value="Cedula Residencial">
                  {{ $t("Cedula_Residencial") }}
                </option>
                <option value="Pasaporte">{{ $t("Pasaporte") }}</option>
              </select>
            </div>
            <!---------------------------------------------------------->
            <!-------------INPUTS DE IDENTIFICACION----------------------------------------------->
            <!---------------------------------------------------------->
            <div v-show="verIdentificacion" class="group">
              <div v-show="CedulaNacional" class="group">
                <i
                  class="fas fa-id-card iconoInput_modal"
                  style="margin-top: 6px; left: -2px"
                ></i>
                <input
                  v-model="formPersona.identificacion"
                  type="text"
                  name="identificacion"
                  class="input_modal"
                  :class="{
                    'is-invalid': formPersona.errors.has('identificacion'),
                  }"
                  v-bind:placeholder="$t('EscribaIDNacional')"
                  id="nacional"
                  onchange="validarCedulaN()"
                />
                <has-error
                  :form="formPersona"
                  field="identificacion"
                ></has-error>
              </div>

              <div v-show="CedulaResidencial" class="group">
                <i
                  class="fas fa-id-card iconoInput_modal"
                  style="margin-top: 6px; left: -2px"
                ></i>
                <input
                  v-model="formPersona.identificacion"
                  id="residencial"
                  type="text"
                  name="identificacion"
                  class="input_modal"
                  :class="{
                    'is-invalid': formPersona.errors.has('identificacion'),
                  }"
                 v-bind:placeholder="$t('EscribaResidencial')"
                  onchange="validateResidencial()"
                />
                <has-error
                  :form="formPersona"
                  field="identificacion"
                ></has-error>
              </div>

              <div v-show="Pasaporte" class="group">
                <i
                  class="fas fa-id-card iconoInput_modal"
                  style="margin-top: 6px; left: -2px"
                ></i>
                <input
                  id="pasaporte"
                  v-model="formPersona.identificacion"
                  type="text"
                  name="identificacion"
                  class="input_modal"
                  :class="{
                    'is-invalid': formPersona.errors.has('identificacion'),
                  }"
                  v-bind:placeholder="$t('EscribaPasaporte')"
                  onchange="validatePasaporte()"
                />
                <has-error
                  :form="formPersona"
                  field="identificacion"
                ></has-error>
              </div>
              <div class="group">
                <label>{{ $t("Nombre") }}</label>
                <i class="fas fa-user-circle iconoInput_modal"></i>
                <input
                  v-model="formPersona.nombre"
                  type="text"
                  name="nombre"
                  class="input_modal"
                  :class="{
                    'is-invalid': formPersona.errors.has('nombre'),
                  }"
                  v-bind:placeholder="$t('EscribaNombre')"
                  minlength="3"
                  maxlength="20"
                  required
                />
                <has-error
                  class="error_modal"
                  :form="formPersona"
                  field="nombre"
                ></has-error>
              </div>

              <div class="group">
                <label>{{ $t("Apellido1") }} </label>
                <i class="fas fa-user-circle iconoInput_modal"></i>
                <input
                  v-model="formPersona.apellido1"
                  type="text"
                  name="apellido1"
                  class="input_modal"
                  :class="{
                    'is-invalid': formPersona.errors.has('apellido1'),
                  }"
                 v-bind:placeholder="$t('EscribaApellido1')"
                  minlength="3"
                  maxlength="20"
                  required
                />
                <has-error
                  class="error_modal"
                  :form="formPersona"
                  field="apellido1"
                ></has-error>
              </div>

              <div class="group">
                <label>{{ $t("Apellido2") }}</label>
                <i class="fas fa-user-circle iconoInput_modal"></i>
                <input
                  v-model="formPersona.apellido2"
                  type="text"
                  name="apellido2"
                  class="input_modal"
                  :class="{
                    'is-invalid': formPersona.errors.has('apellido2'),
                  }"
                  v-bind:placeholder="$t('EscribaApellido2')"
                  minlength="3"
                  maxlength="20"
                  required
                />
                <has-error
                  class="error_modal"
                  :form="formPersona"
                  field="apellido2"
                ></has-error>
              </div>

              <div class="group">
                <label>{{ $t("Telefono") }}</label>
                <i class="fas fa-mobile-alt iconoInput_modal"></i>
                <input
                  v-model="formPersona.telefono"
                  type="tel"
                  name="telefono"
                  class="input_modal"
                  :class="{
                    'is-invalid': formPersona.errors.has('telefono'),
                  }"
                  id="phone"
                  size="8"
                  min="10000000"
                 v-bind:placeholder="$t('EscibaNumero')"
                  required
                />
                <has-error
                  class="error_modal"
                  :form="formPersona"
                  field="telefono"
                ></has-error>
              </div>
              <div class="group">
                <label>{{ $t("Correo") }}</label>
                <i class="fas fa-at iconoInput_modal"></i>
                <input
                  v-model="formPersona.correo"
                  type="email"
                  name="correo"
                  class="input_modal"
                  :class="{
                    'is-invalid': formPersona.errors.has('correo'),
                  }"
                  v-bind:placeholder="$t('EscribaCorreo')"
                  minlength="3"
                  maxlength="100"
                  pattern="[a-zA-Z0-9.-_]{1,}@[a-zA-Z.-]{2,}[.]{1}[a-zA-Z]{2,}"
                  required
                />
                <has-error
                  class="error_modal"
                  :form="formPersona"
                  field="correo"
                ></has-error>
              </div>
            </div>
            <!-------FIN DE LOS INPUTS DE IDENTIFICACION-------->
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-mdb-dismiss="modal"
            >
              {{ $t("Cerrar") }}
            </button>
            <button
              type="button"
              class="btn btn-primary"
              @click="crearPersona()"
              id="botonPersonaRegistro"
            >
              {{ $t("Registrar") }}
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-------------------------------------------------------------------------------------->
    <!------------------------------MODAL DE ORGANIZACION------------------------------------------------->
    <div
      class="modal fade"
      id="modalOrganizacion"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              {{ $t("Registro_Org") }}
            </h5>
            <button
              type="button"
              class="btn-close"
              data-mdb-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <div class="group">
              <label>{{ $t("Cedula_Org") }}</label>
              <i class="fas fa-id-card iconoInput_modal" style="left: -2px"></i>
              <input
                class="input_modal"
                v-model="formOrganizacion.identificacion"
                name="identificacion"
                type="text"
                :class="{
                  'is-invalid': formOrganizacion.errors.has('identificacion'),
                }"
                v-bind:placeholder="$t('CedulaOrga')"
              />
              <has-error
                style="top: 80px"
                :form="formOrganizacion"
                field="identificacion"
              ></has-error>
            </div>
            <div class="group">
              <label>{{ $t("Nombre_Org") }}</label>
              <i class="fas fa-user-circle iconoInput_modal"></i>
              <input
                class="input_modal"
                v-model="formOrganizacion.nombre"
                name="nombre"
                type="text"
                :class="{
                  'is-invalid': formOrganizacion.errors.has('nombre'),
                }"
                v-bind:placeholder="$t('NombreOrga')"
              />
              <has-error
                style="top: 80px"
                :form="formOrganizacion"
                field="nombre"
              ></has-error>
            </div>
            <div class="group">
              <i class="fas fa-mobile-alt iconoInput_modal"></i>
              <label>{{ $t("Telefono_Org") }}</label>
              <input
                class="input_modal"
                v-model="formOrganizacion.telefono"
                name="telefono"
                type="number"
                :class="{
                  'is-invalid': formOrganizacion.errors.has('telefono'),
                }"
                v-bind:placeholder="$t('CelularOrga')"
              />
              <has-error
                style="top: 80px"
                :form="formOrganizacion"
                field="telefono"
              ></has-error>
            </div>

            <div class="group">
              <label>{{ $t("Correo_Org") }}</label>
              <i class="fas fa-at iconoInput_modal"></i>
              <input
                class="input_modal"
                v-model="formOrganizacion.correo"
                name="correo"
                type="email"
                :class="{
                  'is-invalid': formOrganizacion.errors.has('correo'),
                }"
               v-bind:placeholder="$t('CorreoOrga')"
              />
              <has-error
                style="top: 80px"
                :form="formOrganizacion"
                field="correo"
              ></has-error>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-mdb-dismiss="modal"
            >
              {{ $t("Cerrar") }}
            </button>
            <button
              type="button"
              class="btn btn-primary"
              @click="crearOrganizacion()"
            >
              {{ $t("Registrar") }}
            </button>
          </div>
        </div>
      </div>
    </div>
    <!------------------------------MODAL DE GRUPO------------------------------------------------->
    <div
      class="modal fade"
      id="modalGrupo"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              {{ $t("Registrar_Grup") }}
            </h5>
            <button
              type="button"
              class="btn-close"
              data-mdb-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <div class="group">
              <label>{{ $t("Nombre_Grup") }}</label>
              <i class="fas fa-file-signature iconoInput_modal"></i>
              <input
                v-model="formGrupo.nombre"
                type="text"
                name="nombre"
                class="input_modal"
                :class="{
                  'is-invalid': formGrupo.errors.has('nombre'),
                }"
               v-bind:placeholder="$t('EscribaNombreG')"
                minlength="3"
                maxlength="20"
                required
              />
              <has-error
                class="error_modal"
                :form="formGrupo"
                field="nombre"
              ></has-error>
            </div>
            <div class="group">
              <label>{{ $t("Correo") }}</label>
              <i class="fas fa-at iconoInput_modal"></i>
              <input
                v-model="formGrupo.correo"
                type="email"
                name="correo"
                class="input_modal"
                :class="{
                  'is-invalid': formGrupo.errors.has('correo'),
                }"
                v-bind:placeholder="$t('EscribaCorreo')"
                minlength="3"
                maxlength="100"
                pattern="[a-zA-Z0-9.-_]{1,}@[a-zA-Z.-]{2,}[.]{1}[a-zA-Z]{2,}"
                required
              />
              <has-error
                class="error_modal"
                :form="formGrupo"
                field="correo"
              ></has-error>
            </div>
            <div class="group">
              <label>{{ $t("Cantidad_Grup") }}</label>
              <i class="fas fa-user-circle iconoInput_modal"></i>
              <input
                v-model="formGrupo.cantidad"
                type="number"
                name="cantidad"
                class="input_modal"
                :class="{
                  'is-invalid': formGrupo.errors.has('cantidad'),
                }"
                v-bind:placeholder="$t('EscribaCantidadG')"
                minlength="3"
                maxlength="20"
                required
              />
              <has-error
                class="error_modal"
                :form="formGrupo"
                field="cantidad"
              ></has-error>
            </div>
            <div class="group">
              <label>{{ $t("Rango_edad") }}</label>
              <label for="">{{ $t("Rango") }} {{ formGrupo.edades }}</label>
              <input
                v-model="formGrupo.edades"
                type="range"
                name="edades"
                class="input_modal"
                :class="{
                  'is-invalid': formGrupo.errors.has('edades'),
                }"
                placeholder="Cantidad del grupo..."
                min="1"
                max="105"
                value="50"
                required
              />
              <has-error
                class="error_modal"
                :form="formGrupo"
                field="edades"
              ></has-error>
            </div>
            <div class="group">
              <label>{{ $t("Lugar_Procedencia") }}</label>
              <i class="fas fa-globe iconoInput_modal"></i>
              <input
                v-model="formGrupo.lugar"
                type="text"
                name="lugar"
                class="input_modal"
                :class="{
                  'is-invalid': formGrupo.errors.has('lugar'),
                }"
                v-bind:placeholder="$t('EscribaLugarG')"
                required
              />
              <has-error
                class="error_modal"
                :form="formGrupo"
                field="lugar"
              ></has-error>
            </div>
            <div class="group">
              <label>{{ $t("Tematica_Tratar") }}</label>
              <i class="fas fa-comment-alt iconoInput_modal"></i>
              <select
                class="input_modal"
                v-model="formGrupo.tematica"
                :class="{
                  'is-invalid': formGrupo.errors.has('tematica'),
                }"
                required
                @change="verInputOtraTematica()"
              >
                <option disabled value="">
                  {{ $t("Seleccion__Tematica") }}
                </option>
                <option value="Todas las tematicas">
                  {{ $t("Todas_Tema") }}
                </option>
                <option value="Biodiversidad">{{ $t("Biodiversidad") }}</option>
                <option value="Cultura">{{ $t("Cultura") }}</option>
                <option value="Otros">{{ $t("Otros") }}</option>
              </select>
              <has-error
                class="error_modal"
                :form="formGrupo"
                field="tematica"
              ></has-error>
            </div>
            <div class="group">
              <div id="inputOtros" v-show="VerOtraTematica">
                <input
                  style="padding-left: 0px"
                  type="text"
                  v-model="formGrupo.tematica"
                  name="tematica"
                  class="input_modal"
                  :class="{
                    'is-invalid': formGrupo.errors.has('tematica'),
                  }"
                  v-bind:placeholder="$t('EscribaTematica')"
                  required
                />
              </div>
            </div>
            <div class="group">
              <label>{{ $t("Consideraciones") }}</label>
              <textarea
                style="padding-left: 1px"
                v-model="formGrupo.detalles"
                type="text"
                name="detalles"
                class="input_modal"
                :class="{
                  'is-invalid': formGrupo.errors.has('detalles'),
                }"
                v-bind:placeholder="$t('EscribaConsideraciones')"
                required
              >
              </textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-mdb-dismiss="modal"
            >
              {{ $t("Cerrar") }}
            </button>
            <button type="button" @click="crearGrupo()" class="btn btn-primary">
              {{ $t("Registrar") }}
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  components: {},
  name: "Reservacion",
  data() {
    return {
      bloqueraHoras: true, //Bloqueamos las horas para que esten de acuerdo al horario
      bloquearConsulta: false, //Bloqueamos el campo de consulta y su boton
      bloquearReservar: true, //Bloqueamos el boton de reserva hasta que acepte los terminos
      bloquearterminos: true, //Bloqueamos el check de aceptar los terminos
      AceptarTerminos: false, //Para modificar el valor del check de terminos
      CedulaResidencial: false,
      CedulaNacional: false,
      Pasaporte: false,
      tipoIndenteficacion: "",
      mensajeDeExistencia: "", //Vamos a mostrar un mensaje que valide si existe la identificacion
      VermensajeSiExiste: false, //ver mensaje si existe
      VermensajeNoExiste: false, //ver mensaje si no existe
      verIdentificacion: true,
      personaIdArray: {}, //Array de persona
      organizacionIdArray: {}, //array de organizacion
      grupoIdArray: {},
      grupo: {}, //array de grupo
      buscador: "",
      VerOtraTematica: false,
      formCorreo: new Form({
        cedulaReservacion: "",
        fechaReservacion: "",
        cantidaPersonasReservacion: "",
        horaInicio: "",
        horaFin: "",
        correo: "",
      }),
      formReserva: new Form({
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
      formPersona: new Form({
        id: "",
        identificacion: "",
        nombre: "",
        apellido1: "",
        apellido2: "",
        telefono: "",
        correo: "",
      }),
      formOrganizacion: new Form({
        id: "",
        identificacion: "",
        nombre: "",
        telefono: "",
        correo: "",
      }),
      formGrupo: new Form({
        id: "",
        nombre: "G-",
        cantidad: "",
        correo: "",
        edades: "",
        lugar: "",
        tematica: "",
        detalles: "",
      }),
    };
  },
  methods: {
    verInputOtraTematica() {
      if (this.formGrupo.tematica == "Otros") {
        this.VerOtraTematica = true;
        this.formGrupo.tematica = "";
      } else {
        this.VerOtraTematica = false;
      }
    },
    llenarFormularioCorreo() {
      (this.formCorreo.horaInicio = this.formReserva.horaInicio),
        (this.formCorreo.horaFin = this.formReserva.horaFin),
        (this.formCorreo.fechaReservacion = this.formReserva.fecha),
        (this.formCorreo.cantidaPersonasReservacion =
          this.formReserva.cantidad);
    },
    enviaEmail() {
      const templateParams = {
        cedulaReservacion: this.formCorreo.cedulaReservacion,
        fechaReservacion: this.formCorreo.fechaReservacion,
        cantidaPersonasReservacion: this.formCorreo.cantidaPersonasReservacion,
        horaInicio: this.formCorreo.horaInicio,
        horaFin: this.formCorreo.horaFin,
        correo: this.formCorreo.correo,
      };
      console.log(templateParams.correo);
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

    /*////////////////////////////////////////////////////////////*/
    /*-------------------------Validaciones----------------------*/

    tiposDeIndentificacon() {
      if (this.tipoIndenteficacion == "Cedula Nacional") {
        this.CedulaNacional = true;
        this.Pasaporte = false;
        this.CedulaResidencial = false;
        this.formPersona.identificacion = "";
      }
      if (this.tipoIndenteficacion == "Cedula Residencial") {
        this.CedulaNacional = false;
        this.Pasaporte = false;
        this.CedulaResidencial = true;
        this.formPersona.identificacion = "";
      } else if (this.tipoIndenteficacion == "Pasaporte") {
        this.CedulaNacional = false;
        this.Pasaporte = true;
        this.CedulaResidencial = false;
        this.formPersona.identificacion = "";
      }
    },

    modalPersona() {
      $("#modalPersona").modal("show");
      this.formPersona.reset();
      this.formPersona.errors.clear();
    },
    modalOrganizacion() {
      $("#modalOrganizacion").modal("show");
      this.formOrganizacion.reset();
      this.formOrganizacion.errors.clear();
    },
    modalGrupo() {
      $("#modalGrupo").modal("show");
      this.formGrupo.reset();
      this.formGrupo.errors.clear();
    },
    cancelarConsulta() {
      this.formReserva.reset();
      this.formReserva.errors.clear();
      this.bloquearReservar = true;
      this.mensajeExistencia = "";
      this.mensajeNoExistencia = "";
      this.buscador = "";
      this.bloquearConsulta = false;
      this.AceptarTerminos = false;
      this.VermensajeNoExiste = true;
      this.VermensajeSiExiste = true;
      this.mensajeDeExistencia = "";
      this.personaIdArray = {};
      this.organizacionIdArray = {};
    },
    aceptoTerminos() {
      if (this.AceptarTerminos == true) {
        this.bloquearReservar = true;
      } else {
        this.bloquearReservar = false;
      }
    },
    crearPersona() {
      if (this.formPersona.identificacion != "") {
        if (
          /^[1-9]-\d{4}-\d{4}$/.test(this.formPersona.identificacion) ||
          /^[1-9]\d{9}$/.test(this.formPersona.identificacion) ||
          /^\d{11,12}$/.test(this.formPersona.identificacion)
        ) {
          this.formPersona
            .post("/api/reservarCliente/persona", {
              params: {
                identificacion: this.formPersona.identificacion,
              },
            })
            .then((response) => {
              if (response.data.success == false) {
                Swal.fire("Error!", this.$t("IDExiste"), "error");
              } else {
                Swal.fire("success", this.$t("RegistradoExitoso"), "success");
                $("#modalPersona").modal("hide");
              }
            })
            .catch((error) => {
              Swal.fire("Error!", this.$t("CamposVacios"), "error");
            });
        } else {
          Swal.fire("Error!", this.$t("FormatoIDError"), "error");
        }
      } else {
        Swal.fire("Error!", this.$t("CampoIDVacio"), "error");
      }
    },

    crearOrganizacion() {
      if (this.formOrganizacion.identificacion != "") {
        if (/^[1-9]-\d{3}-\d{6}$/.test(this.formOrganizacion.identificacion)) {
          this.formOrganizacion
            .post("/api/reservarCliente/organizacion", {
              params: {
                identificacion: this.formOrganizacion.identificacion,
              },
            })
            .then((response) => {
              if (response.data.success == false) {
                Swal.fire("Error!", this.$t("IDExiste"), "error");
              } else {
                Swal.fire(
                  this.$t("Registrado"),
                  this.$t("RegistradoExitoso"),
                  "success"
                );
                $("#modalOrganizacion").modal("hide");
              }
            })
            .catch((error) => {
              Swal.fire("Error!", this.$t("CamposVacios"), "error");
            });
        } else {
          Swal.fire("Error!", this.$t("FormatoIDOrga"), "error");
        }
      } else {
        Swal.fire("Error!", this.$t("CampoIDOrgan"), "error");
      }
    },
    crearGrupo() {
      if (this.formGrupo.nombre != "") {
        if (/^[G]{1}-\d{1,4}$/.test(this.formGrupo.nombre)) {
          this.formGrupo
            .post("/api/reservarCliente/grupo", {
              params: { nombre: this.formGrupo.nombre },
            })
            .then((response) => {
              if (response.data.success == false) {
                Swal.fire("Error!", this.$t("NombreGrupoExiste"), "error");
              } else {
                Swal.fire(
                  this.$t("Registrado"),
                  this.$t("RegistradoExitoso"),
                  "success"
                );
                $("#modalGrupo").modal("hide");
              }
            })
            .catch((error) => {
              Swal.fire("Error!", $t("CamposVacios"), "error");
            });
        } else {
          Swal.fire("Error!", this.$t("FormatoNombreGrupo"), "error");
        }
      } else {
        Swal.fire("Error!", this.$t("CampoNombreGrupo"), "error");
      }
    },

    consultarDatos() {
      if (this.buscador.length != "") {
        if (
          /^[1-9]-\d{4}-\d{4}$/.test(this.buscador) ||
          /^[1-9]\d{9}$/.test(this.buscador) ||
          /^\d{11,12}$/.test(this.buscador)
        ) {
          this.formReserva
            .get("/api/reservarCliente/verificar", {
              params: { buscador: this.buscador },
            })
            .then(({ data }) => (this.personaIdArray = data.data));
          this.VermensajeNoExiste = false;
          this.VermensajeSiExiste = true;
          this.mensajeDeExistencia = this.$t("YaRegistrado");
          this.bloquearConsulta = true;
          this.bloquearterminos = false;
        } else if (/^[1-9]-\d{3}-\d{6}$/.test(this.buscador)) {
          this.formReserva
            .get("/api/reservarCliente/verificarOrg", {
              params: { buscador: this.buscador },
            })
            .then(({ data }) => (this.organizacionIdArray = data.data));
          this.VermensajeNoExiste = false;
          this.VermensajeSiExiste = true;
          this.mensajeDeExistencia = this.$t("YaRegistrado");
          this.bloquearConsulta = true;
          this.bloquearterminos = false;
        } else if (/^[G]{1}-\d{1,4}$/.test(this.buscador)) {
          this.formReserva
            .get("/api/reservarCliente/verificarGrupo", {
              params: { buscador: this.buscador },
            })
            .then(({ data }) => (this.grupoIdArray = data.data));
          this.VermensajeNoExiste = false;
          this.VermensajeSiExiste = true;
          this.mensajeDeExistencia = this.$t("YaRegistrado");
          this.bloquearConsulta = true;
          this.bloquearterminos = false;
        } else {
          this.VermensajeNoExiste = true;
          this.VermensajeSiExiste = false;
          this.mensajeDeExistencia = this.$t("NoEstaRegistrado");
          this.bloquearConsulta = false;
          this.bloquearterminos = true;
        }
      } else {
        this.VermensajeNoExiste = true;
        this.VermensajeSiExiste = false;
        this.mensajeDeExistencia = this.$t("ErrorConsulta");
      }
    },

    async reservar() {
      try {
        await this.formReserva.post("/api/reservarCliente");
        Swal.fire(
          this.$t("ReservacionMensaje1"),
          this.$t("ReservacionMensaje2"),
          "success"
        );
        this.mensajeExistencia = "";
        this.bloquearConsulta = false;
        this.bloquearterminos = true;
        this.AceptarTerminos = false;
        this.llenarFormularioCorreo();
        this.enviaEmail();
        this.formReserva.reset();
        this.formReserva.errors.clear();
        this.$Progress.finish();
      } catch (error) {
        Swal.fire("Error!", this.$t("ReservacionMensaje3"), "error");
      }
    },
    totalDatosFuncion() {
      if (this.personaIdArray.length != 0) {
        for (let i = 0; i < this.personaIdArray.length; i++) {
          this.formReserva.idPersona = this.personaIdArray[i].id;
          this.formReserva.identificacionPersona =
            this.personaIdArray[i].identificacion;
          this.formCorreo.correo = this.personaIdArray[i].correo;
          this.formCorreo.cedulaReservacion =
            this.personaIdArray[i].identificacion;
        }
      }
      if (this.organizacionIdArray.length != 0) {
        for (let i = 0; i < this.organizacionIdArray.length; i++) {
          this.formReserva.idOrganizacion = this.organizacionIdArray[i].id;
          this.formReserva.identificacionOrganizacion =
            this.organizacionIdArray[i].identificacion;
          this.formCorreo.correo = this.organizacionIdArray[i].correo;
          this.formCorreo.cedulaReservacion =
            this.organizacionIdArray[i].identificacion;
        }
      }
      if (this.grupoIdArray.length != 0) {
        for (let i = 0; i < this.grupoIdArray.length; i++) {
          this.formReserva.idGrupo = this.grupoIdArray[i].id;
          this.formReserva.nombreGrupo = this.grupoIdArray[i].nombre;
          this.formCorreo.correo = this.grupoIdArray[i].correo;
          this.formCorreo.cedulaReservacion = this.grupoIdArray[i].nombre;
        }
      }
    },

    crearReserva() {
      this.totalDatosFuncion();
      if (this.buscador.length != "") {
        if (
          /^[1-9]-\d{4}-\d{4}$/.test(this.formReserva.identificacionPersona) ||
          /^[1-9]\d{9}$/.test(this.formReserva.identificacionPersona) ||
          (/^\d{11,12}$/.test(this.formReserva.identificacionPersona) &&
            this.formReserva.idPersona != 0)
        ) {
          this.reservar();
        } else if (
          /^[1-9]-\d{3}-\d{6}$/.test(
            this.formReserva.identificacionOrganizacion
          ) &&
          this.formReserva.idOrganizacion != 0
        ) {
          this.reservar();
        } else if (
          /^[G]{1}-\d{1,4}$/.test(this.formReserva.nombreGrupo) &&
          this.formReserva.idGrupo != 0
        ) {
          this.reservar();
        } else {
          Swal.fire("Error!", this.$t("ReservacionMensaje4"), "error");
        }
      } else {
        Swal.fire("Error!", this.$t("ReservacionMensaje5"), "error");
      }
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
    opcionHora8() {
      this.formReserva.horaInicio = "15:00";
      this.formReserva.horaFin = "16:00";
    },
    opcionHora9() {
      this.formReserva.horaInicio = "16:00";
      this.formReserva.horaFin = "17:00";
    },
    opcionHora10() {
      this.formReserva.horaInicio = "17:00";
      this.formReserva.horaFin = "18:00";
    },
  },
  created() {
    this.$Progress.start();
    this.$Progress.finish();
  },
  computed: {
    totalDatos: function () {
      if (this.personaIdArray.length != 0) {
        for (let i = 0; i < this.personaIdArray.length; i++) {
          this.formReserva.idPersona = this.personaIdArray[i].id;
          this.formReserva.identificacionPersona =
            this.personaIdArray[i].identificacion;
          this.formCorreo.correo = this.personaIdArray[i].correo;
          this.formCorreo.cedulaReservacion =
            this.personaIdArray[i].identificacion;
        }
      }
      if (this.organizacionIdArray.length != 0) {
        for (let i = 0; i < this.organizacionIdArray.length; i++) {
          this.formReserva.idOrganizacion = this.organizacionIdArray[i].id;
          this.formReserva.identificacionOrganizacion =
            this.organizacionIdArray[i].identificacion;
          this.formCorreo.correo = this.organizacionIdArray[i].correo;
          this.formCorreo.cedulaReservacion =
            this.organizacionIdArray[i].identificacion;
        }
      }
      if (this.grupoIdArray.length != 0) {
        for (let i = 0; i < this.grupoIdArray.length; i++) {
          this.formReserva.idGrupo = this.grupoIdArray[i].id;
          this.formReserva.nombreGrupo = this.grupoIdArray[i].nombre;
          this.formCorreo.correo = this.grupoIdArray[i].correo;
          this.formCorreo.cedulaReservacion = this.grupoIdArray[i].nombre;
        }
      }
    },
  },
  mounted() {
    const plugin = document.createElement("script");
    plugin.setAttribute("src", "/js/validacionesReservacion.js");
    plugin.async = true;
    document.head.appendChild(plugin);
  },
};
</script>

<style scoped>
.contenedor {
  margin: 40px auto;
}

.intro {
  margin: 10px auto 40px auto;
  padding: 15px 0;
  height: 45px;
  text-align: center;
  font-size: 25px;
  color: #000000ad;
  opacity: 0;
  animation-name: introAparece;
  animation-delay: 1s;
  animation-duration: 3s;
  animation-fill-mode: forwards;
  transition: opacity 3s;
}
@keyframes introAparece {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}

.contenedor-2 {
  /*Contiene toda la card*/
  display: flex;
  margin: 20px 10px 130px 10px;
  justify-content: space-evenly;
}
/*CARD QUE CONTIENE HORARIO Y FORMULARIO */
.card {
  width: 1000px;
  height: auto;
  box-shadow: 3px 3px 3px 3px rgb(0 0 0 / 30%);
  border-radius: 20px;
  animation-name: aparecerCard;
  animation-duration: 3s;
  animation-fill-mode: forwards;
  transition: left 3s;
  left: -45%;
}

@keyframes aparecerCard {
  0% {
    left: -45%;
  }
  100% {
    left: 0;
  }
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
  padding-top: 20px;
  border-top-left-radius: 20px;
  border-bottom-left-radius: 20px;
  width: 45%;
}
tr,
td {
  color: #fff;
  font-size: 20px;
  font-weight: 500;
  text-align: center;
}
.col-md-6 {
  width: 55%;
  padding: 10px 5px;
}

.card-body {
  height: 100%;
  -webkit-box-flex: 1;
  -ms-flex: 1 1 auto;
  flex: 1 1 auto;
  padding: 5px;
}
#contact-form {
  margin-top: 40px;
}
.reservar_indicaciones {
  margin: 5px;
  padding: 5px;
}
.card-title {
  text-align: center;
}
.indicaciones_posicion {
  display: flex;
  flex-direction: column;
  flex-wrap: wrap;
  margin: 5px;
  padding: 5px;
  text-align: center;
}
.fas {
  font-weight: 900;
  padding: 5px;
  font-size: 18px;
}
.botones_opciones {
  text-align: center;
}
button {
  text-transform: capitalize;
  font-size: 15px;
}
.campo_form_1 input,
.campo_consulta input,
.group input,
.group textarea {
  border: none;
  border-bottom: 1px solid #757575;
  border-bottom: 2px solid rgb(204, 200, 200);
  transition: border 0.5s;
}

.campo_form_1 input:focus,
.campo_consulta input:focus,
.group input:focus,
.group textarea:focus {
  outline: none;
  border-bottom: 2px solid rgb(14, 14, 170);
}

.campo_consulta {
  display: flex;
  flex-wrap: wrap;
  flex-direction: row;
}
.contenedor_inputs {
  display: flex;
  justify-content: center;
  flex-wrap: nowrap;
}
.input_titulos {
  width: 50%;
}
.input_titulos input {
  width: 80%;
  padding: 10px 0;
  font-size: 18px;
}

.group {
  display: flex;
  flex-direction: column;
  flex-wrap: nowrap;
  align-content: center;
  justify-content: center;
  position: relative;
  padding: 5px;
  margin: 5px;
}

.group_reservacion {
  margin: 5px 5px 30px 5px;
}
.input_buscador {
  width: 75%;
}
.input_buscador input {
  width: 85%;
  padding: 10px 0;
  font-size: 18px;
}
.btn_consultar {
  width: 25%;
}
.aceptar {
  text-align: center;
  font-size: 22px;
  padding: 5px;
  margin: 5px;
}
.botones_finales {
  text-align: center;
  padding: 10px;
  /* font-size: 48px; */
  /* line-height: 3rem; */
  margin: 10px;
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

/*MODAL DISEÑO*/

.group select {
  outline: none;
  border: 0;
  border-bottom: 2px solid #ccc8c8;
  color: #252525;
}
.error {
  margin-top: 10px;
  margin-left: 39px;
}

.iconoInput,
.iconoInput_modal {
  color: #e8e8e8;
  font-size: 26px;
  margin-top: 2%;
}
.group .iconoInput_modal {
  position: absolute;
  margin-top: 5%;
  left: 4px;
}
.input_modal {
  padding-top: 14px;
  padding-left: 32px;
  margin-bottom: 10px;
}
.error_modal {
  margin-top: 75px;
  margin-left: 0;
}

/*FIN DEL DISEÑO DEL MODAL*/

@media only screen and (min-device-width: 280px) and (max-device-width: 800px) {
  .row {
    display: flex;
    flex-direction: column;
  }
  .contenedor {
    margin: 40px auto;
  }
  .col-md-5,
  .col-md-6 {
    width: 100%;
  }
  .col-md-5 {
    border-bottom-left-radius: 0;
    border-top-right-radius: 20px;
  }
  .botones_opciones {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-content: center;
    align-items: center;
  }
  .botones_opciones button {
    width: 200px;
    margin: 10px auto;
  }
  .Posicionar {
    width: 38%;
    margin: 0;
  }
  .campo input {
    margin: 2px;
  }
  h5 {
    font-size: 20px;
  }
  .campo_consulta {
    display: flex;
    flex-wrap: wrap;
    flex-direction: column;
  }
  .input_buscador {
    width: 100%;
    margin: 10px 0;
  }
  .btn_consultar {
    width: 100%;
    margin: 10px;
  }
  .input_titulos {
    margin: 5px 0;
  }
  .error {
    margin-top: 10px;
    margin-left: 0px;
    width: 40%;
  }
  .error_modal {
    margin-top: 95px;
    margin-left: 0;
  }
  .input_titulos input {
    width: 98%;
  }
}
@media only screen and (min-device-width: 340px) and (max-device-width: 900px) {
  .contenedor-2 {
    display: flex;
    margin: 20px 10px 150px 10px;
    justify-content: space-evenly;
  }
}

@media only screen and (max-device-width: 339px) {
  .contenedor-2 {
    display: flex;
    margin: 20px 10px 200px 10px;
    justify-content: space-evenly;
  }
}
@media only screen and (max-device-width: 280px) {
  td {
    font-size: 15px;
  }
  .px-3 {
    width: 40px;
    height: 34px;
  }
  .px-3 i {
    font-size: 10px;
    padding: 0;
  }
  tr {
    font-size: 12px;
  }
  .horas {
    width: 100%;
  }
  .Posicionar {
    width: 55%;
  }
  .botones_finales .btn-success,
  .botones_finales .btn-danger {
    margin: 5px 0;
  }
}
/***********RESPONSIVE MODE***************************/
</style>
