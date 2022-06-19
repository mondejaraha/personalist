

function iniciar_formulario(){
    
    //asociamos la función añadir al boton de menu
    document.querySelectorAll('input').forEach(
        function(elemento){
        elemento.addEventListener("focus",ocultarReq,false);
        elemento.addEventListener("blur",mostrarReq,false);
    });


}//Fin iniciar


function ocultarReq(event){
    let id = event.target.attributes['id'].value; 
    document.querySelector("label[for='"+id+"']").classList.add("active");		
}

function mostrarReq(event){
    let id = event.target.attributes['id'].value; 
    document.querySelector("label[for='"+id+"']").classList.remove("active");		
}



if (document.addEventListener){
    window.addEventListener('load',iniciar_formulario,false);
} else {
    window.attachEvent('onload',iniciar_formulario);    
}



