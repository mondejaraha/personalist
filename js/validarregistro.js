//función que se ejecuta al cargar la página
function iniciar_validar_registro(){

    //asociamos la función validar al boton de submit
    document.getElementById('registrarBt').onclick = validar;
    
    
}

function validar(submit){
    limpiar();
    
    //validamos los campos del registro
    if(validarNombre() & validarApellidos() & validarUsuario() & validarPassword() & validarEmail()){
        //todos los campos son correctos
    }else{
        //hay algún campo incorrecto, inhabilitamos el action del submit
        submit.preventDefault();
    }
}

//funcion para borrar el contenido de los errores
function limpiar(){
    //borramos el contenido de los div
    document.getElementById('errores').innerHTML ="";

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


//Funciones que validan los campos de texto NOMBRE y APELLIDOS. 
function validarNombre(){
    
    //comprobamos el nombre
    let elemento = document.getElementById('nombre');
    let nombre = elemento.value;
    
    let patron = /^([A-Za-zñÁÉÍÓÚáéíóú.]+[\s]*)+$/;
    if (!nombre.match(patron)){
        tratarError('El nombre solo debe contener texto',elemento);
        return false;
    }
    else{
        return true;
    }
}
function validarApellidos(){
    
    //comprobamos los apellidos
    let elemento = document.getElementById('apellidos');
    let apellidos = elemento.value;
   
    let patron = /^([A-Za-zñÁÉÍÓÚáéíóú.]+[\s]*)+$/;   
    if (!apellidos.match(patron)){
        tratarError('Los apellidos solo deben contener texto', elemento);
        return false;
    }
    else{
        return true;
    }
}


//Función que valida el E-MAIL utilizando una expresión regular que nos permite comprobar que el e-mail sigue un formato correcto.
function validarEmail(){
    //comprobamos el email
    
    let elemento = document.getElementById('email');
    let email = elemento.value.toLowerCase();
    console.log(email);
    /*
    vamos a estudiar la cadena en partes antes y después de la @
    /^[a-z\d]+ La primera parte debe comenzar por una letra o número. Puede tener varias ocurrencias de esos caracteres
    ([\.\_]?[a-z\d]+)+ la siguiente subcadena puede contener o no '.' o '_' y con la ? limitamos las ocurrencias a 1 seguida como máximo
    luego pueden seguir más letras o numeros al '.' o '_'.
    ahí aparece la @
    [a-z\d]+ después tiene que venir al menos una letra o numero
    (\.[a-z]+)+ hasta llegar al punto y a partir de ahí tienen que venir una o más subcadenas del tipo .es que pueden estar concatenadas ej .es.com.info
    */
    let patron = /^[a-z\d]+([\.\_]?[a-z\d]+)+@[a-z\d]+(\.[a-z]+)+$/;
    if (!email.match(patron)|| email.length > 40){
        tratarError('El email debe tener el formato algo@algo.algo con un máximo de 40 caracteres',elemento);
        return false;
    }
    else{
        return true;
    }
}


//Validar el campo usuario. 
function validarUsuario(){
    
    //comprobamos el username
    let elemento = document.getElementById('usuario');
    let usuario = elemento.value;
   
    let patron = /^[A-Za-z0-9_\.]{5,20}$/;   
    if (!usuario.match(patron)){
        tratarError('El nombre de usuario tiene que medir entre 5 y 20 caracteres y solo puede contener letras, números, _ y .', elemento);
        return false;
    }
    else{
        return true;
    }
}


//Función que valida el campo password. 
function validarPassword(){
    //comprobamos la contraseña
    let elemento = document.getElementById('password');
    let password = elemento.value;
   
    let patron = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){8,25}$/;   
    
    if (!password.match(patron)){
        tratarError('La contraseña tiene que medir entre 8 y 25 caracteres y al menos una mayúscula, una minúscula, un dígito y un carácter especial.', elemento);
        return false;
    }
    else{
        return true;
    }
}

if (document.addEventListener){
    window.addEventListener('load',iniciar_validar_registro,false);
} else {
    window.attachEvent('onload',iniciar_validar_registro);    
}


