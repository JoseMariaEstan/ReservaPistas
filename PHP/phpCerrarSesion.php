<?php
if (isset($_SESSION['Logeado'])=== true) {
    session_destroy();
    $destino = "paginaPp.php";
    exit();
}
?>