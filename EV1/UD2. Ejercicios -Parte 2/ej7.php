<?php

$matriz = [5, 6, -7, 9, 3, -4, -2, 0, 1, 2];
$sum1 = 0;
$sum2 = 0;
$count1 = 0;
$count2 = 0;

for ($i = 0; $i < sizeof($matriz); $i++) {
    if ($matriz[$i] >= 0) {
        $sum1 += $matriz[$i];
        $count1++;
    } else {
        $sum2 += $matriz[$i];
        $count2++;
    }
}

echo ($sum1 / $count1 . "<br>");
echo ($sum2 / $count2);
