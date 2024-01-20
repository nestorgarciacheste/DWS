<?php

class ConexionBD
{
    private $server = 'mysql:host=localhost;dbname=hoteles;charset=utf8';
    private $user = 'root';
    private $password = '';
    private $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO($this->server, $this->user, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die(json_encode(['error' => 'ERROR de conexión a la base de datos: ' . $e->getMessage()]));
        }
    }

    public function actualizarHotel($cod_hotel, $nombre, $cat, $hab, $poblacion, $direccion)
    {
        try {
            $query = "UPDATE hoteles SET nombre = :nombre, cat = :categoria, hab = :habitaciones, poblacion = :poblacion, direccion = :direccion WHERE cod_hotel = :hotel_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':hotel_id', $cod_hotel);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':categoria', $cat);
            $stmt->bindParam(':habitaciones', $hab);
            $stmt->bindParam(':poblacion', $poblacion);
            $stmt->bindParam(':direccion', $direccion);
            $stmt->execute();
        } catch (PDOException $e) {
            die(json_encode(['error' => 'ERROR al actualizar el hotel: ' . $e->getMessage()]));
        }
    }

    public function añadeHotel($nombre, $cat, $hab, $poblacion, $direccion)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO hoteles (nombre, cat, hab, poblacion, direccion) VALUES (:nombre, :cat, :hab, :poblacion, :direccion)");
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':cat', $cat);
            $stmt->bindParam(':hab', $hab);
            $stmt->bindParam(':poblacion', $poblacion);
            $stmt->bindParam(':direccion', $direccion);
            $stmt->execute();
        } catch (PDOException $e) {
            die(json_encode(['error' => 'ERROR al añadir el hotel: ' . $e->getMessage()]));
        }
    }

    public function deleteHotel($id)
    {
        try {
            $query = "DELETE FROM hoteles WHERE cod_hotel = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            die(json_encode(['error' => 'ERROR al eliminar el hotel: ' . $e->getMessage()]));
        }
    }

    public function hotelExiste($cod_hotel)
    {
        try {
            $query = "SELECT COUNT(*) FROM hoteles WHERE cod_hotel = :cod_hotel";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':cod_hotel', $cod_hotel, PDO::PARAM_INT);
            $stmt->execute();
            $count = $stmt->fetchColumn();
            return $count > 0;
        } catch (PDOException $e) {
            die(json_encode(['error' => 'ERROR al verificar si el hotel existe: ' . $e->getMessage()]));
        }
    }

    public function getHoteles()
    {
        try {
            $query = "SELECT * FROM hoteles";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            $hoteles = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $hoteles;
        } catch (PDOException $e) {
            die(json_encode(['error' => 'ERROR al obtener datos de la base de datos: ' . $e->getMessage()]));
        }
    }

    public function muestraHotel($id)
    {
        try {
            $query = "SELECT * FROM hoteles WHERE cod_hotel = :cod_hotel";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':cod_hotel', $id, PDO::PARAM_INT);
            $stmt->execute();
            $hotel = $stmt->fetch(PDO::FETCH_ASSOC);
            return $hotel;
        } catch (PDOException $e) {
            die(json_encode(['error' => 'ERROR al mostrar el hotel: ' . $e->getMessage()]));
        }
    }
}

$conexion = new ConexionBD();

// Manejar la solicitud HTTP
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // Manejar solicitud GET
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            if ($conexion->hotelExiste($id)) {
                $hotel = $conexion->muestraHotel($id);
                echo json_encode(['hotel' => $hotel]);
            } else {
                echo json_encode(['error' => 'ERROR el hotel con el ID proporcionado no existe.']);
            }
        } else {
            $hoteles = $conexion->getHoteles();
            echo json_encode(['hoteles' => $hoteles]);
        }
        break;

    case 'POST':
        // Manejar solicitud POST (añadir un hotel)
        $nombre = $_POST['nombre'];
        $cat = $_POST['cat'];
        $hab = $_POST['hab'];
        $poblacion = $_POST['poblacion'];
        $direccion = $_POST['direccion'];
        if ($nombre && $cat && $hab && $poblacion && $direccion) {
            $conexion->añadeHotel($nombre, $cat, $hab, $poblacion, $direccion);
            echo json_encode(['message' => 'Hotel añadido con éxito.']);
        } else {
            echo json_encode(['error' => 'ERROR faltan datos necesarios para añadir el hotel.']);
        }
        break;

    case 'PUT':
        // Manejar solicitud PUT (actualizar un hotel)
        parse_str(file_get_contents("php://input"), $put_vars);
        $cod_hotel = $put_vars['cod_hotel'];
        if ($conexion->hotelExiste($cod_hotel)) {
            $conexion->actualizarHotel($cod_hotel, $put_vars['nombre'], $put_vars['cat'], $put_vars['hab'], $put_vars['poblacion'], $put_vars['direccion']);
            echo json_encode(['message' => 'Hotel actualizado con éxito.']);
        } else {
            echo json_encode(['error' => 'ERROR el hotel no existe.']);
        }
        break;

    case 'DELETE':
        // Manejar solicitud DELETE (eliminar un hotel)
        parse_str(file_get_contents("php://input"), $del_vars);
        $id = $del_vars['id'];
        if ($conexion->hotelExiste($id)) {
            $conexion->deleteHotel($id);
            echo json_encode(['message' => 'Hotel eliminado con éxito.']);
        } else {
            echo json_encode(['error' => 'ERROR el hotel no existe o el ID no es válido.']);
        }
        break;

    default:
        // Método HTTP no soportado
        echo json_encode(['error' => 'ERROR ,método HTTP no soportado']);
        break;
}
