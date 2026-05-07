<?php
// Llamada a la conexión con base de datos
require_once "phpConexion.php";

try {
    $conexion = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btnRegistrar'])) {
    
    $usuario_input = $_POST['Usuario'];
    $pass_input = $_POST['contraseña'];
    $pass_confirm = $_POST['confirmarContraseña'];

    // Comprobar que las contraseñas coinciden
    if ($pass_input !== $pass_confirm) {
        $error_registro = "Las contraseñas no coinciden.";
    } else {
        try {
            //Verificar que el nombre de usuario no exista ya en la base de datos
            $check = $conexion->prepare("SELECT nombre_usuario FROM usuario WHERE nombre_usuario = :nom LIMIT 1");
            $check->execute([':nom' => $usuario_input]);
            
            if ($check->fetch()) {
                $error_registro = "Este nombre de usuario ya está en uso.";
            } else {
            //Hasheo autom. para contraseña
            $password_segura = password_hash($pass_input, PASSWORD_DEFAULT);

                //Query para insertar el nuevo usuario en la base de datos
                $sql = "INSERT INTO usuario (nombre_usuario, contraseña) VALUES (:nom, :pass)";
                $stmt = $conexion->prepare($sql);
                $stmt->execute([
                    ':nom'  => $usuario_input,
                    ':pass' => $password_segura
                ]);

                $mensaje_registro = "¡Cuenta creada con éxito! Ya puedes iniciar sesión.";
            }
        } catch (PDOException $e) {
            $error_registro = "Error al procesar el registro.";
        }
    }
}
?>