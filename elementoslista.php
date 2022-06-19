<?php 
//Comprobamos que la sesión este iniciada
session_start();
require_once 'src/generadoresInterfaz.php';

if (!isset($_SESSION['usuario'])) {
    
}
require_once 'bd.php';
if (!isset($_POST['idlista'])){
    header('Location:error.html');
    die();
}else{
    
    $lista = recuperarLista($_POST['idlista']); 
    $items = recuperarElementosLista($_POST['idlista']); 

}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <!-- BootStrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <!--Mi estilo-->
        <link rel="stylesheet" href="css/style.css"/>
        <link rel="stylesheet" href="css/form.css"/>
        <title>Personalist - Tu lista</title>
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
                    </div>
                </div>
                <div class="row m-3">
                    <form action="error.php" method="post" id="additem" name="additem">
                        <div class="form-group row g-2 sinpadding sinmargen"> 
                            <label for="peliculaInput" class="overflow-visible sinmargen col-2 offset-1 text-start mt-3 text-nowrap">Añadir películas</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="peliculaInput" id="peliculaInput" autocomplete="off" list="listapeliculas" placeholder="Escribe el título">
                                <datalist id="listapeliculas">
                                <?php
                                    //añadimos las películas al datalist
                                    $peliculas = recuperarPeliculas();    
                                    foreach($peliculas as $pelicula){
                                        echo '<option data-id="'.$pelicula->idpelicula.'" value="'.$pelicula->title.'"></option>';
                                    }
                                ?>                    
                                </datalist>
                            </div>
                            <div class="col-sm-2">
                                <input type="hidden" name="idlista" id="idlista" value="<?php echo $_POST['idlista']; ?>">
                                <input type="submit" class="btn btn-primary form-control px-3 btn-block" id="anadirBt" name="anadir" value="Añadir">
                            </div>
                            <div class="col-sm-2">
                                <a class="btn btn-info form-control" href="listas.php">Volver</a> 
                            </div>
                        </div>
                    </form>
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
                                            <img class="iconolista mx-auto d-block" alt="caratula" src="https://image.tmdb.org/t/p/w500'.$poster_path.'"/>
                                        </div>
                                        <div class="col-8">
                                            <h4 class="">'. $titulo .'</h4>
                                            <p class="">'.$año.'</p>
                                            <form class="borradores" id="borraritem" action="borrar.php" method="POST">
                                                <input type="submit" class="btn btn-secondary" id="borrarBtn" value="Borrar">
                                                <input type="hidden" id="iditem" value="'.$iditem.'">
                                            </form>
                                        </div>
                                    </div>
                                </div>';
                        }         
                    ?>
                </div>
            </div>
        </main>
        <footer class="navbar navbar-fixed-bottom">
            <?php
                imprimirFooter();
            ?>
        </footer>
        <!-- Scripts/Incluye Manejo del Menú -->
        <script src="js/elementoslista.js"></script>
        <!-- FontAwesome-->
        <script src="https://kit.fontawesome.com/4584823653.js" crossorigin="anonymous"></script>
    </body>
</html>