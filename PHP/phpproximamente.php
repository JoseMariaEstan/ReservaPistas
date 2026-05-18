<?php
require_once "../PHP/phpConexion.php";

if(session_status()==PHP_SESSION_NONE){
    session_start();
}

//Primera encuesta

$votos_positivos = $_SESSION['votos_positivos'];
$votos_negativos = $_SESSION['votos_negativos'];

if (!isset($_SESSION['votos_positivos'])){
    $_SESSION['votos_positivos']=0;
}
if (!isset($_SESSION['votos_negativos'])) {
    $_SESSION['votos_negativos'] =0;
}

// 3. Comprobar si se ha enviado el formulario y sumar +1 al que corresponda
if (isset($_POST['voto'])) {
    if ($_POST['voto'] === 'positivo') {
        $_SESSION['votos_positivos']++;
    } elseif ($_POST['voto'] === 'negativo') {
        $_SESSION['votos_negativos']++;
    }
    header("Location:paginaProximamente.php");

}

// 4. Asignar los valores de la sesión a tus variables para los cálculos
$votos_positivos = $_SESSION['votos_positivos'];
$votos_afavor=$votos_positivos;
$votos_negativos = $_SESSION['votos_negativos'];

// ✅ Correcto
$total_votos = (int)$votos_afavor + (int)$votos_negativos;
// 5. Calcular porcentajes
if ($total_votos > 0) {
    $porcentaje_pos = ($votos_afavor / $total_votos) * 100;
    $porcentaje_neg = ($votos_negativos / $total_votos) * 100;
} else {
    $porcentaje_pos = 50;
    $porcentaje_neg = 50;
}

//Segunda encuesta

$votos_positivos2 = $_SESSION['votos_positivos2'];
$votos_negativos2 = $_SESSION['votos_negativos2'];

if (!isset($_SESSION['votos_positivos2'])){
    $_SESSION['votos_positivos2']=0;
}
if (!isset($_SESSION['votos_negativos2'])) {
    $_SESSION['votos_negativos2'] =0;
}

// 3. Comprobar si se ha enviado el formulario y sumar +1 al que corresponda
if (isset($_POST['voto2'])) {
    if ($_POST['voto2'] === 'positivo') {
        $_SESSION['votos_positivos2']++;
    } elseif ($_POST['voto2'] === 'negativo') {
        $_SESSION['votos_negativos2']++;
    }
    header("Location:paginaProximamente.php");

}

// 4. Asignar los valores de la sesión a tus variables para los cálculos
$votos_positivos2 = $_SESSION['votos_positivos2'];
$votos_afavor2=$votos_positivos2;
$votos_negativos2 = $_SESSION['votos_negativos2'];

// ✅ Correcto
$total_votos2 = (int)$votos_afavor2 + (int)$votos_negativos2;
// 5. Calcular porcentajes
if ($total_votos2 > 0) {
    $porcentaje_pos2 = ($votos_afavor2 / $total_votos2) * 100;
    $porcentaje_neg2 = ($votos_negativos2 / $total_votos2) * 100;
} else {
    $porcentaje_pos2 = 50;
    $porcentaje_neg2 = 50;
}


?>