<template>
  <div class="container">
    <div style="margin-top: 160px" class="row">
      <div class="row">
        <!-- Grid column -->
        <div class="col-md-6 mb-4">
          <div class="card">
            <div class="card-body">
              <!-- Form contact -->
              <form>
                <h2 class="text-center py-4 font-bold font-up info-text">
                  Formulario de reservación
                </h2>
                <div class="text-left">
                  <button type="button" class="btn btn-primary">
                    Registrar Cliente
                  </button>
                  <button type="button" class="btn btn-primary">
                    Registrar Organización
                  </button>
                  <button type="button" class="btn btn-primary">
                    Registrar Grupo
                  </button>
                </div>

                <div class="md-form">
                  <i class="fa fa-user prefix grey-text"></i>
                  <input type="text" id="form31" class="form-control" />
                  <label for="form31">Cedula</label>
                  <button type="button" class="btn btn-success">
                    Comprobar
                  </button>
                </div>
                <div class="md-form">
                  <i class="fa fa-envelope prefix grey-text"></i>
                  <input type="text" id="form21" class="form-control" />
                  <label for="form21">Cantidad de visitantes</label>
                </div>
                <div class="md-form">
                  <i class="fa fa-tag prefix grey-text"></i>
                  <input type="date" id="form321" class="form-control" />
                  <label for="form341">Fecha de visita</label>
                </div>
                
                <div class="md-form">
                  <i class="fa fa-tag prefix grey-text"></i>
                  <input type="time" id="form321" class="form-control" />
                  <label for="form341">Hora de llegada</label>
                </div>
                

                <div class="text-center">
                  <button type="button" class="btn btn-success btn-rounded">
                    RESERVAR
                  </button>
                  <button type="button" class="btn btn-danger btn-rounded">
                    CANCELAR
                  </button>
                </div>
              </form>
              <!-- Form contact -->
            </div>
          </div>
        </div>
        <!-- Grid column -->
        <!-- Grid column -->
        <div class="col-md-6 mb-4">
          <div class="card bg-secondary form-white">
            <!-- Card -->
            <div class="card">
              <!-- Card image -->
              <div class="view overlay">
                <img
                  class="card-img-top"
                  src="https://mdbootstrap.com/img/Mockups/Lightbox/Thumbnail/img%20(67).jpg"
                  alt="Card image cap"
                />
                <a href="#!">
                  <div class="mask rgba-white-slight"></div>
                </a>
              </div>

              <!-- Card content -->
              <div class="card-body">
                <!-- Title -->
                <h4 class="card-title">Horario del sendero</h4>
                <!-- Text -->
                <p class="card-text">
                  Some quick example text to build on the card title and make up
                  the bulk of the card's content.
                </p>
                <!-- Button -->
                 <p class="card-text">
                  Some quick example text to build on the card title and make up
                  the bulk of the card's content.
                </p>
                 <p class="card-text">
                  Some quick example text to build on the card title and make up
                  the bulk of the card's content.
                </p>
                 <p class="card-text">
                  Some quick example text to build on the card title and make up
                  the bulk of the card's content.
                </p>
                 <p class="card-text">
               
                </p>
              </div>
            </div>
            <!-- Card -->
          </div>
        </div>
        <!-- Grid column -->
      </div>
    </div>
  </div>
</template>

<style scoped>
.card {
  height: 700px;
}

.bg-secondary {
  background-color: #034991 !important;
}
.btn {
  font-size: 20px;
  width: 230px;
}

.hm-gradient {
  background-image: linear-gradient(
    to top,
    #f3e7e9 0%,
    #e3eeff 99%,
    #e3eeff 100%
  );
}
.darken-grey-text {
  color: #2e2e2e;
}
.danger-text {
  color: #ff3547;
}
.default-text {
  color: #2bbbad;
}
.info-text {
  color: #33b5e5;
}
.form-white .md-form label {
  color: #fff;
}
.form-white input[type="text"]:focus:not([readonly]) {
  border-bottom: 1px solid #fff;
  -webkit-box-shadow: 0 1px 0 0 #fff;
  box-shadow: 0 1px 0 0 #fff;
}
.form-white input[type="text"]:focus:not([readonly]) + label {
  color: #fff;
}
.form-white input[type="password"]:focus:not([readonly]) {
  border-bottom: 1px solid #fff;
  -webkit-box-shadow: 0 1px 0 0 #fff;
  box-shadow: 0 1px 0 0 #fff;
}
.form-white input[type="password"]:focus:not([readonly]) + label {
  color: #fff;
}
.form-white input[type="password"],
.form-white input[type="text"] {
  border-bottom: 1px solid #fff;
}
.form-white .form-control:focus {
  color: #fff;
}
.form-white .form-control {
  color: #fff;
}
.form-white textarea.md-textarea:focus:not([readonly]) {
  border-bottom: 1px solid #fff;
  box-shadow: 0 1px 0 0 #fff;
  color: #fff;
}
.form-white textarea.md-textarea {
  border-bottom: 1px solid #fff;
  color: #fff;
}
.form-white textarea.md-textarea:focus:not([readonly]) + label {
  color: #fff;
}
.ripe-malinka-gradient {
  background-image: linear-gradient(120deg, #f093fb 0%, #f5576c 100%);
}
.near-moon-gradient {
  background-image: linear-gradient(to bottom, #5ee7df 0%, #b490ca 100%);
}
</style>