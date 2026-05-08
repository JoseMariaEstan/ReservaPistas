<?php
if (!isset($_SESSION['Logueado']) || $_SESSION['Logueado'] !== true) {
    header("Location: login.php");
    exit();
}

$usuarioNom = $_SESSION['usuario_nom'] ?? 'Invitado';
$esEmail = filter_var($usuarioNom, FILTER_VALIDATE_EMAIL) !== false;

$usuarioInfo = [
    'Nombre de usuario' => $usuarioNom,
    'Correo electrónico' => $esEmail ? $usuarioNom : 'No disponible',
    'Tipo de cuenta' => $usuarioNom === 'admin' ? 'Administrador' : 'Usuario estándar',
    'Estado de cuenta' => 'Activa',
    'Registro' => 'Información no disponible'
];
?>