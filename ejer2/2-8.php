<?php
$array = [[13, 1.6], [19, 1.8], [23, 2], [16, 1.9], [18, 2.2]];
$numM = 0;
$numC = 0;
$suma = 0;

for ($i = 0; $i < sizeof($array); $i++) {
    if ($array[$i][0] > 18) {
        $numM++;
        $suma += $array[$i][1];
    }
    if ($array[$i][1] > 1.75) {
        $numC++;
    }
}

echo ("Alumnos Mayores de 18: $numM <br>Suma: $suma <br>Num altos: $numC");
