<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero1 = $_POST["numero1"];
    $numero2 = $_POST["numero2"];

    $resultado = $numero1 * $numero2;

    echo "<p>El resultado de la multiplicación es: $resultado</p>";
} else {
    echo "<p>Error: No se han recibido los datos del formulario correctamente.</p>";
}
