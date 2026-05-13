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
            
            <div class="user-actions" id="reservas">
                    <details class="reservas-detalles">
                        <summary class="desplegable">Ver detalles de mis reservas</summary>
                        <div class="crear-reserva">
                            <form action="../PHP/phpUsuario.php" method="POST">
                                <label for="pista_reserva">Selecciona una pista:</label>
                                    <select name="id_pista" id="pista_reserva" required onchange="this.form.action='paginausuario.php#reservas'; this.form.submit();">
                                        <option value="">-- Elige una pista --</option>
                                        <?php echo $opciones_pistas;?>
                                    </select>
                                    <label for="tipo_pista">Tipo de pista:</label>
                                    <select name="tipo_pista" id="tipo_pista">
                                        <option value="">-- --</option>
                                         <?php foreach ($tipos_de_pista as $tipo) {
                                            echo "<option value='{$tipo}'>{$tipo}</option>";
                                         }?>
                                    </select>
                                    <label for="id_extra">Selecciona un  extra (opcional):</label>
                                    <select name="id_extra" id="extras_reserva">
                                        <option value="">-- Elige un extra --</option>
                                        <?php echo $opciones_extras; ?>
                                    </select>


                                <label for="fecha_reserva">Selecciona una fecha:</label>
                                    <input type="date" id="fecha_reserva" name="fecha_reserva" required>
                                <label for="hora_inicio">Selecciona una hora:</label>
                                
                                <select name="hora_inicio" id="hora_inicio" required>
                                    <option value="">-- Elige una hora --</option>
                                        <?php echo $opciones_value; ?> 
                                </select>
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
