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

    public function actualizarEquipo($usuario, $jugador1, $jugador2, $jugador3, $jugador4, $jugador5, $puntos)
    {
        try {
            $query = "UPDATE equipo SET usuario = :usuario, jugador1 = :jugador1, jugador2 = :jugador2, jugador3 = :jugador3, jugador4 = :jugador4, jugador5 = :jugador5, puntos = :puntos WHERE usuario = :usuario";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(':usuario', $usuario);
            $stmt->bindParam(':jugador1', $jugador1);
            $stmt->bindParam(':jugador2', $jugador2);
            $stmt->bindParam(':jugador3', $jugador3);
            $stmt->bindParam(':jugador4', $jugador4);
            $stmt->bindParam(':jugador5', $jugador5);
            $stmt->bindParam(':puntos', $puntos);

            $stmt->execute();
        } catch (PDOException $e) {
            die(json_encode(['error' => 'ERROR al actualizar el equipo: ' . $e->getMessage()]));
        }
    }

    public function añadeEquipo($usuario, $jugador1, $jugador2, $jugador3, $jugador4, $jugador5, $puntos)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO equipo (usuario, jugador1, jugador2, jugador3, jugador4, jugador5, puntos) VALUES (:usuario, :jugador1, :jugador2, :jugador3, :jugador4, :jugador5, :puntos)");

            $stmt->bindParam(':usuario', $usuario);
            $stmt->bindParam(':jugador1', $jugador1);
            $stmt->bindParam(':jugador2', $jugador2);
            $stmt->bindParam(':jugador3', $jugador3);
            $stmt->bindParam(':jugador4', $jugador4);
            $stmt->bindParam(':jugador5', $jugador5);
            $stmt->bindParam(':puntos', $puntos);

            $stmt->execute();
        } catch (PDOException $e) {
            die(json_encode(['error' => 'ERROR al añadir el equipo: ' . $e->getMessage()]));
        }
    }

    public function deleteEquipo($usuario)
    {
        try {
            $query = "DELETE FROM equipo WHERE usuario = :usuario";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(':usuario', $usuario, PDO::PARAM_INT);


            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            die(json_encode(['error' => 'ERROR al eliminar el equipo: ' . $e->getMessage()]));
        }
    }

    public function equipoExiste($usuario)
    {
        try {
            $query = "SELECT COUNT(*) FROM equipo WHERE usuario = :usuario";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(':usuario', $usuario, PDO::PARAM_INT);

            $stmt->execute();
            $count = $stmt->fetchColumn();
            return $count > 0;
        } catch (PDOException $e) {
            die(json_encode(['error' => 'ERROR al verificar si el equipo existe: ' . $e->getMessage()]));
        }
    }

    public function getEquipos()
    {
        try {
            $query = "SELECT * FROM equipo";
            $stmt = $this->pdo->prepare($query);

            $stmt->execute();
            $equipo = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $equipo;
        } catch (PDOException $e) {
            die(json_encode(['error' => 'ERROR al obtener los equipos: ' . $e->getMessage()]));
        }
    }

    public function muestraEquipo($usuario)
    {
        try {
            $query = "SELECT * FROM equipo WHERE usuario = :usuario";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(':usuario', $usuario, PDO::PARAM_INT);

            $stmt->execute();
            $equipo = $stmt->fetch(PDO::FETCH_ASSOC);
            return $equipo;
        } catch (PDOException $e) {
            die(json_encode(['error' => 'ERROR al mostrar el equipo: ' . $e->getMessage()]));
        }
    }
}

$conexion = new ConexionBD();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['usuario'])) {
            $usuario = $_GET['usuario'];
            if ($conexion->equipoExiste($usuario)) {
                $equipo = $conexion->muestraEquipo($usuario);
                echo json_encode(['equipo' => $equipo]);
            } else {
                echo json_encode(['error' => 'ERROR el equipo con el USUARIO proporcionado no existe.']);
            }
        } else {
            $equipos = $conexion->getEquipos();
            echo json_encode(['equipos' => $equipos]);
        }
        break;

    case 'POST':
        $usuario = $_POST['usuario'];
        $jugador1 = $_POST['jugador1'];
        $jugador2 = $_POST['jugador2'];
        $jugador3 = $_POST['jugador3'];
        $jugador4 = $_POST['jugador4'];
        $jugador5 = $_POST['jugador5'];
        $puntos = $_POST['puntos'];
        if ($usuario && $jugador1 && $jugador2 && $jugador3 && $jugador4 && $jugador5 && $puntos) {
            $conexion->añadeEquipo($usuario, $jugador1, $jugador2, $jugador3, $jugador4, $jugador5, $puntos);
            echo json_encode(['message' => 'Equipo añadido con éxito añadido con éxito.']);
        } else {
            echo json_encode(['error' => 'ERROR faltan datos necesarios para añadir el equipo.']);
        }
        break;

    case 'PUT':
        parse_str(file_get_contents("php://input"), $put_vars);
        $usuario = $put_vars['usuario'];
        if ($conexion->equipoExiste($usuario)) {
            $conexion->actualizarEquipo($usuario, $put_vars['jugador1'], $put_vars['jugador2'], $put_vars['jugador3'], $put_vars['jugador4'], $put_vars['jugador5'], $put_vars['puntos']);
            echo json_encode(['message' => 'Equipo actualizado con éxito.']);
        } else {
            echo json_encode(['error' => 'ERROR el equipo no existe.']);
        }
        break;

    case 'DELETE':
        parse_str(file_get_contents("php://input"), $del_vars);
        $usuario = $del_vars['usuario'];
        if ($conexion->equipoExiste($usuario)) {
            $conexion->deleteEquipo($usuario);
            echo json_encode(['message' => 'Equipo eliminado con éxito.']);
        } else {
            echo json_encode(['error' => 'ERROR el equipo no existe o el USUARIO no es válido.']);
        }
        break;

    default:
        echo json_encode(['error' => 'ERROR ,método HTTP no soportado']);
        break;
}
