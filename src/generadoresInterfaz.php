<?php
session_start();

//función que crea el encabezado
function imprimirHeader(){
    if(!isset($_SESSION['usuario'])){
        imprimirHeaderSinSesion();
    }else{
        imprimirHeaderConSesionIniciada();
    }
}

function imprimirHeaderConSesionIniciada(){
    echo '<div class="cabecera">
                <a href="index.php"><img class="logo" src="img/logot.png" alt= "personalist" /></a> 
                <h1 class="">Donde tus listas se encuentran</h1>
            </div>
            <div class="sesion">
                <div class="input-group">
                    <label class="usuario">'.$_SESSION['usuario'].'</label>
                    <input type="hidden" class="form-control font-weight-bold" id="usu" name="usu" value="'.$_SESSION['usuario'].'" disabled/>
                </div>
                <a href="cerrar.php" class="botoncerrar">Cerrar Sesión</a>
            </div>';
            
}
function imprimirHeaderSinSesion(){
    echo ' <div class="cabecera">
            <a href="index.php"><img class="logo" src="img/logot.png" alt="personalist"/></a>
                <h1 class="">Donde tus listas se encuentran</h1>
            </div>
            <div class="sesion">
                <a href="login.php" class="login">Inicia Sesión</a>
                <a href="register.php" class="login">Regístrate</a>
            </div>';
    
}

//función que crea el navegador
function imprimirNav(){
    
    if(!isset($_SESSION['usuario'])){
        //imprimimos el menu vacío
        echo '<ul></ul>';
    }else{
        if (!isset($_SESSION['admin'])) {
            //si no tiene rol de administrador imprimir el nav de usuario general
            echo '<div class="menu_bar">
                    <a href="#" class="bt-menu"><i class="fa-solid fa-bars me-3"></i>Menú</a>
                </div>  

                <div class="toggler">
                    <ul id="menu_list">
                        <li><a href="index.php">LISTAS DESTACADAS</a></li>
                        <li><a href="listas.php">TUS LISTAS</a></li>
                        <li><a href="nuevalista.php">NUEVA LISTA</a></li>
                    </ul>
                </div>';
        }else{
            //imprimir el nav con menu de admin
            echo '<div class="menu_bar">
			        <a href="#" class="bt-menu"><i class="fa-solid fa-bars me-3"></i>Menú</a>
		        </div>  

                <div class="toggler">
                    <ul id="menu_list">
                        <li><a href="index.php">LISTAS DESTACADAS</a></li>
                        <li><a href="listas.php">TUS LISTAS</a></li>
                        <li><a href="nuevalista.php">NUEVA LISTA</a></li>
                        <li><a href="gestionusuarios.php">GESTIONAR USUARIOS</a></li>
                        <li><a href="borrarbd.php">BORRAR BD</a></li>
                    </ul>
                </div>';
        } 
    }
    
    

}

function imprimirFooter(){
    echo "<h6>©Personalist - Todos los derechos reservados - Antonio Mondéjar</h6>";
}

?>