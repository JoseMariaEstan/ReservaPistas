<?php include "../PHP/phpCrearCuenta.php"; ?>
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
                    <li><a href="loginIngles.php">Switch to English?</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <section class="login-section">
        <div>
            <h1>Crear Cuenta</h1>

            <?php if (isset($mensaje_registro)): ?>
                <p style="color: #28a745; text-align: center; font-weight: bold;"><?php echo $mensaje_registro; ?></p>
            <?php endif; ?>
            <?php if (isset($error_registro)): ?>
                <p style="color: #ff4d4d; text-align: center; font-weight: bold;"><?php echo $error_registro; ?></p>
            <?php endif; ?>

            <form action="crearCuenta.php" method="post" class="formLogin">
                <div class="campoLogin">
                    <label for="Usuario">Usuario (Email):</label>
                    <input type="text" id="Usuario" name="Usuario" required placeholder="ejemplo@gmail.com">
                </div>
                <div class="campoLogin">
                    <label for="contraseña">Contraseña:</label>
                    <input type="password" id="contraseña" name="contraseña" required placeholder="Escriba su Contraseña">
                </div>
                <div class="campoLogin">
                    <label for="confirmarContraseña">Confirmar Contraseña:</label>
                    <input type="password" id="confirmarContraseña" name="confirmarContraseña" required placeholder="Confirme su Contraseña">
                </div>
                <button class="ButInicSes" type="submit" name="btnRegistrar">Crear Cuenta</button>
            </form>
        </div>
        <div class="crearCuenta">
            <p>¿Ya tienes una cuenta? <a href="login.php">Iniciar Sesión</a></p>
        </div>
    </section>

    <footer class="footer" id="Contacto">
        <p><strong>Contacto:</strong> info@pistasvegaplus.com</p>
        <p><strong>Dirección:</strong> Calle Falsa 123, Ciudad, País</p>
        <p><strong>Teléfono:</strong> +34 123 456 789</p>
    </footer>
</body>
</html>