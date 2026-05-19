<?php include "../PHP/phpAdmin.php"; ?>
<!DOCTYPE html>
<htm lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <link rel="stylesheet" href="../Css/StylePp.css">
    <link rel="stylesheet" href="../Css/StyleAdmin.css">
    <title>Panel Administrador - PistasVegaPlus</title>
    <style>
    </style>
</head>
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
                    <li><a href="paginausuario.php">Reservas</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <section class="admin-header">
        <h1>Panel Administrador</h1>
        <p>Resumen de actividad y rendimiento en tiempo real de PistasVegaPlus.</p>
    </section>

    <section class="admin-dashboard">
        <article class="admin-card">
            <div>
                <h2>Usuarios conectados</h2>
                <p class="stat">1</p>
            </div>
            <p class="note">Número de sesiones activas en este momento, incluyendo clientes y administradores.</p>
        </article>

        <article class="admin-card">
            <div>
                <h2>Cuentas creadas</h2>
                <p class="stat"><?php echo $total_cuentas; ?></p>
            </div>
            <p class="note">Total de cuentas registradas en la plataforma desde su puesta en marcha.</p>
        </article>

        <article class="admin-card">
            <div>
                <h2>Carga del servidor</h2>
                <p class="stat"><?php echo $carga_servidor; ?>%</p>
            </div>
            <p class="note">Uso aproximado de los recursos de servidor en las últimas 5 minutos.</p>
        </article>

        <article class="admin-card">
            <div>
                <h2>Media usuarios mensuales</h2>
                <p class="stat"><?php echo $media_usuarios_mensuales; ?></p>
            </div>
            <p class="note">Promedio de usuarios únicos que visitan la plataforma cada mes.</p>
        </article>
    </section>

    <section class="admin-table" id="lista-usuarios">
        <h2>Lista de Usuarios Registrados</h2>
        <?php echo $tabla_usuarios; ?>
        <form method="post" action="#lista-usuarios" style="margin-top: 15px; display: flex; align-items: center; justify-content: center; gap: 10px;">
            <input type="hidden" name="inicio" value="<?php echo $inicio; ?>">
            <input type="submit" name="direccion" value="anterior" <?php if($inicio <= 0) echo 'disabled'; ?>>
            <span>Página: <?php echo $pagina_actual; ?></span>
            <input type="submit" name="direccion" value="siguiente" <?php if($inicio + 15 >= $total_cuentas) echo 'disabled'; ?>>
        </form>
    </section>
    <section class="admin-delete" id="admin-delete">
        <h2>ELIMINAR USUARIOS</h2>
        <?php if (!empty($mensaje_eliminar)): ?>
            <p class="delete-message"><?php echo htmlspecialchars($mensaje_eliminar); ?></p>
        <?php endif; ?>
        <form action="#admin-delete" method="post">
            <input type="hidden" name="inicio" value="<?php echo $inicio; ?>">
            <label for="usuario_borrar">Nombre de usuario a eliminar:</label>
            <input id="usuario_borrar" type="text" name="usuario_borrar" required>
            <div style="display:flex; gap:10px; justify-content:center; margin-top:10px;">
                <button class="ButInicSes" type="submit">Eliminar cuenta</button>
                <button type="reset">Limpiar</button>
            </div>
        </form>
    </section>
    
    <?php include "../HTML/footer.php"?>

</body>
</html>