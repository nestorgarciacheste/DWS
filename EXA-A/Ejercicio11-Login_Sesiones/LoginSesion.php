<?php
session_start();

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

    public function getAllUsers()
    {
        try {
            $query = "SELECT login, password FROM usuario";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die(json_encode(['error' => 'ERROR al obtener usuarios: ' . $e->getMessage()]));
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener las credenciales del formulario
    $usuario = $_POST["name"];
    $clave = $_POST["password"];

    // Instanciar la clase de conexión
    $conexion = new ConexionBD();

    // Obtener todos los usuarios y contraseñas de la base de datos
    $usuarios = $conexion->getAllUsers();

    // Verificar si las credenciales coinciden con algún usuario
    foreach ($usuarios as $user) {
        $hashed_password = $user['password'];

        if ($usuario == $user['login'] && password_verify($clave, $hashed_password)) {
            $_SESSION["usuario"] = $usuario;
            $_SESSION["password"] = $hashed_password; // Almacena la contraseña cifrada

            // Redirigir al usuario a la página deseada
            header("Location: ejercicio11b.php");
            exit();
        }
    }

    // Si llegamos aquí, las credenciales no coinciden con ningún usuario
    echo "<div class='resultado'>Usuario o contraseña incorrectos. Verifica las credenciales e inténtalo nuevamente.</div>";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="estilos/formulario.css" />
</head>

<body>
    <h1 style="text-align: center;">Inicio de Sesión</h1>

    <form action="" method="post">
        <label for="name">Usuario:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Iniciar Sesión</button>
    </form>
</body>

</html>