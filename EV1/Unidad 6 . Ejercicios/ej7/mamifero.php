<?php

class Mamifero
{
    protected $especie;
    protected $sonido;
    protected $familia;

    public function __construct($especie, $sonido)
    {
        $this->especie = $especie;
        $this->sonido = $sonido;
    }

    public function sonido()
    {
        echo "Sonido de " . $this->especie . ", de la familia " . $this->familia . ": " . $this->sonido . "\n";
    }
}
