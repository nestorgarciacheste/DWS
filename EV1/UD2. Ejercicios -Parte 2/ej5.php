<?php

$matriz = [5, -6, 7, 9, 3, -4, -2, 0, 1, 2];

for ($i = 0; $i < sizeof($matriz); $i++) {
    $num = $matriz[$i];
    if ($num === 0) {
        break;
    } elseif ($num > 0) {
        echo $num . " es positivo" . "<br>";
    } else {
        echo $num . " es negativo" . "<br>";
    }
}
