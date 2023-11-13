<?php

echo  " Bucle For" . "<br><br>";

for ($i = 1; $i <= 100; $i++) {
    echo $i % 5 === 0 ? $i . " es múltiplo de 5" . "<br>" : "";
}

echo  "<br>" . " Bucle While" . "<br><br>";

$i = 1;
while ($i <= 100) {
    echo $i % 5 === 0 ? $i . " es múltiplo de 5" . "<br>" : "";
    $i++;
}

echo  "<br>" . " Bucle Do While" . "<br><br>";

$i = 1;
do {
    echo $i % 5 === 0 ? $i . " es múltiplo de 5" . "<br>" : "";
    $i++;
} while ($i <= 100);
