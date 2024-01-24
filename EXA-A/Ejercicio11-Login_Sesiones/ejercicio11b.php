<?php
session_start();
echo "<div class = 'resultado'> Hola " . $_SESSION["usuario"] . " de contraseña " . $_SESSION["password"] . "</div>";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>

</html>
<!--Cuando se reinicia el navegador, se crea una nueva sesión, pidiéndonos así los credenciales de nuevo.-->