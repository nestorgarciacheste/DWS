<?php

class Empleado
{
    private $nombre;
    private $sueldo;

    public function __construct($nombre, $sueldo)
    {
        $this->nombre = $nombre;
        $this->sueldo = $sueldo;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getSueldo()
    {
        return $this->sueldo;
    }
}

$empleado1 = new Empleado("Juan", 3000);
$empleado2 = new Empleado("Ana", 3500);

echo $empleado1->getNombre() . " tiene un sueldo de " . $empleado1->getSueldo() . "\n";
echo $empleado2->getNombre() . " tiene un sueldo de " . $empleado2->getSueldo() . "\n";
