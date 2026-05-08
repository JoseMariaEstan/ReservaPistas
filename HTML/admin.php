<?php include "../PHP/phpAdmin.php"; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/StylePp.css">
    <link rel="stylesheet" href="../Css/StyleAdmin.css">
    <title>Panel Administrador - PistasVegaPlus</title>
    <style>
    </style>
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
                    <li><a href="paginaReservas.php">Reservas</a></li>
                    <li><a href="loginIngles.php">Inglés</a></li>
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

    <section class="admin-table">
        <h2>Lista de Usuarios Registrados</h2>
        <?php echo $tabla_usuarios; ?>
        <form method="post" action="" style="margin-top: 15px; display: flex; align-items: center; justify-content: center; gap: 10px;">
            <input type="hidden" name="inicio" value="<?php echo $inicio; ?>">
            <input type="submit" name="direccion" value="anterior" <?php if($inicio <= 0) echo 'disabled'; ?>>
            <span>Página: <?php echo $pagina_actual; ?></span>
            <input type="submit" name="direccion" value="siguiente" <?php if($inicio + 16 >= $total_cuentas) echo 'disabled'; ?>>
        </form>
    </section>

    <section class="admin-summary">
        <h2>Información adicional</h2>
        <p>Este panel muestra datos simulados diseñados para representar métricas de administración. En un entorno real, estos indicadores se actualizarían automáticamente con información tomada desde el servidor y la base de datos.</p>
        <p>La sección de usuarios conectados sirve para detectar picos de tráfico. Las cuentas creadas ofrecen una visión del crecimiento. La carga del servidor ayuda a entender el rendimiento, y la media mensual permite conocer la tendencia de uso.</p>
    </section>
</body>
</html>