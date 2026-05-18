<?php
// Iniciar sesión para gestionar el estado de logueo
if (isset($_SESSION['Logeado']) && $_SESSION['Logeado'] == false) {
    $destino = "login.php";

}else if (isset($_SESSION['Logeado']) && $_SESSION['Logeado'] === true) {
    $destino = "paginausuario.php";
}

//Imagenes aleatorias cada que se recargue la página
$imagenes_padel = ["../Imagenes/PistaPadel.jpg", "../Imagenes/PistaPadel2.jpg", "../Imagenes/PistaPadel3.jpg"];
$imagenes_tenis = ["../Imagenes/PistaTennis.jpg", "../Imagenes/PistaTennis2.jpg", "../Imagenes/PistaTennis3.jpg"];
$imagenes_futbol = ["../Imagenes/CampoFutbol.jpg", "../Imagenes/CampoFutbol2.jpg", "../Imagenes/CampoFutbol3.jpg"];

//Seleccion aleatoria de imagen para el tenis
$indice_aleatorioT = array_rand($imagenes_tenis);
$imagen_elegida1 = $imagenes_tenis[$indice_aleatorioT];

//Seleccion aleatoria de imagen para el padel
$indice_aleatorioP   = array_rand($imagenes_padel);
$imagen_elegida2 = $imagenes_padel[$indice_aleatorioP];

//Seleccion aleatoria de imagen para el futbol
$indice_aleatorioF   = array_rand($imagenes_futbol);
$imagen_elegida3 = $imagenes_futbol[$indice_aleatorioF];

?>