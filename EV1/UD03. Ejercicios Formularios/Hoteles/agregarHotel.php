<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Añadir Hotel</title>
</head>

<body>
    <h2>Añadir Nuevo Hotel</h2>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST["id"];
        $nombre = $_POST["nombre"];
        $ciudad = $_POST["ciudad"];
        $estrellas = $_POST["estrellas"];

        $line = "$id,$nombre,$ciudad,$estrellas\n";

        file_put_contents('hoteles.csv', $line, FILE_APPEND);
        echo "<p>Hotel añadido con éxito.</p>";
    }
    ?>
    <form action="agregarHotel.php" method="post">
        <label for="id">ID:</label>
        <input type="text" id="id" name="id" required><br>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br>

        <label for="ciudad">Ciudad:</label>
        <input type="text" id="ciudad" name="ciudad" required><br>

        <label for="estrellas">Estrellas:</label>
        <input type="number" id="estrellas" name="estrellas" required><br>

        <input type="submit" value="Añadir Hotel">
    </form>
    <a href="index.html">Volver</a>
</body>

</html>