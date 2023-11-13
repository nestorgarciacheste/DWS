<?php

$codigo = 1;
$nombre = "Tom";
$apellido = "Smith";
$puesto = "Vendedor";
$sueldo = 75000;
$edad = 26;
$num_hijos = 0;
$sucursal = "New York";

echo "El sueldo inicial es de " . $sueldo . "<br>";

if (strtolower($puesto) === "vendedor" && $sueldo > 70000) {
    $sueldo -= $sueldo * 0.1;
    echo "El sueldo se le reduce a " . $sueldo . "<br>";
} else {
    $sueldo -= $sueldo * 0.2;
    echo "El sueldo se le reduce a " . $sueldo . "<br>";
}

if ($edad > 50 || $num_hijos > 2) {
    $sueldo -= $sueldo * 0.05;
    echo "El sueldo se le reduce a " . $sueldo . "<br>";
} else {
    $sueldo -= $sueldo * 0.1;
    echo "El sueldo se le reduce a " . $sueldo . "<br>";
}

if ($sueldo > 50000 && $sueldo < 80000) {
    $sueldo -= $sueldo * 0.05;
    echo "El sueldo se le reduce a " . $sueldo . "<br>";
} else {
    $sueldo -= $sueldo * 0.12;
    echo "El sueldo se le reduce a " . $sueldo . "<br>";
}

if ($num_hijos === 1 || $num_hijos === 2) {
    $sueldo -= $sueldo * 0.1;
    echo "El sueldo final es de " . $sueldo . "<br>";
} else {
    $sueldo -= $sueldo * 0.05;
    echo "El sueldo final es de " . $sueldo . "<br>";
}
