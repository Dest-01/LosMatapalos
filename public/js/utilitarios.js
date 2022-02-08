//VALIDACION DE LA CEDULA NACIONAL
function validate() {
    const button = document.getElementById("validar");
    const inputCedulaNacional = document.getElementById("nacional");
    var cedulaNacional = document.getElementById("nacional").value;
    var cedulaNacional2 = document.getElementById("nacional");
    var re = /^[1-9]-\d{4}-\d{4}$/;
    if (re.test(cedulaNacional)) {
        button.disabled = false;
        inputCedulaNacional.disabled = true;
        cedulaNacional2.style.borderBottom = "#0a9d00 solid 2px";
        inputCedulaNacional.style.width = "400px";
        return true;
    } else {
        cedulaNacional2.style.borderBottom = "red solid 2px";
        button.disabled = true;
        return false;
    }
}

function bloquearCedula() {
    const button = document.getElementById("validar");
    const inputCedulaNacional = document.getElementById("nacional");
    if(button.disabled = true && inputCedulaNacional != ""){
        inputCedulaNacional.disabled = true;
        button.disabled = false;
    }else {
        inputCedulaNacional.disabled = false;
        button.disabled = true;
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
function limpiarCampo() {
    var pasaporteIdent2 = document.getElementById("pasaporte");
    var residencialIdent2 = document.getElementById("residencial");
    var cedulaNacional2 = document.getElementById("nacional");
    pasaporteIdent2.style.borderBottom = "#ced4da solid 1px";
    residencialIdent2.style.borderBottom = "#ced4da solid 1px";
    cedulaNacional2.style.borderBottom = "#ced4da solid 1px";
}

function quitarAlerta() {
    $(".alert").remove();
}


function validarHora() {
    $(".alert").remove();
    const button = document.getElementById("reservar");
    var horaInicio = $("#horaInicio").val();
    var horaFin = $("#horaFin").val();

    if (horaInicio <= "07:59" || horaInicio >= "14:01" || horaFin <= "08:59" || horaFin >= "15:01") {
        $("#horaFin").parent().after(
            '<div class="alert alert-warning">Cambiar las horas! <br>Hora inicio entre 08:00 am y 02:00 pm<br> Hora fin entre las 09:00 am y 03:00 pm</div>'
        );
        button.disabled = true;

    } else if (horaFin > horaInicio) {
        $("#horaFin").parent().after(
            '<div class="alert alert-success">Correcto! <br>Las horas corresponden al horario</div>'
        );
        button.disabled = false;
    }
}
