<?php
require_once 'bd.php';
if (isset($_POST['cargado'])) {
    
    $peliculas = json_decode($_POST['peliculasjson']);

    foreach($peliculas as $pelicula){
        //extraigo solo los datos que me interesan del json peliculas
        $mipelicula = new \stdClass();
        $mipelicula->id_moviedb = $pelicula->id;
        $mipelicula->title = $pelicula->title;
        $mipelicula->original_title = $pelicula->original_title;
        $mipelicula->overview = $pelicula->overview;
        $mipelicula->release_date = $pelicula->release_date;
        $mipelicula->poster_path = $pelicula->poster_path;
        insertarPelicula($mipelicula);
    }
    
}
?>
