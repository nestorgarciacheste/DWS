<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ver Hoteles</title>
</head>

<body>
    <h2>Lista de Hoteles</h2>
    <?php
    $filename = 'hoteles.csv';
    if (($handle = fopen($filename, "r")) !== FALSE) {
        echo "<table border='1'>";
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            echo "<tr>";
            foreach ($data as $cell) {
                echo "<td>" . htmlspecialchars($cell) . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        fclose($handle);
    }
    ?>
    <a href="index.html">Volver</a>
</body>

</html>