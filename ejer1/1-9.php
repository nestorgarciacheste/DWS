<?php
    /*
        Crear una página que calcule el importe final de una factura. Debemos crear dos variables
        que contendrán el precio de un producto y las unidades adquiridas. Además, crear una
        constante llamada IVA del 21%. Debemos calcular y devolver el precio del producto, las
        unidades adquiridas, el importe base de la factura, el importe del IVA y el importe final de la
        factura.
    */

    const IVA = 0.21;

    $precio = 10;
    $unidades = 5;
    $result = ($precio * $unidades) * IVA;

    echo("Precio de producto: ". $precio . ", " . $unidades . " unidades , en total: " . $result);