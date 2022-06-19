

function iniciar_menu(){

    //incluimos jQuery
    let script = document.createElement("script");
    script.src = 'https://code.jquery.com/jquery-3.6.0.js';
    //script.type = 'text/javascript';
    document.getElementsByTagName('head')[0].appendChild(script);


    //asociamos la función añadir al boton de menu
    document.querySelector('.menu_bar').addEventListener("click",mostrarOcultarMenu,false);


}//Fin iniciar


function mostrarOcultarMenu(){

    $('.toggler').toggle("slow");
    
			
}

function eliminarToggle(){
    
    if(mayor && window.innerWidth<650){
        //si era mayor y la hacemos pequeña
        mayor = false;
        
    }else {
        
        if(!mayor && window.innerWidth>650 && document.querySelector('.toggler').style.display == "none"){
            //si era menor y la hacemos grande
            mayor = true;
            $('.toggler').toggle("");
        }
    }
}

var mayor = true;

if (document.addEventListener){
    window.addEventListener('load',iniciar_menu,false);
} else {
    window.attachEvent('onload',iniciar_menu);    
}

window.onresize = eliminarToggle;


