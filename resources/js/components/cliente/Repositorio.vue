<template>
  <div class="principal">
    <div class="titulo">
      <h1>Repositorio de documentos</h1>
    </div>
    <div class="secundario">
      <table class="table align-middle">
        <thead>
          <tr>
            <th class="icono"></th>
            <th class="nombre" scope="col">Nombre</th>
            <th class="botones" scope="col"></th>
            <th class="botones" scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="icono">
              <img
                src="/images/PDFIcono.png"
                width="50px"
                height="50px"
                alt=""
              />
            </td>
            <td class="nombre">Nombre del documento</td>
            <td class="botones">
              <button type="button" class="btn btn-info btn-sm px-3">
                <i class="fas fa-info-circle"></i>
              </button>
            </td>
            <td class="botones">
              <button type="button" class="btn btn-danger btn-sm px-3">
                <i class="fas fa-download"></i>
              </button>
            </td>
          </tr>
          <tr>
            <td class="icono">
              <img
                src="/images/PDFIcono.png"
                width="50px"
                height="50px"
                alt=""
              />
            </td>
            <td class="nombre">Nombre del documento</td>
            <td class="botones">
              <button type="button" class="btn btn-info btn-sm px-3">
                <i class="fas fa-info-circle"></i>
              </button>
            </td>
            <td class="botones">
              <button type="button" class="btn btn-danger btn-sm px-3">
                <i class="fas fa-download"></i>
              </button>
            </td>
          </tr>
          <tr>
            <td class="icono">
              <img
                src="/images/PDFIcono.png"
                width="50px"
                height="50px"
                alt=""
              />
            </td>
            <td class="nombre">Nombre del documento</td>
            <td class="botones">
              <button type="button" class="btn btn-info btn-sm px-3">
                <i class="fas fa-info-circle"></i>
              </button>
            </td>
            <td class="botones">
              <button type="button" class="btn btn-danger btn-sm px-3">
                <i class="fas fa-download"></i>
              </button>
            </td>
          </tr>
          <tr>
            <td class="icono">
              <img
                src="/images/PDFIcono.png"
                width="50px"
                height="50px"
                alt=""
              />
            </td>
            <td class="nombre">Nombre del documento</td>
            <td class="botones">
              <button type="button" class="btn btn-info btn-sm px-3">
                <i class="fas fa-info-circle"></i>
              </button>
            </td>
            <td class="botones">
              <button type="button" class="btn btn-danger btn-sm px-3">
                <i class="fas fa-download"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<style scoped>
.principal {
  margin: 130px 10px 10px 10px;
  width: 100%;
  height: 100%;
  text-align: center;
  font-family: "Poppins";
}
.titulo{
  margin: 10px;

}
.secundario {
  width: 100%;
  height: 500px;
  margin: 10px 10px 10px 10px;
  padding: 20px 250px;
    text-align: start;
}
.table tbody {
  border: 1px;
  border-block: unset;
  border-bottom-color: #5a5a5a87;
  border-bottom-style: groove;
}
.icono {
  width: 100px;
}
.nombre {
  width: 400px;
  font-size: 1.5rem;
  font-weight: 400;
}
.botones {
  width: 50px;
}
.table > :not(caption) > * > * {
  padding: 1.2rem 0.1rem;
}

@media (max-width: 768px) {
  .secundario {
    width: 100%;
    height: auto;
    margin: 1px 1px;
    padding: 1px 18px 1px 1px;
  }
  .nombre {
    width: 400px;
    font-size: 1.1rem;
    font-weight: 400;
  }
}
</style>