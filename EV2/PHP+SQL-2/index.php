<?php
$host = 'localhost';
$dbname = 'hoteles';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

function crearHotel($cod_hotel, $nombre, $categoria, $habitacion, $poblacion, $direccion)
{
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO hoteles (cod_Hotel, Nombre, Categoria, Habitacion, Poblacion, Direccion) VALUES (?, ?, ?, ?, ?, ?)");
    return $stmt->execute([$cod_hotel, $nombre, $categoria, $habitacion, $poblacion, $direccion]);
}

function actualizarHotel($cod_hotel, $nombre, $categoria, $habitacion, $poblacion, $direccion)
{
    global $pdo;
    $stmt = $pdo->prepare("UPDATE hoteles SET Nombre=?, Categoria=?, Habitacion=?, Poblacion=?, Direccion=? WHERE cod_Hotel=?");
    return $stmt->execute([$nombre, $categoria, $habitacion, $poblacion, $direccion, $cod_hotel]);
}

function obtenerNombreHotel($cod_hotel)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT Nombre FROM hoteles WHERE cod_Hotel = ?");
    $stmt->execute([$cod_hotel]);
    return $stmt->fetchColumn();
}

function eliminarHotel($cod_hotel)
{
    global $pdo;
    $nombreHotel = obtenerNombreHotel($cod_hotel);
    if ($nombreHotel) {
        $stmt = $pdo->prepare("DELETE FROM hoteles WHERE cod_Hotel=?");
        $stmt->execute([$cod_hotel]);
        return $nombreHotel;
    }
    return false;
}

$accion = $_POST['accion'] ?? '';
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    switch ($accion) {
        case 'crear':
            if (isset($_POST['cod_hotel'], $_POST['nombre'], $_POST['categoria'], $_POST['habitacion'], $_POST['poblacion'], $_POST['direccion'])) {
                if (crearHotel($_POST['cod_hotel'], $_POST['nombre'], $_POST['categoria'], $_POST['habitacion'], $_POST['poblacion'], $_POST['direccion'])) {
                    $mensaje = "Hotel creado con éxito.";
                } else {
                    $mensaje = "Error al crear el hotel.";
                }
            }
            break;
        case 'actualizar':
            if (isset($_POST['cod_hotel'], $_POST['nombre'], $_POST['categoria'], $_POST['habitacion'], $_POST['poblacion'], $_POST['direccion'])) {
                if (actualizarHotel($_POST['cod_hotel'], $_POST['nombre'], $_POST['categoria'], $_POST['habitacion'], $_POST['poblacion'], $_POST['direccion'])) {
                    $mensaje = "Hotel actualizado con éxito.";
                } else {
                    $mensaje = "Error al actualizar el hotel.";
                }
            }
            break;
            break;
        case 'eliminar':
            if (isset($_POST['cod_hotel'])) {
                $nombreEliminado = eliminarHotel($_POST['cod_hotel']);
                if ($nombreEliminado) {
                    $mensaje = "Hotel '$nombreEliminado' eliminado con éxito.";
                } else {
                    $mensaje = "Error al eliminar el hotel o no se encontró el hotel con el código proporcionado.";
                }
            }
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestión de Hoteles</title>
</head>

<body>


    <?php if (!empty($mensaje)) : ?>
        <p><?php echo $mensaje; ?></p>
    <?php endif; ?>

    <form action="" method="post">
        <select name="accion" onchange="this.form.submit()">
            <option value="">Selecciona una acción</option>
            <option value="crear" <?php echo $accion === 'crear' ? 'selected' : ''; ?>>Crear Hotel</option>
            <option value="actualizar" <?php echo $accion === 'actualizar' ? 'selected' : ''; ?>>Actualizar Hotel</option>
            <option value="eliminar" <?php echo $accion === 'eliminar' ? 'selected' : ''; ?>>Eliminar Hotel</option>
        </select>
    </form>

    <?php if ($accion === 'crear') : ?>
        <form action="" method="post">
            <input type="hidden" name="accion" value="crear">
            <input type="text" name="cod_hotel" placeholder="Código del Hotel" required>
            <input type="text" name="nombre" placeholder="Nombre" required>
            <input type="number" name="categoria" placeholder="Categoría" required>
            <input type="number" name="habitacion" placeholder="Habitación" required>
            <input type="text" name="poblacion" placeholder="Población" required>
            <input type="text" name="direccion" placeholder="Dirección" required>
            <button type="submit">Crear Hotel</button>
        </form>
    <?php elseif ($accion === 'actualizar') : ?>
        <form action="" method="post">
            <input type="hidden" name="accion" value="actualizar">
            <input type="text" name="cod_hotel" placeholder="Código del Hotel" required>
            <input type="text" name="nombre" placeholder="Nombre" required>
            <input type="number" name="categoria" placeholder="Categoría" required>
            <input type="number" name="habitacion" placeholder="Habitación" required>
            <input type="text" name="poblacion" placeholder="Población" required>
            <input type="text" name="direccion" placeholder="Dirección" required>
            <button type="submit">Actualizar Hotel</button>
        </form>
    <?php elseif ($accion === 'eliminar') : ?>
        <form action="" method="post">
            <input type="hidden" name="accion" value="eliminar">
            <input type="text" name="cod_hotel" placeholder="Código del Hotel" required>
            <button type="submit">Eliminar Hotel</button>
        </form>
    <?php endif; ?>

</body>

</html>