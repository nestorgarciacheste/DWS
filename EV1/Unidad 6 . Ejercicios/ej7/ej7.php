<?php

require_once 'Perro.php';
require_once 'Gato.php';

$perro = new Perro("Perro", "Ladrido");
$gato = new Gato("Gato", "Maullido");

$perro->sonido();
$gato->sonido();
