<?php 
//Comprobamos que la sesión este iniciada
session_start();

require_once 'src/generadoresInterfaz.php';

if (!isset($_SESSION['usuario'])) {
    
}
require_once 'bd.php';
if (!isset($_GET['idlista'])){
    //header('Location:error.html');
    //die();
}else{
    
    $lista = recuperarLista($_GET['idlista']); 
    $items = recuperarElementosLista($_GET['idlista']); 

}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <!-- BootStrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <!--Mi estilo-->
        <link rel="stylesheet" href="css/style.css"/>
        <link rel="stylesheet" href="css/form.css"/>
        <title>Personalist - Lista</title>
        <link rel="icon" href="img/logot.png">
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
            <div class="container-fluid">   
                <div class="row mt-3">
                    <div class="col">
                        <h2 class="text-center shadow titulo-main">
                                <?php
                                    echo 'Lista: '.$lista->nombrelista;
                                ?> 
                        </h2>
                        <p class="descripcion">
                                <?php
                                    echo 'Descripción: '.$lista->descripcion;
                                ?> 
                        </p>
                        <div class="text-end mb-2">
                                <a class="btn fondo-anaranjado" href="index.php">Volver</a> 
                        </div>
                    </div>
                </div>
                <div id="elementos" class="row row-cols-lg-3 g-3">
                    <?php
                        foreach ($items as $item) {
                            //obtenemos los parámetros de cada elemento de la lista seleccionada
                            $iditem = $item->iditem;
                            $titulo = $item->title;
                            $año = $item->año;
                            $poster_path = $item->poster_path;

                            echo '<div class="col-lg-4">
                                    <div class="row h-100 shadow-sm g-3 m-1 p-3 bg-success bg-gradient bg-opacity-50 text-white border border-opacity-50 rounded rounded-4 border-1">
                                        <div class="col-4">
                                            <img class="iconolista mx-auto d-block" src="https://image.tmdb.org/t/p/w500'.$poster_path.'"/>
                                        </div>
                                        <div class="col-8">
                                            <h4 class="">'. $titulo .'</h4>
                                            <p class="">'.$año.'</p>
                                        </div>
                                    </div>
                                </div>';
                        }         
                    ?>
                </div>
        </main>
        <footer class="navbar navbar-fixed-bottom">
            <?php
                imprimirFooter();
            ?>
        </footer>

       
    </body>
    <!-- Scripts -->
    <script src="js/menu.js"></script>
    <!-- FontAwesome-->
    <script src="https://kit.fontawesome.com/4584823653.js" crossorigin="anonymous"></script>
</html>