<?php
session_start();
if (!isset($_SESSION['usuario'])||!isset($_SESSION['admin'])) {
    header('Location:index.php');
    die();
}

require_once 'bd.php';
require_once 'src/generadoresInterfaz.php';

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no"/>

        <!-- BootStrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
       
        <link rel="stylesheet" href="css/style.css"/>
        <link rel="stylesheet" href="css/form.css"/>

        <title>Personalist - Borrar</title>
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

           
                
            <form class="" action="src/dropdatabase.php" method="POST">
                <input type="submit" class="btn btn-danger" id="eliminarBtn" name="eliminar" value="ELIMINAR LA BASE DE DATOS COMPLETAMENTE"/>
                <input type="hidden" id="db_name" name="db_name" value="b15_31953594_personalist"/>
            </form>
                                  
                
        </main>
        <footer class="navbar navbar-fixed-bottom">
            <?php
                imprimirFooter();
            ?>
        </footer>
        
        <!-- Scripts -->
        <script src="js/validarregistro.js"></script>
        <script src="js/gestiondeusuarios.js"></script>
        <script src="js/menu.js"></script>
         <!-- FontAwesome-->
        <script src="https://kit.fontawesome.com/4584823653.js" crossorigin="anonymous"></script>
    </body>
</html>