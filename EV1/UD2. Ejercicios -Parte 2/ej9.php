<?php

$facturas = array(
    array("codigo" => 1, "cantidad_litros" => 10, "precio_litro" => 5),
    array("codigo" => 2, "cantidad_litros" => 15, "precio_litro" => 8),
    array("codigo" => 1, "cantidad_litros" => 8, "precio_litro" => 6),
    array("codigo" => 3, "cantidad_litros" => 12, "precio_litro" => 7),
    array("codigo" => 4, "cantidad_litros" => 5, "precio_litro" => 10)
);

$facturacionTotal = 0;
$cantidadLitrosArticulo1 = 0;
$facturasMas600 = 0;

foreach ($facturas as $factura) {
    $importe = $factura["cantidad_litros"] * $factura["precio_litro"];

    $facturacionTotal += $importe;

    if ($factura["codigo"] == 1) {
        $cantidadLitrosArticulo1 += $factura["cantidad_litros"];
    }

    if ($importe > 600) {
        $facturasMas600++;
    }
}

echo "Facturación total: " . $facturacionTotal . " €<br>";
echo "Cantidad en litros del artículo 1: " . $cantidadLitrosArticulo1 . " litros<br>";
echo "Cantidad de facturas mayores a 600 €: " . $facturasMas600;
