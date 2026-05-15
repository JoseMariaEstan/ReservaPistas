<?php
// Llamada a la conexión con base de datos
require_once "phpConexion.php";



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btncambiar'])) {
    
    $usuario_input = $_POST['Usuario'];
    $pass_inputNew = $_POST['newcontra'];
    $pass_confirmNew = $_POST['confirmarContraseñanueva'];

    // Comprobar que las contraseñas coinciden
    if ($pass_inputNew !== $pass_confirmNew) {
        $error_cambio = "Las contraseñas no coinciden.";
    } else {
        try {
            //Verificar que el nombre de usuario exista ya en la base de datos
            $check = $conexion->prepare("SELECT nombre_usuario FROM usuario WHERE nombre_usuario = :nom LIMIT 1");
            $check->execute([':nom' => $usuario_input]);
            
            if (!$check->fetch()) {
                $error_cambio = "Este nombre de usuario no existe.";
            } else {
            //Hasheo autom. para contraseña y evitar problemas con la BD
            $password_seguraNew = password_hash($pass_inputNew, PASSWORD_DEFAULT);

                //Query para cambiar la contraseña en la base de datos
                $sql = "UPDATE usuario SET contraseña = :pass WHERE nombre_usuario = :nom";
                $stmt = $conexion->prepare($sql);
                $stmt->execute([
                    ':nom'  => $usuario_input,
                    ':pass' => $password_seguraNew
                ]);

                $mensaje_cambio = "¡Contraseña cambiada con exito! Ya puedes iniciar sesión.";
            }
        } catch (PDOException $e) {
            $error_cambio = "Error al procesar el cambio.";
        }
    }
}
?>