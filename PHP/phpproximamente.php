<?php
// Supongamos que estos datos vienen de tu base de datos
$votos_positivos = 150; 
$votos_negativos = 50;
$total_votos = $votos_positivos + $votos_negativos;

// Evitar división por cero y calcular porcentajes
if ($total_votos > 0) {
    $porcentaje_pos = ($votos_positivos / $total_votos) * 100;
    $porcentaje_neg = ($votos_negativos / $total_votos) * 100;
} else {
    $porcentaje_pos = 50; // Estado neutro si no hay votos
    $porcentaje_neg = 50;
}
?>