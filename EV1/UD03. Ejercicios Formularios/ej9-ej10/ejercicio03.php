<?php
$error = "";
$resultado = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_STRING);
    if (empty($nombre)) {
        $error .= "ERROR. Debe introducir un nombre válido.<br>";
    }

    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error .= "ERROR. Debe introducir un email válido.<br>";
    }

    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
    if (empty($username)) {
        $error .= "ERROR. Debe introducir un user válido.<br>";
    }

    $password = $_POST["password"];
    if (empty($password)) {
        $error .= "ERROR. Debe introducir un pass válido.<br>";
    }

    $confirm_password = $_POST["confirm_password"];
    if (empty($confirm_password) || $password !== $confirm_password) {
        $error .= "ERROR. Debe introducir un pass2 válido.<br>";
    }

    if (isset($_FILES["file"])) {
        $file = $_FILES["file"];
        $maxSize = 2 * 1024 * 1024;
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

        if ($file['size'] > $maxSize) {
            $error .= "ERROR. El archivo es demasiado grande. Tamaño máximo permitido: 2MB.<br>";
        }

        if (!in_array($file['type'], $allowedTypes)) {
            $error .= "ERROR. Tipo de archivo no permitido. Solo se permiten imágenes JPEG, PNG, y GIF.<br>";
        }
    } else {
        $error .= "ERROR. Debe subir una foto.<br>";
    }

    if (empty($error)) {
        $resultado .= "Resultado de poner todos los campos bien:<br>";
        $resultado .= "nombre: $nombre<br>";
        $resultado .= "email: $email<br>";
        $resultado .= "pass: $password<br>";
        $resultado .= "pass2: $confirm_password<br>";
        $resultado .= "El usuario no está bloqueado<br>";
    }
}

echo $error ?: $resultado;
