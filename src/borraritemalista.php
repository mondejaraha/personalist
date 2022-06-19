<?php
require_once '../bd.php';
$idlista = $_POST['idlista'];
$iditem =$_POST['iditem'];

if(borrarItemDeLista($iditem,$idlista)){
    echo "itemborrado";
}else{
    echo "No se puede borrar";
}
?>