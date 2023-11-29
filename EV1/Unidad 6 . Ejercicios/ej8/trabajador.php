<?php

class Trabajador
{
    protected $nombre;
    protected $sueldo;

    public function __construct($nombre)
    {
        $this->nombre = $nombre;
    }

    public function calcularSueldo()
    {
        return 0;
    }
}
