<?php 
require_once "../PHP/phpConexion.php";
include "../PHP/phpUsuario.php";

$id_factura = $_GET['id'] ?? null;

if (!$id_factura) {
    echo "<h1>Error: No se ha recibido ningún ID de factura.</h1>";
    echo "<p>Asegúrate de acceder a esta página desde el enlace en 'Mis reservas'.</p>";
    exit();
}
?>