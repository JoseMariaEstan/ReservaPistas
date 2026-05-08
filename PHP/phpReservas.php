<?php
// php para calcular el precio total de la reserva según el deporte y los extras seleccionados

$precio_total = 0;
$deporte_elegido = isset($_POST['deporte']) ? $_POST['deporte'] : "";

// Definición de precios base
$precios_base = [
    "padel" => 20,
    "tenis" => 15,
    "futbol" => 40
];

// Cálculo si hay un deporte seleccionado
if (!empty($deporte_elegido) && array_key_exists($deporte_elegido, $precios_base)) {
    $precio_total = $precios_base[$deporte_elegido];

    // Sumar extras
    if (isset($_POST['luz'])) {
        $precio_total += 5;
    }
    
    if (isset($_POST['techada'])) {
        $precio_total += 10;
    }
}
?>