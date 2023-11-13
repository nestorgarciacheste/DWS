<?php

$precio = 10;
$unidades = 5;
define("IVA", 0.21);
$result = $precio + ($precio * IVA);
echo "Existen " . $unidades . " unidades del producto, su precio inicial es de " . $precio . " y el precio de cada uno de estos con el IVA es de " . $result;
