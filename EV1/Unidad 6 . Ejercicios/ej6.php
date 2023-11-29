<?php

class Calculadora
{
    private $primerNumero = 8;

    public static function sumar($b)
    {
        $calculadora = new Calculadora();
        return $calculadora->primerNumero + $b;
    }

    public static function restar($b)
    {
        $calculadora = new Calculadora();
        return $calculadora->primerNumero - $b;
    }

    public static function multiplicar($b)
    {
        $calculadora = new Calculadora();
        return $calculadora->primerNumero * $b;
    }

    public static function dividir($b)
    {
        $calculadora = new Calculadora();
        if ($b == 0) {
            return "Error: División por cero";
        }
        return $calculadora->primerNumero / $b;
    }
}

echo "Suma: " . Calculadora::sumar(5) . "\n";
echo "Resta: " . Calculadora::restar(5) . "\n";
echo "Multiplicación: " . Calculadora::multiplicar(5) . "\n";
echo "División: " . Calculadora::dividir(5) . "\n";
