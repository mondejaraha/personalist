<?php 
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

require_once 'bd.php';
require_once 'src/generadoresInterfaz.php';

//si no existe la base de datos vamos a la página donde la podemos crear
/*if (!existeBD('b15_31953594_personalist')) {
    header('Location:arrancar.php');
    die();
}*/

$listas_para_tarjeta = recuperarListasParaTarjeta();

?>
<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css"/>
        <link rel="stylesheet" href="css/form.css"/>
        <link rel="icon" href="img/logot.png">
        <title>Personalist - Home</title>
    </head>
    <body>
        <header>
            <?php
                imprimirHeader();
            ?>
        </header>
        <nav class="menu">
            <?php
                imprimirNav();
            ?>
        </nav>
        <main class="">
        <div class="container-fluid">   
                <div class="row mt-3">
                    <div class="col">
                        <h1 class="text-center shadow titulo-main">Listas Destacadas</h1>
                    </div>
                </div>
                
                <div id="elementos" class="row row-cols-lg-4 g-3">
                    <?php
                        $i = 1;
                        foreach ($listas_para_tarjeta as $lista) {
                            //obtenemos los parámetros de cada elemento de la lista seleccionada
                            $idlista = $lista->idlista;
                            $nombre = $lista->nombrelista;
                            $username = $lista->user;
                            $nelementos = $lista->nitems;

                            echo '<div class="col-md-4 h-100 tarjeta p-0">
                                    <a href="verlista.php?idlista='.$idlista.'">
                                    <div class="row h-100 shadow-sm g-3 m-1 p-3 bg-info bg-gradient bg-opacity-50 text-white border border-opacity-50 rounded rounded-5 border-1">
                                        <div class="col">
                                            <h4 class="text-secondary mb-3"><i class="fa-solid fa-hashtag me-1"></i>'.$i.' '.$nombre.'</h4>
                                            <p class=""><i class="fa-solid fa-user me-2"></i>'.$username.'</p>
                                            <p class=""><i class="fa-solid fa-list me-2"></i>Elementos de la lista: '.$nelementos.'</p>
                                        </div>
                                    </div>
                                    </a>
                            </div>';
                            
                            $i++;
                        }         
                    ?>
                </div>
             </main>
        <footer class="navbar navbar-fixed-bottom">
            <?php
                imprimirFooter();
            ?>
        </footer> 

        <!-- Scripts -->
        <script src="js/menu.js"></script>
        <!-- FontAwesome-->
        <script src="https://kit.fontawesome.com/4584823653.js" crossorigin="anonymous"></script>
    </body>
</html>