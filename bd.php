<?php 
/**********Procedimientos Conexión y BD ********************************************/
function crearConexion(){
    $host = "sql108.byethost15.com";
    $db = "b15_31953594_personalist";
    $user = "b15_31953594";
    $pass = "personalist84";
    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
    try {
        $conexionBD=new PDO($dsn, $user, $pass);
     } catch (PDOException $e) {
         echo 'Falló la conexión: ' . $e->getMessage();
     }
     $conexionBD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     return $conexionBD;
}

function crearConexionSinBd(){
    $host = "sql108.byethost15.com";
    $user = "b15_31953594";
    $pass = "personalist84";
    $dsn = "mysql:host=$host;charset=utf8mb4";
    try {
        $conexionBD=new PDO($dsn, $user, $pass);
     } catch (PDOException $e) {
         echo 'Falló la conexión: ' . $e->getMessage();
     }
     $conexionBD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     return $conexionBD;
}

function existeBD($database){
    $conexionBD = crearConexionSinBd();
    $consulta="SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '{$database}'";
    $resultadoConsulta = $conexionBD->query($consulta);
    $conexionBD = null;
    try {
       if($resultadoConsulta->rowCount()>0){
           return true;
       }
       else{
           return false;
       };
    } catch (PDOException $ex) {
        die("Error al recuperar listas: " . $ex->getMessage());
    }
}

function inicializarBD(){
    $conexionBD = crearConexionSinBd();
    $queries = explode(';', file_get_contents('bd.sql'));
    foreach($queries as $query)
    {
        if($query != ''){
            $conexionBD->query($query); // Asumo un objeto conexión que ejecuta consultas
        }
    }
}

function inicializarBD2(){
    
    $conexionBD = crearConexionSinBd();
    $fileSQL = file_get_contents('sql/bdpersonalist.sql');

    /* Ejecutar consulta multiquery */
    $conexionBD->query($fileSQL);

    /* cerrar conexión */
    $conexionBD = null;
}

function borrarBD($schema){
    $conexionBD = crearConexion();
    $sentencia = $conexionBD->prepare("DROP DATABASE ".$schema);
    $result = $sentencia->execute();
    $conexionBD = null;
    if ($result) {
        return true;
    } else {
        return false;
    }
}

/*************************Procedimientos listas ********************************************/
function recuperarListas(){
    $conexionBD = crearConexion();
    $consulta="SELECT idlista, nombrelista FROM listas";
    $resultadoConsulta = $conexionBD->query($consulta);
    try {
        $listas=$resultadoConsulta->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $ex) {
        die("Error al recuperar listas: " . $ex->getMessage());
    }
    $conexionBD = null;
    return $listas;
}

function recuperarLista($idlista){
    $conexionBD = crearConexion();
    $consulta="SELECT * FROM listas WHERE idlista = {$idlista}";
    $resultadoConsulta = $conexionBD->query($consulta);
    try {
        $lista=$resultadoConsulta->fetch(PDO::FETCH_OBJ);
    } catch (PDOException $ex) {
        die("Error al recuperar listas: " . $ex->getMessage());
    }
    $conexionBD = null;
    return $lista;
}

function recuperarListasPublicas(){
    $conexionBD = crearConexion();
    $consulta="SELECT idlista, nombrelista FROM listas WHERE privacidad = 'g'";
    $resultadoConsulta = $conexionBD->query($consulta);
    try {
        $listas=$resultadoConsulta->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $ex) {
        die("Error al recuperar listas: " . $ex->getMessage());
    }
    $conexionBD = null;
    return $listas;
}

function recuperarListasParaTarjeta(){
    $conexionBD = crearConexion();
    $consulta="SELECT l.idlista, l.nombrelista, u.user, count(l.idlista) AS nitems
                FROM listas l INNER JOIN usuarios u ON l.idusuario = u.idusuario 
                INNER JOIN items_lista il ON il.idlista = l.idlista
                WHERE privacidad = 'g'
                GROUP BY l.idlista";
    $resultadoConsulta = $conexionBD->query($consulta);
    try {
        $listas=$resultadoConsulta->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $ex) {
        die("Error al recuperar listas: " . $ex->getMessage());
    }
    $conexionBD = null;
    return $listas;
}

function recuperarListasUsuario($usuario){
    $conexionBD = crearConexion();
    $idusuario = obtenerIdUsuario($usuario);
    $consulta="SELECT idlista, nombrelista, privacidad, categoria FROM listas WHERE idusuario = '{$idusuario}'";
    $resultadoConsulta = $conexionBD->query($consulta);
    try {
        $listas=$resultadoConsulta->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $ex) {
        die("Error al recuperar listas: " . $ex->getMessage());
    }
    $conexionBD = null;
    return $listas;
}

function insertarLista($nombre_lista,$categoria,$privacidad,$descripcion,$usuario){
    $conexionBD = crearConexion();
    $idsuario = obtenerIdUsuario($usuario);
    $sentencia = $conexionBD->prepare(
        "INSERT INTO listas(nombrelista, categoria, privacidad, descripcion, idusuario) 
        VALUES (:nombre_lista, :categoria, :privacidad, :descripcion, :idusuario)"
    );
    $sentencia->bindParam("nombre_lista", $nombre_lista, PDO::PARAM_STR);
    $sentencia->bindParam("categoria", $categoria, PDO::PARAM_STR);
    $sentencia->bindParam("privacidad", $privacidad, PDO::PARAM_STR);
    $sentencia->bindParam("descripcion", $descripcion, PDO::PARAM_STR);
    $sentencia->bindParam("idusuario", $idsuario, PDO::PARAM_STR);
    $result = $sentencia->execute();
    $conexionBD = null;
    if ($result) {
        return true;
    } else {
        return false;
    }
}

function eliminarLista($idlista){
    $conexionBD = crearConexion();
    $sentencia = $conexionBD->prepare("DELETE FROM listas WHERE idlista = :idlista");
    $sentencia->bindParam("idlista", intval($idlista), PDO::PARAM_STR);
    $result = $sentencia->execute();
    $conexionBD = null;
    if ($result) {
        return true;
    } else {
        return false;
    }
}

function recuperarElementosLista($idlista){
    $conexionBD = crearConexion();
    $consulta=
        "SELECT iditem, title, year(release_date) AS año, poster_path 
         FROM ipeliculas p, items_lista i
         WHERE p.idpelicula = i.iditem AND i.idlista = {$idlista}";
    $resultadoConsulta = $conexionBD->query($consulta);
    try {
        $items=$resultadoConsulta->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $ex) {
        die("Error al recuperar listas: " . $ex->getMessage());
    }
    $conexionBD = null;
    return $items;
}

function existeItemInLista($iditem,$idlista){
    $conexionBD = crearConexion();
    $consulta = $conexionBD->prepare("SELECT * FROM items_lista WHERE iditem = :iditem AND idlista = :idlista");
    $consulta->bindParam("iditem", $iditem, PDO::PARAM_STR);
    $consulta->bindParam("idlista", $idlista, PDO::PARAM_STR);
    $consulta->execute();
    $count = $consulta->rowCount();
    $conexionBD = null;
    if ($count>0) {
        //el registro ya existe
        return true;
    }
    return false;
}

function insertarItemALista($iditem,$idlista){
    if(!existeItemInLista($iditem,$idlista)){
        $conexionBD = crearConexion();
        $sentencia = $conexionBD->prepare("INSERT INTO items_lista (iditem, idlista) VALUES (:iditem, :idlista)");
        $sentencia->bindParam("iditem", $iditem, PDO::PARAM_STR);
        $sentencia->bindParam("idlista", $idlista, PDO::PARAM_STR);
        $result = $sentencia->execute();
        $conexionBD = null;
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}

function borrarItemDeLista($iditem,$idlista){
    $conexionBD = crearConexion();
    $sentencia = $conexionBD->prepare("DELETE FROM items_lista WHERE iditem = :iditem AND idlista = :idlista");
    $sentencia->bindParam("iditem", $iditem, PDO::PARAM_STR);
    $sentencia->bindParam("idlista", $idlista, PDO::PARAM_STR);
    $result = $sentencia->execute();
    $conexionBD = null;
    if ($result) {
        return true;
    } else {
        return false;
    }
}

/****************Procedimientos usuario **********************************************/
function validarUsuario($usuario, $passwd)
{
    $conexionBD = crearConexion();
    $consulta = "SELECT * FROM usuarios WHERE user = '{$usuario}' AND  password = '{$passwd}'";
    try {
        $resultadoConsulta = $conexionBD->query($consulta);
    } catch (PDOException $ex) {
        die("Error al recuperar usuarios para login: " . $ex->getMessage());
    }
    $conexionBD = null;
    if(!$resultadoConsulta->fetch()){
        return false;
    }
    else return true;
}

//comprobamos las credenciales de un usuario con bindparam para caracteres de escape
function validarUsuario2($usuario,$passwd){
    $conexionBD = crearConexion();
    $consulta = $conexionBD->prepare("SELECT * FROM usuarios WHERE user = :username AND  password = :password");
    $consulta->bindParam("username", $usuario, PDO::PARAM_STR);
    $consulta->bindParam("password", $passwd, PDO::PARAM_STR);
    $result = $consulta->execute();
    $conexionBD = null;
    if ($result) {
        return true;
    } else {
        return false;
    }
}

function esAdmin($usuario){
    $conexionBD = crearConexion();
    $consulta = "SELECT rol FROM usuarios WHERE user = '{$usuario}'";
    try {
        $resultadoConsulta = $conexionBD->query($consulta);
    } catch (PDOException $ex) {
        die("Error al recuperar usuarios para login: " . $ex->getMessage());
    }
    $conexionBD = null;
    if($usuario = $resultadoConsulta->fetch()){
        if($usuario['rol']=='a'){
            return true;
        }
    }
    return false;
}

//recuperamos el Id de un usuario a partir de su nombre
function obtenerIdUsuario($usuario)
{
    $conexionBD = crearConexion();
    $consulta = "SELECT idusuario FROM usuarios WHERE user = '{$usuario}'";
    try {
        $resultadoConsulta = $conexionBD->query($consulta);
    } catch (PDOException $ex) {
        die("Error al recuperar id de usuario: " . $ex->getMessage());
    }
    $conexionBD = null;
    if($usuario = $resultadoConsulta->fetch()){
        return $usuario['idusuario'];
    }
    else return -1;
}

function recuperarUsuarios(){
    $conexionBD = crearConexion();
    $consulta="SELECT * FROM usuarios";
    $resultadoConsulta = $conexionBD->query($consulta);
    try {
        $usuarios=$resultadoConsulta->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $ex) {
        die("Error al recuperar listas: " . $ex->getMessage());
    }
    $conexionBD = null;
    return $usuarios;
}

//función para registrar usuarios
function insertarUsuario($usuario,$password,$nombre,$apellidos,$email){
    $conexionBD = crearConexion();
    $sentencia = $conexionBD->prepare("INSERT INTO usuarios (user, password, email, nombre, apellidos) VALUES (:user, :passwd, :email, :first_name, :last_name)");
    $sentencia->bindParam("user", $usuario, PDO::PARAM_STR);
    $sentencia->bindParam("passwd", $password, PDO::PARAM_STR);
    $sentencia->bindParam("email", $email, PDO::PARAM_STR);
    $sentencia->bindParam("first_name", $nombre, PDO::PARAM_STR);
    $sentencia->bindParam("last_name", $apellidos, PDO::PARAM_STR);
    $result = $sentencia->execute();
    $conexionBD = null;
    if ($result) {
        return true;
    } else {
        return false;
    }
}

function eliminarUsuario($idusuario){
    $conexionBD = crearConexion();
    $sentencia = $conexionBD->prepare("DELETE FROM usuarios WHERE idusuario = :idusuario");
    $sentencia->bindParam("idusuario", intval($idusuario), PDO::PARAM_STR);
    $result = $sentencia->execute();
    $conexionBD = null;
    if ($result) {
        return true;
    } else {
        return false;
    }
}

//comprueba si ya existe un usuario a partir de su nombre
function existeUsuario($usuario){
    $conexionBD = crearConexion();
    $consulta = $conexionBD->prepare("SELECT * FROM usuarios WHERE user = :username");
    $consulta->bindParam("username", $usuario, PDO::PARAM_STR);
    $consulta->execute();
    $count = $consulta->rowCount();
    $conexionBD = null;
    if ($count>0) {
        //el registro ya existe
        return true;
    }
    return false;
    
}

//comprueba si el email ya está registrado
function existeEmail($email){
    $conexionBD = crearConexion();
    $consulta = $conexionBD->prepare("SELECT * FROM usuarios WHERE email = :email");
    $consulta->bindParam("email", $email, PDO::PARAM_STR);
    $consulta->execute();
    $count = $consulta->rowCount();
    $conexionBD = null;
    if ($count>0) {
        //el email ya existe
        return true;
    }
    return false;
}

/*********************Procedimientos películas***************************/
function insertarPelicula($pelicula){
    $conexionBD = crearConexion();

    $sql_item = "INSERT INTO items (tipo_item) VALUES('m')"; 
    if($conexionBD->query($sql_item)){
        $idpelicula=$conexionBD->lastInsertId();
        $sentencia = $conexionBD->prepare(
            "INSERT INTO ipeliculas (idpelicula, id_moviedb, title, original_title, overview, release_date, poster_path) 
            VALUES (:idpelicula, :id_moviedb, :title, :original_title, :overview, :release_date, :poster_path)");
        $sentencia->bindParam("idpelicula", $idpelicula, PDO::PARAM_STR);
        $sentencia->bindParam("id_moviedb", $pelicula->id_moviedb, PDO::PARAM_STR);
        $sentencia->bindParam("title", $pelicula->title, PDO::PARAM_STR);
        $sentencia->bindParam("original_title", $pelicula->original_title, PDO::PARAM_STR);
        $sentencia->bindParam("overview", $pelicula->overview, PDO::PARAM_STR);
        $sentencia->bindParam("release_date", $pelicula->release_date, PDO::PARAM_STR);
        $sentencia->bindParam("poster_path", $pelicula->poster_path, PDO::PARAM_STR);
        $result = $sentencia->execute();
    }else{
        echo "No se insertó la película correctamente.";
    }

    $conexionBD = null;
    if ($result) {
        return true;
    } else {
        return false;
    }
}

function recuperarPeliculas(){
    $conexionBD = crearConexion();
    $consulta="SELECT * FROM ipeliculas";
    $resultadoConsulta = $conexionBD->query($consulta);
    try {
        $peliculas=$resultadoConsulta->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $ex) {
        die("Error al recuperar listas: " . $ex->getMessage());
    }
    $conexionBD = null;
    return $peliculas;
}

//devuelve una película en formato JSON
function recuperarPeliculaJSON($idpelicula){
    $conexionBD = crearConexion();
    $consulta="SELECT * FROM ipeliculas WHERE idpelicula = {$idpelicula}";
    $resultadoConsulta = $conexionBD->query($consulta);
    try {
        $pelicula=$resultadoConsulta->fetch(PDO::FETCH_OBJ);
    } catch (PDOException $ex) {
        die("Error al recuperar película JSON: " . $ex->getMessage());
    }
    $conexionBD = null;
    return json_encode($pelicula);
}

/*********************Procedimientos Series***************************/
function insertarSerie($serie){
    //recibe un objeto de una serie
    $conexionBD = crearConexion();

    $sql_item = "INSERT INTO items (tipo_item) VALUES('s')"; 
    if($conexionBD->query($sql_item)){
        $idserie=$conexionBD->lastInsertId();
        $sentencia = $conexionBD->prepare(
            "INSERT INTO iseries (idserie, id_moviedb, title, original_title, overview, release_date, poster_path) 
            VALUES (:idserie, :id_moviedb, :title, :original_title, :overview, :release_date, :poster_path)");
        $sentencia->bindParam("idserie", $idserie, PDO::PARAM_STR);
        $sentencia->bindParam("id_moviedb", $serie->id_moviedb, PDO::PARAM_STR);
        $sentencia->bindParam("title", $serie->title, PDO::PARAM_STR);
        $sentencia->bindParam("original_title", $serie->original_title, PDO::PARAM_STR);
        $sentencia->bindParam("overview", $serie->overview, PDO::PARAM_STR);
        $sentencia->bindParam("release_date", $serie->release_date, PDO::PARAM_STR);
        $sentencia->bindParam("poster_path", $serie->poster_path, PDO::PARAM_STR);
        $result = $sentencia->execute();
    }else{
        echo "No se insertó la serie correctamente.";
    }

    $conexionBD = null;
    if ($result) {
        return true;
    } else {
        return false;
    }
}

function recuperarSerie(){
    $conexionBD = crearConexion();
    $consulta="SELECT DISTINCT * FROM iseries";
    $resultadoConsulta = $conexionBD->query($consulta);
    try {
        $series=$resultadoConsulta->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $ex) {
        die("Error al recuperar listas: " . $ex->getMessage());
    }
    $conexionBD = null;
    return $series;
}

//devuelve una película en formato JSON
function recuperarSerieJSON($idserie){
    $conexionBD = crearConexion();
    $consulta="SELECT DISTINCT * FROM iseries WHERE idserie = {$idserie}";
    $resultadoConsulta = $conexionBD->query($consulta);
    try {
        $serie=$resultadoConsulta->fetch(PDO::FETCH_OBJ);
    } catch (PDOException $ex) {
        die("Error al recuperar película JSON: " . $ex->getMessage());
    }
    $conexionBD = null;
    return json_encode($serie);
}

?>