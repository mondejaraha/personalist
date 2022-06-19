<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location:index.php');
    die();
}
if(!empty($_POST['nombrelista'])&&!empty($_POST['privacidad']&&!empty($_POST['categoria']))){
    //si han enviado los datos obligatorios, realizamos la inserción en la base de datos
    require_once 'bd.php';
    insertarLista($_POST['nombrelista'],$_POST['categoria'],$_POST['privacidad'],$_POST['descripcion'],$_SESSION['usuario']);
    header('Location:listas.php');
    die();
}
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

        <title>Personalist - Nueva Lista</title>
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

        <main class="container">
            <div class="form">
                <h1 class="formulario">Nueva Lista</h1>
                <!-- Formulario para crear una nueva lista -->
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" name="nuevalista">                            
                    <div class="fila">
                        <label class="otrolabel" for="nombrelista">Nombre</label>
                        <input type="text" class="" id="nombrelista" name="nombrelista" aria-describedby="nombrelista" placeholder="Nombre de la lista" maxlength="50" required="">
                    </div>


                    <div class="fila">
                        <label class="otrolabel" for="privacidad">Privacidad</label>
                        <select class="" id="privacidad" name="privacidad">
                            <option value="g" selected="">Pública</option>
                            <option value="p">Privada</option>
                        </select>
                    </div>
                    <div class="fila">
                        <label class="otrolabel" for="categoria">Categoría</label>
                        <select class="" id="categoria" name="categoria">
                            <option value="m" selected>Películas</option>
                            <option value="l">Libros</option>
                            <option value="s">Series</option>
                        </select>
                    </div>

                    <div class="fila">
                        <label class="otrolabel" for="descripcion">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" aria-describedby="descripcion" placeholder="Descripcion"></textarea>
                    </div>

                    <div class="fila">
                        <input type="submit" class="boton" id="crearListaBt" name="crearListaBt" value="Crear">
                    </div>    
                </form>
                <div class="">
                    <a class="aboton" href="listas.php">Volver</a>
                </div>
                <div id="errores" class="error"></div>
            </div> <!-- /form -->
           
        </main>
        <footer class="navbar navbar-fixed-bottom">
            <?php
                imprimirFooter();
            ?>
        </footer>
        <!-- FontAwesome-->
        <script src="https://kit.fontawesome.com/4584823653.js" crossorigin="anonymous"></script>
       
        <!-- Scripts con el menu incluído -->
        <script src="js/validarnuevalista.js"></script>
        
    </body>
</html>