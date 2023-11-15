<?php
    $array = [1, 9, 128, 19, 982, 1, 5, 8, -9, 10, 15];
    $num = 0;
    $suma = 0;

    for ($i=0; $i < sizeof($array); $i++) { 
        if ($array[$i] < 0) {
            break;
        }
        $num ++;
        $suma += $array[$i];
    }

    echo($suma / $num);

?>