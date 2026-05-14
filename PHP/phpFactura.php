<?php 
require_once "../PHP/phpConexion.php";
include "../PHP/phpUsuario.php";

$id_factura = $_GET['id'] ?? null;

if (!$id_factura) {
    echo "<h1>Error: No se ha recibido ningún ID de factura.</h1>";
    exit();
}

try {
    $sql = "SELECT u.nombre_usuario, r.id_reservas, r.id_pista, r.id_extra, 
                   r.fecha_reserva, r.hora_inicio, r.precio_total 
            FROM reservas r
            JOIN usuario u ON r.usuario_id = u.id_usuario 
            WHERE r.id_reservas = :id_reserva";
    
    $stmt = $conexion->prepare($sql);
    $stmt->execute([':id_reserva' => $id_factura]);
    $info_factura = $stmt->fetch(PDO::FETCH_ASSOC);

    if($info_factura){
        $nombre_usuario = $info_factura['nombre_usuario'];
        $fecha_reserva  = $info_factura['fecha_reserva'];
        $hora_inicio    = $info_factura['hora_inicio'];
        $precio_total   = (float)$info_factura['precio_total']; // Total con extras pero sin IVA (según tu form anterior)

        // Cálculos financieros
        $precio_pista   = 8.00; // Precio base definido en tu lógica
        $precio_extras  = $precio_total - $precio_pista; 
        
        // Supongamos que el precio_total que guardaste es la base imponible
        $subtotal = $precio_total;
        $iva      = $subtotal * 0.21;
        $total_con_iva = $subtotal + $iva;

        // Obtener nombre de la pista
        $sql_pista = "SELECT nombre FROM pistas WHERE id_pista = :id_pista";
        $stmt_pista = $conexion->prepare($sql_pista);
        $stmt_pista->execute([':id_pista' => $info_factura['id_pista']]);
        $pista = $stmt_pista->fetch(PDO::FETCH_ASSOC);
        $nombre_pista = $pista ? $pista['nombre'] : "Pista no encontrada";

    } else {
        echo "No hay información para esta reserva";
        exit();
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>