<?php
session_start();

if (!isset($_SESSION['hora_entrada'])) {
    $_SESSION['hora_entrada'] = time();
}

$hora_entrada = $_SESSION['hora_entrada'];
$hora_actual = time();
$tiempo_transcurrido = $hora_actual - $hora_entrada;

$tiempo_formato = date("H:i:s", $tiempo_transcurrido);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Página de Ejemplo</title>
</head>

<body>
    <h1>Bienvenido a la página de ejemplo</h1>
    <p>Tu hora de entrada en esta página fue: <?php echo date("H:i:s", $hora_entrada); ?></p>
    <p>Has estado en esta página durante: <?php echo $tiempo_formato; ?></p>
    <a href="salir.php">SALIR</a>
</body>

</html>