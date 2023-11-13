<?php
    echo "Hola mundo ";

    $a = 1;
    $b = 2;

    if($a > $b) {
        echo "a > b";
    } else {
        echo "b > a";
    }
    
    echo $a > $b? "a > b" : ($a < $b ? "b < a" : "b = a");