<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['Logueado'])) {
    header("Location: login.php");
    exit();
} else {
    $usuarioNom = $_SESSION['usuario_nom'] ?? 'Invitado';
    $esEmail = filter_var($usuarioNom, FILTER_VALIDATE_EMAIL) !== false;

    require_once __DIR__ . '/phpConexion.php';
    try{
//Query para obtener las reservas del usuario con la info

        $sql = "SELECT r.usuario_id FROM reservas r, usuario u where u.id_usuario = r.usuario_id";
        $stmt= $conexion->prepare($sql);
        $stmt->execute();
        $resultado= $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }




    $usuarioInfo = [
        'Nombre de usuario' => $usuarioNom,
        'Correo electrónico' => $esEmail ? $usuarioNom : 'No disponible',
        'Tipo de cuenta' => $usuarioNom === 'admin' ? 'Administrador' : 'Usuario estándar',
        'Estado de cuenta' => 'Activa',
        'Reservas' => 'Tienes ' . count($resultado) . ' reserva(s) activa(s).'.'los detalles de tus reservas son:
        
        '

    ];
}
?>