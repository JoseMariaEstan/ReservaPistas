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
                    <li><a href="<?php echo isset($_SESSION['Logueado']) && $_SESSION['Logueado'] ? 'paginaReservas.php' : 'login.php'; ?>">Reservas</a></li>
                    <li><a href="paginausuario.php">Mi cuenta</a></li>
                    <li><a href="paginaIngles.php">Switch to English?</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="usuario-container">
        <section class="user-card">
            <h1>Información general</h1>
            <p class="user-note">Aquí puedes ver los datos principales de tu cuenta en PistasVegaPlus.</p>

            <div class="user-info">
                <?php foreach ($usuarioInfo as $label => $valor): ?>
                    <div class="user-info-row">
                        <span><?php echo htmlspecialchars($label); ?></span>
                        <strong><?php echo htmlspecialchars($valor); ?></strong>
                    </div>
                <?php endforeach; ?>
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
