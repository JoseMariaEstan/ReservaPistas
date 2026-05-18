<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
//Comprobar si el usuario está Logeado, si no lo está, redirigir al login
if (empty($_SESSION['Logeado'])) {
    header("Location: login.php");
    exit();
} else {
    $usuarioNom = $_SESSION['usuario_nom'] ?? 'Invitado';
    $esEmail = filter_var($usuarioNom, FILTER_VALIDATE_EMAIL) !== false;


    //Si el usuario pulsa en cerrar sesion o en cambiar contraseña, se cerrara la sesion

    //Uso con base de datos.
    require_once __DIR__ . '/phpConexion.php';

    // 1. Obtener reservas (Añadido filtro para que solo muestre las reservas del usuario Logeado)
    $id_usuario_sesion = $_SESSION['id_usuario'] ?? 0;
    try {
        $sql = "SELECT r.usuario_id, r.hora_inicio, r.id_pista 
                FROM reservas r 
                WHERE r.usuario_id = :usuario_id
                ORDER BY r.fecha_reserva DESC, r.hora_inicio DESC";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([':usuario_id' => $id_usuario_sesion]);
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $resultado = [];
        echo "Error en reservas: " . $e->getMessage();
    }

    $usuarioInfo = [
        'Nombre de usuario' => $usuarioNom,
        'Correo electrónico' => $esEmail ? $usuarioNom : 'No disponible',
        'Tipo de cuenta' => $usuarioNom === 'admin' ? 'Administrador' : 'Usuario estándar',
        'Estado de cuenta' => 'Activa',
        'Historial Reservas' => 'Tienes ' . count($resultado) . ' reserva(s) realizada(s)'
    ];

    // 2. Cargar Pistas
    $opciones_pistas = "";
    $tipos_de_pista = [];//array para tener todos los tipos de pista
    $pista_tipo = "<option value=''>-- --</option>"; // Valor por defecto
    $selected_tipo_pista = "";
    $selected_extra = $_POST['id_extra'] ?? '';
    $selected_fecha = $_POST['fecha_reserva'] ?? '';
    $selected_hora = $_POST['hora_inicio'] ?? '';


    //Si la fecha es superior a la de las reservas en la base de datos, se borrara autom.
    try{
        $sql_borrarFecha="DELETE FROM reservas WHERE fecha_reserva < CURDATE();";
        $stmt = $conexion->prepare($sql_borrarFecha);
        $stmt = $conexion->query($sql_borrarFecha);
        $stmt->execute();

    }
    catch(PDOException $e){
        echo "Error al eliminar reservas antiguas: " . $e->getMessage();
    }

    // Detectamos si el usuario acaba de cambiar la pista en el desplegable
    $id_pista_seleccionada = $_POST['id_pista'] ?? null;

    try {
        $sql_pistas = "SELECT DISTINCT tipo_pista FROM pistas";
        $stmt_pistas = $conexion->query($sql_pistas);
        while ($tipo = $stmt_pistas->fetch(PDO::FETCH_ASSOC)) {
            $tipos_de_pista[] = $tipo['tipo_pista'];
        }

        if ($id_pista_seleccionada) {
            $sql_tipo = "SELECT tipo_pista FROM pistas WHERE id_pista = :id_pista";
            $stmt_tipo = $conexion->prepare($sql_tipo);
            $stmt_tipo->execute([':id_pista' => $id_pista_seleccionada]);
            $fila = $stmt_tipo->fetch(PDO::FETCH_ASSOC);
            if ($fila) {
                $selected_tipo_pista = $fila['tipo_pista'];
            }
        }

        $sql = "SELECT id_pista, nombre, estado, tipo_pista FROM pistas";
        $stmt = $conexion->query($sql);
        
        while ($pista = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $estado_pista = $pista['estado'];
            $tipo_pista = $pista['tipo_pista'];
            
            // Mantiene la pista seleccionada visualmente tras la recarga automática
            $selected_pista = ($pista['id_pista'] == $id_pista_seleccionada) ? 'selected' : '';

            if ($estado_pista === 'reparacion') {
                $opciones_pistas .= "<option value='{$pista['id_pista']}' disabled>{$pista['nombre']} (En reparación)</option>";
            } else {
                $opciones_pistas .= "<option value='{$pista['id_pista']}' {$selected_pista}>{$pista['nombre']}</option>";
            }

            // Si esta fila corresponde a la pista que el usuario seleccionó, construimos su tipo
            if ($id_pista_seleccionada && $pista['id_pista'] == $id_pista_seleccionada) {
                $pista_tipo = "<option value='{$tipo_pista}' selected>{$tipo_pista}</option>";
            }

            //Si el tipo de pista esta en el array ese tipo sera el unico en no estar "disabled" en el desplegable de tipos de pista
            
        }
    } catch (PDOException $e) { 
        echo "Error pistas: " . $e->getMessage(); 
    }

    // 3. Cargar Extras
    $opciones_extras = "";
    $precio_pista = 8.00; // Precio base por cada pista
    try {
        $sql = "SELECT id_extra, tipo_extra, precio_extra FROM extras_reservas";
        $stmt = $conexion->query($sql);
        while ($extra = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $precio_extra = $extra['precio_extra'];
            $selected_item_extra = ($selected_extra !== '' && $selected_extra == $extra['id_extra']) ? ' selected' : '';
            $opciones_extras .= "<option value='{$extra['id_extra']}'{$selected_item_extra}>{$extra['tipo_extra']}</option>";
            //calcular el precio total
                if ($selected_extra !== '' && $selected_extra == $extra['id_extra']) {
                    $precio_total = $precio_extra + $precio_pista; // Aquí podrías sumar el precio de la pista si lo deseas
                }
        }
    } catch (PDOException $e) { echo "Error extras: " . $e->getMessage(); }

    // 4. Generar Horas
    $opciones_value = "";
    $opciones_horas = ["8", "9", "10", "11", "12", "13", "15", "16", "17", "18", "19", "20", "21", "22"];

    // Si hay pista y fecha seleccionada, buscamos las horas que ya están ocupadas
    $horas_ocupadas = [];
    if ($id_pista_seleccionada && $selected_fecha) {
        try {
            $sql_reservas = "SELECT hora_inicio FROM reservas WHERE id_pista = :id_pista AND fecha_reserva = :fecha_reserva";
            $stmt_reservas = $conexion->prepare($sql_reservas);
            $stmt_reservas->execute([':id_pista' => $id_pista_seleccionada, ':fecha_reserva' => $selected_fecha]);
            // Convertimos las horas de la BD (ej: "08:00:00") a formato corto "08:00"
            $horas_bd = $stmt_reservas->fetchAll(PDO::FETCH_COLUMN);
            $horas_ocupadas = array_map(function($h) { return substr($h, 0, 5); }, $horas_bd);
        } catch (PDOException $e) {
            echo "Error al verificar horas ocupadas: " . $e->getMessage();
        }
    }

    // Generamos las opciones del desplegable una sola vez
    foreach ($opciones_horas as $hora) {
        $h_formato = str_pad($hora, 2, "0", STR_PAD_LEFT) . ":00";
        $selected_item_hora = ($selected_hora !== '' && $selected_hora == $h_formato) ? ' selected' : '';
        
        if (in_array($h_formato, $horas_ocupadas)) {
            $opciones_value .= "<option value='$h_formato' disabled>$h_formato (Ocupada)</option>";
        } else {
            $opciones_value .= "<option value='$h_formato'{$selected_item_hora}>$h_formato</option>";
        }
    }

    $precio_final="";
    // 5. PROCESAR FORMULARIO (INSERT)
    // Importante: Asegúrate de que tu botón en el HTML tenga name="crear_reserva"
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear_reserva'])) {
        
        $id_usuario = $_SESSION['id_usuario'] ?? null;
        $id_pista = $_POST['id_pista'] ?? null;
        $id_extra = $_POST['id_extra'] ?? null;
        $fecha_reserva = $_POST['fecha_reserva'] ?? null;
        $hora_reserva = $_POST['hora_inicio'] ?? null;
        $precio_total_sucio=$_POST['precio_total'] ?? null;
        $precio_limpio= str_replace(['€', ','], ['','.'], $precio_total_sucio);
        $precio_final=(double)$precio_limpio;

        if ($id_usuario === null && !empty($_SESSION['usuario_nom'])) {
            try {
                $sql_user = "SELECT id_usuario FROM usuario WHERE nombre_usuario = :usuario_nom LIMIT 1";
                $stmt_user = $conexion->prepare($sql_user);
                $stmt_user->execute([':usuario_nom' => $_SESSION['usuario_nom']]);
                $user_row = $stmt_user->fetch(PDO::FETCH_ASSOC);
                if ($user_row && !empty($user_row['id_usuario'])) {
                    $id_usuario = $user_row['id_usuario'];
                    $_SESSION['id_usuario'] = $id_usuario;
                }
            } catch (PDOException $e) {
                // Si no se puede recuperar el usuario, dejamos que el error original sea más claro
            }
        }

        if ($id_usuario === null) {
            echo "Error al crear reserva: usuario no identificado en sesión.";
        } else {
            try {
                $sql_insert = "INSERT INTO reservas (usuario_id, id_pista, id_extra, fecha_reserva, hora_inicio, precio_total) 
                               VALUES (:usuario_id, :id_pista, :id_extra, :fecha_reserva, :hora_inicio, :precio_total)";
                $stmt_insert = $conexion->prepare($sql_insert);
                $stmt_insert->execute([
                    ':usuario_id' => $id_usuario,
                    ':id_pista' => $id_pista,
                    ':id_extra' => $id_extra,
                    ':fecha_reserva' => $fecha_reserva,
                    ':hora_inicio' => $hora_reserva,
                    ':precio_total'=>$precio_final,

                ]);
                $id_nueva_reserva = $conexion->lastInsertId();

                $_SESSION['ultima_reserva_id'] = $id_nueva_reserva;
                $_SESSION['reserva_exitosa'] = true;
                // Redirigir para evitar reenvío de formulario
                header("Location: paginausuario.php");
                exit();
            } catch (PDOException $e) {
                echo "Error al crear reserva: " . $e->getMessage();
            }
        }        
    }
}