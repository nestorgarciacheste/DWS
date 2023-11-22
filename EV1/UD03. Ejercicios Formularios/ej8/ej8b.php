<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $texto = $_POST["texto"];
    $filtro = $_POST["filtro"];

    switch ($filtro) {
        case "email":
            if (filter_var($texto, FILTER_VALIDATE_EMAIL)) {
                echo "El texto es un email válido.";
            } else {
                echo "El texto no es un email válido.";
            }
            break;

        case "numeros":
            if (ctype_digit($texto)) {
                echo "El texto contiene solo números.";
            } else {
                echo "El texto no contiene solo números.";
            }
            break;

        case "nif":
            if (preg_match('/^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]$/i', $texto)) {
                echo "El texto es un NIF válido.";
            } else {
                echo "El texto no es un NIF válido.";
            }
            break;

        case "texto":
            if (ctype_alpha($texto)) {
                echo "El texto contiene solo letras.";
            } else {
                echo "El texto no contiene solo letras.";
            }
            break;

        default:
            echo "Selecciona un tipo de validación válido.";
            break;
    }
} else {
    echo "Acceso no permitido.";
}
