<?php
$nomina = 1300;
if ($nomina < 800) {
    $nomina += $nomina * 0.2;
    echo "Tu nómina es de " . $nomina;
} elseif ($nomina >= 800 && $nomina <= 1200) {
    echo "Tu nómina es de " . $nomina;
} else {
    $nomina -= $nomina * 0.15;
    echo "Tu nómina es de " . $nomina;
}
