const email = document.querySelector('#email');
const celular = document.querySelector('#celular');
const asunto = document.querySelector('#asunto');
const mensaje = document.querySelector('#mensaje');
const nombre = document.querySelector('#nombre');




email.addEventListener('blur', validarCorreo);
celular.addEventListener('blur', validarCelular);
asunto.addEventListener('blur', asuntoA);
mensaje.addEventListener('blur', mensajeF);
nombre.addEventListener('blur', nombreFull);





function validarCorreo(e){
    e.preventDefault();
    if(e.target.value <= 0){
        e.target.style.borderColor = '2px solid red';
    }
    if(e.target.type === 'email'){
        const er = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
        if(er.test(e.target.value)){            
            e.target.style.borderBottom='#0a9d00 solid 2px';
            return true;            
        }else{
            e.target.style.borderBottom='2px solid red';
        }
    }    
}


function validarCelular(e){
    e.preventDefault();
    if(e.target.value <= 0){
        e.target.style.borderColor = '2px solid red';
    }   
    if(e.target.type === 'tel'){
        const er = /^[0-9]*(\.?)[0-9]+$/;
        if(er.test(e.target.value)){            
            e.target.style.borderBottom='#0a9d00 solid 2px';
            return true;            
        }else{
            e.target.style.borderBottom='2px solid red';
        }
    }
}

function asuntoA(e){
    e.preventDefault();
    if(e.target.value <= 0){
        e.target.style.borderColor = '2px solid red';
    }
    if(e.target.type === 'text'){
        const er =  /^.{3,}$/s;
        if(er.test(e.target.value)){            
            e.target.style.borderBottom='#0a9d00 solid 2px';
            return true;            
        }else{
            e.target.style.borderBottom='2px solid red';
        }
    }    
}

function mensajeF(e){
    e.preventDefault();
    if(e.target.value <= 0){
        e.target.style.borderColor = '2px solid red';
    }
    if(e.target.type === 'textarea'){
        const er =  /^.{5,}$/;
        if(er.test(e.target.value)){            
            e.target.style.borderBottom='#0a9d00 solid 2px';
            return true;            
        }else{
            e.target.style.borderBottom='2px solid red';
        }
    }    
}

function nombreFull(e){
    e.preventDefault();
    if(e.target.value <= 0){
        e.target.style.borderColor = '2px solid red';
    }
    if(e.target.type === 'text'){
        const er =  /^([A-Z]{1}[a-zñáéíóú]+[\s]*)+$/;
        if(er.test(e.target.value)){            
            e.target.style.borderBottom='#0a9d00 solid 2px';
            return true;            
        }else{
            e.target.style.borderBottom='2px solid red';
        }
    } 
}