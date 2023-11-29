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

    public function debePagarImpuestos()
    {
        return $this->sueldo > 1200;
    }
}

$empleado1 = new Empleado("Juan", 3000);
$empleado2 = new Empleado("Ana", 1100);

function mostrarInformacionEmpleado($empleado)
{
    echo $empleado->getNombre() . " tiene un sueldo de " . $empleado->getSueldo();
    if ($empleado->debePagarImpuestos()) {
        echo " y tiene que pagar impuestos\n";
    } else {
        echo " y no tiene que pagar impuestos\n";
    }
}

mostrarInformacionEmpleado($empleado1);
mostrarInformacionEmpleado($empleado2);
