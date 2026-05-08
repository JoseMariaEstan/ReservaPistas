<?php
require_once '../PHP/phpConexion.php';


if (isset($_SESSION['usuario_nom']) && isset($_SESSION['Logueado'])===true) {
    $Info = $_SESSION['usuario_nom'];
    
}else {
    $Info = "Iniciar Sesión";
}

try{
$total_cuentas = 0; // Inicializar la variable

// Consulta para obtener el total de cuentas

$sql = "SELECT COUNT(*) AS total FROM usuario";
$stmt = $conexion->prepare($sql);
$stmt->execute();

$resultado = $stmt->fetch(PDO::FETCH_ASSOC); // Obtener el total de cuentas
$total_cuentas = $resultado['total'];
}
catch (PDOException $e) {
    echo "Error al obtener el total de cuentas: " . $e->getMessage();
    $total_cuentas = "N/A"; // En caso de error, mostrar N/A
}

try{
// Simulación de carga del servidor (en un entorno real, esto se obtendría de métricas del sistema)

    $carga_servidor = rand(1, 100); // Simular una carga aleatoria del servidor
}
catch (PDOException $e) {
    echo "Error al obtener la carga del servidor: " . $e->getMessage();
    $carga_servidor = "N/A"; // En caso de error, mostrar N/A
}
try{
// Simulación de media de usuarios mensuales (en un entorno real, esto se calcularía a partir de los registros de usuarios y visitas)

    $media_usuarios_mensuales = rand(1, $total_cuentas); // Simular una media aleatoria de usuarios mensuales
}
catch (PDOException $e) {
    echo "Error al obtener la media de usuarios mensuales: " . $e->getMessage();
    $media_usuarios_mensuales = "No hay datos";
}

// Paginación para la tabla de usuarios
$registros_por_pagina = 16;
$inicio = isset($_POST['inicio']) ? (int)$_POST['inicio'] : 0;

if (isset($_POST['direccion'])) {
    if ($_POST['direccion'] == 'siguiente' && $inicio + $registros_por_pagina < $total_cuentas) {
        $inicio += $registros_por_pagina;
    } elseif ($_POST['direccion'] == 'anterior' && $inicio > 0) {
        $inicio -= $registros_por_pagina;
        if ($inicio < 0) $inicio = 0;
    }
}

$pagina_actual = floor($inicio / $registros_por_pagina) + 1;

// Obtener y mostrar la tabla de usuarios
try {
    $sql = "SELECT nombre_usuario FROM usuario LIMIT $registros_por_pagina OFFSET $inicio";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $tabla_usuarios = '';
    if (count($usuarios) > 0) {
        $tabla_usuarios .= '<div class="usuarios-grid">';
        foreach ($usuarios as $fila) {
            $tabla_usuarios .= '<div class="usuario-card">';
            foreach ($fila as $columna => $valor) {
                $tabla_usuarios .= "<div class='campo'><strong>$columna:</strong> $valor</div>";
            }
            $tabla_usuarios .= '</div>';
        }
        $tabla_usuarios .= '</div>';
    } else {
        $tabla_usuarios = "<p style='text-align: center;'>No hay usuarios registrados.</p>";
    }
} catch (PDOException $e) {
    $tabla_usuarios = "Error al obtener los usuarios: " . $e->getMessage();
}

//Borrado de Usuarios de la base de datos por Admin
try{
    if (isset($_POST['eliminar_cuenta'])) {
        if ($login_input === "admin@gmail.com" && $password_input === "admin123") {
                $error_login = "La cuenta de administrador no se puede eliminar.";
            } else {
                $sql = "SELECT nombre_usuario, contraseña FROM usuario WHERE nombre_usuario = :nom_user LIMIT 1";
                $stmt = $conexion->prepare($sql);
                $stmt->execute([':nom_user' => $login_input]);
                $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($usuario && password_verify($password_input, $usuario['contraseña'])) {
                //query para borrar cuentas
                $sqlDelete = "DELETE FROM usuario WHERE nombre_usuario = :nom_user";

                    $deleteStmt = $conexion->prepare($sqlDelete);
                    $deleteStmt->execute([':nom_user' => $login_input]);

                    $_SESSION = [];
                    session_unset();
                    session_destroy();

                    header("Location: login.php");
                    exit();
                } else {
                    $error_login = "El nombre de usuario o la contraseña son incorrectos.";
                    $_SESSION['Logueado'] = false;
                }
            }
        }
    } catch (PDOException $e) {
        $error_login = "Error en el sistema de eliminación.";
    }
?>