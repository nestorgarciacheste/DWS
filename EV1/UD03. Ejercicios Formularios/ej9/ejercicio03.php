<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $usuario = $_POST["usuario"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $check1 = isset($_POST["check1"]) ? "Sí" : "No";
    $check2 = isset($_POST["check2"]) ? "Sí" : "No";

    if ($password !== $confirm_password) {
        die("Error: Las contraseñas no coinciden.");
    }

    if ($_FILES["foto"]["size"] > 500000) {
        die("Error: El tamaño del archivo de la foto es demasiado grande.");
    }

    $allowed_types = array("image/jpeg", "image/png", "image/gif");
    if (!in_array($_FILES["foto"]["type"], $allowed_types)) {
        die("Error: Tipo de archivo no permitido. Sube una imagen en formato JPEG, PNG o GIF.");
    }

    echo "<h2>Datos del Usuario Registrado:</h2>";
    echo "<p><strong>Nombre:</strong> $nombre</p>";
    echo "<p><strong>E-mail:</strong> $email</p>";
    echo "<p><strong>Nombre de Usuario:</strong> $usuario</p>";
    echo "<p><strong>Check 1:</strong> $check1</p>";
    echo "<p><strong>Check 2:</strong> $check2</p>";

    $foto_destino = "fotos/" . basename($_FILES["foto"]["name"]);
    move_uploaded_file($_FILES["foto"]["tmp_name"], $foto_destino);

    echo "<p><strong>Foto:</strong> <img src='$foto_destino' alt='Foto de perfil'></p>";
} else {
    echo "Acceso no permitido.";
}
