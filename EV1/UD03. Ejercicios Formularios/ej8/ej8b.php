<?php
$texto = $_POST['texto'] ?? '';
$tipo_validacion = $_POST['tipo_validacion'] ?? '';

$esValido = false;
$mensaje = "";

switch ($tipo_validacion) {
    case 'email':
        $esValido = filter_var($texto, FILTER_VALIDATE_EMAIL);
        $mensaje = $esValido ? "El texto es un e-mail válido." : "El texto no es un e-mail válido.";
        break;
    case 'dni':
        $patron_dni = "/^[0-9]{8}[A-Za-z]$/";
        $esValido = preg_match($patron_dni, $texto);
        $mensaje = $esValido ? "El texto es un DNI válido." : "El texto no es un DNI válido.";
        break;
    case 'numeros':
        $esValido = filter_var($texto, FILTER_VALIDATE_INT);
        $mensaje = $esValido ? "El texto contiene sólo números." : "El texto no contiene sólo números.";
        break;
    default:
        $mensaje = "Por favor, selecciona un tipo de validación.";
        break;
}

echo $mensaje;
