<?php

// Clase para manejar la conexión y operaciones con la base de datos de hoteles.
class ConexionBD
{
    // Propiedades privadas para almacenar los detalles de conexión a la base de datos.
    private $server = 'mysql:host=localhost;dbname=hoteles;charset=utf8';
    private $user = 'root';
    private $password = '';
    private $pdo; // Objeto PDO para la conexión con la base de datos.

    // Constructor de la clase, se ejecuta al instanciar la clase.
    public function __construct()
    {
        try {
            // Intenta establecer conexión con la base de datos usando PDO.
            $this->pdo = new PDO($this->server, $this->user, $this->password);
            // Configura el modo de error de PDO para lanzar excepciones.
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Captura cualquier excepción relacionada con PDO y termina la ejecución, mostrando el mensaje de error.
            die(json_encode(['error' => 'ERROR de conexión a la base de datos: ' . $e->getMessage()]));
        }
    }

    // Método para actualizar la información de un hotel existente.
    public function actualizarHotel($cod_hotel, $nombre, $cat, $hab, $poblacion, $direccion)
    {
        try {
            // Prepara una consulta SQL para actualizar un hotel.
            $query = "UPDATE hoteles SET nombre = :nombre, cat = :categoria, hab = :habitaciones, poblacion = :poblacion, direccion = :direccion WHERE cod_hotel = :hotel_id";
            $stmt = $this->pdo->prepare($query);

            // Vincula los parámetros con los valores proporcionados.
            $stmt->bindParam(':hotel_id', $cod_hotel);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':categoria', $cat);
            $stmt->bindParam(':habitaciones', $hab);
            $stmt->bindParam(':poblacion', $poblacion);
            $stmt->bindParam(':direccion', $direccion);

            // Ejecuta la consulta.
            $stmt->execute();
        } catch (PDOException $e) {
            // Captura cualquier excepción y termina la ejecución, mostrando el mensaje de error.
            die(json_encode(['error' => 'ERROR al actualizar el hotel: ' . $e->getMessage()]));
        }
    }

    // Método para añadir un nuevo hotel a la base de datos.
    public function añadeHotel($nombre, $cat, $hab, $poblacion, $direccion)
    {
        try {
            // Prepara una consulta SQL para insertar un nuevo hotel.
            $stmt = $this->pdo->prepare("INSERT INTO hoteles (nombre, cat, hab, poblacion, direccion) VALUES (:nombre, :cat, :hab, :poblacion, :direccion)");

            // Vincula los parámetros con los valores proporcionados.
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':cat', $cat);
            $stmt->bindParam(':hab', $hab);
            $stmt->bindParam(':poblacion', $poblacion);
            $stmt->bindParam(':direccion', $direccion);

            // Ejecuta la consulta.
            $stmt->execute();
        } catch (PDOException $e) {
            // Captura cualquier excepción y termina la ejecución, mostrando el mensaje de error.
            die(json_encode(['error' => 'ERROR al añadir el hotel: ' . $e->getMessage()]));
        }
    }

    // Método para eliminar un hotel de la base de datos.
    public function deleteHotel($id)
    {
        try {
            // Prepara una consulta SQL para eliminar un hotel por su ID.
            $query = "DELETE FROM hoteles WHERE cod_hotel = :id";
            $stmt = $this->pdo->prepare($query);

            // Vincula el ID del hotel con el valor proporcionado.
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            // Ejecuta la consulta y retorna el número de filas afectadas.
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            // Captura cualquier excepción y termina la ejecución, mostrando el mensaje de error.
            die(json_encode(['error' => 'ERROR al eliminar el hotel: ' . $e->getMessage()]));
        }
    }

    // Método para verificar si existe un hotel en la base de datos.
    public function hotelExiste($cod_hotel)
    {
        try {
            // Prepara una consulta SQL para contar los hoteles con un determinado código.
            $query = "SELECT COUNT(*) FROM hoteles WHERE cod_hotel = :cod_hotel";
            $stmt = $this->pdo->prepare($query);

            // Vincula el código del hotel con el valor proporcionado.
            $stmt->bindParam(':cod_hotel', $cod_hotel, PDO::PARAM_INT);

            // Ejecuta la consulta y retorna verdadero si el hotel existe.
            $stmt->execute();
            $count = $stmt->fetchColumn();
            return $count > 0;
        } catch (PDOException $e) {
            // Captura cualquier excepción y termina la ejecución, mostrando el mensaje de error.
            die(json_encode(['error' => 'ERROR al verificar si el hotel existe: ' . $e->getMessage()]));
        }
    }

    // Método para obtener todos los hoteles de la base de datos.
    public function getHoteles()
    {
        try {
            // Prepara una consulta SQL para seleccionar todos los hoteles.
            $query = "SELECT * FROM hoteles";
            $stmt = $this->pdo->prepare($query);

            // Ejecuta la consulta y retorna todos los hoteles.
            $stmt->execute();
            $hoteles = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $hoteles;
        } catch (PDOException $e) {
            // Captura cualquier excepción y termina la ejecución, mostrando el mensaje de error.
            die(json_encode(['error' => 'ERROR al obtener datos de la base de datos: ' . $e->getMessage()]));
        }
    }

    // Método para obtener los detalles de un hotel específico.
    public function muestraHotel($id)
    {
        try {
            // Prepara una consulta SQL para seleccionar un hotel por su ID.
            $query = "SELECT * FROM hoteles WHERE cod_hotel = :cod_hotel";
            $stmt = $this->pdo->prepare($query);

            // Vincula el ID del hotel con el valor proporcionado.
            $stmt->bindParam(':cod_hotel', $id, PDO::PARAM_INT);

            // Ejecuta la consulta y retorna los detalles del hotel.
            $stmt->execute();
            $hotel = $stmt->fetch(PDO::FETCH_ASSOC);
            return $hotel;
        } catch (PDOException $e) {
            // Captura cualquier excepción y termina la ejecución, mostrando el mensaje de error.
            die(json_encode(['error' => 'ERROR al mostrar el hotel: ' . $e->getMessage()]));
        }
    }
}

// Crear una instancia de la clase ConexionBD para manejar la base de datos.
$conexion = new ConexionBD();

// Manejar la solicitud HTTP
$method = $_SERVER['REQUEST_METHOD'];

// El código utiliza una estructura switch para manejar diferentes tipos de solicitudes HTTP.
switch ($method) {
    case 'GET':
        // Manejar solicitudes GET.
        // Verifica si se ha enviado el parámetro 'id' a través de la URL.
        if (isset($_GET['id'])) {
            $id = $_GET['id'];  // Obtiene el valor de 'id'.
            // Verifica si el hotel con ese ID existe en la base de datos.
            if ($conexion->hotelExiste($id)) {
                $hotel = $conexion->muestraHotel($id);  // Obtiene los detalles del hotel.
                echo json_encode(['hotel' => $hotel]);  // Devuelve los detalles del hotel en formato JSON.
            } else {
                // Si el hotel no existe, devuelve un mensaje de error en formato JSON.
                echo json_encode(['error' => 'ERROR el hotel con el ID proporcionado no existe.']);
            }
        } else {
            // Si no se proporcionó 'id', obtiene todos los hoteles.
            $hoteles = $conexion->getHoteles();
            echo json_encode(['hoteles' => $hoteles]);  // Devuelve la lista de hoteles en formato JSON.
        }
        break;

    case 'POST':
        // Manejar solicitudes POST (para añadir un nuevo hotel).
        // Recoge los datos enviados a través del formulario o API.
        $nombre = $_POST['nombre'];
        $cat = $_POST['cat'];
        $hab = $_POST['hab'];
        $poblacion = $_POST['poblacion'];
        $direccion = $_POST['direccion'];
        // Verifica si todos los datos necesarios están presentes.
        if ($nombre && $cat && $hab && $poblacion && $direccion) {
            // Añade el nuevo hotel a la base de datos.
            $conexion->añadeHotel($nombre, $cat, $hab, $poblacion, $direccion);
            echo json_encode(['message' => 'Hotel añadido con éxito.']);  // Devuelve un mensaje de éxito.
        } else {
            // Si faltan datos, devuelve un mensaje de error.
            echo json_encode(['error' => 'ERROR faltan datos necesarios para añadir el hotel.']);
        }
        break;

    case 'PUT':
        // Manejar solicitudes PUT (para actualizar un hotel existente).
        // Los datos se envían a través del cuerpo de la solicitud, no de la URL.
        parse_str(file_get_contents("php://input"), $put_vars);
        $cod_hotel = $put_vars['cod_hotel'];
        // Verifica si el hotel a actualizar existe.
        if ($conexion->hotelExiste($cod_hotel)) {
            // Actualiza la información del hotel.
            $conexion->actualizarHotel($cod_hotel, $put_vars['nombre'], $put_vars['cat'], $put_vars['hab'], $put_vars['poblacion'], $put_vars['direccion']);
            echo json_encode(['message' => 'Hotel actualizado con éxito.']);  // Devuelve un mensaje de éxito.
        } else {
            // Si el hotel no existe, devuelve un mensaje de error.
            echo json_encode(['error' => 'ERROR el hotel no existe.']);
        }
        break;

    case 'DELETE':
        // Manejar solicitudes DELETE (para eliminar un hotel).
        parse_str(file_get_contents("php://input"), $del_vars);
        $id = $del_vars['id'];
        // Verifica si el hotel a eliminar existe.
        if ($conexion->hotelExiste($id)) {
            $conexion->deleteHotel($id);  // Elimina el hotel.
            echo json_encode(['message' => 'Hotel eliminado con éxito.']);  // Devuelve un mensaje de éxito.
        } else {
            // Si el hotel no existe o el ID no es válido, devuelve un mensaje de error.
            echo json_encode(['error' => 'ERROR el hotel no existe o el ID no es válido.']);
        }
        break;

    default:
        // En caso de un método HTTP no soportado, devuelve un mensaje de error.
        echo json_encode(['error' => 'ERROR ,método HTTP no soportado']);
        break;
}
