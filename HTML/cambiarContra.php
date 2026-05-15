<?php include "../PHP/phpCambiarContra.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/StyleLogin.css">
    <title>Crear Cuenta - Pistas VegaPlus</title>
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
                </ul>
            </div>
        </nav>
    </header>

    <section id="crear-cuenta" class="login-section">
        <div>
            <h1>Cambiar Contraseña</h1>

            <?php if (isset($mensaje_cambio)): ?>
                <p style="color: #28a745; text-align: center; font-weight: bold;"><?php echo $mensaje_cambio; ?></p>
            <?php endif; ?>
            <?php if (isset($error_cambio)): ?>
                <p style="color: #ff4d4d; text-align: center; font-weight: bold;"><?php echo $error_cambio; ?></p>
            <?php endif; ?>

            <form action="cambiarContra.php#crear-cuenta" method="post" class="formLogin">
                <div class="campoLogin">
                    <label for="Usuario">Usuario (Email):</label>
                    <input type="text" id="Usuario" name="Usuario" required placeholder="ejemplo@gmail.com">
                </div>
                <div class="campoLogin">
                    <label for="newcontra">Contraseña:</label>
                    <input type="password" id="newcontra" name="newcontra" required placeholder="Escriba su nueva Contraseña ">
                </div>
                <div class="campoLogin">
                    <label for="confirmarContraseñanueva">Confirmar Contraseña:</label>
                    <input type="password" id="confirmarContraseñanueva" name="confirmarContraseñanueva" required placeholder="Confirme su nueva Contraseña">
                </div>
                <button class="ButInicSes" type="submit" name="btncambiar">Cambiar Contraseña</button>
            </form>
        </div>
        <div class="crearCuenta">
            <p>¿Ya has cambiado la contraseña? <a href="login.php">Iniciar Sesión</a></p>
        </div>
    </section>

    <footer class="footer" id="Contacto">
        <p><strong>Contacto:</strong> info@pistasvegaplus.com</p>
        <p><strong>Dirección:</strong> Calle Falsa 123, Ciudad, País</p>
        <p><strong>Teléfono:</strong> +34 123 456 789</p>
    </footer>
</body>
</html>