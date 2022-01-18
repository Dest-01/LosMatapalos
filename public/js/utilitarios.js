//VALIDACION DE LA CEDULA NACIONAL
function validate() {
    const button = document.getElementById("validar");
    var cedulaNacional = document.getElementById("nacional").value;
    var cedulaNacional2 = document.getElementById("nacional");
    var re = /^[1-9]-\d{4}-\d{4}$/;
    if (re.test(cedulaNacional)) {
        button.disabled = false;
        cedulaNacional2.style.borderBottom = "#0a9d00 solid 2px";
        return true;
    } else {
        cedulaNacional2.style.borderBottom = "red solid 2px";
        button.disabled = true;
        return false;
    }
}

//FIN DE LA VALIDACION DE LA CEDULA

//VALIDACION DE LA CEDULA RESIDENCIAL
function validateResidencial() {
  const button = document.getElementById("validar");
  var residencialIdent = document.getElementById("residencial").value;
  var residencialIdent2 = document.getElementById("residencial");
  var re = /^\d{10}$/;
  if (re.test(residencialIdent)) {
      button.disabled = false;
      residencialIdent2.style.borderBottom = "#0a9d00 solid 2px";
      return true;
      
  } else {
    residencialIdent2.style.borderBottom = "red solid 2px";
      button.disabled = true;
      return false;
  }
}
//FIN DE LA VALIDACION DE LA CEDULA RESIDENCIAL

//VALIDACION DEL PASAPORTE
function validatePasaporte() {
  const button = document.getElementById("validar");
  var pasaporteIdent = document.getElementById("pasaporte").value;
  var pasaporteIdent2 = document.getElementById("pasaporte");
  var re = /^\d{11,12}$/;
  if (re.test(pasaporteIdent)) {
      button.disabled = false;
      pasaporteIdent2.style.borderBottom = "#0a9d00 solid 2px";
      return true;
  } else {
    pasaporteIdent2.style.borderBottom = "red solid 2px";
      button.disabled = true;
      return false;
  }
}
//FIN DE LA VALIDACION DEL PASAPORTE
function limpiarCampo(){
    var pasaporteIdent2 = document.getElementById("pasaporte");
    var residencialIdent2 = document.getElementById("residencial");
    var cedulaNacional2 = document.getElementById("nacional");
    pasaporteIdent2.style.borderBottom = "#ced4da solid 1px";
    residencialIdent2.style.borderBottom = "#ced4da solid 1px";
    cedulaNacional2.style.borderBottom = "#ced4da solid 1px";
}

var swiper = new Swiper('.blog-slider', {
    spaceBetween: 30,
    effect: 'fade',
    loop: true,
    mousewheel: {
        invert: false,
    },
    // autoHeight: true,
    pagination: {
        el: '.blog-slider__pagination',
        clickable: true,
    }
});


