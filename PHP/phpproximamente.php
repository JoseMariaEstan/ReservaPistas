<?php
require_once "../PHP/phpConexion.php";

if (!isset($_SESSION['Logeado'])===true) {
    $votos_afavor=0;
    $votos_negativos=0;
    $total_votos=0;
    $porcentaje_pos=0;
    $porcentaje_neg=0;
    $mensaje_noLogeado= "Sin una cuenta no puedes acceder a informacion de las actividades o planes de nuestras instalaciones.Inicia Sesion y podras verlo";
    
}
else{
    if(session_status()==PHP_SESSION_NONE){
        session_start();
    }

    //Primera encuesta

    $votos_positivos = $_SESSION['votos_positivos'];
    $votos_negativos = $_SESSION['votos_negativos'];

    if (!isset($_SESSION['votos_positivos'])){
        $_SESSION['votos_positivos']=0;
    }
    if (!isset($_SESSION['votos_negativos'])) {
        $_SESSION['votos_negativos'] =0;
    }

    // 3. Comprobar si se ha enviado el formulario y sumar +1 al que corresponda
    if (isset($_POST['voto'])) {
        if ($_POST['voto'] === 'positivo') {
            $_SESSION['votos_positivos']++;
        } elseif ($_POST['voto'] === 'negativo') {
            $_SESSION['votos_negativos']++;
        }
        header("Location:paginaProximamente.php");

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


    //Actualizacion Base de datos
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id_propuesta = null;
        $tipo_voto = null;
        $texto_adicion="";

        // --- FORMULARIO 1: FRONTÓN ---
        if (isset($_POST['voto'])) {
            $id_propuesta = 1;              // ID de la fila del frontón en tu base de datos
            $tipo_voto = $_POST['voto'];    // Captura 'positivo' o 'negativo'
            $texto_adicion= "";
        }
        
        // Si se identificó un voto válido, procedemos a actualizar la base de datos
        if ($id_propuesta !== null && $tipo_voto !== null) {
            try {
                if ($tipo_voto === 'positivo') {
                    $sql = "UPDATE lgsmipistas.propuesta_adicion 
                            SET votos_positivos = $votos_afavor
                            WHERE id = :id";
                } elseif ($tipo_voto === 'negativo') {
                    $sql = "UPDATE lgsmipistas.propuesta_adicion 
                            SET votos_negativos = $votos_negativos
                            WHERE id = :id";
                }

                // Ejecutamos la consulta mediante Sentencias Preparadas (evita Inyección SQL)
                if (isset($sql)) {
                    $stmt = $conexion->prepare($sql);
                    $stmt->execute([':id' => $id_propuesta]);
                }

                if ($id_propuesta === 1) {
                    header("Location: paginaProximamente.php#Encuesta1");
                }
                exit();

            } catch (PDOException $e) {
                // Manejo de errores por si falla la comunicación con la base de datos
                echo "Error al registrar el voto en el sistema: " . $e->getMessage();
            }
        }
    }
}
?>