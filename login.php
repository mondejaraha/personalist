<?php
session_start();

require_once 'src/generadoresInterfaz.php';

if (isset($_SESSION['usuario'])) {
    header('Location:listas.php');
    die();
}

//si venimos de intento de inicio de sesión validamos usuario para hacer login
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    require_once 'bd.php';
    if(validarUsuario($username,$password)){
        //credenciales correctas
        $_SESSION['usuario'] = $username;

        if(esAdmin($username)){
            $_SESSION['admin'] = true;
        }
        header('Location:index.php');
        die();
    }else{
        //credenciales incorrectas
        $credenciales_incorrectas = true;
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no"/>
        <link rel="stylesheet" href="css/style.css"/>
        <link rel="stylesheet" href="css/form.css"/>

        <title>Personalist - Login</title>
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
            <div class="form">
                 
                        <h1 class="formulario">Inicia sesión</h1>

                        <form action="login.php" method="POST">                            
                            <div class="field-wrap">
                                <label for="username" class="label">
                                    Usuario<span class="req">*</span>
                                </label>
                                <input type="text" required autocomplete="off"
                                       placeholder="Usuario" name="username" id="username"/>
                            </div>

                            <div class="field-wrap">
                                <label for="password" class="label">
                                    Contraseña<span class="req">*</span>
                                </label>
                                <input type="password"required autocomplete="off" placeholder="Contraseña" name="password" id="password"/>
                            </div>

                            <button type="submit" class="boton" name="login" id="loginBt" value="login">Iniciar Sesión</button>

                        </form>
                    
                    
                    <?php
                    if (isset($_SESSION['registro'])) {
                        //venimos de un registro exitoso
                        echo '<p class="exito">Se ha registrado correctamente. Ya puede iniciar sesión.</p>';
                        session_destroy();
                    }
                    else{
                        echo '<p class="pform">¿Todavía no tiene una cuenta? Cree una <a href="register.php">aquí</a></p>';
                    }

                    if($credenciales_incorrectas){
                        echo '<p class="error">Las credenciales introducidas no son correctas</p>';
                    }   
                    ?>
                    
               

            </div> <!-- /form -->
            
            <div id="errores"></div>
        </main>

        <footer class="navbar navbar-fixed-bottom">
            <?php
                imprimirFooter();
            ?>
        </footer>

    </body>
    <!-- Scripts-->
    <script src="js/formulario.js"></script>
    <!-- FontAwesome-->
    <script src="https://kit.fontawesome.com/4584823653.js" crossorigin="anonymous"></script>
</html>