<?php
require_once "phpConexion.php"; 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar el POST y la existencia de usuario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Usuario'])) {
    
    $login_input = trim($_POST['Usuario']);
    $password_input = $_POST['contraseña'];

    try {
        if (isset($_POST['eliminar_cuenta'])) {
            if ($login_input === "admin@gmail.com" && $password_input === "admin123") {
                $error_login = "La cuenta de administrador no se puede eliminar.";
            } else {
                $sql = "SELECT nombre_usuario, contraseña FROM usuario WHERE nombre_usuario = :nom_user LIMIT 1";
                $stmt = $conexion->prepare($sql);
                $stmt->execute([':nom_user' => $login_input]);
                $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($usuario && password_verify($password_input, $usuario['contraseña'])) {
                    // Aquí escribe la query de la base de datos para eliminar la cuenta:
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
        } else {
            $sql = "SELECT id_usuario, nombre_usuario, contraseña FROM usuario WHERE nombre_usuario = :nom_user LIMIT 1";
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

            } else {
                if ($usuario && password_verify($password_input, $usuario['contraseña'])) {
                    // True para usuario normal
                    $_SESSION['id_usuario'] = $usuario['id_usuario'];
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
        }
    } catch (PDOException $e) {
        $error_login = "Error en el sistema de autenticación.";
    }
}
?>