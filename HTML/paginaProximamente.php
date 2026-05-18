<?php include "../PHP/phpPrincipal.php"; 
include "../PHP/phpproximamente.php"?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../Css/StylePp.css">
    <link rel="stylesheet" href="../Css/StyleProx.css">
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
                    <li><a href="#Contacto">Contacto</a></li>
                    <li><a href="paginausuario.php"> <img src="../Imagenes/Usuario.svg" width="20" alt="Usuario"></a></li>
                </ul>
            </div>
        </nav>
    </header>
    <section class="contenido">
        <div class="Introduccion">
            <h2>Proximamente</h2>
            <h3>En este apartado se muestra lo que la directiva piensa añadir a nuestro recinto</h3>
            <p>Este apartado ya mencionado, contara con una seria de secciones que mensualmente se iran actualizando, 
                según las recomendaciones que los usuarios vayan haciendo en el formulario puerto al final de cada pagina.
                Estas recomendaciones, no solo seran revisadas por nuestra directiva y equipo tecnico para evaluar la posibilidad 
                de su implementacion.Sino que tambien os dejaremos votar y ver que recomendaciones son las que mas os gustaria tener
                 cuanto antes en la encuesta de aqui debajo</p>
            
            <p>
               <strong>Tu tambien tienes el control de tu proximo juego</strong>
            </p>
        </div>

        <div class="imagenrecinto">
            <img src="../Imagenes/pistaConstruccion.png" alt="Pista en construccion">
        </div> 
    </section>

    <section class="Votos">
        <div class="fila-votos">
            <div class="columna_izq">
            <div class="formVotos">
                <h3>¿Nueva pista en el recinto, fronton?</h3>
                <label><strong>Votad en esta pequeña encuesta y veréis los resultados</strong></label>
                <form action="paginaProximamente.php#Encuesta1" method="post" id="Encuesta1">
                    <button for="voto" type="submit" name="voto" id="Afavor" value='positivo'>✅</button>
                    <button for="voto" type="submit" name="voto" id="enContra" value='negativo'>❌</button>
                </form>
            </div>
            
            <div class="contenedor-encuesta">
            <h3>Resultados de la Encuesta</h3>            
                <div class="info-votos">
                    <span>👍 <?php echo $votos_afavor; ?> Positivos</span>
                    <span>👎 <?php echo $votos_negativos; ?> Negativos</span>
                </div>
                <div class="grafico-barra">
                    <div class="barra-positiva" style="width: <?php echo $porcentaje_pos; ?>%;">
                        <?php echo round($porcentaje_pos); ?>%
                    </div>
                    <div class="barra-negativa" style="width: <?php echo $porcentaje_neg; ?>%;">
                        <?php echo round($porcentaje_neg); ?>%
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="imagenrecinto" id="fronton">
        <img src="../Imagenes/fronton.jpg" alt="nueva pista">
    </div>
    </section>
    
        <section class="Votos">
        <div class="fila-votos">
            <div class="columna_izq">
            <div class="formVotos">
                <h3>¿Adicion de deporte:Natcion + piscina climatizada?</h3>
                <label><strong>Votad en esta pequeña encuesta y veréis los resultados</strong></label>
                <form action="paginaProximamente.php#Encuesta2" method="post" id="Encuesta2">
                    <button for="voto2" type="submit" name="voto2" id="Afavor2" value='positivo'>✅</button>
                    <button for="voto2" type="submit" name="voto2" id="enContra2" value='negativo'>❌</button>
                </form>
            </div>
            
            <div class="contenedor-encuesta">
            <h3>Resultados de la Encuesta</h3>            
                <div class="info-votos">
                    <span>👍 <?php echo $votos_afavor2; ?> Positivos</span>
                    <span>👎 <?php echo $votos_negativos2; ?> Negativos</span>
                </div>
                <div class="grafico-barra">
                    <div class="barra-positiva" style="width: <?php echo $porcentaje_pos2; ?>%;">
                        <?php echo round($porcentaje_pos2); ?>%
                    </div>
                    <div class="barra-negativa" style="width: <?php echo $porcentaje_neg2; ?>%;">
                        <?php echo round($porcentaje_neg2); ?>%
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="imagenrecinto" id="fronton">
        <img src="../Imagenes/piscinaclimat.jpg" alt="nueva pista">
    </div>
    </section>


    <?php include "../HTML/footer.php"?>

</body>
</html>
