<?php

    /*
        Crear las variables código, nombre, apellidos, puesto, sueldo, edad, num_hijos y sucursal
        e inicializarlas con los siguientes valores:
        Realizar los siguientes cálculos de retenciones:
            • Retención 1.- Si es Vendedor y el Sueldo mayor a 70000 aplicar una retención del 10%
            sobre el sueldo y en caso contrario el 20%
            • Retención 2.- Si tiene más de 50 años o más de 2 hijos aplicar una retención del 5% sobre
            el sueldo y en caso contrario el 10%
            • Retención 3.- Si el sueldo es mayor de 50000 y menor de 80000 aplicar una retención
            del 5% sobre el sueldo y en caso contrario el 12%
            • Retención 4.- Si tiene 1 o 2 hijos aplicar una retención del 10% sobre el sueldo y en caso
            contrario el 5%
            • Retención 5.- Si el sueldo es mayor de 80000 o no tiene hijos aplicar una retención del
            15% sobre el sueldo y en caso contrario el 5%
    */

$codigo = 1;
$nombre = "Juan";
$apellidos = "Perez";
$puesto = "Vendedor";
$sueldo = 75000;
$edad = 26;
$num_hijos = 0;
$sucursal = "Sucursal A";

$retencion_1 = ($puesto == "Vendedor" && $sueldo > 70000) ? 0.10 : 0.20;
$retencion_2 = ($edad > 50 || $num_hijos > 2) ? 0.05 : 0.10;
$retencion_3 = (50000 < $sueldo && $sueldo < 80000) ? 0.05 : 0.12;
$retencion_4 = ($num_hijos == 1 || $num_hijos == 2) ? 0.10 : 0.05;
$retencion_5 = ($sueldo > 80000 || $num_hijos == 0) ? 0.15 : 0.05;
$retencion_total = $retencion_1 + $retencion_2 + $retencion_3 + $retencion_4 + $retencion_5;
$sueldo_neto = $sueldo * (1 - $retencion_total);
echo "Código: $codigo<br>Nombre: $nombre<br>Apellidos: $apellidos<br>Puesto: $puesto<br>Sueldo: $sueldo<br>Edad: $edad<br>Número de hijos: $num_hijos<br>Sucursal: $sucursal<br>Retención total: " . ($retencion_total * 100) . "%<br>Sueldo neto: $sueldo_neto<br>";
