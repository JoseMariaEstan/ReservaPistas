<?php
require_once "phpConexion.php"; 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar el POST y la existencia de usuario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Usuario'])) {
    
    $login_input = $_POST['Usuario'];
    $password_input = $_POST['contraseña'];

    try {
        $sql = "SELECT nombre_usuario, contraseña FROM usuario WHERE nombre_usuario = :nom_user LIMIT 1";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([':nom_user' => $login_input]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        if($login_input === "admin@gmail.com" && $password_input === "admin123") {
            // True para admin
            session_regenerate_id(true);
            $_SESSION['usuario_nom'] = "admin";
            $_SESSION['Logueado'] = true;

            header("Location: admin.php");
            exit();

        }else{
            if ($usuario && password_verify($password_input, $usuario['contraseña'])) {
            // True para usuario normal
            $_SESSION['usuario_nom'] = $usuario['nombre_usuario'];
            $_SESSION['Logueado'] = true;
            session_regenerate_id(true);
            header("Location: paginausuario.php");
            exit(); 
        } else {
            //False para ambos casos
            $error_login = "El nombre de usuario o la contraseña son incorrectos.";
            $_SESSION['Logueado'] = false;
            }
        }   
    } catch (PDOException $e) {
        $error_login = "Error en el sistema de autenticación.";
    }
}
?>