<?php
$array = [1, 9, 128, 19, 0, 982, 1, 5, 8, -9, 10, 15];
$num0 = 0;
$numP = 0;
$numN = 0;
$sumaP = 0;
$sumaN = 0;

for ($i = 0; $i < sizeof($array); $i++) {
    if ($array[$i] > 0) {
        $numP++;
        $sumaP += $array[$i];
    } else if ($array[$i] < 0) {
        $numN++;
        $sumaN += $array[$i];
    } else {
        $num0 ++;
    }
}

echo ("Positivo " . $sumaP / $numP . "<br>Negativo " . $sumaN / $numN . "<br>Ceros " . $num0);
