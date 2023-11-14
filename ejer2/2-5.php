<?php
    $array = [-5, -4, -3, -2, -1, 5, 4, 3, 2, 1, 0, -9999];

    for ($i=0;; $i++) { 
        $num = $array[$i];
        if ($num === 0) {
            echo($num . " vamo a parar");
            break;
        } else if ($num % 2 === 0) {
            echo($num . " es par <br>");
        } else{
            echo($num . " es impar <br>");
        }
    }
?>