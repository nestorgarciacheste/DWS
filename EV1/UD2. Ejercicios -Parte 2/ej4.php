<?php

for ($i = 1; $i <= 10; $i++) {
    echo "tabla del " . $i . "<br>" . "***************" . "<br>";
    for ($j = 0; $j <= 10; $j++) {
        echo $i . " x " . $j . " = " . $i * $j . "<br>";
    }
}
