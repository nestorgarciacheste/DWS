<?php

    /*
        Hacer un programa en php que muestre el texto contenido en las variables llamadas
        nombre y edad. Si nombre es NULL mostrará Hola desconocido, Si se declara un nombre X y
        edad es NULL mostrará Hola X, No se tu edad Si se declara un nombre X y edad es Y mostrará
        Hola X, Tiene Y años.
    */

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
