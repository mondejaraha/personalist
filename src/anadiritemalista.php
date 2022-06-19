<?php
require_once '../bd.php';
$idlista = $_POST['idlista'];
$iditem =$_POST['iditem'];

if(insertarItemALista($iditem,$idlista)){
    echo recuperarPeliculaJSON($iditem);
}else{
    echo "Ya existe";
}
?>