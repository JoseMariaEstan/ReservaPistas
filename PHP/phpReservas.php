<?php
require_once "phpConexion.php";

$deporteSeleccionado = $_POST['deporte'] ?? 'todas';
$fechaSeleccionada = $_POST['fecha_seleccionada'] ?? '';

$pistas = [];
$usarBaseDeDatos = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $deporte = $conn->real_escape_string($deporteSeleccionado);
    $fecha = $conn->real_escape_string($fechaSeleccionada);

    $sql = "SELECT * FROM pistas WHERE ('$deporte' = 'todas' OR deporte = '$deporte')";
    if ($fecha !== '') {
        $sql .= " AND fecha = '$fecha'";
    }

    $resultado = $conn->query($sql);
    if ($resultado instanceof mysqli_result) {
        $usarBaseDeDatos = true;
        while ($fila = $resultado->fetch_assoc()) {
            $pistas[] = [
                'nombre' => $fila['nombre'],
                'deporte' => $fila['deporte'],
                'extras' => $fila['extras'] ?? '',
                'fecha' => $fila['fecha'] ?? '',
            ];
        }
    }
}

if (!$usarBaseDeDatos) {
    $pistas = [
        ['nombre' => 'Pista Azul', 'deporte' => 'padel', 'extras' => 'Iluminación, Pista Techada', 'fecha' => '2026-05-11'],
        ['nombre' => 'Pista Naranja', 'deporte' => 'tenis', 'extras' => 'Resina, Red Oficial', 'fecha' => '2026-05-12'],
        ['nombre' => 'Campo Central', 'deporte' => 'futbol', 'extras' => 'Luz nocturna, Césped Artificial', 'fecha' => '2026-05-11'],
    ];
}

$mostrarPistas = [];
foreach ($pistas as $pista) {
    if (($deporteSeleccionado === 'todas' || $pista['deporte'] === $deporteSeleccionado)
        && ($fechaSeleccionada === '' || $pista['fecha'] === $fechaSeleccionada)) {
        $mostrarPistas[] = $pista;
    }
}

if (empty($mostrarPistas)) {
    echo "<p class='sin-resultados'>No hay pistas disponibles para el filtro seleccionado.</p>";
    return;
}

foreach ($mostrarPistas as $pista) {
    $nombre = $pista['nombre'];
    $deporte = $pista['deporte'];
    $extras = $pista['extras'];
    $fechaPista = $pista['fecha'];
    $fechaTexto = $fechaSeleccionada !== '' ? date('d/m/Y', strtotime($fechaSeleccionada)) : 'Hoy';

    echo "<details class='pistas-detalles' data-deporte='" . $deporte . "'>";
    echo "<summary class='desplegable'>" . $nombre . " (" . ucfirst($deporte) . ")</summary>";
    echo "<div class='contenedor_horarios_flex'>";
    echo "<div class='dia_cabecera'>Horarios disponibles (" . $fechaTexto . ")</div>";
    echo "<table class='tabla_horarios'>";
    echo "<tr><td class='hora'>8:00</td><td class='hora'>9:00</td><td class='hora'>10:00</td><td class='hora'>11:00</td></tr>";
    echo "<tr><td class='hora'>12:00</td><td class='hora'>13:00</td><td class='hora'>15:00</td><td class='hora'>16:00</td></tr>";
    echo "<tr><td class='hora'>17:00</td><td class='hora'>18:00</td><td class='hora'>19:00</td><td class='hora'>20:00</td></tr>";
    echo "<tr><td class='hora'>21:00</td><td class='hora'>22:00</td><td colspan='2'></td></tr>";
    echo "</table>";
    echo "</div>";
    echo "<div class='extras-content'>";
    echo "<h3>EXTRAS</h3>";
    echo "<p>" . $extras . "</p>";
    echo "<p><strong>Fecha seleccionada:</strong> " . ($fechaPista !== '' ? $fechaPista : 'No disponible') . "</p>";
    echo "</div>";
    echo "</details>";
}
?>
