<?php include "../PHP/phpLogin.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/StyleLogin.css">
    <title>Iniciar Sesión - Pistas VegaPlus</title>
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

    <section id="login-section" class="login-section">
        <div >
            <h1>Iniciar Sesión</h1>
                <?php if (isset($error_login)): ?>
                    <p style="color: #ff4d4d; font-weight: bold; text-align: center;">
                        <?php echo $error_login; ?>
                    </p>
                <?php endif; ?>

            <form action="login.php#login-section" method="post" class="formLogin">
                <div class="campoLogin">
                    <label for="Usuario">Usuario:</label>
                    <input type="text" id="Usuario" name="Usuario" required placeholder="Ejemplo@gmail.com">
                </div>
                <div class="campoLogin">
                    <label for="contraseña">Contraseña:</label>
                    <input type="password" id="contraseña" name="contraseña" required placeholder="Escriba su Contraseña">
                </div>
                
                <div class="login-buttons">
                    <button class="ButInicSes" type="submit" name="login">Iniciar Sesión</button>
                    <button class="ButInicSes" type="submit" name="eliminar_cuenta">Eliminar Cuenta</button>
                </div>
            </form>
        </div>
        <div class="contenedorRedes">
        <a href="#" class="botonRedes">
            <img src="../Imagenes/logoGoogle.svg" alt="Google" class="logosLogin">
            <span>Google</span>
        </a>
        <a href="#" class="botonRedes">
            <img src="../Imagenes/logoFacebook.svg" alt="Facebook" class="logosLogin">
            <span>Facebook</span>
        </a>
        </div>
        <div class="crearCuenta">
            <p>¿No tienes una cuenta? <a href="crearCuenta.php">Crear Cuenta</a></p>
        </div>
    </section>
        <footer class="footer" id="Contacto">
        <p><strong>Contacto:</strong> info@pistasvegaplus.com</p>
        <p><strong>Dirección:</strong> Calle Falsa 123, Ciudad, País</p>
        <p><strong>Teléfono:</strong> +34 123 456 789</p>
    </footer>
</body>
</html>