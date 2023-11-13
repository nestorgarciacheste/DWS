<?php

    /*
        Hacer un programa que, indicada una nómina en una variable, si es menor de 800€ le haga
        un incremento del 20%, si está entre 800 € y 1200 € la deje como está, y si es mayor le quite
        un 15%. Usar el condicional if
    */

    $var = 1300;

    if ($var < 800) {
        $var += ($var*0.2);
    } else if ($var < 1200) {
    } else {
        $var -= ($var*0.15);
    }
    
    echo "La nómina és: $var";