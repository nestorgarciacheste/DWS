<?php

    /*
        Crear un archivo php que, dados dos números almacenados en dos variables, nos muestre
        por pantalla el mayor de ellos o la frase “Los números son iguales” si son iguales. Usar la
        estructura switch y el operador nave espacial
    */

$numero1 = 10;
$numero2 = 5; 

$resultado = $numero1 <=> $numero2;

switch ($resultado) {
    case 1:
        echo "El mayor número es: $numero1";
        break;
    case -1:
        echo "El mayor número es: $numero2";
        break;
    case 0:
        echo "Los números son iguales";
        break;
}

?>
