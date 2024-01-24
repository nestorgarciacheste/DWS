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

    public function actualizarUsuario($login, $password)
    {
        try {
            $query = "UPDATE usuario SET password = :password WHERE login = :login";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(':login', $login);
            $stmt->bindParam(':password', $password);

            $stmt->execute();
        } catch (PDOException $e) {
            die(json_encode(['error' => 'ERROR al actualizar el usuario: ' . $e->getMessage()]));
        }
    }

    public function añadirUsuario($login, $password)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO usuario (login, password) VALUES (:login, :password)");

            $stmt->bindParam(':login', $login);
            $stmt->bindParam(':password', $password);

            $stmt->execute();
        } catch (PDOException $e) {
            die(json_encode(['error' => 'ERROR al añadir el usuario: ' . $e->getMessage()]));
        }
    }

    public function eliminarUsuario($login)
    {
        try {
            $query = "DELETE FROM usuario WHERE login = :login";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(':login', $login);

            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            die(json_encode(['error' => 'ERROR al eliminar el usuario: ' . $e->getMessage()]));
        }
    }

    public function usuarioExiste($login)
    {
        try {
            $query = "SELECT COUNT(*) FROM usuario WHERE login = :login";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(':login', $login);

            $stmt->execute();
            $count = $stmt->fetchColumn();
            return $count > 0;
        } catch (PDOException $e) {
            die(json_encode(['error' => 'ERROR al verificar si el usuario existe: ' . $e->getMessage()]));
        }
    }

    public function getUsuarios()
    {
        try {
            $query = "SELECT * FROM usuario";
            $stmt = $this->pdo->prepare($query);

            $stmt->execute();
            $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $usuarios;
        } catch (PDOException $e) {
            die(json_encode(['error' => 'ERROR al obtener los usuarios: ' . $e->getMessage()]));
        }
    }

    public function mostrarUsuario($login)
    {
        try {
            $query = "SELECT * FROM usuario WHERE login = :login";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(':login', $login);

            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            return $usuario;
        } catch (PDOException $e) {
            die(json_encode(['error' => 'ERROR al mostrar el usuario: ' . $e->getMessage()]));
        }
    }
}

$conexion = new ConexionBD();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['login'])) {
            $login = $_GET['login'];
            if ($conexion->usuarioExiste($login)) {
                $usuario = $conexion->mostrarUsuario($login);
                echo json_encode(['usuario' => $usuario]);
            } else {
                echo json_encode(['error' => 'ERROR el usuario con el LOGIN proporcionado no existe.']);
            }
        } else {
            $usuarios = $conexion->getUsuarios();
            echo json_encode(['usuarios' => $usuarios]);
        }
        break;

    case 'POST':
        $login = $_POST['login'];
        $password = $_POST['password'];
        if ($login && $password) {
            $conexion->añadirUsuario($login, $password);
            echo json_encode(['message' => 'Usuario añadido con éxito.']);
        } else {
            echo json_encode(['error' => 'ERROR faltan datos necesarios para añadir el usuario.']);
        }
        break;

    case 'PUT':
        parse_str(file_get_contents("php://input"), $put_vars);
        $login = $put_vars['login'];
        if ($conexion->usuarioExiste($login)) {
            $conexion->actualizarUsuario($login, $put_vars['password']);
            echo json_encode(['message' => 'Usuario actualizado con éxito.']);
        } else {
            echo json_encode(['error' => 'ERROR el usuario no existe.']);
        }
        break;

    case 'DELETE':
        parse_str(file_get_contents("php://input"), $del_vars);
        $login = $del_vars['login'];
        if ($conexion->usuarioExiste($login)) {
            $conexion->eliminarUsuario($login);
            echo json_encode(['message' => 'Usuario eliminado con éxito.']);
        } else {
            echo json_encode(['error' => 'ERROR el usuario no existe o el LOGIN no es válido.']);
        }
        break;

    default:
        echo json_encode(['error' => 'ERROR ,método HTTP no soportado']);
        break;
}
