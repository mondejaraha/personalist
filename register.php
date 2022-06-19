<?php
session_start();

require_once 'src/generadoresInterfaz.php';

if (isset($_SESSION['usuario'])) {
    header('Location:listas.php');
    die();
}
if (isset($_POST['registro'])) {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];

    require_once 'bd.php';

    if(!existeUsuario($usuario)&!existeEmail($email)){
        if(insertarUsuario($usuario,$password,$nombre,$apellidos,$email)){
            //usuario insertado correctamente, iniciamos sesión y vamos a pantalla de login
            //además recogemos que venimos de registro para que salga el mensaje de registro correto en login
            $_SESSION['registro']=true;
            header('Location:login.php');
            die();
        }
    }else{
            //error al registrar
            $error_registro = true;
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

        <title>Personalist - Registro</title>
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
                <div class="tab-content">  
                        <h1 class="formulario">Regístrate gratis</h1>

                        <form action="register.php" method="POST">
                            <div class="top-row">
                                <div class="field-wrap">
                                    <label for="nombre" class="label">
                                        First Name<span class="req">*</span>
                                    </label>
                                    <input type="text" required autocomplete="on" id="nombre" name="nombre" placeholder="Nombre" maxlength="20"/>
                                </div>

                                <div class="field-wrap">
                                    <label for="apellidos" class="label">
                                        Apellidos Apellidos<span class="req">*</span>
                                    </label>
                                    <input type="text"required autocomplete="off" id="apellidos" name="apellidos" placeholder="Apellidos" maxlength="45"/>
                                </div>
                            </div>

                            <div class="field-wrap">
                                <label for="email" class="label">
                                    Correo Electrónico<span class="req">*</span>
                                </label>
                                <input type="email"required id="email" name="email" placeholder="Correo electrónico"/>
                            </div>
                            
                            <div class="field-wrap">
                                <label for="usuario" class="label">
                                    Usuario<span class="req">*</span>
                                </label>
                                <input type="text" required autocomplete="off" id="usuario" name="usuario" placeholder="Usuario"/>
                            </div>

                            <div class="field-wrap">
                                <label for="password" class="label">
                                    Contraseña<span class="req">*</span>
                                </label>
                                <input type="password"required autocomplete="off" id="password" name="password" placeholder="Contraseña"/>
                            </div>

                            <input type="submit" class="boton" id="registrarBt" name="registro" value="Registrar"/>

                        </form>
                    
                    <p class="pform">¿Ya tiene una cuenta? Inicie sesión <a href="login.php">aquí</a></p>

                    

                    <?php
                            //si venimos de intento de registro sesión
                            if($error_registro)
                            echo '<p class="error">No se completó el registro debido a que el email o el nombre de usuario 
                            ya se encuentran en la base de datos.</p>';
                    ?>
                   

                </div><!-- tab-content -->

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
        
        <!-- Scripts -->
        <script src="js/validarregistro.js"></script>
        <script src="js/formulario.js"></script>
    </body>
</html><?php
session_start();

require_once 'src/generadoresInterfaz.php';

if (isset($_SESSION['usuario'])) {
    header('Location:listas.php');
    die();
}
if (isset($_POST['registro'])) {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];

    require_once 'bd.php';

    if(!existeUsuario($usuario)&!existeEmail($email)){
        if(insertarUsuario($usuario,$password,$nombre,$apellidos,$email)){
            //usuario insertado correctamente, iniciamos sesión y vamos a pantalla de login
            //además recogemos que venimos de registro para que salga el mensaje de registro correto en login
            $_SESSION['registro']=true;
            header('Location:login.php');
            die();
        }
    }else{
            //error al registrar
            $error_registro = true;
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

        <title>Personalist - Registro</title>
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
                <div class="tab-content">  
                        <h1 class="formulario">Regístrate gratis</h1>

                        <form action="register.php" method="POST">
                            <div class="top-row">
                                <div class="field-wrap">
                                    <label for="nombre" class="label">
                                        First Name<span class="req">*</span>
                                    </label>
                                    <input type="text" required autocomplete="on" id="nombre" name="nombre" placeholder="Nombre" maxlength="20"/>
                                </div>

                                <div class="field-wrap">
                                    <label for="apellidos" class="label">
                                        Apellidos Apellidos<span class="req">*</span>
                                    </label>
                                    <input type="text"required autocomplete="off" id="apellidos" name="apellidos" placeholder="Apellidos" maxlength="45"/>
                                </div>
                            </div>

                            <div class="field-wrap">
                                <label for="email" class="label">
                                    Correo Electrónico<span class="req">*</span>
                                </label>
                                <input type="email"required id="email" name="email" placeholder="Correo electrónico"/>
                            </div>
                            
                            <div class="field-wrap">
                                <label for="usuario" class="label">
                                    Usuario<span class="req">*</span>
                                </label>
                                <input type="text" required autocomplete="off" id="usuario" name="usuario" placeholder="Usuario"/>
                            </div>

                            <div class="field-wrap">
                                <label for="password" class="label">
                                    Contraseña<span class="req">*</span>
                                </label>
                                <input type="password"required autocomplete="off" id="password" name="password" placeholder="Contraseña"/>
                            </div>

                            <input type="submit" class="boton" id="registrarBt" name="registro" value="Registrar"/>

                        </form>
                    
                    <p class="pform">¿Ya tiene una cuenta? Inicie sesión <a href="login.php">aquí</a></p>

                    

                    <?php
                            //si venimos de intento de registro sesión
                            if($error_registro)
                            echo '<p class="error">No se completó el registro debido a que el email o el nombre de usuario 
                            ya se encuentran en la base de datos.</p>';
                    ?>
                   

                </div><!-- tab-content -->

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
        
        <!-- Scripts -->
        <script src="js/validarregistro.js"></script>
        <script src="js/formulario.js"></script>
    </body>
</html>