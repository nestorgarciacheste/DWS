<?php

define("LIMITE", 50);
$n1 = rand(1, LIMITE);

echo $n1 % 2 === 0 ? $n1 . " es par" : $n1 . " es impar";
