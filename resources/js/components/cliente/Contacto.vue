<template>
  <div class="contenedor-contacto">
    <div class="titulo">
      <h1 class="logo" style="margin-bottom: 20px">
        {{ $t("Contactanos")
        }}<span style="color: #38ab81">{{ $t("us") }}</span>
      </h1>
    </div>
    <div class="contenedor_triple">
      <div class="figura">
        <div class="contact-form">
          <h3 style="text-align: center">{{ $t("Los_MP") }}</h3>
          <form id="contact-form">
            <input type="hidden" name="contact_number" />
            <p>
              <label>{{ $t("nombre_c") }}</label>
              <input
                type="text"
                v-model="form.nombreCompleto"
                name="nombre"
                id="nombre"
                onkeypress="validarNombre()"
              />
            </p>
            <p>
              <label>Email</label>
              <input
                id="email"
                type="email"
                v-model="form.correo"
                name="email"
              />
            </p>
            <p>
              <label>{{ $t("numero_tel") }}</label>
              <input
                v-model="form.numero"
                type="tel"
                id="celular"
                name="celular"
              />
            </p>
            <p>
              <label>{{ $t("asunto") }}</label>
              <input
                v-model="form.asunto"
                type="text"
                id="asunto"
                name="asunto"
              />
            </p>
            <div class="final_enviar">
              <p class="block">
                <label>{{ $t("Mensaje") }}</label>
                <textarea
                  name="mensaje"
                  v-model="form.mensaje"
                  rows="3"
                  id="mensaje"
                ></textarea>
              </p>
              <p class="block btn_enviar" style="text-align: center">
                <button
                  class="btn btn-danger btn-sm px-3"
                  type="button"
                  @click="enviaEmail()"
                >
                  {{ $t("Enviar") }}
                </button>
              </p>
            </div>
          </form>
        </div>
        <div class="contact-info">
          <div class="informacion">
            <h4>{{ $t("Mas_informacion") }}</h4>
            <ul>
              <li><i class="fas fa-phone"></i> (506) 2562-6253</li>
              <li>
                <i class="fas fa-envelope-open-text"></i> sendero.una.ac.cr
              </li>
            </ul>
            <i class="fas fa-map-marker-alt"></i>
            <p>
              {{ $t("Parrafo_Info1") }}
            </p>
          </div>
        </div>
      </div>

      <div class="contenedor_mapa">
        <div class="map-cont">
          <div class="map-box">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1185.9005890353978!2d-85.45202258885914!3d10.617110488200765!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f757d3b9e5cff01%3A0x4139935881accb02!2sUniversidad%20Nacional!5e1!3m2!1ses!2scr!4v1645770888267!5m2!1ses!2scr"
              width="600"
              height="450"
              style="border: 0"
              allowfullscreen=""
              loading="lazy"
            ></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      nombreCompleto: "",
      correo: "",
      numero: "",
      asunto: "",
      mensaje: "",

      form: new Form({
        nombreCompleto: "",
        correo: "",
        numero: "",
        asunto: "",
        mensaje: "",
      }),
    };
  },
  methods: {
    limpiar() {
      this.form.reset();
    },
    enviaEmail() {
      if (
        this.form.nombreCompleto != "" &&
        this.form.correo != "" &&
        this.form.numero != "" &&
        this.form.asunto != "" &&
        this.form.mensaje != ""
      ) {
        if (
          /^([A-Z]{1}[a-zñáéíóú]+[\s]*)+$/.test(this.form.nombreCompleto) &&
          /[\w._%+-]+@[\w.-]+\.[a-zA-Z]{2,4}/.test(this.form.correo) &&
          /^[2-9]\d{3}\d{4}$/.test(this.form.numero) &&
          /^.{3,}$/.test(this.form.asunto) &&
          /^.{5,}$/.test(this.form.mensaje)
        ) {
          const templateParams = {
            nombreCompleto: this.form.nombreCompleto,
            correo: this.form.correo,
            numero: this.form.numero,
            asunto: this.form.asunto,
            mensaje: this.form.mensaje,
          };
          console.log(templateParams.correo);
          emailjs.send(
            "service_xf6d5cg",
            "template_oqin6bo",
            templateParams,
            "user_GMf53dmaF0FI8RLY0cj3V"
          );
          Swal.fire("Listo!", this.$t("MensajeEnviado"), "success");
          this.limpiar();
        } else {
          Swal.fire("Error!", this.$t("FormatoIncorrecto"), "error");
        }
      } else {
        Swal.fire("Error!", this.$t("CamposVacios"), "error");
      }
    },
  },
  mounted() {
    const plugin = document.createElement("script");
    plugin.setAttribute(
      "src",
      "https://maps.googleapis.com/maps/api/js?key=AIzaSyAf2BTaIHXz95AJVwvHuoFd2CkF8gTcuvM"
    );
    plugin.async = true;
    document.head.appendChild(plugin);
  },
};
</script>
<style scoped>
.titulo {
  text-align: center;
}
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

.figura {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  width: 55%;
  position: relative;
}
.contact-form {
  background: #000000ba;
  color: #fff;
  padding: 15px;
  width: 60%;
}
.contact-info {
  background: #000000e6;
  color: #fff;
  width: 40%;
  height: 100%;
}
.contenedor_mapa {
  width: 45%;
}
.informacion {
  width: 80%;
  padding: 15px;
}

.map {
  background: #fff;
}
.map-cont {
  height: 650px;
}
.map-box {
  width: 100%;
  height: 100%;
}
.map-box iframe {
  width: 100%;
  height: 100%;
}
#nombre:focus,
#celular:focus,
#asunto:focus,
#email:focus,
#asunto:focus,
#mensaje:focus {
  border-bottom: 2px solid blue;
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
textarea {
  resize: none;
}

.fa-map-marker-alt {
  color: rgba(184, 13, 13, 0.938);
}
@media only screen and (min-device-width: 100px) and (max-device-width: 950px) {
  .contenedor_triple {
    display: flex;
    flex-direction: column;
  }
  .figura {
    display: flex;
    flex-direction: column;
    width: 100%;
  }
  .contact-form {
    width: 100%;
  }
  .contact-info {
    width: 100%;
    clip-path: polygon(0 0, 100% 0%, 100% 100%, 0% 100%);
    position: relative;
    left: 0;
  }
  .contenedor_mapa {
    width: 100%;
    clip-path: polygon(0 0, 100% 0%, 100% 100%, 0% 100%);
  }
}
</style>