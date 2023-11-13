<?php 
    /* 
        Hacer un programa en php que defina una constante LÍMITE y genere un número aleatorio
        entre 1 y el límite y lo muestre por pantalla indicando si es par o impar. Usar el operador
        ternario ‘?’y la función rand(). 
    */

    const limite = 10;
    $var = rand(1, limite);

    echo($var % 2 == 0 ? "El numero es ". $var . " y es par" : "El numero es ". $var . " y es impar");