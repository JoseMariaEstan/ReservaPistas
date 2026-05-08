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
    $media_usuarios_mensuales = "N/A"; // En caso de error, mostrar N/A
}

?>