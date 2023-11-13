<?php
$lista = "";
$count = 1;

for ($i = 0; $i < 20; $i++) {
    if ($i % 2 === 0) {
        $lista .= "n" . $count . " = " . $i . "<br>";
        $count++;
    }
    if ($count === 5) {
        break;
    }
}

echo $lista;
