<?php
$deporteSeleccionado = $_SERVER['REQUEST_METHOD'] === 'POST' ? ($_POST['deporte'] ?? 'todas') : 'todas';
$fechaSeleccionada = $_SERVER['REQUEST_METHOD'] === 'POST' ? ($_POST['fecha_seleccionada'] ?? '') : '';

function mostrarDetalle(string $deporte, string $fecha, string $filtroDeporte, string $filtroFecha): string
{
    $coincideDeporte = $filtroDeporte === 'todas' || $filtroDeporte === $deporte;
    $coincideFecha = $filtroFecha === '' || $filtroFecha === $fecha;
    return $coincideDeporte && $coincideFecha ? '' : ' style="display:none;"';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/StylePR.css">
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
            <ul class="menu">
                <li><a href="paginaPp.php">Inicio</a></li>
                <li><a href="#Contacto">Contacto</a></li>
                <li><a href="paginaInglesReservas.php">English?</a></li>
                <li><a href="paginausuario.php"> <img src="../Imagenes/Usuario.svg" width="20" alt="Usuario"></a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>PISTAS A RESERVAR</h1>

        <section class="seccion_croquis">
            <h2>Mapa Básico Instalaciones</h2>
            <div class="CroquisRecinto">
                <img src="../Imagenes/CroquisRecinto.png" alt="Croquis del Recinto Deportivo">
            </div>
        </section>

        <section class="seccion_filtro">
            <h2>Reservar Pistas</h2>
            <form method="POST" action="">
                <div>
                    <label class="tipo-pista" for="filtro-pistas">Filtrar por tipo de pista:</label>
                    <select id="filtro-pistas" name="deporte">
                        <option value="todas" <?= $deporteSeleccionado === 'todas' ? 'selected' : '' ?>>Todas</option>
                        <option value="padel" <?= $deporteSeleccionado === 'padel' ? 'selected' : '' ?>>Pádel</option>
                        <option value="tenis" <?= $deporteSeleccionado === 'tenis' ? 'selected' : '' ?>>Tenis</option>
                        <option value="futbol" <?= $deporteSeleccionado === 'futbol' ? 'selected' : '' ?>>Fútbol 11 / Sala</option>
                    </select>
                    <label for="fecha">Selecciona una fecha:</label>
                    <input type="date" id="fecha" name="fecha_seleccionada" value="<?= $fechaSeleccionada ?>">
                    <button type="submit">Enviar</button>
                </div>
            </form>
        </section>

        <section class="SecPistas">
            <details class="pistas-detalles" data-deporte="padel" data-fecha="2026-05-11"<?= mostrarDetalle('padel', '2026-05-11', $deporteSeleccionado, $fechaSeleccionada) ?>>
                <summary class="desplegable">Pista de Pádel</summary>
                <div class="contenedor_horarios_flex">
                    <div class="dia_cabecera">Horarios disponibles (Hoy)</div>
                    <table class="tabla_horarios">
                        <tr>
                            <td class="hora">8:00</td>
                            <td class="hora">9:00</td>
                            <td class="hora">10:00</td>
                            <td class="hora">11:00</td>
                        </tr>
                        <tr>
                            <td class="hora">12:00</td>
                            <td class="hora">13:00</td>
                            <td class="hora">15:00</td>
                            <td class="hora">16:00</td>
                        </tr>
                        <tr>
                            <td class="hora">17:00</td>
                            <td class="hora">18:00</td>
                            <td class="hora">19:00</td>
                            <td class="hora">20:00</td>
                        </tr>
                        <tr>
                            <td class="hora">21:00</td>
                            <td class="hora">22:00</td>
                            <td colspan="2"></td>
                        </tr>
                    </table>
                </div>
                <div class="extras-content">
                    <h3>EXTRAS</h3>
                    <label class="container">⬤ Iluminación <input type="checkbox"><span class="checkmark"></span></label>
                    <label class="container">⬤ Pista Techada <input type="checkbox"><span class="checkmark"></span></label>
                    <h3>TIPOS DE PISTA</h3>
                    <label class="container">⬤ Césped Artificial <input type="checkbox"><span class="checkmark"></span></label>
                    <label class="container">⬤ Resina <input type="checkbox"><span class="checkmark"></span></label>
                    <label class="container">⬤ Hormigón poroso <input type="checkbox"><span class="checkmark"></span></label>
                </div>
            </details>

            <details class="pistas-detalles" data-deporte="tenis" data-fecha="2026-05-12"<?= mostrarDetalle('tenis', '2026-05-12', $deporteSeleccionado, $fechaSeleccionada) ?>>
                <summary class="desplegable">Pista de Tenis</summary>
                <div class="contenedor_horarios_flex">
                    <div class="dia_cabecera">Horarios disponibles (Hoy)</div>
                    <table class="tabla_horarios">
                        <tr>
                            <td class="hora">8:00</td>
                            <td class="hora">9:00</td>
                            <td class="hora">10:00</td>
                            <td class="hora">11:00</td>
                        </tr>
                        <tr>
                            <td class="hora">12:00</td>
                            <td class="hora">13:00</td>
                            <td class="hora">15:00</td>
                            <td class="hora">16:00</td>
                        </tr>
                        <tr>
                            <td class="hora">17:00</td>
                            <td class="hora">18:00</td>
                            <td class="hora">19:00</td>
                            <td class="hora">20:00</td>
                        </tr>
                        <tr>
                            <td class="hora">21:00</td>
                            <td class="hora">22:00</td>
                            <td colspan="2"></td>
                        </tr>
                    </table>
                </div>
                <div class="extras-content">
                    <h3>EXTRAS</h3>
                    <label class="container">⬤ Iluminación <input type="checkbox"><span class="checkmark"></span></label>
                    <label class="container">⬤ Pista Techada <input type="checkbox"><span class="checkmark"></span></label>
                    <h3>TIPOS DE PISTA</h3>
                    <label class="container">⬤ Arena <input type="checkbox"><span class="checkmark"></span></label>
                    <label class="container">⬤ Resina <input type="checkbox"><span class="checkmark"></span></label>
                    <label class="container">⬤ Hormigón poroso <input type="checkbox"><span class="checkmark"></span></label>
                </div>
            </details>

            <details class="pistas-detalles" data-deporte="futbol" data-fecha="2026-05-11"<?= mostrarDetalle('futbol', '2026-05-11', $deporteSeleccionado, $fechaSeleccionada) ?>>
                <summary class="desplegable">Fútbol 11 / Sala</summary>
                <div class="contenedor_horarios_flex">
                    <div class="dia_cabecera">Horarios disponibles (Hoy)</div>
                    <table class="tabla_horarios">
                        <tr>
                            <td class="hora">8:00</td>
                            <td class="hora">9:00</td>
                            <td class="hora">10:00</td>
                            <td class="hora">11:00</td>
                        </tr>
                        <tr>
                            <td class="hora">12:00</td>
                            <td class="hora">13:00</td>
                            <td class="hora">15:00</td>
                            <td class="hora">16:00</td>
                        </tr>
                        <tr>
                            <td class="hora">17:00</td>
                            <td class="hora">18:00</td>
                            <td class="hora">19:00</td>
                            <td class="hora">20:00</td>
                        </tr>
                        <tr>
                            <td class="hora">21:00</td>
                            <td class="hora">22:00</td>
                            <td colspan="2"></td>
                        </tr>
                    </table>
                </div>
                <div class="extras-content">
                    <h3>EXTRAS</h3>
                    <label class="container">⬤ Iluminación <input type="checkbox"><span class="checkmark"></span></label>
                    <label class="container">⬤ Pista Techada <input type="checkbox"><span class="checkmark"></span></label>
                    <h3>TIPOS DE PISTA</h3>
                    <label class="container">⬤ Césped Natural <input type="checkbox"><span class="checkmark"></span></label>
                    <label class="container">⬤ Césped Artificial <input type="checkbox"><span class="checkmark"></span></label>
                    <label class="container">⬤ Pista de Sala <input type="checkbox"><span class="checkmark"></span></label>
                </div>
            </details>
        </section>

        <div class="marco-precio">
            <p>Total Reserva:</p>
            <span id="precio-valor">0.00€</span>
        </div>
    </main>

    <footer class="footer" id="Contacto">
        <p><strong>Contacto:</strong> info@pistasvegaplus.com</p>
        <p><strong>Dirección:</strong> Calle Falsa 123, Ciudad, País</p>
        <p><strong>Teléfono:</strong> +34 123 456 789</p>
    </footer>
</body>
</html>
