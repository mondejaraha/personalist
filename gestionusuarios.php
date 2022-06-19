<?php
session_start();
if (!isset($_SESSION['usuario'])||!isset($_SESSION['admin'])) {
    header('Location:index.php');
    die();
}

require_once 'bd.php';
require_once 'src/generadoresInterfaz.php';

if (isset($_POST['alta'])) {
    //si se han enviado los datos, creamos el usuario
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];

    if(existeUsuario($usuario)||existeEmail($email)){
      
        //error al registrar
        $error_registro = true;
        
    }
    else{
        insertarUsuario($usuario,$password,$nombre,$apellidos,$email);
    }
}
if (isset($_POST['eliminar'])) {
    //si se han enviado los datos, creamos el usuario
    eliminarUsuario($_POST['idusuario']);
}

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

        <title>Personalist - Usuarios</title>
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

            <div class="container">
                <div class="row mt-3">
                    <div class="col">
                        <h1 class="text-center shadow titulo-main">Gestión de Usuarios</h1>
                    </div>
                </div>
                <div class="row">
                    <div id="titulo" class="col text-end visible">
                    </div>
                    <div class="col text-end">   
                        <button id="mostrarAltaBt" class="btn btn-success col mt-4"><i class="fa-solid fa-circle-plus"></i> Nuevo usuario</button>
                    </div>
                </div>

                <div class="row form oculto mt-0" value="false" id="altaForm">
                    
                    <h1 class="formulario">Nuevo Usuario</h1>
    
                    <form action="" method="POST">
                        <div class="top-row">
                            <div class="field-wrap">
                                <label for="nombre" class="label">
                                    Nombre<span class="req">*</span>
                                </label>
                                <input type="text" required autocomplete="on" id="nombre" name="nombre" placeholder="Nombre" maxlength="20"/>
                            </div>
    
                            <div class="field-wrap">
                                <label for="apellidos" class="label">
                                    Apellido<span class="req">*</span>
                                </label>
                                <input type="text"required autocomplete="off" id="apellidos" name="apellidos" placeholder="Apellidos" maxlength="45"/>
                            </div>
                        </div>
    
                        <div class="field-wrap">
                            <label for="email" class="label">
                                Correo Electron<span class="req">*</span>
                            </label>
                            <input type="email"required id="email" name="email" placeholder="Correo electrónico"/>
                        </div>
                        
                        <div class="field-wrap">
                            <label for="usuario" class="label">
                                Usuari<span class="req">*</span>
                            </label>
                            <input type="text" required autocomplete="off" id="usuario" name="usuario" placeholder="Usuario"/>
                        </div>
    
                        <div class="field-wrap">
                            <label for="password" class="label">
                                Password<span class="req">*</span>
                            </label>
                            <input type="password"required autocomplete="off" id="password" name="password" placeholder="Contraseña"/>
                        </div>
    
                        <div class="fila">
                            <label class="otrolabel" for="rol">Rol</label>
                            <select class="" id="rol" name="rol">
                                <option value="u" selected="">Usuario General</option>
                                <option value="a">Administrador</option>
                            </select>
                        </div>
    
                        <input type="submit" class="boton" id="registrarBt" name="alta" value="dar de alta"/>
    
                    </form>
                    
                    <?php
                            //si venimos de intento de registro sesión
                            if($error_registro)
                            echo '<p class="error">No se completó el registro debido a que el email o el nombre de usuario 
                            ya se encuentran en la base de datos.</p>';
                    ?>
                    
    
                    <div id="errores" class="error"></div>
                </div> <!-- /form -->
                
                <div class="row">
                    <table class="table table-striped table-hover table-dark table-sm mt-3 text-center">
                        <thead>
                            <tr class="text-center">
                                <th class="col">Usuarios</th>
                                <th class="col">Email</th>
                                <th class="col">Perfil</th>
                                <th class="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $usuarios = recuperarUsuarios();
                            //imprimimos las listas del usuario
                            foreach ($usuarios as $usuario) {
                                //obtenemos los parámetros de cada lista de la tabla
                                $idusuario = $usuario->idusuario;
                                $user = $usuario->user;
                                $email = $usuario->email;
                            
                                switch($usuario->rol){
                                    case 'a': 
                                        $rol = '<i class="fa-solid fa-lock"></i>'.' Admin';
                                        break;
                                    case 'u': 
                                        $rol = '<i class="fa-solid fa-globe"></i>'.' General';
                                }

                        
                                echo '<tr>
                                        <td class="text-center">' . $user . '</td>
                                        <td class="text-center">' . $email . '</td>
                                        <td class="text-center">' . $rol . '</td>
                                        <td class="">
                                            <div class="justify-content-md-center">
                                                <form class="" action="gestionusuarios.php" method="POST">
                                                    <input type="submit" class="btn btn-danger" id="eliminarBtn" name="eliminar" value="Eliminar"/>
                                                    <input type="hidden" id="idusuario" name="idusuario" 
                                                    value="'.$idusuario.'"/>
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
        
        <!-- Scripts -->
        <script src="js/validarregistro.js"></script>
        <script src="js/gestiondeusuarios.js"></script>
        <script src="js/menu.js"></script>
        <script src="js/formulario.js"></script>
         <!-- FontAwesome-->
        <script src="https://kit.fontawesome.com/4584823653.js" crossorigin="anonymous"></script>
    </body>
</html>