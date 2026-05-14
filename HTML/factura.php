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
            <!-- en esta parte, aparecen:
                -Logo
                -Nombre del centro
                -Cif
                -Direccion
                -Numero de factura
                -Fecha-->
                <div class="Logo">
                    <img src="../Imagenes/LogoRVegaPlus.png">
                </div>
                <div class="detalles">
                    <div class="detalles_centro">
                        <p>Nombre del centro: Pistas Vega Plus</p>
                        <p>CIF: B-1234567-8</p>
                        <p>Direccion: Calle Falsa 123, Ciudad, País</p>
                    </div>
                    <div class="detalles_centro2">
                        <p>Nº FACTURA: <?php echo $id_factura?></p>
                        <p>Fecha: <?php echo date('d-m-Y')?></p>
                    </div>
                </div>



            </div>
            <div class="cuerpo_factura">
                <!--En esta parte aparecen:
                    -Datos del cliente(Usuario,id_reserva)-->
                <div class="detalles_factura">
                    <!--En esta parte aparecen:
                    -Datos de la reserva(NombrePista,Extras escogidos,fecha,hora
                    ,precio de la reserva y precio total + IVA)-->
                
                </div>
            </div>
            
            <div class="pagar">
                <!--En esta parte aparecen:
                    -Datos del pago(Apareceran opciones de pago: Transferencia Bancaria/tarjeta/bizum/ Pago en efectivo presencial)-->
                

            </div>
        </section>
    <footer class="footer" id="Contacto">
        <p><strong>Contacto:</strong> info@pistasvegaplus.com</p>
        <p><strong>Dirección:</strong> Calle Falsa 123, Ciudad, País</p>
        <p><strong>Teléfono:</strong> +34 123 456 789</p>
    </footer>
</body>
</html>
