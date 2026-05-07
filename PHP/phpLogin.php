<?php
require_once "phpConexion.php"; 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cambiamos isset($_POST['Usuario']) por el nombre del botón o verificamos el POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Usuario'])) {
    
    $login_input = $_POST['Usuario'];
    $password_input = $_POST['contraseña'];

    try {
        $sql = "SELECT nombre_usuario, contraseña FROM usuario WHERE nombre_usuario = :nom_user LIMIT 1";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([':nom_user' => $login_input]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($password_input, $usuario['contraseña'])) {
            // ÉXITO
            session_regenerate_id(true);
            $_SESSION['usuario_nom'] = $usuario['nombre_usuario'];

            header("Location: paginaReservas.php");
            exit(); 
        } else {
            // ERROR: No ponemos echo aquí para no romper el HTML
            $error_login = "El nombre de usuario o la contraseña son incorrectos.";
        }
    } catch (PDOException $e) {
        $error_login = "Error en el sistema de autenticación.";
    }
}
?>