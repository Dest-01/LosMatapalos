
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
