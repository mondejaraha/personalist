<?php
require_once '../bd.php';
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);
if (isset($_POST['generar'])) {
    
    inicializarBD2();
    header('Location:../index.php');
    die(); 
}
?>
