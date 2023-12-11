<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Tienda</title>
</head>

<body>

    <h2>Seleccionar Fabricante</h2>
    <form method="get" action="">
        <label for="cod">Seleccionar ID del fabricante:</label>

        <select name="cod" id="cod">

            <?php
            $server = 'mysql:host=localhost;dbname=tienda;charset=utf8';
            $user = 'root';
            $password = '';

            try {
                $pdo = new PDO($server, $user, $password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $query = "SELECT cod, nombre FROM fabricantes";
                $stmt = $pdo->query($query);

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $selected = (isset($_GET['id']) && $_GET['cod'] == $row['cod']) ? 'selected' : '';
                    echo '<option value="' . $row['cod'] . '" ' . $selected . '>' . htmlspecialchars($row['cod']) . '</option>';
                }
            } catch (PDOException $e) {
                echo 'Error de conexión a la base de datos: ' . $e->getMessage();
            }
            ?>
        </select>
        <input type="submit" value="Mostrar Fabricante">
    </form>
    <p>##########################################################################</p>

    <?php
    if (isset($_GET['cod'])) {
        $selectedid = $_GET['cod'];

        try {
            $query = "SELECT cod, nombre FROM fabricantes WHERE cod = $selectedid";
            $stmt = $pdo->query($query);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                echo '<h2>' . htmlspecialchars($row['cod']) . '</h2>';
                echo '<p>' . nl2br(htmlspecialchars($row['nombre'])) . '</p>';
            } else {
                echo '<p>No se encontró al fabricante seleccionado.</p>';
            }
        } catch (PDOException $e) {
            echo 'Error al obtener al fabricante: ' . $e->getMessage();
        }
    }

    $pdo = null;
    ?>

</body>

</html>