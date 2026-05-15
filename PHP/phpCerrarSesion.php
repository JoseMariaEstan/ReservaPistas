<?php
if (isset($_SESSION['Logueado'])=== true) {
    session_destroy();
    $destino = "paginaPp.php";
    exit();
}
?>