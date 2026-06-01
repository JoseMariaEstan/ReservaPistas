<?php
include "../PHP/phpUsuario.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../Imagenes/LogoRVegaPlus.png" type="image/x-icon">
    <link rel="stylesheet" href="../Css/StyleUsuario.css">
    <link rel="stylesheet" href="../Css/StylePp.css">

    <title>Mi cuenta - PistasVegaPlus</title>
</head>
<body>
    <header>
        <nav> 
            <div class="logopagina">
                <a href="paginaPp.php">
                    <img src="../Imagenes/LogoRVegaPlus.png" width="100" alt="Logo PistasVegaPlus" class="logo">
                </a>
            </div> 
            <div>
                <ul class="menu">
                    <li><a href="paginaPp.php">Inicio</a></li>
                    <li><a href="paginaPp.php#Horarios">Horarios</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <main class="usuario-container">
        <section class="user-card">
            <h1>Información general</h1>
            <p class="user-note">Aquí puedes ver los datos principales de tu cuenta en PistasVegaPlus.</p>

            <div class="user-info">
                <?php foreach ($usuarioInfo as $infoUsser => $valor): ?>
                    <div class="user-info-row">
                        <span><?php echo htmlspecialchars($infoUsser); ?></span>
                        <strong><?php echo htmlspecialchars($valor); ?></strong>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="user-actions">

            <details class="reservas-detalles">
            <summary class="desplegable" id="reservasRealizadas">Mis Reservas Realizadas</summary>
                
                <?php echo $tabla_reservas; ?>
                
                <form method="post" action="paginausuario.php#reservasRealizadas" style="margin-top: 15px; display: flex; align-items: center; justify-content: center; gap: 10px;">
                    <input type="hidden" name="inicio" value="<?php echo $inicio; ?>">
                    <input type="submit" name="direccion" value="anterior" <?php if($inicio <= 0) echo 'disabled'; ?>>
                    <span>Página: <?php echo $pagina_actual; ?></span>
                    <input type="submit" name="direccion" value="siguiente" <?php if($inicio + $registros_por_pagina >= $total_reservas) echo 'disabled'; ?>>
                </form>
           </details> 
            
            
                    <details class="reservas-detalles">
                        <summary class="desplegable" id="reservas">Añadir reserva</summary>
                        <div class="crear-reserva">
                            <form action="paginausuario.php#reservas" method="POST" id="formulario_reserva">
                                <label for="pista_reserva">Selecciona una pista:</label>
                                    <select name="id_pista"  required onchange="this.form.action='paginausuario.php#reservas'; this.form.submit();">
                                        <option value="">-- Elige una pista --</option>
                                        <?php echo $opciones_pistas;?>
                                    </select>
                                    <label for="tipo_pista">Tipo de pista:</label>
                                        <select name="tipo_pista" id="tipo_pista">
                                            <option value="todas">-- Mostrar todas --</option>
                                            <?php
                                            foreach ($tipos_de_pista as $tipo) {
                                                // Si hay una pista elegida, deshabilitamos todos los tipos excepto el que coincide
                                                $disabled = ($id_pista_seleccionada && $tipo !== $selected_tipo_pista) ? ' disabled' : '';
                                                
                                                // Marcamos como seleccionado de forma automática el tipo de pista correspondiente
                                                $selected = ($id_pista_seleccionada && $tipo === $selected_tipo_pista) ? ' selected' : '';
                                                
                                                echo "<option value='{$tipo}'{$disabled}{$selected}>{$tipo}</option>";
                                            }
                                            ?>
                                        </select>
                                    </select>
                                    <label for="id_extra">Selecciona un  extra (opcional):</label>
                                    <select name="id_extra" id="extras_reserva" onchange="this.form.action='paginausuario.php#reservas'; this.form.submit();">
                                        <option value="">-- Elige un extra --</option>
                                        <?php echo $opciones_extras; ?>
                                    </select>

                                <label for="fecha_reserva">Selecciona una fecha:</label>
                                    <input type="date" id="fecha_reserva" name="fecha_reserva" value="<?php echo htmlspecialchars($selected_fecha); ?>" min="<?php echo date('Y-m-d')?>" required  onchange="this.form.action='paginausuario.php#reservas'; this.form.submit();">

                                <label for="hora_inicio">Selecciona una hora:</label> 
                                <select name="hora_inicio" id="hora_inicio" required onchange="this.form.action='paginausuario.php#reservas'; this.form.submit();">
                                    <option value="">-- Elige una hora --</option>
                                        <?php echo $opciones_value; ?> 
                                </select>

                                <label for="rpecio_total">Precio total:</label>
                                <input type="text" id="precio_total" name="precio_total" value="<?php echo isset($precio_total) ? number_format($precio_total, 2) . ' €' : ''; ?>" readonly>

                                <button type="submit"name="crear_reserva">Crear nueva reserva</button>
                                <?php if (isset($_SESSION['reserva_exitosa']) && $_SESSION['reserva_exitosa'] === true) {
                                        $id_reserva = $_SESSION['ultima_reserva_id'] ?? null;
                                        $mensaje_reserva = "Reserva creada exitosamente ✅. <a href='factura.php?id=" . $id_reserva . "'>Ver factura</a>";
                                        echo "<p class='reservas-mensaje'>" . $mensaje_reserva . "</p>";
                                        // Limpiar la variable de sesión después de mostrar el mensaje
                                        unset($_SESSION['reserva_exitosa']);
                                } ?>
                        </form>
                    </div>
                </details>
            </div>
            <div class="user-actions">
                <a class="button" href="paginaPp.php">Volver a inicio</a>
                <a class="button secondary" href="../PHP/phpUsuario.php?action=cerrarSession" name="cerrarSesion">Cerrar sesión</a>
                <a class="button secondary" href="../PHP/phpUsuario.php?action=" name="cambiarContra">Cambiar contraseña</a>
            </div>
        </section>
    </main>

    <?php include "../HTML/footer.php"?>

</body>
</html>