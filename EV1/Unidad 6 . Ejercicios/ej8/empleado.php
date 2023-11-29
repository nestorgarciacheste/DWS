<?php

require_once 'Trabajador.php';

class Empleado extends Trabajador
{
    private $horasTrabajadas;
    private $pagoPorHora = 9.50;

    public function __construct($nombre, $horasTrabajadas)
    {
        parent::__construct($nombre);
        $this->horasTrabajadas = $horasTrabajadas;
    }

    public function calcularSueldo()
    {
        return $this->horasTrabajadas * $this->pagoPorHora;
    }
}
