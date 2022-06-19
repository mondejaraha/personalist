<?php
session_start();
if (!isset($_SESSION['usuario'])||!isset($_SESSION['admin'])) {
    header('Location:../index.php');
    die();
}
require_once '../bd.php';
if (isset($_POST['db_name'])) {
    if(borrarBD($_POST['db_name'])){
        //si se borra con éxito vamos a la página de inicialización
        session_destroy();
        header('Location:../arranque.php');
        die();
    }else echo "error al eliminar"; 
}
?>
