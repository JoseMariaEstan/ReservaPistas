<?php include "../PHP/phpPrincipal.php"; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Imagenes/LogoRVegaPlus.png" type="image/x-icon">
    <link rel="stylesheet" href="../Css/StylePp.css">
    <title>PistasVegaPlus</title>
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
                    <li><a href="#Horarios">Horarios</a></li>
                    <li><a href="paginaProximamente.php">Próximamente</a></li>
                    <li><a href="#Contacto">Contacto</a></li>
                    <li><a href="paginausuario.php"> <img src="../Imagenes/Usuario.svg" width="20" alt="Usuario"></a></li>
                </ul>
            </div>
        </nav>
    </header>

    <div style="text-align: center;">
        <h1>Bienvenido a PistasVegaPlus</h1>
        <p>Tu lugar ideal para reservar pistas deportivas en la Vega Baja</p>
    </div>
    <section class="contenido">
        <div class="Introduccion">
            <h2>¿Por qué elegir PistasVegaPlus?</h2>
            <h3>Tu próxima partida, a solo un clic</h3>
            <p>La forma de reservar tus espacios deportivos para que el tiempo juegue siempre a tu favor. 
               Sabemos que tu ritmo de vida no se detiene, por eso hemos creado una plataforma intuitiva donde la rapidez y la sencillez son nuestra máxima prioridad. 
               Olvida las esperas al teléfono o los desplazamientos innecesarios solo para consultar disponibilidad.</p>
            
            <p>Esta web te ofrece acceso inmediato a un calendario en tiempo real de todas nuestras instalaciones. 
               Gestiona tus reservas desde cualquier dispositivo y concéntrate en lo que realmente importa: 
               <strong>tu mejor golpe y disfrutar del juego.</strong>
            </p>
        </div>

        <div class="imagenrecinto">
            <img src="../Imagenes/RecintoPistas.png" alt="Recinto Deportivo">
        </div> 
    </section>
    <section id="Horarios" class="seccion_horarios">
        <h1>HORARIOS DISPONIBLES De Nuestras Instalaciones</h1>
        <table class="tabla_horarios">
            <thead>
                <tr>
                    <th>Día</th>
                    <th>Apertura</th>
                    <th>Cierre</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>Lunes</td><td>8:00</td><td>22:00</td></tr>
                <tr><td>Martes</td><td>8:00</td><td>22:00</td></tr>
                <tr><td>Miércoles</td><td>8:00</td><td>22:00</td></tr>
                <tr><td>Jueves</td><td>8:00</td><td>22:00</td></tr>
                <tr><td>Viernes</td><td>8:00</td><td>22:00</td></tr>
                <tr><td>Sábado</td><td>8:00</td><td>20:00</td></tr>
                <tr><td>Domingo</td><td>8:00</td><td>20:00</td></tr>
            </tbody>
        </table>
    </section>
    <section>
        <h1>POSIBLES PISTAS</h1>
        <div class="contenido">
            <div class="pistas">
                <img src="<?php echo "$imagen_elegida2"; ?>" alt="Pista de Pádel">
                <h3>Pista de Pádel</h3>
                <div class="extras">
                    <ul>
                        <li>Iluminación</li>
                        <li>Pista Techada</li>
                        <li><strong>TIPOS DE PISTAS</strong>
                            <ul>
                                <li>Pista de Césped Artificial</li>
                                <li>Resina</li>
                                <li>Hormigón poroso</li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="pistas">
                <img src="<?php echo "$imagen_elegida1"; ?>" alt="Pista de Tenis">
                <h3>Pista de Tenis</h3>
                <div class="extras">
                    <ul>
                        <li>Iluminación</li>
                        <li>Pista Techada</li>
                        <li><strong>TIPOS DE PISTAS</strong>
                            <ul>
                                <li>Pista de arena</li>
                                <li>Resina</li>
                                <li>Hormigón poroso</li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="pistas">
                <img src="<?php echo "$imagen_elegida3"; ?>" alt="Pista de Fútbol">
                <h3>Pista de Fútbol 11 / Futbol Sala</h3>
                <div class="extras">
                    <ul>
                        <li>Iluminación</li>
                        <li>Pista Techada</li>
                        <li><strong>TIPOS DE PISTAS</strong>
                            <ul>
                                <li>Pista de Césped Natural / Cesped Artificial</li>
                                <li>Pista de Fútbol Sala</li>
                                <li>Pista de Fútbol 7</li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="seccion_croquis">
        <h2>Mapa Basico Instalaciones</h2>
        <div class="CroquisRecinto">
                <img src="../Imagenes/CroquisRecinto.png" alt="Croquis del Recinto Deportivo">
        </div>
    </section>

    <?php include "../HTML/footer.php"?>

</body>
</html>