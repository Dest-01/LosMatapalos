<template>
  <section class="content">
    <div class="container-fluid">
      <div class="block-header" v-if="$gate.isAdmin() || $gate.isUser()">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <ul class="breadcrumb breadcrumb-style">
              <li class="breadcrumb-item">
                <h4 class="page-title">Donativos</h4>
              </li>
              <li class="breadcrumb-item bcrumb-1">
                <a href="/admin/dashboard">
                  <i class="fas fa-home"></i>
                  Inicio
                </a>
              </li>
              <li class="breadcrumb-item active">Donativos</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card" v-if="$gate.isAdmin() || $gate.isUser()">
            <div class="card-header">
              <h3 class="card-title">Lista de donativos</h3>

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
                    Registrar donativo
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

                    Registro donante
                  </button>
                </div>
                <div>
                  <button
                    type="button"
                    class="btn btn-sm btn-primary"
                    @click="modalOrganizacion()"
                  >
                    <i class="fa fa-plus-square"></i>
                    Registro organización donante
                  </button>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Persona donante</th>
                    <th>Organización donante</th>
                    <th>Tipo donativo</th>
                    <th>Detalles de donativo</th>
                    <th>Foto de donativo</th>
                    <th>Fecha de donativo</th>
                    <th>Estado de donativo</th>
                    <th>Funciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="donativo in donativos.data" :key="donativo.id">
                    <td>{{ donativo.id }}</td>
                    <td>{{ donativo.identificacionPersona }}</td>
                    <td>{{ donativo.identificacionOrganizacion }}</td>
                    <td>{{ donativo.tipo }}</td>
                    <td>{{ donativo.detalle | truncate(10, "...") }}</td>
                    <td>
                      <img
                        v-bind:src="'/images/donativos/' + donativo.photo"
                        width="80%"
                        height="70px"
                      />
                    </td>
                    <td>{{ donativo.fecha }}</td>
                    <td>{{ donativo.estado }}</td>
                    <td>
                      <a href="#" @click="editModal(donativo)">
                        <i id="icono" class="fa fa-edit blue"></i>
                      </a>
                      /
                      <a href="#" @click="eliminarDonativo(donativo.id)">
                        <i id="icono" class="fa fa-trash red"></i>
                      </a>
                      /
                      <a href="#" @click="detailsModal(donativo)">
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
                :data="donativos"
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

      <!-- Modal de Donativos -->
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
                Crear nuevo donativo
              </h5>
              <h5 class="modal-title" v-show="editmode">Actualizar donativo</h5>
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
                editmode ? actualizarDonativo() : crearDonativo()
              "
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
                  <label>Tipo de donativo</label>
                  <select
                    v-model="form.tipo"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('tipo') }"
                    :disabled="bloquearCamposDonativo"
                  >
                    <option disabled value="">Seleccione un elemento</option>
                    <option value="Material">{{ Material }}</option>
                    <option value="Monetario">{{ Monetario }}</option>
                  </select>

                  <has-error :form="form" field="estado"></has-error>
                </div>

                <div class="form-group">
                  <label>Detalles del donativo</label>
                  <textarea
                    v-model="form.detalle"
                    type="text"
                    name="detalle"
                    class="form-control"
                    :disabled="bloquearCamposDonativo"
                    :class="{ 'is-invalid': form.errors.has('detalle') }"
                    placeholder="Breve detalle acerca del donativo"
                    required
                    pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ0-9\s]{5,255}"
                    title="Digite descripción de la donación."
                    minlength="2"
                    maxlength="255"
                  >
                  </textarea>
                  <has-error :form="form" field="detalle"></has-error>
                </div>

                <div class="form-group">
                  <div>
                    <div class="row">
                      <div class="col-8">
                        <label for="">Imagen del donativo</label>
                        <label class="btn btn-default p-0">
                          <input
                            type="file"
                            accept="image/*"
                            ref="file"
                            name="photo"
                            @change="updatePhoto"
                            :disabled="bloquearCamposDonativo"
                            :class="{ 'is-invalid': form.errors.has('photo') }"
                            id="SubirImagen"
                          />
                          <has-error :form="form" field="photo"></has-error>
                        </label>
                      </div>
                      <div class="col-4"></div>
                    </div>
                    <div class="progress"></div>
                    <div v-if="previewImage">
                      <div>
                        <img
                          class="preview my-3"
                          :src="previewImage"
                          alt=""
                          title="Imagen Previa"
                          width="100%"
                          height="250px"
                        />
                      </div>
                    </div>
                    <div
                      v-if="message"
                      class="alert alert-secondary"
                      role="alert"
                    >
                      {{ message }}
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Fecha del donativo</label>
                  <input
                    v-model="form.fecha"
                    type="date"
                    name="fecha"
                    class="form-control"
                    :disabled="bloquearCamposDonativo"
                    :class="{ 'is-invalid': form.errors.has('fecha') }"
                    required
                  />
                  <has-error :form="form" field="fecha"></has-error>
                </div>
                <div class="form-group">
                  <label>Estado del donativo</label>
                  <select
                    class="form-control"
                    v-model="form.estado"
                    :disabled="bloquearCamposDonativo"
                    :class="{ 'is-invalid': form.errors.has('estado') }"
                    required
                  >
                    <div class="form-group"></div>
                    <option disabled value="">Seleccione un elemento</option>
                    <option value="Recibido">Recibido</option>
                    <option value="Pendiente">Pendiente</option>
                    <option value="Rechazado">Rechazado</option>
                  </select>

                  <has-error :form="form" field="estado"></has-error>
                </div>
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-dismiss="modal"
                  @click="limpiarDonativo()"
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
                  :disabled="bloquearCamposDonativo"
                >
                  Registrar
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- Modal de ver informacion -->
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
                <label>Identificación Persona Donante</label>
                <input
                  v-model="form.identificacionPersona"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
              <div id="inputsModal" class="form-group">
                <label>Identificación Organización Donante</label>
                <input
                  v-model="form.identificacionOrganizacion"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
              <div id="inputsModal" class="form-group">
                <label>Tipo donativo</label>
                <input
                  v-model="form.tipo"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
              <div id="inputsModal" class="form-group">
                <label>Detalles del donativo</label>
                <textarea
                  v-model="form.detalle"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                ></textarea>
              </div>
              <div class="form-group">
                <label>Foto del donativo</label>
                <img
                  v-bind:src="'/images/donativos/' + form.photo"
                  width="100%"
                  height="350px"
                />
              </div>
              <div id="inputsModal" class="form-group">
                <label>Fecha del donativo</label>
                <input
                  v-model="form.fecha"
                  type="text"
                  class="form-control"
                  :disabled="verDetalles"
                />
              </div>
              <div id="inputsModal" class="form-group">
                <label>Estado del donativo</label>
                <input
                  v-model="form.estado"
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
      <!-- MODAL DE ORGANIZACIONES Y PERSONAS-->
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
                    <option value="Cedula Residencial">
                      Cedula Residencial
                    </option>
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

                    <has-error
                      :form="formPer"
                      field="identificacion"
                    ></has-error>
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
                    <has-error
                      :form="formPer"
                      field="identificacion"
                    ></has-error>
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
                    <has-error
                      :form="formPer"
                      field="identificacion"
                    ></has-error>
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
                <button type="submit" class="btn btn-primary">Registrar</button>
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
                <button type="submit" class="btn btn-primary">Registrar</button>
              </div>
            </form>
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
      valorMostrar: "10",
      currentImage: undefined,
      previewImage: undefined, //Imagen Previa al cargar
      editmode: false,
      buscador: "", //v-model de buscar en el input de consulta
      donativos: {}, //Se llena con ultimos 10 donativos
      personaIdArray: {}, //Array para guardar la identificacion encontrada en persona
      organizacionIdArray: {}, //Array para guardar la identificacion encontrada en organizacion
      nuevoDonativos: {}, //Para hacer el filtro en computed
      mensajeDeExistencia: "", //Vamos a mostrar un mensaje que valide si existe la identificacion
      VermensajeSiExiste: false, //ver mensaje si existe
      VermensajeNoExiste: false, //ver mensaje si no existe
      bloquearCamposDonativo: true, //Bloqueamos los campos de reservacion
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
      DNINacional: "",
      DNIResidencial: "",
      DNIPasaporte: "",
      form: new Form({
        id: "",
        persona: "",
        idPersona: "",
        identificacionPersona: "",
        idOrganizacion: "",
        identificacionOrganizacion: "",
        tipo: "",
        detalle: "",
        photo: "",
        fecha: "",
        estado: "",
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
      Monetario: "Monetario",
      Material: "Material",
    };
  },

  methods: {
    updatePhoto(e) {
      let file = e.target.files[0];
      this.previewImage = URL.createObjectURL(file);
      this.currentImage = file;
      let reader = new FileReader();

      if (file["size"] < 12111775) {
        reader.onloadend = (file) => {
          //console.log('RESULT', reader.result)
          this.form.photo = reader.result;
        };
        reader.readAsDataURL(file);
      } else {
        swal({
          type: "error",
          title: "ops...",
          text: "archivo muy grande",
        });
      }
    },

    filtrar() {
      if (this.filtrarBusqueda == "") {
        this.donativos.data = this.nuevoDonativos;
      } else if (this.filtrarBusqueda != "") {
        this.donativos.data = this.donativosFiltradas;
      }
    },

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

    cancelarbusqueda() {
      //vamos a cancelar la busqueda bloqueando los input de reservacion
      this.bloquearCampoConsulta = false;
      this.bloquearCamposDonativo = true;
      this.VermensajeSiExiste = false;
      this.VermensajeNoExiste = false;
      this.mensajeDeExistencia = "";
    },

    limpiarDonativo() {
      this.form.errors.clear();
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

    editModal(donativo) {
      this.editmode = true;
      (this.verCamposdeConsulta = false),
        (this.verCampoDeIdentificacionEdit = true),
        (this.bloquearCamposDonativo = false),
        $("#addNew").modal("show");
      $("#SubirImagen").val("");
      this.previewImage = "";
      this.form.fill(donativo);
      this.form.errors.clear();
    },
    newModal() {
      this.cancelarbusqueda();
      (this.verCamposdeConsulta = true),
        (this.verCampoDeIdentificacionEdit = false),
        (this.editmode = false);
      this.form.reset();
      this.form.errors.clear();
      $("#SubirImagen").val("");
      this.previewImage = "";
      $("#addNew").modal("show");
    },

    detailsModal(donativo) {
      $("#ModalVer").modal("show");
      this.form.fill(donativo);
    },
    mostrarMensajeConsulta() {
      this.VermensajeSiExiste = true;
      this.VermensajeNoExiste = false;
      this.mensajeDeExistencia = "Si existe!";
      this.bloquearCampoConsulta = true;
      this.bloquearCamposDonativo = false;
    },
    LlenarDonativoPersona() {
      for (let i = 0; i < this.personaIdArray.length; i++) {
        if (this.personaIdArray[i].identificacion == this.buscador) {
          this.form.identificacionPersona =
            this.personaIdArray[i].identificacion;
          this.form.idPersona = this.personaIdArray[i].id;
        }
      }
    },
    LlenarDonativoOganizacion() {
      for (let i = 0; i < this.organizacionIdArray.length; i++) {
        if (this.organizacionIdArray[i].identificacion == this.buscador) {
          this.form.identificacionOrganizacion =
            this.organizacionIdArray[i].identificacion;
          this.form.idOrganizacion = this.organizacionIdArray[i].id;
        }
      }
    },

    ConsultaCedula() {
      if (this.buscador.length != 0) {
        if (
          /^[1-9]-\d{4}-\d{4}$/.test(this.buscador) ||
          /^[1-9]\d{9}$/.test(this.buscador) ||
          /^\d{11,12}$/.test(this.buscador)
        ) {
          this.form
            .get("/api/donativo/verificar", {
              params: { buscador: this.buscador },
            })
            .then(({ data }) => (this.personaIdArray = data.data));
          this.mostrarMensajeConsulta();
        } else if (/^[1-9]-\d{3}-\d{6}$/.test(this.buscador)) {
          this.form
            .get("/api/donativo/verificarOrg", {
              params: { buscador: this.buscador },
            })
            .then(({ data }) => (this.organizacionIdArray = data.data));
          this.mostrarMensajeConsulta();
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
    mostrar() {
      if (this.$gate.isAdmin() || this.$gate.isUser()) {
        this.form
          .get("/api/donativo/mostrar/", {
            params: { valor: this.valorMostrar },
          })
          .then(({ data }) => (this.donativos = data.data));
      }
    },
    getResults(page = 1) {
      this.$Progress.start();

      axios
        .get("/api/donativo?page=" + page, {
          params: { valor: this.valorMostrar },
        })
        .then(({ data }) => (this.donativos = data.data));

      this.$Progress.finish();
    },
    cargarDonativos() {
      if (this.$gate.isAdmin() || this.$gate.isUser()) {
        axios
          .get("/api/donativo")
          .then(({ data }) => (this.donativos = data.data));
        axios
          .get("/api/donativo/listar")
          .then(({ data }) => (this.nuevoDonativos = data.data));
      }
    },
    donativo() {
      this.$Progress.start();
      this.form
        .post("/api/donativo")
        .then((response) => {
          $("#addNew").modal("hide");

          Toast.fire({
            icon: "success",
            title: response.data.message,
          });

          this.$Progress.finish();
          this.cargarDonativos();
        })
        .catch(() => {
          Toast.fire({
            icon: "error",
            title: "Ocurrio un error!",
          });
        });
    },

    crearDonativo() {
      if (this.buscador.length != "") {
        if (this.personaIdArray.length != 0) {
          console.log("Array pesonas");
          this.LlenarDonativoPersona();
        }
        if (this.organizacionIdArray.length != 0) {
          console.log("Array organizacion");
          this.LlenarDonativoOganizacion();
        }
        if (
          /^[1-9]-\d{4}-\d{4}$/.test(this.form.identificacionPersona) ||
          /^[1-9]\d{9}$/.test(this.form.identificacionPersona) ||
          (/^\d{11,12}$/.test(this.form.identificacionPersona) &&
            this.form.idPersona != 0)
        ) {
          this.donativo();
        } else if (
          /^[1-9]-\d{3}-\d{6}$/.test(this.form.identificacionOrganizacion) &&
          this.form.idOrganizacion != 0
        ) {
          this.donativo();
        } else {
          Swal.fire("Error!", "Identificacion formato incorrecto!", "error");
        }
      } else {
        Swal.fire("Error!", "Primero verifique que existe!", "error");
      }
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
            .post("/api/donativo/guardarPersona", {
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
                title: "Campos Vacios!",
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
            .post("/api/donativo/guardarOrganizacion", {
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
    actualizarDonativo() {
      this.$Progress.start();
      this.form
        .put("/api/donativo/" + this.form.id)
        .then((response) => {
          // success
          $("#addNew").modal("hide");
          Toast.fire({
            icon: "success",
            title: response.data.message,
          });
          this.$Progress.finish();
          //  Fire.$emit('AfterCreate');

          this.cargarDonativos();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    eliminarDonativo(id) {
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
            .delete("/api/donativo/" + id)
            .then(() => {
              Swal.fire(
                "Eliminado!",
                "Se ha eliminado la información.",
                "success"
              );
              // Fire.$emit('AfterCreate');
              this.cargarDonativos();
            })
            .catch((data) => {
              Swal.fire("Fallo!", "Esta acción no está autorizada!", "warning");
            });
        }
      });
    },
  },
  created() {
    this.$Progress.start();
    this.cargarDonativos();
    this.$Progress.finish();
  },
  filters: {
    truncate: function (text, length, suffix) {
      return text.substring(0, length) + suffix;
    },
  },
  computed: {
    donativosFiltradas: function () {
      return this.nuevoDonativos.filter((donativo) => {
        return (
          donativo.detalle
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) ||
          donativo.estado
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) ||
          donativo.fecha
            .toLowerCase()
            .includes(this.filtrarBusqueda.toLowerCase()) ||
          donativo.tipo
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
#modal-contentino {
  width: 150%;
}
#modal-body {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  justify-content: space-around;
}
#inputsModal {
  width: 45%;
  margin: 10px 15px;
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
  #modal-contentino {
    width: 100%;
  }
  #inputsModal {
  width: 90%;
  margin: 10px 15px;
}
}
</style>