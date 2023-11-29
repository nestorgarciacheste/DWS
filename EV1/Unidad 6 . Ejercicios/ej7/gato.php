<?php

require_once 'Mamifero.php';

class Gato extends Mamifero
{
    public function __construct($especie, $sonido)
    {
        parent::__construct($especie, $sonido);
        $this->familia = "felinos";
    }
}
