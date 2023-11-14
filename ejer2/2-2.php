<?php

    /*
        Muestra los números múltiplos de 5 de 0 a 100 utilizando un bucle for. Cambia el código
        para hacerlo con un while y con un do-while
    */

    for ($i=0; $i <= 100 ; $i++) { 
        if ($i % 5 === 0) {
            echo($i . "<br>");
        }
    }

    $i = 0;

    while ($i <= 100) {
        if ($i % 5 === 0) {
            echo($i . "<br>");
        }
        $i++;
    }

    $i = 0;

    do{
        if ($i % 5 === 0) {
            echo($i . "<br>");
        }
        $i++;
    } while ($i <= 100);