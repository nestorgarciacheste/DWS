<?php
// Crear las variables
$codigo = 1;
$nombre = "Juan";
$apellidos = "Perez";
$puesto = "Vendedor";
$sueldo = 75000;
$edad = 55;
$num_hijos = 3;
$sucursal = "Sucursal A";

$retencion_1 = ($puesto == "Vendedor" && $sueldo > 70000) ? 0.10 : 0.20;
$retencion_2 = ($edad > 50 || $num_hijos > 2) ? 0.05 : 0.10;
$retencion_3 = (50000 < $sueldo && $sueldo < 80000) ? 0.05 : 0.12;
$retencion_4 = ($num_hijos == 1 || $num_hijos == 2) ? 0.10 : 0.05;
$retencion_5 = ($sueldo > 80000 || $num_hijos == 0) ? 0.15 : 0.05;
$retencion_total = $retencion_1 + $retencion_2 + $retencion_3 + $retencion_4 + $retencion_5;
$sueldo_neto = $sueldo * (1 - $retencion_total);
echo "Código: $codigo<br>Nombre: $nombre<br>Apellidos: $apellidos<br>Puesto: $puesto<br>Sueldo: $sueldo<br>Edad: $edad<br>Número de hijos: $num_hijos<br>Sucursal: $sucursal<br>Retención total: " . ($retencion_total * 100) . "%<br>Sueldo neto: $sueldo_neto<br>";
