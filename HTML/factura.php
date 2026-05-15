<?php
include "../PHP/phpUsuario.php";
include "../PHP/phpFactura.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../Css/StylePp.css">
    <link rel="stylesheet" href="../Css/StyleFactura.css">
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
                    <li><a href="">Switch to English?</a></li>
                    <li><a href="paginausuario.php"> <img src="../Imagenes/Usuario.svg" width="20" alt="Usuario"></a></li>
                </ul>
            </div>
        </nav>
    </header>
    <body>
        <section class="factura">
            <div class="header_factura">
                <div class="Logo">
                    <img src="../Imagenes/LogoRVegaPlus.png">
                </div>
                    <h5>Detalles del centro y factura</h5>
                <div class="detalles">
                    <div class="detalles_centro">
                        <p>Nombre del centro: Pistas Vega Plus</p>
                        <p>CIF: B-1234567-8</p>
                        <p>Direccion: Calle Falsa 123, Ciudad, País</p>
                    </div>
                    <div class="detalles_centro2">
                        <p>Nº FACTURA: <?php echo $id_factura;?></p>
                        <p>Fecha: <?php echo date('d-m-Y')?></p>
                    </div>
                </div>
                <div class="detalles_factura">
                   <h5>Detalles de la reserva</h5>
                        <div class="cuerpo_factura">
                            <p><strong>Usuario:</strong> <?php echo htmlspecialchars($nombre_usuario); ?></p>
                            <p><strong>Fecha:</strong> <?php echo htmlspecialchars($fecha_reserva); ?></p>
                            <p><strong>Hora:</strong> <?php echo htmlspecialchars($hora_inicio); ?></p>

                            <div class="detalles_cobro_seccion">
                                <h5>Detalles del cobro</h5>
                                <table class="tabla-factura">
                                    <thead>
                                        <tr>
                                            <th>Descripción</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Reserva Pista: <?php echo htmlspecialchars($nombre_pista); ?></td>
                                            <td><?php echo number_format($precio_pista, 2); ?> €</td>
                                        </tr>
                                        <tr>
                                            <td>Extras contratados</td>
                                            <td><?php echo number_format($precio_extras, 2); ?> €</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td>Tipo de extra contratado</td>
<<<<<<< HEAD
                                            <td><?php echo $nombre_extra ?></td>
=======
                                            <td><?php echo $nombre_extra; ?></td>
>>>>>>> PHP-Factura
                                        </tr>
                                        <tr>
                                            <td>Subtotal (Base Imponible)</td>
                                            <td><?php echo number_format($subtotal, 2); ?> €</td>
                                        </tr>
                                        <tr>
                                            <td>IVA (21%)</td>
                                            <td><?php echo number_format($iva, 2); ?> €</td>
                                        </tr>
                                        <tr class="total-row">
                                            <td><strong>TOTAL A PAGAR</strong></td>
                                            <td><strong><?php echo number_format($total_con_iva, 2); ?> €</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <div class="pagar">
                            <h5>Método de Pago</h5>
                            <form action="factura.php?id=<?php echo $id_factura; ?>" method="post">
                            <select name="metodo_pago" class="select-pago" required>
                                <option value="transferencia">Transferencia Bancaria</option>
                                <option value="tarjeta">Tarjeta de Crédito/Débito</option>
                                <option value="bizum">Bizum</option>
                                <option value="efectivo">Pago en efectivo presencial</option>
                            </select>
                            <button class="btn-pagar" name="pagar">Confirmar y Pagar</button>
                            <?php if (isset($_POST['pagar'])){
                                    echo "<p style='color: green; font-weight: bold;' >🎉Reserva pagada gracias por reservar en Pistas Vega Plus🎉</p>";
                            } ?>
                            </form> 
                        </div>
                    <!--En esta parte aparecen:
                    -Datos de la reserva(NombrePista,Extras escogidos,fecha,hora
                    ,precio de la reserva y precio total + IVA)-->
                
                </div>
            </div>
        </section>
    <footer class="footer" id="Contacto">
        <p><strong>Contacto:</strong> info@pistasvegaplus.com</p>
        <p><strong>Dirección:</strong> Calle Falsa 123, Ciudad, País</p>
        <p><strong>Teléfono:</strong> +34 123 456 789</p>
    </footer>
</body>
</html>
