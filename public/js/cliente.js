


(function () {
    var Util,
        __bind = function (fn, me) {
            return function () {
                return fn.apply(me, arguments);
            };
        };

    Util = (function () {
        function Util() {}

        Util.prototype.extend = function (custom, defaults) {
            var key, value;
            for (key in custom) {
                value = custom[key];
                if (value != null) {
                    defaults[key] = value;
                }
            }
            return defaults;
        };

        Util.prototype.isMobile = function (agent) {
            return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(agent);
        };

        return Util;

    })();

    this.WOW = (function () {
        WOW.prototype.defaults = {
            boxClass: 'wow',
            animateClass: 'animated',
            offset: 0,
            mobile: true
        };

        function WOW(options) {
            if (options == null) {
                options = {};
            }
            this.scrollCallback = __bind(this.scrollCallback, this);
            this.scrollHandler = __bind(this.scrollHandler, this);
            this.start = __bind(this.start, this);
            this.scrolled = true;
            this.config = this.util().extend(options, this.defaults);
        }

        WOW.prototype.init = function () {
            var _ref;
            this.element = window.document.documentElement;
            if ((_ref = document.readyState) === "interactive" || _ref === "complete") {
                return this.start();
            } else {
                return document.addEventListener('DOMContentLoaded', this.start);
            }
        };

        WOW.prototype.start = function () {
            var box, _i, _len, _ref;
            this.boxes = this.element.getElementsByClassName(this.config.boxClass);
            if (this.boxes.length) {
                if (this.disabled()) {
                    return this.resetStyle();
                } else {
                    _ref = this.boxes;
                    for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                        box = _ref[_i];
                        this.applyStyle(box, true);
                    }
                    window.addEventListener('scroll', this.scrollHandler, false);
                    window.addEventListener('resize', this.scrollHandler, false);
                    return this.interval = setInterval(this.scrollCallback, 50);
                }
            }
        };

        WOW.prototype.stop = function () {
            window.removeEventListener('scroll', this.scrollHandler, false);
            window.removeEventListener('resize', this.scrollHandler, false);
            if (this.interval != null) {
                return clearInterval(this.interval);
            }
        };

        WOW.prototype.show = function (box) {
            this.applyStyle(box);
            return box.className = "" + box.className + " " + this.config.animateClass;
        };

        WOW.prototype.applyStyle = function (box, hidden) {
            var delay, duration, iteration;
            duration = box.getAttribute('data-wow-duration');
            delay = box.getAttribute('data-wow-delay');
            iteration = box.getAttribute('data-wow-iteration');
            return box.setAttribute('style', this.customStyle(hidden, duration, delay, iteration));
        };

        WOW.prototype.resetStyle = function () {
            var box, _i, _len, _ref, _results;
            _ref = this.boxes;
            _results = [];
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                box = _ref[_i];
                _results.push(box.setAttribute('style', 'visibility: visible;'));
            }
            return _results;
        };

        WOW.prototype.customStyle = function (hidden, duration, delay, iteration) {
            var style;
            style = hidden ? "visibility: hidden; -webkit-animation-name: none; -moz-animation-name: none; animation-name: none;" : "visibility: visible;";
            if (duration) {
                style += "-webkit-animation-duration: " + duration + "; -moz-animation-duration: " + duration + "; animation-duration: " + duration + ";";
            }
            if (delay) {
                style += "-webkit-animation-delay: " + delay + "; -moz-animation-delay: " + delay + "; animation-delay: " + delay + ";";
            }
            if (iteration) {
                style += "-webkit-animation-iteration-count: " + iteration + "; -moz-animation-iteration-count: " + iteration + "; animation-iteration-count: " + iteration + ";";
            }
            return style;
        };

        WOW.prototype.scrollHandler = function () {
            return this.scrolled = true;
        };

        WOW.prototype.scrollCallback = function () {
            var box;
            if (this.scrolled) {
                this.scrolled = false;
                this.boxes = (function () {
                    var _i, _len, _ref, _results;
                    _ref = this.boxes;
                    _results = [];
                    for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                        box = _ref[_i];
                        if (!(box)) {
                            continue;
                        }
                        if (this.isVisible(box)) {
                            this.show(box);
                            continue;
                        }
                        _results.push(box);
                    }
                    return _results;
                }).call(this);
                if (!this.boxes.length) {
                    return this.stop();
                }
            }
        };

        WOW.prototype.offsetTop = function (element) {
            var top;
            top = element.offsetTop;
            while (element = element.offsetParent) {
                top += element.offsetTop;
            }
            return top;
        };

        WOW.prototype.isVisible = function (box) {
            var bottom, offset, top, viewBottom, viewTop;
            offset = box.getAttribute('data-wow-offset') || this.config.offset;
            viewTop = window.pageYOffset;
            viewBottom = viewTop + this.element.clientHeight - offset;
            top = this.offsetTop(box);
            bottom = top + box.clientHeight;
            return top <= viewBottom && bottom >= viewTop;
        };

        WOW.prototype.util = function () {
            return this._util || (this._util = new Util());
        };

        WOW.prototype.disabled = function () {
            return !this.config.mobile && this.util().isMobile(navigator.userAgent);
        };

        return WOW;

    })();

}).call(this);


wow = new WOW({
    animateClass: 'animated',
    offset: 100
});
wow.init();

//FUNCION DE ENVIAR EMAILS
(function () {
    // https://dashboard.emailjs.com/admin/integration
    emailjs.init('user_GMf53dmaF0FI8RLY0cj3V');
})();

window.onload = function () {

    const botonEnviar = document.getElementById("enviarMensaje");
    botonEnviar.disabled = true;

    document.getElementById('contact-form').addEventListener('submit', function (event) {
        event.preventDefault();
        // generate a five digit number for the contact_number variable
        this.contact_number.value = Math.random() * 100000 | 0;
        // these IDs from the previous steps
        emailjs.sendForm('service_xf6d5cg', 'template_oqin6bo', this)
            .then(function () {
                console.log('SUCCESS!');
                document.getElementById('nombre').value = '';
                document.getElementById('email').value = '';
                document.getElementById('celular').value = '';
                document.getElementById('asunto').value = '';
                document.getElementById('mensaje').value = '';
            }, function (error) {
                console.log('FAILED...', error);
            });
    });
}

function validar() {
    var nombreMensaje = document.getElementById("nombre").value;
    var emailMensaje = document.getElementById("email").value;
    var celularMensaje = document.getElementById("celular").value;
    var asuntoMensaje = document.getElementById("asunto").value;
    var mensajeMensaje = document.getElementById("mensaje").value;
    var nombreValidar = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9\s]+$/;
    var emailValidar = /(.+)@(.+)\.(.+)/i;
    var celulareValidar = /^\d{8}$/;
    var asuntoValidar = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9\s]+$/;
    var mensajeValidar = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9\s]+$/
    const botonEnviar = document.getElementById("enviarMensaje");
    if (nombreValidar.test(nombreMensaje) && emailValidar.test(emailMensaje) && celulareValidar.test(celularMensaje) && asuntoValidar.test(asuntoMensaje) && mensajeValidar.test(mensajeMensaje)) {
        botonEnviar.disabled = false;
    } else {
        botonEnviar.disabled = true;
    }
}


function ocultarContactar() {

    let boxContacto = document.getElementById("box_contacto");

    if (boxContacto.style.opacity == '1') {

        boxContacto.style.opacity = '0';

    } else {
        boxContacto.style.opacity = '1';
        boxContacto.style.transition = 'all 1.2s';
    }
}

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
function cancelarCedula(){
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

function cancelarCedulaResidencial(){
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

function cancelarPasaporte(){
    const inputPasaporte = document.getElementById("inputPasaporte");
    const buttonCancelar = document.getElementById("botonCancelar_pasaporte");
    const button = document.getElementById("botonPersonaRegistro");

    inputPasaporte.value = "";
    inputPasaporte.style.borderBottom = "2px solid #757575";
    inputPasaporte.disabled = false; //Desbloqueamos el input
    button.disabled = true; //Bloqueamos el boton de registrar
    buttonCancelar.style.visibility = 'hidden'; //ocultamos el botton de cancelar

}