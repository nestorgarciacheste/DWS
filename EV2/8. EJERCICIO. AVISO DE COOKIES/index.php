<?php
if (isset($_COOKIE["aceptar_cookies"])) {
    $cookiesAceptadas = true;
} else {
    $cookiesAceptadas = false;
    if (isset($_POST["aceptar_cookies"])) {
        setcookie("aceptar_cookies", "1", time() + (86400 * 30), "/");
        $cookiesAceptadas = true;
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Aceptar Cookies</title>
</head>

<body>

    <?php if (!$cookiesAceptadas) : ?>
        <div id="cuadro-cookies">
            <p>Este sitio utiliza cookies para mejorar la experiencia de usuario.</p>
            <form method="post">
                <button type="submit" name="aceptar_cookies">Aceptar Cookies</button>
            </form>
        </div>
    <?php endif; ?>

</body>

</html>