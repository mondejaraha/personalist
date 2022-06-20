<?php 
//Comprobamos que la base de datos está creada
require_once 'bd.php';
require_once 'src/generadoresInterfaz.php';

if (existeBD('personalist')) {
    //header('Location:index.php');
    //die();
}
else{
    //creamos todas las tablas
    inicializarBD();
    
    header('Location:index.php');
    die();
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <!-- BootStrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <link rel="stylesheet" href="css/style.css"/>
        <link rel="stylesheet" href="css/form.css"/>
        <title>Personalist</title>

        <script type="text/javascript">
            let peticionJSON;
            
            let peliculas = new Array();
            
            const iniciar = () => {   
                document.getElementById("cargarBT").disabled=true;
            
                let url="https://api.themoviedb.org/3/movie/top_rated?api_key=071770f4827f411710efaaa1dcd322bb&language=es-ES&page=";

                let minpage = 402;
                let maxpage = 501;
                
                for(var i=minpage;i<maxpage;i++)
                    pedirPeliculas(url+i);

                 //console.log(peliculas);
                
                 setTimeout(imprimirRes,3000);
                 setTimeout(enableCargarBt,5000);  
            } 
            
            function imprimirRes(){
                //añadimos el resultado al contenedor
                document.getElementById("peliculasjson").innerHTML = JSON.stringify(peliculas);
                console.log(JSON.stringify(peliculas));
                $.ajax({
                        type:"POST",
                        url:"cargarBD.php",
                        data:{pelis:peliculas},
                        dataType: "JSON",
                        success: function(respuesta){
                        alert(respuesta);
                    }
                });
            }

            async function pedirPeliculas(url) {
                const response = await fetch(url);
                const res= await response.json();
                //añadimos al array de peliculas cada pelicula de cada fetch
                res['results'].forEach(pelicula => peliculas.push(pelicula));
            }

            const enableCargarBt = () => {
                document.getElementById("cargarBT").disabled=false;
            }
            
            window.addEventListener("load", iniciar, false);

        </script>
    </head>
    <body>
        <header>
            <?php
            imprimirHeader();
            ?>
        </header>
        <nav class="menu borde">
            <?php
            imprimirNav();
            ?>
        </nav>
        <main class="">

            <h1 class="m-3 titulo-main">NO HAY BASE DE DATOS, ¡HAY QUE CREARLA! </h1>

            <form action="src/generarBD.php" method="POST">
                <button id="cargarBT" type="submit" class="boton">GENERAR BASE DE DATOS</button>
                <input type="hidden" name="generar" value="true"/>
            </form>

            <form action="cargarBD.php" method="POST">
                <button id="cargarBT" type="submit" class="">Cargar películas en la base de datos</button>
                <textarea id="peliculasjson" name="peliculasjson" rows="50"></textarea>
                <input type="hidden" name="cargado" value="true"/>
            </form>


        </main>
    </body>
    <!-- FontAwesome-->
    <script src="https://kit.fontawesome.com/4584823653.js" crossorigin="anonymous"></script>
</html>