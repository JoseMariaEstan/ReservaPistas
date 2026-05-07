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
                    <li><a href="login.php">Reservas</a></li>
                    <li><a href="paginaReservas.php">Panel Usuario</a></li>
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
                <p class="stat">128</p>
            </div>
            <p class="note">Número de sesiones activas en este momento, incluyendo clientes y administradores.</p>
        </article>

        <article class="admin-card">
            <div>
                <h2>Cuentas creadas</h2>
                <p class="stat">5,742</p>
            </div>
            <p class="note">Total de cuentas registradas en la plataforma desde su puesta en marcha.</p>
        </article>

        <article class="admin-card">
            <div>
                <h2>Carga del servidor</h2>
                <p class="stat">67%</p>
            </div>
            <p class="note">Uso aproximado de los recursos de servidor en las últimas 5 minutos.</p>
        </article>

        <article class="admin-card">
            <div>
                <h2>Media usuarios mensuales</h2>
                <p class="stat">3,950</p>
            </div>
            <p class="note">Promedio de usuarios únicos que visitan la plataforma cada mes.</p>
        </article>
    </section>

    <section class="admin-summary">
        <h2>Información adicional</h2>
        <p>Este panel muestra datos simulados diseñados para representar métricas de administración. En un entorno real, estos indicadores se actualizarían automáticamente con información tomada desde el servidor y la base de datos.</p>
        <p>La sección de usuarios conectados sirve para detectar picos de tráfico. Las cuentas creadas ofrecen una visión del crecimiento. La carga del servidor ayuda a entender el rendimiento, y la media mensual permite conocer la tendencia de uso.</p>
    </section>
</body>
</html>