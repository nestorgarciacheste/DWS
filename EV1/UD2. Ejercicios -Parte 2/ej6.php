<?php

$matriz = [5, 6, -7, 9, 3, -4, -2, 0, 1, 2];
$num = 0;
$i = 0;
$sum = 0;

while ($num >= 0) {
    $num = $matriz[$i];
    if ($num >= 0) {
        $sum += $num;
        $i++;
    }
}

echo ($sum / $i);
