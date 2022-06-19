

//función que se ejecuta al cargar la página
function iniciar(){

    //incluimos jQuery
    let script = document.createElement("script");
    script.src = 'https://code.jquery.com/jquery-3.6.0.js';
    //script.type = 'text/javascript';
    document.getElementsByTagName('head')[0].appendChild(script);


    //asociamos la función añadir al boton de menu
    document.querySelector('.menu_bar').addEventListener("click",mostrarOcultarMenu,false);
    //asociamos la función validar al boton de submit
    document.getElementById('crearListaBt').onclick = validar;

}

function validar(submit){

    // Validar los campos del formulario que vamos a insertar en la BD
    if(validarNombre() & validarPrivacidad() & validarCategoria() & validarDescripcion()){
        //todos los campos son correctos
        alert("Lista insertada correctamente");
    }else{
        //hay algún campo incorrecto, inhabilitamos el action del submit
        submit.preventDefault();
    }
}

//funcion para añadir el error al contenedor de errores y poner el foco en donde toca
//recibe el texto que hay que mostrar y el elemento del error
function tratarError(texto, elemento){
    var parrafo = document.createElement("p");
    parrafo.innerHTML = texto;
    document.getElementById('errores').appendChild(parrafo);
    elemento.className = "error";
    elemento.focus();
}

//Función que valida el nombre de la lista
function validarNombre(){
    //comprobamos el nombre
    let elemento = document.getElementById('nombrelista');
    let nombre = elemento.value;
    //hemos puesto que tiene que empezar por mayúscula
    if (nombre.length>0 && nombre.length<26){
         return true;
    }
    else{
        tratarError('El nombre no puede superar los 25 caracteres',elemento);
        return false;
    }
}

//Función que valida la privacidad de la lista
function validarPrivacidad(){
    //comprobamos la edad
    let elemento = document.getElementById('privacidad');
    let privacidad = elemento.value;
    
    //la privacidad tiene que cumplir el patrón de los valores posibles
    let patron = /^[gp]{1}$/;
    if (!privacidad.match(patron)){
        tratarError('El valor privacidad no es correcto',elemento);
        return false;
    }
    else{
        return true;
    }
}

//Función que valida la privacidad de la lista
function validarCategoria(){
    //comprobamos la edad
    let elemento = document.getElementById('categoria');
    let categoria = elemento.value;
    
    //la categoría tiene que cumplir el patrón de los valores posibles
    let patron = /^[lms]{1}$/;
    if (!categoria.match(patron)){
        tratarError('El valor categoría no es correcto',elemento);
        return false;
    }
    else{
        return true;
    }
}

//Función que valida la descripción de la lista
function validarDescripcion(){
    //comprobamos la edad
    let elemento = document.getElementById('descripcion');
    let descripcion = elemento.value;
    
    if (descripcion.length>200){
        tratarError('La descripción no puede exceder de 200 caracteres.',elemento);
        return false;
    }
    else{
        return true;
    }
}

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

window.onload = iniciar;

window.onresize = eliminarToggle;


