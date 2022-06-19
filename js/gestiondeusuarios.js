//función que se ejecuta al cargar la página
function iniciar_gestion_usuarios(){
    
    //asociamos la función validar al boton de submit
    
    document.getElementById('mostrarAltaBt').onclick = mostrarFormulario;
    
    
}

function mostrarFormulario(){
    
    let contenedorFormulario = document.getElementById('altaForm');
    let titulo = document.getElementById('titulo');
        
    contenedorFormulario.classList.toggle('visible');
    contenedorFormulario.classList.toggle('oculto');
    
    titulo.classList.toggle('visible');
    titulo.classList.toggle('oculto');
    
    /*if(visible=='true'){
        
        contenedorFormulario.setAttribute('value',false);        
        contenedorFormulario.classList.remove('visible');
        contenedorFormulario.classList.add('oculto');
        
    }else{
        
        contenedorFormulario.setAttribute('value',true);
        contenedorFormulario.classList.remove('oculto');
        contenedorFormulario.classList.add('visible');

    }*/
}

if (document.addEventListener){
    window.addEventListener('load',iniciar_gestion_usuarios,false);
} else {
    window.attachEvent('onload',iniciar_gestion_usuarios);    
}

