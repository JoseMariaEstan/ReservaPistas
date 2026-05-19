<?php
if (isset($_POST['enviarRecomendacion'])) {
    $mensajeRecom = "<p style='color:green; font-weight:bold;'>El mensaje ha sido enviado a nuestros administradores.</p>";
} else {
    $mensajeRecom = "<p style='color:black; font-weight:bold;'>Pulse enviar y se enviará la recomendación a nuestros administradores.</p>";
}

echo '<footer class="footer" id="Contacto">';
echo '<p><strong>Contacto:</strong> info@pistasvegaplus.com</p>';
echo '<p><strong>Dirección:</strong> Vereda Molino, s/n, 03380 Bigastro, Alicante.</p>';
echo '<p><strong>Teléfono:</strong> +34 123 456 789</p>';
echo '<form action="#Contacto" method="post">';  


echo '<iframe name="iframe_aemet_id33044" width="100%" height="100%" tabindex="0" id="iframe_aemet_id33044" src="https://www.aemet.es/es/eltiempo/prediccion/municipios/mostrarwidget/bigastro-id03044?w=g4p011100001ohmffffffx4f86d9t95b6e9r1s8n2" frameborder="0" scrolling="no"></iframe>';


echo '<label for="recomendacion">¿Desea enviar alguna recomendación?</label>';
echo '<input type="text" id="recomendacion" name="recomendacion" placeholder="Me gustaría que añadieran nuevos deportes">';
echo '<button class="enviarRecomd" type="submit" name="enviarRecomendacion">Enviar</button>';
echo $mensajeRecom;  
echo '</form>';      
echo '</footer>';
?>