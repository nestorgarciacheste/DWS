<?php
$matrizAlumnos = [[18, 1.80], [14, 1.65], [19, 2], [34, 1.70], [15, 1.76]];
$edades = 0;
$alturas = 0;
$countEdades = 0;
$countAlturas = 0;
$countMayores = 0;
$altos = 0;

for ($i = 0; $i < sizeof($matrizAlumnos); $i++) {
    for ($j = 0; $j < sizeof($matrizAlumnos[0]); $j++) {
        if ($j === 0) {
            $edades += $matrizAlumnos[$i][$j];
            $countEdades++;
            if ($matrizAlumnos[$i][$j] >= 18) {
                $countMayores++;
            }
        } else {
            $alturas += $matrizAlumnos[$i][$j];
            $countAlturas++;
            if ($matrizAlumnos[$i][$j] >= 1.75) {
                $altos++;
            }
        }
    }
}

echo ("Edad media de la clase: " . $edades / $countEdades . "<br>");
echo ("Altura media de la clase: " . $alturas / $countAlturas . "<br>");
echo ("Mayores de 18: " . $countMayores . "<br>");
echo ("Mayores de 1.75: " . $altos . "<br>");
