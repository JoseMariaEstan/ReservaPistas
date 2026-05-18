<?php
require_once "../PHP/phpConexion.php";

//if (!isset($_SESSION['Logeado'])===true) {
   // $votos_afavor=0;
    //$votos_negativos=0;
    //$total_votos=0;
    //$porcentaje_pos=0;
    //$porcentaje_neg=0;
    //$mensaje_noLogeado= "Sin una cuenta no puedes acceder a informacion de las actividades o planes de nuestras instalaciones.Inicia Sesion y podras verlo";
    
//}
//else{
if(session_status() == PHP_SESSION_NONE){
    session_start();
}

// 1. Inicializar variables de sesión si no existen
if (!isset($_SESSION['votos_positivos'])){
    $_SESSION['votos_positivos'] = 0;
}
if (!isset($_SESSION['votos_negativos'])) {
    $_SESSION['votos_negativos'] = 0;
}

// 2. Procesar el formulario cuando se envía un VOTO (POST)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['voto'])) {
    
    $id_propuesta = 1; // ID de la fila del frontón
    $tipo_voto = $_POST['voto'];
    
    // Incrementar el valor en la sesión
    if ($tipo_voto === 'positivo') {
        $_SESSION['votos_positivos']++;
        $votos_actualizados = $_SESSION['votos_positivos'];
        $sql = "UPDATE propuesta_adicion 
                SET votos_positivos = :votos
                WHERE id = :id";
    } elseif ($tipo_voto === 'negativo') {
        $_SESSION['votos_negativos']++;
        $votos_actualizados = $_SESSION['votos_negativos'];
        $sql = "UPDATE propuesta_adicion 
                SET votos_negativos = :votos
                WHERE id = :id";
    }

    // Actualizar la Base de Datos de forma segura
    try {
        $stmt = $conexion->prepare($sql);
        // Vinculamos correctamente los marcadores que declaramos en el SQL
        $stmt->execute([
            ':votos' => $votos_actualizados,
            ':id'    => $id_propuesta
        ]);

        // Redireccionamos AQUÍ, una vez que la base de datos ya se actualizó
        header("Location: paginaProximamente.php#Encuesta1");
        exit();

    } catch (PDOException $e) {
        echo "Error al registrar el voto en el sistema: " . $e->getMessage();
        exit();
    }
}
    // 4. Asignar los valores de la sesión a tus variables para los cálculos
    $votos_positivos = $_SESSION['votos_positivos'];
    $votos_afavor=$votos_positivos;
    $votos_negativos = $_SESSION['votos_negativos'];

    // ✅ Correcto
    $total_votos = (int)$votos_afavor + (int)$votos_negativos;
    // 5. Calcular porcentajes
    if ($total_votos > 0) {
        $porcentaje_pos = ($votos_afavor / $total_votos) * 100;
        $porcentaje_neg = ($votos_negativos / $total_votos) * 100;
    } else {
        $porcentaje_pos = 50;
        $porcentaje_neg = 50;
    }
//}
?>