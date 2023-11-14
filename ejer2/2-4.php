<?php

echo "Tabla de Multiplicar del 1 al 10:<br>";

for ($i = 1; $i <= 10; $i++) {
    echo "<br>Tabla del $i:<br>***********<br>";
    for ($j = 1; $j <= 10; $j++) {
        echo "$i x $j = " . ($i * $j) . "<br>";
    }
    echo "-----------------<br>";
}

?>
