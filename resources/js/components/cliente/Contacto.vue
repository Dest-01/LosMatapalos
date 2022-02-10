<template>
  <div class="contenedor-contacto">
    <h1 class="logo" style="margin-bottom: 20px">
      Contacta<span style="color: #38ab81">nos</span>
    </h1>
    <div class="contenedor_triple">
      <div class="figura">
        <div id="box_contacto" class="contact-wrapper animated bounceInUp">
          <div class="contact-form">
            <h3 style="text-align: center">Sendero los Mataplos</h3>
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
              <div class="final_enviar">
                <p class="block">
                  <label>Mensaje</label>
                  <textarea
                    onchange="validar()"
                    name="mensaje"
                    id="mensaje"
                    rows="3"
                  ></textarea>
                </p>
                <p class="block btn_enviar" style="text-align: center">
                  <button
                    id="enviarMensaje"
                    class="btn btn-danger btn-sm px-3"
                    type="submit"
                    value="Send"
                  >
                    Enviar
                  </button>
                </p>
              </div>
            </form>
          </div>
          <div class="contact-info">
            <h4>Mas información</h4>
            <ul>
              <li><i class="fas fa-phone"></i> (506) 0000-0000</li>
              <li>
                <i class="fas fa-envelope-open-text"></i> sendero.una.ac.cr
              </li>
            </ul>
            <i class="fas fa-map-marker-alt"></i>
            <p>
              Dirección: 600 m al sur del Colegio Técnico de Liberia, Campus
              Liberia, Sede Regional Chorotega, Universidad Nacional
            </p>
          </div>
        </div>
      </div>

      <div class="contenedor_mapa">
        <div class="map-cont">
          <div class="map-box">
            <!-- <img src="img/ilustracion4.svg" alt="">-->
            <iframe
              src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=es&amp;q=JG8X+XCW,%20El%20Capul%C3%ADn,%20Provincia%20de%20Guanacaste+(Universidad%20Nacional%20Campus%20Liberia%20-%20Costa%20Rica)&amp;t=&amp;z=16&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"
              width="100%"
              height="450"
              allowfullscreen=""
              loading="lazy"
              frameborder="0"
              scrolling="no"
              marginheight="0"
              marginwidth="0"
            ></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped>
/*Contenedor principal*/
.contenedor-contacto {
  background: #ffffff;
  width: 100%;
  height: auto;
  min-height: 745px;
  max-height: 100%;
}
/*Contiene a los 3 elementos*/
.contenedor_triple {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  width: 100%;
}
/*Contiene la parte de mas informacion y el enviar mensaje*/
.contact-wrapper {
  color: white;
  min-height: 650px;
}
.figura {
  width: 50%;
}
/*contiene al mapa */
.contenedor_mapa {
  width: 50%;
}

.map {
  background: #fff;
}
.map-cont {
  display: flex;
  justify-content: space-evenly;
  align-items: center;
  height: 650px;
  clip-path: polygon(16% 0, 100% 0, 100% 100%, 0 100%);
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
.logo {
  text-align: center;
  font-size: 3em;
}

.contact-form {
  background: #222222a6;
  height: 650px;
}

.contact-form form {
  display: flex;
  position: relative;
  flex-direction: column;
  width: 100%;
  height: 650px;
}
#nombre:focus,
#celular:focus,
#asunto:focus,
#email:focus,
#asunto:focus,
#mensaje:focus {
  border-bottom: 1px solid blue;
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
  background: #38ab81;
  border: 0;
  padding: 1em;
  border-radius: 20px;
  width: 50%;
}

/* CONTACT INFO */
.contact-info {
  background: #2a2a2aeb;
  clip-path: polygon(0 0, 100% 0, 79% 100%, 0 100%);
  width: 149%;
}
textarea {
  resize: none;
}
.contact-info p {
  width: 78%;
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
@media only screen and (min-device-width: 300px) and (max-device-width: 699px) {
  .contenedor_triple {
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    width: 100%;
  }
  .figura {
    width: 100%;
  }
  #box_contacto {
    padding: 5px;
  }
  .contenedor_mapa{
    padding: 5px;
  }
  .contenedor_mapa,
  .map-cont {
    width: 100%;
    clip-path: polygon(0 0, 100% 0, 100% 100%, 0% 100%);
    margin-top: -20px;
  }
  .contact-info {
    clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
    width: 100%;
  }
  form p {
    padding: 4px 40px;
  }
}
</style>