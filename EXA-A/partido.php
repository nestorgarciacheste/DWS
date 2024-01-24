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

    public function actualizarPartido($jornada, $jugador, $puntos)
    {
        try {
            $query = "UPDATE partido SET puntos = :puntos WHERE jornada = :jornada AND jugador = :jugador";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(':jornada', $jornada);
            $stmt->bindParam(':jugador', $jugador);
            $stmt->bindParam(':puntos', $puntos);

            $stmt->execute();
        } catch (PDOException $e) {
            die(json_encode(['error' => 'ERROR al actualizar el partido: ' . $e->getMessage()]));
        }
    }

    public function añadirPartido($jornada, $jugador, $puntos)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO partido (jornada, jugador, puntos) VALUES (:jornada, :jugador, :puntos)");

            $stmt->bindParam(':jornada', $jornada);
            $stmt->bindParam(':jugador', $jugador);
            $stmt->bindParam(':puntos', $puntos);

            $stmt->execute();
        } catch (PDOException $e) {
            die(json_encode(['error' => 'ERROR al añadir el partido: ' . $e->getMessage()]));
        }
    }

    public function eliminarPartido($jornada, $jugador)
    {
        try {
            $query = "DELETE FROM partido WHERE jornada = :jornada AND jugador = :jugador";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(':jornada', $jornada);
            $stmt->bindParam(':jugador', $jugador);

            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            die(json_encode(['error' => 'ERROR al eliminar el partido: ' . $e->getMessage()]));
        }
    }

    public function partidoExiste($jornada, $jugador)
    {
        try {
            $query = "SELECT COUNT(*) FROM partido WHERE jornada = :jornada AND jugador = :jugador";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(':jornada', $jornada);
            $stmt->bindParam(':jugador', $jugador);

            $stmt->execute();
            $count = $stmt->fetchColumn();
            return $count > 0;
        } catch (PDOException $e) {
            die(json_encode(['error' => 'ERROR al verificar si el partido existe: ' . $e->getMessage()]));
        }
    }

    public function getPartidos()
    {
        try {
            $query = "SELECT * FROM partido";
            $stmt = $this->pdo->prepare($query);

            $stmt->execute();
            $partidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $partidos;
        } catch (PDOException $e) {
            die(json_encode(['error' => 'ERROR al obtener los partidos: ' . $e->getMessage()]));
        }
    }

    public function mostrarPartido($jornada, $jugador)
    {
        try {
            $query = "SELECT * FROM partido WHERE jornada = :jornada AND jugador = :jugador";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(':jornada', $jornada);
            $stmt->bindParam(':jugador', $jugador);

            $stmt->execute();
            $partido = $stmt->fetch(PDO::FETCH_ASSOC);
            return $partido;
        } catch (PDOException $e) {
            die(json_encode(['error' => 'ERROR al mostrar el partido: ' . $e->getMessage()]));
        }
    }
}

$conexion = new ConexionBD();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['jornada']) && isset($_GET['jugador'])) {
            $jornada = $_GET['jornada'];
            $jugador = $_GET['jugador'];
            if ($conexion->partidoExiste($jornada, $jugador)) {
                $partido = $conexion->mostrarPartido($jornada, $jugador);
                echo json_encode(['partido' => $partido]);
            } else {
                echo json_encode(['error' => 'ERROR el partido con la JORNADA y JUGADOR proporcionados no existe.']);
            }
        } else {
            $partidos = $conexion->getPartidos();
            echo json_encode(['partidos' => $partidos]);
        }
        break;

    case 'POST':
        $jornada = $_POST['jornada'];
        $jugador = $_POST['jugador'];
        $puntos = $_POST['puntos'];
        if ($jornada && $jugador && $puntos) {
            $conexion->añadirPartido($jornada, $jugador, $puntos);
            echo json_encode(['message' => 'Partido añadido con éxito.']);
        } else {
            echo json_encode(['error' => 'ERROR faltan datos necesarios para añadir el partido.']);
        }
        break;

    case 'PUT':
        parse_str(file_get_contents("php://input"), $put_vars);
        $jornada = $put_vars['jornada'];
        $jugador = $put_vars['jugador'];
        if ($conexion->partidoExiste($jornada, $jugador)) {
            $conexion->actualizarPartido($jornada, $jugador, $put_vars['puntos']);
            echo json_encode(['message' => 'Partido actualizado con éxito.']);
        } else {
            echo json_encode(['error' => 'ERROR el partido no existe.']);
        }
        break;

    case 'DELETE':
        parse_str(file_get_contents("php://input"), $del_vars);
        $jornada = $del_vars['jornada'];
        $jugador = $del_vars['jugador'];
        if ($conexion->partidoExiste($jornada, $jugador)) {
            $conexion->eliminarPartido($jornada, $jugador);
            echo json_encode(['message' => 'Partido eliminado con éxito.']);
        } else {
            echo json_encode(['error' => 'ERROR el partido no existe o la JORNADA o JUGADOR no son válidos.']);
        }
        break;

    default:
        echo json_encode(['error' => 'ERROR ,método HTTP no soportado']);
        break;
}
