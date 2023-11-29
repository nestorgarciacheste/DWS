<?php

class Gerente extends Trabajador
{
    private $sueldoBase = 2500;
    private $porcentajeBeneficios;
    private $beneficioEmpresa;

    public function __construct($nombre, $porcentajeBeneficios, $beneficioEmpresa)
    {
        parent::__construct($nombre);
        $this->porcentajeBeneficios = $porcentajeBeneficios;
        $this->beneficioEmpresa = $beneficioEmpresa;
    }

    public function calcularSueldo()
    {
        return $this->sueldoBase + ($this->beneficioEmpresa * $this->porcentajeBeneficios / 100);
    }
}
