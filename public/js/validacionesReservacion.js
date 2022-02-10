
///////////////////////////////////////////////////////////////////////////////////////////////////////
/*ENVIAR CORREO DE RESERVACION */
/////////////////////////////////////////////////////////////////////////////////////////////////////// 
function enviarCorreoReservacion() {
    var cedula = document.getElementById('cedulaReservacion').value;
    var cantidad = document.getElementById('cantidaPersonasReservacion').value;
    var fecha = document.getElementById('fechaReservacion').value;
    var horaIni = document.getElementById('horaLLegaReservacion').value;
    var horaFin = document.getElementById('horaFinReservacion').value;
    if (cedula != "" && cantidad != "" && fecha != "" && horaIni != "" && horaFin != "") {
        document.getElementById('contact-form').addEventListener('submit', function (event) {
            event.preventDefault();
            // generate a five digit number for the contact_number variable
            this.contact_number.value = Math.random() * 100000 | 0;
            // these IDs from the previous steps
            emailjs.sendForm('service_xf6d5cg', 'template_mw3itut', this)
                .then(function () {
                    console.log('SUCCESS!');

                }, function (error) {
                    console.log('FAILED...', error);
                });
        });
    }

}




///////////////////////////////////////////////////////////////////////////////////////////////////////
/*FIN ENVIAR CORREO DE RESERVACION */
/////////////////////////////////////////////////////////////////////////////////////////////////////// 


/*VALIDAR DATOS DE RESERVACION*/

function validaCedulaNacional() {
    const button = document.getElementById("botonPersonaRegistro");
    const buttonCancelar = document.getElementById("botonCancelar");
    const inputCedulaNacional = document.getElementById("inputNacional");
    var cedulaNacional = document.getElementById("inputNacional").value;
    var cedulaNacional2 = document.getElementById("inputNacional");
    var re = /^[1-9]-\d{4}-\d{4}$/;
    if (re.test(cedulaNacional)) {
        button.disabled = false;
        inputCedulaNacional.disabled = true;
        cedulaNacional2.style.borderBottom = "#0a9d00 solid 2px";
        buttonCancelar.style.visibility = 'visible';
        return true;
    } else {
        cedulaNacional2.style.borderBottom = "red solid 2px";
        button.disabled = true;
        buttonCancelar.style.visibility = 'hidden';
        return false;
    }
}

function cancelarCedula() {
    const inputCedulaNacional = document.getElementById("inputNacional");
    const buttonCancelar = document.getElementById("botonCancelar");
    const button = document.getElementById("botonPersonaRegistro");

    inputCedulaNacional.value = "";
    inputCedulaNacional.style.borderBottom = "2px solid #757575";
    inputCedulaNacional.disabled = false; //Desbloqueamos el input
    button.disabled = true; //Bloqueamos el boton de registrar
    buttonCancelar.style.visibility = 'hidden'; //ocultamos el botton de cancelar

}
//
//Validar cedula residencial
function validaCedulaResidencial() {
    const button = document.getElementById("botonPersonaRegistro");
    const buttonCancelar = document.getElementById("botonCancelar_residencial");
    const inputCedulaResidencial = document.getElementById("inputResidencial");
    var residencialIdent = document.getElementById("inputResidencial").value;
    var residencialIdent2 = document.getElementById("inputResidencial");
    var re = /^\d{10}$/;
    if (re.test(residencialIdent)) {
        button.disabled = false;
        inputCedulaResidencial.disabled = true;
        residencialIdent2.style.borderBottom = "#0a9d00 solid 2px";
        buttonCancelar.style.visibility = 'visible';
        return true;
    } else {
        residencialIdent2.style.borderBottom = "red solid 2px";
        button.disabled = true;
        buttonCancelar.style.visibility = 'hidden';
        return false;
    }
}

function cancelarCedulaResidencial() {
    const inputCedulaResidencial = document.getElementById("inputResidencial");
    const buttonCancelar = document.getElementById("botonCancelar_residencial");
    const button = document.getElementById("botonPersonaRegistro");

    inputCedulaResidencial.value = "";
    inputCedulaResidencial.style.borderBottom = "2px solid #757575";
    inputCedulaResidencial.disabled = false; //Desbloqueamos el input
    button.disabled = true; //Bloqueamos el boton de registrar
    buttonCancelar.style.visibility = 'hidden'; //ocultamos el botton de cancelar

}

//Validar Pasaporte
function validarPasaporte() {
    const button = document.getElementById("botonPersonaRegistro");
    const buttonCancelar = document.getElementById("botonCancelar_pasaporte");
    const inputPasaporte = document.getElementById("inputPasaporte");
    var pasaporteIdent = document.getElementById("inputPasaporte").value;
    var pasaporteIdent2 = document.getElementById("inputPasaporte");
    var re = /^\d{11,12}$/;
    if (re.test(pasaporteIdent)) {
        button.disabled = false;
        inputPasaporte.disabled = true;
        pasaporteIdent2.style.borderBottom = "#0a9d00 solid 2px";
        buttonCancelar.style.visibility = 'visible';
        return true;
    } else {
        pasaporteIdent2.style.borderBottom = "red solid 2px";
        button.disabled = true;
        buttonCancelar.style.visibility = 'hidden';
        return false;
    }
}

function cancelarPasaporte() {
    const inputPasaporte = document.getElementById("inputPasaporte");
    const buttonCancelar = document.getElementById("botonCancelar_pasaporte");
    const button = document.getElementById("botonPersonaRegistro");

    inputPasaporte.value = "";
    inputPasaporte.style.borderBottom = "2px solid #757575";
    inputPasaporte.disabled = false; //Desbloqueamos el input
    button.disabled = true; //Bloqueamos el boton de registrar
    buttonCancelar.style.visibility = 'hidden'; //ocultamos el botton de cancelar

}
