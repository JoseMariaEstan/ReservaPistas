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

    //Uso con base de datos.
    require_once __DIR__ . '/phpConexion.php';

    // 1. Obtener reservas (Añadido filtro para que solo muestre las reservas del usuario logueado)
    $id_usuario_sesion = $_SESSION['id_usuario'] ?? 0;
    try {
        $sql = "SELECT r.usuario_id, r.hora_inicio, r.id_pista 
                FROM reservas r 
                WHERE r.usuario_id = :usuario_id";
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
        'Reservas' => 'Tienes ' . count($resultado) . ' reserva(s) activa(s).'
    ];

    // 2. Cargar Pistas
    $opciones_pistas = "";
    $tipos_de_pista = [];//array para tener todos los tipos de pista
    $pista_tipo = "<option value=''>-- --</option>"; // Valor por defecto

    // Detectamos si el usuario acaba de cambiar la pista en el desplegable
    $id_pista_seleccionada = $_POST['id_pista'] ?? null;

    try {
        $sql_pistas = "SELECT DISTINCT tipo_pista FROM pistas";
        $stmt_pistas = $conexion->query($sql_pistas);
        while ($tipo = $stmt_pistas->fetch(PDO::FETCH_ASSOC)) {
            $tipos_de_pista[] = $tipo['tipo_pista'];
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
    try {
        $sql = "SELECT id_extra, tipo_extra FROM extras_reservas";
        $stmt = $conexion->query($sql);
        while ($extra = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $opciones_extras .= "<option value='{$extra['id_extra']}'>{$extra['tipo_extra']}</option>";
        }
    } catch (PDOException $e) { echo "Error extras: " . $e->getMessage(); }

    // 4. Generar Horas
    $opciones_value = "";
    $opciones_horas = ["8", "9", "10", "11", "12", "13", "15", "16", "17", "18", "19", "20", "21", "22"];
    foreach ($opciones_horas as $hora) {
        $h_formato = str_pad($hora, 2, "0", STR_PAD_LEFT) . ":00";
        $opciones_value .= "<option value='$h_formato'>$h_formato</option>";
    }
    // 5. PROCESAR FORMULARIO (INSERT)
    // Importante: Asegúrate de que tu botón en el HTML tenga name="crear_reserva"
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear_reserva'])) {
        
        $id_usuario = $_SESSION['id_usuario'] ?? null;
        $id_pista = $_POST['id_pista'] ?? null;
        $id_extra = $_POST['id_extra'] ?? 6;
        $id_extra = $_POST['id_extra'] ?? 6;
        $fecha_reserva = $_POST['fecha_reserva'] ?? null; // Corregido: antes tenías $ = ...
        $hora_reserva = $_POST['hora_inicio'] ?? null;
    }
}