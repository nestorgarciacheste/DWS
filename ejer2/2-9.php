<?php

$facturas = array(
    array("codigo_articulo" => 1, "cantidad_litros" => 10, "precio_litro" => 5),
    array("codigo_articulo" => 2, "cantidad_litros" => 8, "precio_litro" => 7),
    array("codigo_articulo" => 1, "cantidad_litros" => 15, "precio_litro" => 6),
    array("codigo_articulo" => 3, "cantidad_litros" => 12, "precio_litro" => 8),
    array("codigo_articulo" => 2, "cantidad_litros" => 5, "precio_litro" => 10)
);

$facturacion_total = 0;
$cantidad_litros_articulo1 = 0;
$facturas_mayores_600 = 0;

foreach ($facturas as $factura) {
    $importe_factura = $factura["cantidad_litros"] * $factura["precio_litro"];
    $facturacion_total += $importe_factura;

    if ($factura["codigo_articulo"] == 1) {
        $cantidad_litros_articulo1 += $factura["cantidad_litros"];
    }

    if ($importe_factura > 600) {
        $facturas_mayores_600++;
    }
}

echo "Facturación total: " . $facturacion_total . "€<br>";
echo "Litros vendidos del artículo 1: " . $cantidad_litros_articulo1 . " litros<br>";
echo "Cantidad de facturas mayores a 600€: " . $facturas_mayores_600 . " facturas<br>";

?>
