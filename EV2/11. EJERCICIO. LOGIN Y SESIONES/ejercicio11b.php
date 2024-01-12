<?php
session_start();

$admin_username = "admin";
$admin_password = "admin123";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username === $admin_username && $password === $admin_password) {
        $_SESSION["admin"] = true;
        header("Location: ejercicio11b.php");
        exit();
    } else {
        echo "Acceso denegado. Usuario no autorizado.";
    }
}

if (isset($_SESSION["admin"]) && $_SESSION["admin"] === true) {
    echo "Bienvenido, administrador.";
} else {
    echo "Acceso denegado. Usuario no autorizado.";
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Panel de Administración</title>
</head>

<body>
</body>

</html>