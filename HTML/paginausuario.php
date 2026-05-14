<?php
include "../PHP/phpUsuario.php";
require_once "../PHP/phpConexion.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../Css/StyleUsuario.css">
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
                    <li><a href="paginaUsuarioIngles.php">Switch to English?</a></li>
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
                                    <input type="date" id="fecha_reserva" value="<?php echo htmlspecialchars($selected_fecha); ?>" name="fecha_reserva" required  onchange="this.form.action='paginausuario.php#reservas'; this.form.submit();">

                                <label for="hora_inicio">Selecciona una hora:</label> 
                                <select name="hora_inicio" id="hora_inicio" required onchange="this.form.action='paginausuario.php#reservas'; this.form.submit();">
                                    <option value="">-- Elige una hora --</option>
                                        <?php echo $opciones_value; ?> 
                                </select>

                                <label for="rpecio_total">Precio total:</label>
                                <input type="text" id="precio_total" name="precio_total" value="<?php echo isset($precio_total) ? number_format($precio_total, 2) . ' €' : ''; ?>" readonly>

                                <button type="submit"name="crear_reserva">Crear nueva reserva</button>
                        </form>
                    </div>
                </details>
            </div>
            <div class="user-actions">
                <a class="button" href="paginaPp.php">Volver a inicio</a>
                <a class="button secondary" href="login.php">Cerrar sesión</a>
            </div>
        </section>
    </main>

    <footer class="footer" id="Contacto">
        <p><strong>Contacto:</strong> info@pistasvegaplus.com</p>
        <p><strong>Dirección:</strong> Calle Falsa 123, Ciudad, País</p>
        <p><strong>Teléfono:</strong> +34 123 456 789</p>
    </footer>
</body>
</html>