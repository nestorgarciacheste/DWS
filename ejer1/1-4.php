<?php

$nombre = "Juan";
$edad = 25;

if ($nombre !== null && $edad !== null) {
    echo "Hola $nombre, Tiene $edad años.";
} elseif ($nombre !== null) {
    echo "Hola $nombre, No se tu edad.";
} else {
    echo "Hola desconocido.";
}

?>
