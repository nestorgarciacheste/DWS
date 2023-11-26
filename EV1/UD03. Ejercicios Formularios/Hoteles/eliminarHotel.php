<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Eliminar Hotel</title>
</head>

<body>
    <h2>Eliminar Hotel</h2>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST["id"];

        $filename = 'hoteles.csv';
        $tempFile = 'temp.csv';
        $handle = fopen($filename, "r");
        $temp = fopen($tempFile, "w");

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            if ($data[0] != $id) {
                fputcsv($temp, $data);
            }
        }

        fclose($handle);
        fclose($temp);
        rename($tempFile, $filename);

        echo "<p>Hotel eliminado con éxito.</p>";
    }
    ?>
    <form action="eliminarHotel.php" method="post">
        <label for="id">ID del Hotel a Eliminar:</label>
        <input type="text" id="id" name="id" required><br>

        <input type="submit" value="Eliminar Hotel">
    </form>
    <a href="index.html">Volver</a>
</body>

</html>