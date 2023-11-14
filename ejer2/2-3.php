<?php

    /* 
        Programa que muestre por pantalla los 5 primeros números pares.
    */

    $i = 0;
    $num = 1;
    while($i < 5) {
        if ($num % 2 == 0) {
            echo($num . "<br>");
            $i ++;
        }
        $num ++;
    }