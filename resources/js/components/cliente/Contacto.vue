<template>
  <div class="contenedor-contacto">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Contactenos</h5>
        <div class="form-outline">
          <input
            type="text"
            id="typeText"
            class="form-control"
            placeholder="Escribe su nombre"
          />
          <label class="form-label" for="typeText">Nombre</label>
        </div>
        <div class="form-outline">
          <input
            type="email"
            id="typeEmail"
            class="form-control"
            placeholder="ejemplo@gmail.com"
          />
          <label class="form-label" for="typeEmail">Correo</label>
        </div>
        <div class="form-outline">
          <textarea
            class="form-control"
            id="textAreaExample"
            rows="4"
            placeholder="Escriba el mensaje"
          ></textarea>
          <label class="form-label" for="textAreaExample">Mensaje</label>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
          <button
            style="
              width: 100%;
              font-size: 1rem;
              border-radius: 20px;
              background: #034991;
            "
            type="button"
            class="btn btn-primary"
          >
            Enviar
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped>
* {
  font-family: "Frutiger", 700;
  font-weight: bold;
}
.contenedor-contacto {
  width: 100%;
  background-image: url(/images/campus.jpg);
  background-size: cover;
  background-repeat: no-repeat;
  background-blend-mode: lighten;
  position: relative;
  height: auto;
  display: flex;
  justify-content: center;
  min-height: 500px;
  max-height: 100%;
}
.card {
  min-width: 500px;
  max-width: 100%;
  top: 1%;
  height: auto;
  margin: 20px 20px 20px 20px;
  position: absolute;
  text-align: center;
  font-size: 20px;
  font-weight: 600;
  background: #000000a8;
  color: white;
  border-radius: 30px;
  padding: 5px;
}

.card-title {
  margin-bottom: 0.5rem;
  font-size: 20px;
  font-weight: 600;
}

.form-outline .form-control {
  min-height: auto;
  padding: 0.33em 0.75em;
  border: 0;
  background: transparent;
  -webkit-transition: all 0.2s linear;
  transition: all 0.2s linear;
  border-bottom: 2px solid white;
  margin: 15px;
  padding: 15px;
  color: white;
}
.form-outline .form-control ~ .form-label {
  position: absolute;
  top: 0;
  max-width: 90%;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  left: 0.75rem;
  padding-top: 0.37rem;
  pointer-events: none;
  -webkit-transform-origin: 0 0;
  transform-origin: 0 0;
  -webkit-transition: all 0.2s ease-out;
  transition: all 0.2s ease-out;
  color: rgb(255 255 255 / 66%);
  margin-bottom: 0;
}

.form-outline .form-control:focus {
  border-bottom: 2px solid #034991;
}

textarea {
  resize: none;
}
</style>