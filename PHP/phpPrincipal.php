<?php

if (isset($_SESSION['Logueado']) && $_SESSION['Logueado'] == false) {
    $destino = "login.php";

}else if (isset($_SESSION['Logueado']) && $_SESSION['Logueado'] === true) {
    $destino = "paginausuario.php";
}

?>