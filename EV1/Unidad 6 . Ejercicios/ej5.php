<?php

class Calculadora
{

    public static function sumar($a, $b)
    {
        return $a + $b;
    }

    public static function restar($a, $b)
    {
        return $a - $b;
    }

    public static function multiplicar($a, $b)
    {
        return $a * $b;
    }

    public static function dividir($a, $b)
    {
        if ($b == 0) {
            return "Error: División por cero";
        }
        return $a / $b;
    }
}

echo "Suma: " . Calculadora::sumar(10, 5) . "\n";
echo "Resta: " . Calculadora::restar(10, 5) . "\n";
echo "Multiplicación: " . Calculadora::multiplicar(10, 5) . "\n";
echo "División: " . Calculadora::dividir(10, 5) . "\n";
