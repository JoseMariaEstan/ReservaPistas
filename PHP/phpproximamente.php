<?php
require_once "../PHP/phpConexion.php";

if (!isset($_SESSION['Logeado']) || $_SESSION['Logeado'] !== true) {
    $votos_afavor = 0;
    $votos_negativos = 0;
    $porcentaje_pos = 0;
    $porcentaje_neg = 0;
    $mensaje_noLogeado = "Sin una cuenta no puedes acceder a información exclusiva de usuarios";
} else {

    $id_propuesta = 1;
    // 1. Procesar voto si se envía
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['voto']) && !isset($_SESSION['voto_encuesta1'])) {
        
        $tipo_voto = $_POST['voto'];
        $columna = ($tipo_voto === 'positivo') ? 'votos_positivos' : 'votos_negativos';

        try {
            $sql = "UPDATE propuesta_adicion SET $columna = $columna + 1 WHERE id = :id";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([':id' => $id_propuesta]);

            $_SESSION['voto_encuesta1'] = $tipo_voto;
            header("Location: paginaProximamente.php#Encuesta1");
            exit();

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            exit();
        }
    }

    // 2. Leer votos SIEMPRE desde la base de datos
    try {
        $stmt = $conexion->prepare("SELECT votos_positivos, votos_negativos FROM propuesta_adicion WHERE id = :id");
        $stmt->execute([':id' => $id_propuesta]);
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);

        $votos_afavor    = $fila['votos_positivos'] ?? 0;
        $votos_negativos = $fila['votos_negativos'] ?? 0;

    } catch (PDOException $e) {
        $votos_afavor = 0;
        $votos_negativos = 0;
    }

    // 3. Calcular porcentajes
    $total_votos = $votos_afavor + $votos_negativos;
    if ($total_votos > 0) {
        $porcentaje_pos = ($votos_afavor / $total_votos) * 100;
        $porcentaje_neg = ($votos_negativos / $total_votos) * 100;
    } else {
        $porcentaje_pos = 50;
        $porcentaje_neg = 50;
    }
}

    //Mensaje de no logeado
    $deshabilitar = isset($_SESSION['voto_encuesta1']) ? ' disabled' : '';

    if (isset($_POST['voto']) && !isset($_SESSION['voto_encuesta1'])) {
    $_SESSION['voto_encuesta1'] = $_POST['voto']; // Guarda 'positivo' o 'negativo'
    }
    
?>