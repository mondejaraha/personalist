<?php
session_start();
if(isset($_SESSION['usuario'])){
    //si la sesión esta establecida para un usuario la cerramos
    session_destroy();
}
//redirigimos a login
header('Location:index.php');
?>