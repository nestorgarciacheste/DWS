<?php

$codigo = 1;
$nombre = "Tom";
$apellido = "Smith";
$puesto = "Vendedor";
$sueldo = 75000;
$edad = 26;
$num_hijos = 0;
$sucursal = "New York";

$retencion1 = ($puesto === "Vendedor" && $sueldo > 70000) ? 0.10 : 0.20;

$retencion2 = ($edad > 50 || $num_hijos > 2) ? 0.05 : 0.10;

$retencion3 = ($sueldo > 50000 && $sueldo < 80000) ? 0.05 : 0.12;

$retencion4 = ($num_hijos >= 1 && $num_hijos <= 2) ? 0.10 : 0.05;

$retencion5 = ($sueldo > 80000 || $num_hijos === 0) ? 0.15 : 0.05;

$retencionTotal = $sueldo * ($retencion1 + $retencion2 + $retencion3 + $retencion4 + $retencion5);

$sueldoNeto = $sueldo - $retencionTotal;

echo "Código: $codigo\n";
echo "Nombre: $nombre\n";
echo "Apellido: $apellido\n";
echo "Puesto: $puesto\n";
echo "Sueldo: $sueldo\n";
echo "Edad: $edad\n";
echo "Número de hijos: $num_hijos\n";
echo "Sucursal: $sucursal\n";
echo "Retención Total: $retencionTotal\n";
echo "Sueldo Neto: $sueldoNeto\n";
