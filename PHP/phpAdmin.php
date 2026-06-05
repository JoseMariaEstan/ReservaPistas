<?php
require_once '../PHP/phpConexion.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
//eliminar cuenta
$mensaje_eliminar = 'El usuario ha sido borrado de la base de datos correctamente';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['usuario_borrar'])) {
    $usuario_borrar = trim($_POST['usuario_borrar']);

    if ($usuario_borrar === '') {
        $mensaje_eliminar = 'Debe escribir un nombre de usuario para eliminar.';
        header("Location: admin.php#admin-delete");
    } elseif (strtolower($usuario_borrar) === 'admin' || strtolower($usuario_borrar) === 'admin@gmail.com') {
        $mensaje_eliminar = 'No se puede eliminar la cuenta de administrador.';
    } else {
        try {
            $sql = 'SELECT nombre_usuario FROM usuario WHERE nombre_usuario = :nom_user LIMIT 1';
            $stmt = $conexion->prepare($sql);
            $stmt->execute([':nom_user' => $usuario_borrar]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario) {
                $sqlDelete = 'DELETE FROM usuario WHERE nombre_usuario = :nom_user';
                $deleteStmt = $conexion->prepare($sqlDelete);
                $deleteStmt->execute([':nom_user' => $usuario_borrar]);
                $mensaje_eliminar = 'Cuenta eliminada correctamente: ' . htmlspecialchars($usuario_borrar);
            } else {
                $mensaje_eliminar = 'No existe ningún usuario con ese nombre.';
            }
        } catch (PDOException $e) {
            $mensaje_eliminar = 'Error al eliminar el usuario: ' . $e->getMessage();
        }
    }
}

if (isset($_SESSION['usuario_nom']) && isset($_SESSION['Logeado'])===true) {
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
$registros_por_pagina = 15;
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


//Buscar usuarios por nombre
$busqueda_usuario = '';
$tabla_usuarios = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['busqueda_usuario'])) {
    $busqueda_usuario = trim($_POST['busqueda_usuario']);
    try {
        $sql = "SELECT nombre_usuario FROM usuario WHERE nombre_usuario LIKE :busqueda LIMIT 15";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([':busqueda' => "%$busqueda_usuario%"]);
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($usuarios) {
            $tabla_usuarios = '<div class="usuarios-grid">';
            foreach ($usuarios as $fila) {
                $tabla_usuarios .= '<div class="usuario-card">';
                foreach ($fila as $col => $val) {
                    $tabla_usuarios .= "<div class='campo'><strong>$col:</strong> $val</div>";
                }
                $tabla_usuarios .= '</div>';
            }
            $tabla_usuarios .= '</div>';
        } else {
            $tabla_usuarios = "<p style='text-align:center'>No se encontraron usuarios.</p>";
        }
    } catch (PDOException $e) {
        $tabla_usuarios = "Error: " . $e->getMessage();
    }

} else {
    try {
        $sql = "SELECT nombre_usuario FROM usuario LIMIT $registros_por_pagina OFFSET $inicio";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($usuarios) {
            $tabla_usuarios = '<div class="usuarios-grid">';
            foreach ($usuarios as $fila) {
                $tabla_usuarios .= '<div class="usuario-card">';
                foreach ($fila as $col => $val) {
                    $tabla_usuarios .= "<div class='campo'><strong>$col:</strong> $val</div>";
                }
                $tabla_usuarios .= '</div>';
            }
            $tabla_usuarios .= '</div>';
        } else {
            $tabla_usuarios = "<p style='text-align:center'>No hay usuarios registrados.</p>";
        }
    } catch (PDOException $e) {
        $tabla_usuarios = "Error: " . $e->getMessage();
    }
}
?>