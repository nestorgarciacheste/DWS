<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Eliminar Hotel</title>
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
            <input type="text" id="id" name="id" required>

            <input type="submit" value="Eliminar Hotel">
        </form>
        <a href="index.html">Volver</a>
    </div>
</body>

</html>