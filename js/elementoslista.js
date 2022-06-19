function iniciar(){

    //incluimos jQuery
    let script = document.createElement("script");
    script.src = 'https://code.jquery.com/jquery-3.6.0.js';
    //script.type = 'text/javascript';
    document.getElementsByTagName('head')[0].appendChild(script);


    //asociamos la función añadir al boton de añadir
    document.getElementById('additem').addEventListener("submit",anadirItem3,false);

    //asociamos la función del evento borrar a todos los botones que borran un elemento de la lista
    document.querySelectorAll('.borradores').forEach(function(formulario) {
        formulario.addEventListener("submit",borrarItem,false);
    })

    document.querySelector('.menu_bar').addEventListener("click",mostrarOcultarMenu,false);


}//Fin iniciar

function anadirItem(){

    //recuperamos el título seleccionado
    let title = document.getElementById("peliculaInput").value;

    //recuperamos el valor del atributo data-id (el iditem) del título seleccionado
    let iditem = document.querySelector("#listapeliculas option[value='"+title+"']").dataset.id;

    //recuperamos el id de la lista en la que estamos trabajando
    let idlista = document.getElementById("idlista").value;

    //manejamos el evento submit del formulario
    $("#additem").submit(function(event) {
        event.preventDefault();

        // let urlform = $("#additem").attr('action');

        $.ajax({            
            type: "POST",
            url: "../src/anadiritemalista.php",
            data: {
                iditem: iditem,
                idlista: idlista
            },
            dataType: "JSON",
            success: function(pelicula)
            {
                //si la petición funcionó añadimos el elemento a la tabla
                let fila = document.getElementById("tablaitems").insertRow(-1);

                let htmlfila = '<td class="text-center">' + pelicula.idpelicula + '</td>' +
                    '<td class="text-center">' + pelicula.title + '</td>' +
                    '<td class="text-center">'+
                    '<div class="row justify-content-md-center">' +
                    '</div>'+
                    '</td>';

                fila.innerHTML = htmlfila;

                //el formulario me toca añadirlo "a mano" ya que no se añadía al documento cuando utilizaba htmlfila
                let formulario = document.createElement("form");
                formulario.setAttribute("class","");
                formulario.setAttribute("id","borraritem");
                formulario.setAttribute("action","borrar.php");
                formulario.setAttribute("method","POST");

                var campo = document.createElement("input");
                campo.setAttribute("type","submit");
                campo.setAttribute("class","btn btn-danger");
                campo.setAttribute("id","borrarBtn");
                campo.setAttribute("value","Borrar");

                formulario.appendChild(campo);

                var campo2 = document.createElement("input");
                campo2.setAttribute("type","hidden");
                campo2.setAttribute("id","iditem");
                campo2.setAttribute("value",pelicula.idpelicula);

                formulario.appendChild(campo2);

                fila.lastElementChild.lastElementChild.appendChild(formulario);

            }
        });
    });
}//Fin añadir item

function anadirItem2(event){
    //manejamos el evento submit del formulario
    event.preventDefault();
    //recuperamos el título seleccionado
    let title = document.getElementById("peliculaInput").value;

    //recuperamos el valor del atributo data-id (el iditem) del título seleccionado
    let iditem = document.querySelector("#listapeliculas option[value='"+title+"']").dataset.id;

    //recuperamos el id de la lista en la que estamos trabajando
    let idlista = document.getElementById("idlista").value;



    // let urlform = $("#additem").attr('action');

    $.ajax({            
        type: "POST",
        url: "../src/anadiritemalista.php",
        data: {
            iditem: iditem,
            idlista: idlista
        },
        dataType: "JSON",
        success: function(pelicula)
        {
            //si la petición funcionó añadimos el elemento a la tabla
            let fila = document.getElementById("tablaitems").insertRow(-1);

            let htmlfila = '<td class="text-center">' + pelicula.idpelicula + '</td>' +
                '<td class="text-center">' + pelicula.title + '</td>' +
                '<td class="text-center">'+
                '<div class="row justify-content-md-center">' +
                '</div>'+
                '</td>';


            fila.innerHTML = htmlfila;

            //el formulario me toca añadirlo "a mano" ya que no se añadía al documento cuando utilizaba htmlfila
            let formulario = document.createElement("form");
            formulario.setAttribute("class","");
            formulario.setAttribute("id","borraritem");
            formulario.setAttribute("action","borrar.php");
            formulario.setAttribute("method","POST");
            formulario.addEventListener("submit",borrarItem,false);

            var campo = document.createElement("input");
            campo.setAttribute("type","submit");
            campo.setAttribute("class","btn btn-danger");
            campo.setAttribute("id","borrarBtn");
            campo.setAttribute("value","Borrar");

            formulario.appendChild(campo);

            var campo2 = document.createElement("input");
            campo2.setAttribute("type","hidden");
            campo2.setAttribute("id","iditem");
            campo2.setAttribute("value",pelicula.idpelicula);

            formulario.appendChild(campo2);

            fila.lastElementChild.lastElementChild.appendChild(formulario);
        }
    });

}//Fin añadir item

function anadirItem3(event){
    //manejamos el evento submit del formulario
    event.preventDefault();
    //recuperamos el título seleccionado
    let title = document.getElementById("peliculaInput").value;

    //recuperamos el valor del atributo data-id (el iditem) del título seleccionado
    let iditem = document.querySelector("#listapeliculas option[value='"+title+"']").dataset.id;

    //recuperamos el id de la lista en la que estamos trabajando
    let idlista = document.getElementById("idlista").value;



    // let urlform = $("#additem").attr('action');

    $.ajax({            
        type: "POST",
        url: "../src/anadiritemalista.php",
        data: {
            iditem: iditem,
            idlista: idlista
        },
        dataType: "JSON",
        success: function(pelicula)
        {
            //si la petición funcionó añadimos el elemento a la tabla
            let contenedor = document.getElementById("elementos");

            let htmlelemento = '<div class="row h-100 shadow-sm g-3 m-1 p-3 bg-success bg-gradient bg-opacity-50 text-                      white border border-opacity-50 rounded rounded-4 border-1">' +
                '<div class="col-4">'+
                '<img class="iconolista mx-auto d-block" src="https://image.tmdb.org/t/p/w500' + pelicula.poster_path + '"/>' +
                '</div>'+
                '<div class="col-8">'+
                '<h4 class="">' + pelicula.title +'</h4>'+
                '<p class="">' + new Date(pelicula.release_date).getFullYear() +'</p>' +
                '</div>'+
                '</div>';

            let item = document.createElement("div");
            item.setAttribute("class","col-lg-4");
            item.innerHTML = htmlelemento;

            contenedor.appendChild(item);


            //el formulario me toca añadirlo "a mano" ya que no se añadía al documento cuando utilizaba htmlfila
            let formulario = document.createElement("form");
            formulario.setAttribute("class","borradores");
            formulario.setAttribute("id","borraritem");
            formulario.setAttribute("action","");
            formulario.setAttribute("method","POST");
            formulario.addEventListener("submit",borrarItem,false);

            let campo = document.createElement("input");
            campo.setAttribute("type","submit");
            campo.setAttribute("class","btn btn-secondary");
            campo.setAttribute("id","borrarBtn");
            campo.setAttribute("value","Borrar");

            formulario.appendChild(campo);

            let campo2 = document.createElement("input");
            campo2.setAttribute("type","hidden");
            campo2.setAttribute("id","iditem");
            campo2.setAttribute("value",pelicula.idpelicula);

            formulario.appendChild(campo2);

            contenedor.lastElementChild.lastElementChild.lastElementChild.appendChild(formulario);


        }
    });

}//Fin añadir item

function borrarItem(event){

    //manejamos el evento submit del formulario
    event.preventDefault();

    //recuperamos el valor del atributo data-id (el iditem) del título seleccionado
    let iditem = event.target.lastElementChild.value;

    //recuperamos el id de la lista en la que estamos trabajando
    let idlista = document.getElementById("idlista").value;

    $.ajax({            
        type: "POST",
        url: "../src/borraritemalista.php",
        data: {
            iditem: iditem,
            idlista: idlista
        },
        success: function(respuesta)
        {
            event.target.parentElement.parentElement.parentElement.remove();
        }
    });

}//Fin borrar item

var mayor = true;


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


window.onload = iniciar;

window.onresize = eliminarToggle;







