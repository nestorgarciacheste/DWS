<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Resultados del Formulario</title>
</head>

<body>
    <?php
    function recoge($var)
    {
        $tmp = (isset($_GET[$var])) ? trim(htmlspecialchars($_GET[$var], ENT_QUOTES, "UTF-8")) : '';
        $tmp = strip_tags($tmp);
        return $tmp;
    }

    $nombre = recoge('nombre');
    $sexo = recoge('sexo');
    $edad = recoge('edad');
    $peso = recoge('peso');
    $estado_civil = recoge('estado_civil');
    $aficiones = (isset($_GET['aficiones'])) ? $_GET['aficiones'] : [];

    echo "<p>NOMBRE: " . $nombre . "</p>";
    echo "<p>SEXO: " . $sexo . "</p>";
    echo "<p>EDAD: " . $edad . "</p>";
    echo "<p>PESO: " . $peso . "</p>";
    echo "<p>ESTADO CIVIL: " . $estado_civil . "</p>";
    echo "<p>Aficiones: " . implode(", ", $aficiones) . "</p>";

    echo "<a href='ejercicio7a.html'>Volver</a>";
    ?>
</body>

</html>