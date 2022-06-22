//VALIDACION DE LA CEDULA NACIONAL
function validarCedulaN() {
    var cedulaNacional = document.getElementById("nacional").value;
    var cedulaNacional2 = document.getElementById("nacional");
    var re = /^[1-9]-\d{4}-\d{4}$/;
    if (re.test(cedulaNacional)) {
        cedulaNacional2.style.border = "#0a9d00 solid 2px";
        return true;
    } else {
        cedulaNacional2.style.border = "red solid 2px";
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
        residencialIdent2.style.border = "#0a9d00 solid 2px";
        return true;
    } else {
        residencialIdent2.style.border = "red solid 2px";
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
        pasaporteIdent2.style.border = "#0a9d00 solid 2px";
        return true;
    } else {
        pasaporteIdent2.style.border = "red solid 2px";
        return false;
    }
}
//FIN DE LA VALIDACION DEL PASAPORTE
function limpiarCampo() {
    var pasaporteIdent2 = document.getElementById("pasaporte");
    var residencialIdent2 = document.getElementById("residencial");
    var cedulaNacional2 = document.getElementById("nacional");
    pasaporteIdent2.style.border = "#ced4da solid 2px";
    residencialIdent2.style.border = "#ced4da solid 2px";
    cedulaNacional2.style.border = "#ced4da solid 2px";
}

function quitarAlerta() {
    $(".alert").remove();
}


function validarHora() {
    $(".alert").remove();
    const button = document.getElementById("reservar");
    var horaInicio = $("#horaInicio").val();
    var horaFin = $("#horaFin").val();

    if (horaInicio <= "08:00" || horaInicio >= "14:00" || horaFin >= "18:00") {
        $("#horaFin").parent().after(
            '<div class="alert alert-warning">Cambiar las horas! <br>Hora inicio entre 08:00 y 14:00 <br> Hora fin entre 18:00 </div>'
        );
        button.disabled = true;

    } else if (horaInicio < horaFin) {
        $("#horaFin").parent().after(
            '<div class="alert alert-success">Correcto! <br>Las horas corresponden al horario</div>'
        );
        button.disabled = false;
    }
}

function ocultarSideBar(){
    if (screen.width <= 991){
        $('[data-widget="pushmenu"]').PushMenu("collapse");
    }
}
