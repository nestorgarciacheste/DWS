<?php
$nombre = "Juan";
$edad = null;

echo $nombre === null ? "Hola desconocido" : (($nombre != null || $nombre != "") && $edad === null ? "Hola " . $nombre . ", no sé tu edad" : "Hola " . $nombre . ", tienes " . $edad . " años");
