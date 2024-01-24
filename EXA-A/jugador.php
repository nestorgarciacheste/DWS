<?php

class ConexionBD
{
    private $server = 'mysql:host=localhost;dbname=examena;charset=utf8';
    private $user = 'admin';
    private $password = 'admin';
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

    public function actualizarJugador($id, $nombre, $posicion)
    {
        try {
            $query = "UPDATE jugador SET nombre = :nombre, posicion = :posicion WHERE id = :id";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':posicion', $posicion);

            $stmt->execute();
        } catch (PDOException $e) {
            die(json_encode(['error' => 'ERROR al actualizar el jugador: ' . $e->getMessage()]));
        }
    }

    public function añadirJugador($nombre, $posicion)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO jugador (nombre, posicion) VALUES (:nombre, :posicion)");

            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':posicion', $posicion);

            $stmt->execute();
        } catch (PDOException $e) {
            die(json_encode(['error' => 'ERROR al añadir el jugador: ' . $e->getMessage()]));
        }
    }

    public function eliminarJugador($id)
    {
        try {
            $query = "DELETE FROM jugador WHERE id = :id";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            die(json_encode(['error' => 'ERROR al eliminar el jugador: ' . $e->getMessage()]));
        }
    }

    public function jugadorExiste($id)
    {
        try {
            $query = "SELECT COUNT(*) FROM jugador WHERE id = :id";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->execute();
            $count = $stmt->fetchColumn();
            return $count > 0;
        } catch (PDOException $e) {
            die(json_encode(['error' => 'ERROR al verificar si el jugador existe: ' . $e->getMessage()]));
        }
    }

    public function getJugadores()
    {
        try {
            $query = "SELECT * FROM jugador";
            $stmt = $this->pdo->prepare($query);

            $stmt->execute();
            $jugadores = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $jugadores;
        } catch (PDOException $e) {
            die(json_encode(['error' => 'ERROR al obtener los jugadores: ' . $e->getMessage()]));
        }
    }

    public function mostrarJugador($id)
    {
        try {
            $query = "SELECT * FROM jugador WHERE id = :id";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->execute();
            $jugador = $stmt->fetch(PDO::FETCH_ASSOC);
            return $jugador;
        } catch (PDOException $e) {
            die(json_encode(['error' => 'ERROR al mostrar el jugador: ' . $e->getMessage()]));
        }
    }
}

$conexion = new ConexionBD();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            if ($conexion->jugadorExiste($id)) {
                $jugador = $conexion->mostrarJugador($id);
                echo json_encode(['jugador' => $jugador]);
            } else {
                echo json_encode(['error' => 'ERROR el jugador con el ID proporcionado no existe.']);
            }
        } else {
            $jugadores = $conexion->getJugadores();
            echo json_encode(['jugadores' => $jugadores]);
        }
        break;

    case 'POST':
        $nombre = $_POST['nombre'];
        $posicion = $_POST['posicion'];
        if ($nombre && $posicion) {
            $conexion->añadirJugador($nombre, $posicion);
            echo json_encode(['message' => 'Jugador añadido con éxito.']);
        } else {
            echo json_encode(['error' => 'ERROR faltan datos necesarios para añadir el jugador.']);
        }
        break;

    case 'PUT':
        parse_str(file_get_contents("php://input"), $put_vars);
        $id = $put_vars['id'];
        if ($conexion->jugadorExiste($id)) {
            $conexion->actualizarJugador($id, $put_vars['nombre'], $put_vars['posicion']);
            echo json_encode(['message' => 'Jugador actualizado con éxito.']);
        } else {
            echo json_encode(['error' => 'ERROR el jugador no existe.']);
        }
        break;

    case 'DELETE':
        parse_str(file_get_contents("php://input"), $del_vars);
        $id = $del_vars['id'];
        if ($conexion->jugadorExiste($id)) {
            $conexion->eliminarJugador($id);
            echo json_encode(['message' => 'Jugador eliminado con éxito.']);
        } else {
            echo json_encode(['error' => 'ERROR el jugador no existe o el ID no es válido.']);
        }
        break;

    default:
        echo json_encode(['error' => 'ERROR ,método HTTP no soportado']);
        break;
}
