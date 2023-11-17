<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora PHP</title>
</head>

<body>

    <h2>Calculadora PHP</h2>
    <form method="post" action="">
        Número 1: <input type="number" name="num1" required>
        <br><br>
        Número 2: <input type="number" name="num2" required>
        <br><br>
        Operación:
        <input type="radio" name="operacion" value="sumar"> Sumar
        <input type="radio" name="operacion" value="restar"> Restar
        <input type="radio" name="operacion" value="multiplicar"> Multiplicar
        <input type="radio" name="operacion" value="dividir"> Dividir
        <br><br>
        <input type="submit" name="calcular" value="Calcular">
    </form>

    <?php
    if (isset($_POST["calcular"])) {
        $num1 = $_POST["num1"];
        $num2 = $_POST["num2"];
        $operacion = isset($_POST["operacion"]) ? $_POST["operacion"] : "";

        if (!empty($operacion)) {
            switch ($operacion) {
                case 'sumar':
                    $resultado = $num1 + $num2;
                    break;

                case 'restar':
                    $resultado = $num1 - $num2;
                    break;

                case 'multiplicar':
                    $resultado = $num1 * $num2;
                    break;

                case 'dividir':
                    if ($num2 != 0) {
                        $resultado = $num1 / $num2;
                    } else {
                        echo "Error: No se puede dividir por cero.";
                    }
                    break;

                default:
                    echo "Error: Operación no válida.";
                    break;
            }

            if (isset($resultado)) {
                echo "<br><br>Resultado: " . $num1 . " " . $operacion . " " . $num2 . " = " . $resultado;
            }
        }
    }
    ?>

</body>

</html>