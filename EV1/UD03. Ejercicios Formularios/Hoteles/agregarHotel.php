<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Añadir Hotel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            margin: auto;
        }

        h2 {
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-top: 10px;
        }

        input[type="text"],
        input[type="number"] {
            padding: 8px;
            margin-top: 5px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        input[type="submit"] {
            margin-top: 20px;
            padding: 10px;
            border-radius: 4px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        a {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
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
            <input type="text" id="id" name="id" required>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="ciudad">Ciudad:</label>
            <input type="text" id="ciudad" name="ciudad" required>

            <label for="estrellas">Estrellas:</label>
            <input type="number" id="estrellas" name="estrellas" required>

            <input type="submit" value="Añadir Hotel">
        </form>
        <a href="index.html">Volver</a>
    </div>
</body>

</html>