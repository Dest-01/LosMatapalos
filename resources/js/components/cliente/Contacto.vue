<template>
  <div class="contenedor-contacto">
    <div class="content">
      <h1 class="logo">Contacta<span>nos</span></h1>
      <hr />
      <div class="contact-wrapper animated bounceInUp">
        <div id="collapseExample4" class="collapse shadow-sm hide contact-form">
          <h3>Sendero los Mataplos</h3>
          <form id="contact-form">
            <input type="hidden" name="contact_number" />
            <p>
              <label>Nombre completo</label>
              <input
                onchange="validar()"
                type="text"
                id="nombre"
                name="nombre"
              />
            </p>
            <p>
              <label>Email</label>
              <input
                onchange="validar()"
                type="email"
                id="email"
                name="email"
              />
            </p>
            <p>
              <label>Número de celular</label>
              <input
                onchange="validar()"
                type="tel"
                id="celular"
                name="celular"
              />
            </p>
            <p>
              <label>Asunto</label>
              <input
                onchange="validar()"
                type="text"
                id="asunto"
                name="asunto"
              />
            </p>
            <p class="block">
              <label>mensaje</label>
              <textarea
                onchange="validar()"
                name="mensaje"
                id="mensaje"
                rows="3"
              ></textarea>
            </p>
            <p class="block btn_enviar">
              <button
                id="enviarMensaje"
                class="btn btn-danger btn-sm px-3"
                type="submit"
                value="Send"
              >
                Enviar
              </button>
            </p>
          </form>
        </div>
        <div class="contact-info">
          <h4>Mas información</h4>
          <ul>
            <li><i class="fas fa-phone"></i> (506) 0000-0000</li>
            <li><i class="fas fa-envelope-open-text"></i> sendero.una.ac.cr</li>
          </ul>
          <i class="fas fa-map-marker-alt"></i>
          <p>
            Dirección: 600 m al sur del Colegio Técnico de Liberia, Campus
            Liberia, Sede Regional Chorotega, Universidad Nacional
          </p>
          <!-- Collapse Panel 4--><a
            data-toggle="collapse"
            href="#collapseExample4"
            role="button"
            aria-expanded="true"
            aria-controls="collapseExample4"
            class="btn btn-danger btn-block p2-3 shadow-sm with-chevron"
          >
            <p
              class="
                d-flex
                align-items-center
                justify-content-between
                mb-0
                px-3
                py-2
              "
            >
              <strong class="text-uppercase">Contactar</strong
              >
            </p>
          </a>
        </div>
      </div>
    </div>

    <div class="contenedor_mapa">
      <div class="map-cont">
        <div class="map-box">
          <!-- <img src="img/ilustracion4.svg" alt="">-->
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4697.277481346486!2d-85.45376162258393!3d10.617667351742492!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f757d3b9e5cff01%3A0x4139935881accb02!2sUniversidad%20Nacional!5e0!3m2!1sen!2scr!4v1631573581299!5m2!1sen!2scr"
            width="1000"
            height="450"
            allowfullscreen=""
            loading="lazy"
          ></iframe>
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped>
h1 {
  color: #4f4f4f;
  font-weight: 700;
}
hr:not([size]) {
  height: 5px;
}
.contenedor_mapa {
  width: 100%;
  margin-top: 4%;
}
.map {
  background: #fff;
  padding-bottom: 30px;
}
.map-cont {
  display: flex;
  justify-content: space-evenly;
  align-items: center;
  height: 700px;
}
.map-box {
  display: flex;
  width: 100%;
  align-items: center;
  height: 100%;
}
.map-box iframe {
  width: 100%;
  height: 100%;
}
.contenedor-contacto {
  background: #f9f9f9;
  width: 100%;
  position: relative;
  height: auto;
  display: flex;
  justify-content: center;
  min-height: 600px;
  max-height: 100%;
}
.content {
  position: absolute;
  width: 45%;
}

.container {
  max-width: 1170px;
  margin-left: auto;
  margin-right: auto;
  padding: 1.5em;
}

ul {
  list-style: none;
  padding: 0;
}

.logo {
  text-align: center;
  font-size: 3em;
}

.logo span {
  color: #38ab81;
}

.contact-wrapper {
  box-shadow: 0 0 10px 0 #ffffff;
  color: white;
  border-radius: 20px;
}

.contact-wrapper > * {
  padding: 1em;
}

.contact-form {
  background: #222222a6;
  border-top-left-radius: 20px;
  border-bottom-left-radius: 20px;
}

.contact-form form {
  display: grid;
  grid-template-columns: 1fr 1fr;
  position: relative;
}

.contact-form form label {
  display: block;
}

.contact-form form p {
  margin: 0;
  padding: 1em;
}

.contact-form form .block {
  grid-column: 1 / 3;
}

.contact-form form button,
.contact-form form input,
.contact-form form textarea {
  width: 100%;
  padding: 0.7em;
  border: none;
  background: none;
  outline: 0;
  color: #fff;
  border-bottom: 1px solid #f1f1f1;
}

.contact-form form button {
  background: #034991;
  border: 0;
  padding: 1em;
  border-radius: 20px;
}

.contact-form form button:hover,
.contact-form form button:focus {
  background: #d63031;
  color: #fff;
  transition: background-color 1s ease-out;
  outline: 0;
}

/* CONTACT INFO */
.contact-info {
  background: #000000c9;
  border-top-right-radius: 20px;
  border-bottom-right-radius: 20px;
}

.contact-info h4,
.contact-info ul,
.contact-info p {
  text-align: justify;
  margin: 0 0 1rem 0;
}

textarea {
  resize: none;
}

.fa-map-marker-alt {
  color: rgba(184, 13, 13, 0.938);
}

/* LARGE SIZE */
@media (min-width: 700px) {
  body {
    padding: 0 4em;
  }
  .contact-wrapper {
    display: grid;
    grid-template-columns: 2fr 1fr;
  }
  .contact-wrapper > * {
    padding: 2em;
  }
  .contact-info h4,
  .contact-info ul,
  .contact-info p {
    text-align: justify;
  }
}
</style>