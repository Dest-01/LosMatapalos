function validarCedulaN() {
    var cedulaNacional = document.getElementById("nacional").value;
    var cedulaNacional2 = document.getElementById("nacional");
    var re = /^[1-9]-\d{4}-\d{4}$/;
    if (re.test(cedulaNacional)) {
        cedulaNacional2.style.borderBottom = "#0a9d00 solid 2px";
        return true;
    } else {
        cedulaNacional2.style.borderBottom = "red solid 2px";
        return false;
    }
}


//FIN DE LA VALIDACION DE LA CEDULA

//VALIDACION DE LA CEDULA RESIDENCIAL
function validateResidencial() {
    var residencialIdent = document.getElementById("residencial").value;
    var residencialIdent2 = document.getElementById("residencial");
    var re = /^[1-9]\d{9}$/;
    if (re.test(residencialIdent)) {
        residencialIdent2.style.borderBottom = "#0a9d00 solid 2px";
        return true;
    } else {
        residencialIdent2.style.borderBottom = "red solid 2px";
        return false;
    }
}
//FIN DE LA VALIDACION DE LA CEDULA RESIDENCIAL

//VALIDACION DEL PASAPORTE
function validatePasaporte() {
    var pasaporteIdent = document.getElementById("pasaporte").value;
    var pasaporteIdent2 = document.getElementById("pasaporte");
    var re = /^\d{11,12}$/;
    if (re.test(pasaporteIdent)) {
        pasaporteIdent2.style.borderBottom = "#0a9d00 solid 2px";
        return true;
    } else {
        pasaporteIdent2.style.borderBottom = "red solid 2px";
        return false;
    }
}
//FIN DE LA VALIDACION DEL PASAPORTE