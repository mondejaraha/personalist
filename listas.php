<?php 
//Comprobamos que la sesión este iniciada
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location:login.php');
    die();
}

require_once 'bd.php';
require_once 'src/generadoresInterfaz.php';

if(isset($_POST['idlistaborrar'])){
    
    eliminarLista(intval($_POST['idlistaborrar']));

}

?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <!-- BootStrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
       
        <link rel="stylesheet" href="css/style.css"/>
        <link rel="stylesheet" href="css/form.css"/>
        
        <title>Personalist - Tus listas</title>
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
            <div class="container mt-0">
                <div class="row mt-3">
                    <div class="col">
                        <h1 class="text-center shadow titulo-main">Tus Listas</h1>
                    </div>
                </div>

                <div class="row">
                    <div id="titulo" class="col text-end visible">
                    </div>
                    <div class="col text-end">   
                        <a class="btn btn-success col mt-4" href="nuevalista.php">  <i class="fa-solid fa-circle-plus"></i> Nueva Lista </a>
                    </div>
                </div>
    
               
                <div class="row">
                    <table class="table table-striped table-hover table-dark table-sm mt-3 ">
                        <thead>
                            <tr class="text-center">
                                <th class="col-4">Nombre de la lista</th>
                                <th class="col-2 text-end">Categoría</th>
                                <th class="col-2">Privacidad</th>
                                <th class="col-2"></th>
                                <th class="col-2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $lists = recuperarListasUsuario($_SESSION['usuario']);
                            //imprimimos las listas del usuario
                            foreach ($lists as $lista) {
                                //obtenemos los parámetros de cada lista de la tabla
                                $idlista = $lista->idlista;
                                $nombre = $lista->nombrelista;
                            
                                switch($lista->categoria){
                                    case 'm': 
                                        $categoria = "Películas";
                                        break;
                                    case 'l': 
                                        $categoria = "Libros";
                                        break;
                                    case 's': 
                                        $categoria = "Series";
                                }

                                switch($lista->privacidad){
                                    case 'g': 
                                        $privacidad = '<i class="fa-solid fa-globe"></i>';
                                        break;
                                    case 'p': 
                                        $privacidad = '<i class="fa-solid fa-lock"></i>';
                                        break;
                                }
                        
                                echo '<tr>
                                        <td class="text-center">' . $nombre . '</td>
                                        <td class="text-end">' . $categoria . '</td>
                                        <td class="text-center">' . $privacidad . '</td>
                                        <td class="">
                                            <div class="justify-content-md-center">
                                                <form class="" action="elementoslista.php" method="POST">
                                                    <input type="submit" class="btn fondo-anaranjado" id="editarBtn" value="Ver"/>
                                                    <input type="hidden" id="idlista" name="idlista" 
                                                    value="'.$idlista.'"/>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="">
                                            <div class="justify-content-md-center">
                                                <form class="" action="listas.php" method="POST">
                                                    <input type="submit" class="btn fondo-anaranjado" id="eliminarBtn" name="eliminar" value="Eliminar"/>
                                                    <input type="hidden" id="idlistaborrar" name="idlistaborrar" 
                                                    value="'.$idlista.'"/>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
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