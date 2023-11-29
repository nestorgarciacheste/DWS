<?php

require_once 'Empleado.php';
require_once 'Gerente.php';

$empleado = new Empleado("Juan", 40);
$gerente = new Gerente("Ana", 10, 100000);

echo $empleado->calcularSueldo() . "\n";
echo $gerente->calcularSueldo(5000);
