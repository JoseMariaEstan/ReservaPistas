<?php
require_once 'phpConexion.php';

// Obtener los filtros del formulario POST
$deporteSeleccionado = $_SERVER['REQUEST_METHOD'] === 'POST' ? ($_POST['deporte'] ?? 'todas') : 'todas';
$fechaSeleccionada = $_SERVER['REQUEST_METHOD'] === 'POST' ? ($_POST['fecha_seleccionada'] ?? '') : '';

// Proximamente, aquí se podría realizar una consulta a la base de datos para obtener las pistas disponibles según los filtros seleccionados.

//Filtrar segun el deporte
if ($deporteSeleccionado == 'todas') {
    // Si en el filtro se filtra por todas, se mostraran todas las pistas disponibles
}
?>