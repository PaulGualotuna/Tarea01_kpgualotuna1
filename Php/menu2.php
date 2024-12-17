<?php
// Constante simbólica para la opción 2
define("MAX", 1000); // Se redujo el valor de MAX para pruebas más rápidas

// Función para generar la serie de Fibonacci
function fibonacci($n) {
    $a = 0;
    $b = 1;
    $fibonacci = [$a, $b];
    for ($i = 2; $i < $n; $i++) {
        $temp = $a + $b;
        $fibonacci[] = $temp;
        $a = $b;
        $b = $temp;
    }
    return $fibonacci;
}

// Función para verificar si un número cumple la condición del cubo
function esNumeroCubo($num) {
    $sumCubo = 0;
    $temp = $num;
    while ($temp > 0) {
        $digito = $temp % 10;
        $sumCubo += $digito * $digito * $digito;
        $temp = (int)($temp / 10);
    }
    return $sumCubo == $num;
}

// Función para calcular la expresión A + B * C - D
function calcularExpresion($a, $b, $c, $d) {
    if ($c <= 0) {
        return "Error: El denominador (C) no puede ser negativo ni cero.";
    }
    return $a + ($b * $c) - $d;
}

// Procesar la opción seleccionada
$resultado = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $opcion = $_POST['opcion'];

    switch ($opcion) {
        case "1":
            $n = intval($_POST['fibonacci_n']);
            if ($n >= 1 && $n <= 50) {
                $serie = fibonacci($n);
                $resultado = "Los primeros $n números de Fibonacci son: " . implode(", ", $serie);
            } else {
                $resultado = "Número inválido. Debe estar entre 1 y 50.";
            }
            break;

        case "2":
            $resultado = "Números entre 1 y " . MAX . " que cumplen la condición de la suma del cubo de sus dígitos:<br>";
            for ($i = 1; $i <= MAX; $i++) {
                if (esNumeroCubo($i)) {
                    $resultado .= $i . "<br>";
                }
            }
            break;

        case "3":
            $a = floatval($_POST['a']);
            $b = floatval($_POST['b']);
            $c = floatval($_POST['c']); // C como denominador
            $d = floatval($_POST['d']);

            if ($c <= 0) {
                $resultado = "Error: El denominador (C) no puede ser negativo ni cero.";
            } else {
                $resultado = "Resultado de la expresión A + B / C - D: " . calcularExpresion($a, $b, $c, $d);
            }
            break;

        case "S":
            $resultado = "Has seleccionado Salir.";
            break;

        default:
            $resultado = "Opción inválida.";
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú PHP</title>
    <!-- Incluir Bootstrap 3 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body style="background-color: #f8f9fa;">
    <div class="container">
        <h1>Menú</h1>
        <form method="POST" action="">
            <label>Seleccione una opción:</label><br>
            <input type="radio" name="opcion" value="1" required> 1. Fibonacci<br>
            <input type="radio" name="opcion" value="2"> 2. Cubo<br>
            <input type="radio" name="opcion" value="3"> 3. Fraccionarios<br>
            <input type="radio" name="opcion" value="S"> S. Salir<br><br>

            <!-- Entrada para Fibonacci -->
            <div id="fibonacci" style="display: <?= isset($_POST['opcion']) && $_POST['opcion'] == '1' ? 'block' : 'none' ?>;">
                <label>Ingrese un número (1-50 para Fibonacci):</label>
                <input type="number" name="fibonacci_n" min="1" max="50" class="form-control">
            </div>

            <!-- Entradas para Cubo -->
            <div id="cubo" style="display: <?= isset($_POST['opcion']) && $_POST['opcion'] == '2' ? 'block' : 'none' ?>;">
                <!-- Este bloque no necesita entradas, se genera automáticamente el resultado -->
            </div>

            <!-- Entradas para Fraccionarios -->
            <div id="fraccionarios" style="display: <?= isset($_POST['opcion']) && $_POST['opcion'] == '3' ? 'block' : 'none' ?>;">
                <label>Ingrese 4 números fraccionarios (para la expresión A + B * C - D):</label><br>
                A: <input type="text" name="a" placeholder="Ej. 1.5" class="form-control"><br>
                B: <input type="text" name="b" placeholder="Ej. 2.3" class="form-control"><br>
                C: <input type="text" name="c" placeholder="Ej. 3.1" class="form-control"><br>
                D: <input type="text" name="d" placeholder="Ej. 4.0" class="form-control"><br>
            </div>

            <br>
            <!-- Botón de Enviar con clase Bootstrap 3 -->
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>

        <!-- Resultado -->
        <?php if (!empty($resultado)): ?>
            <h2>Resultado:</h2>
            <p><?= $resultado; ?></p>
        <?php endif; ?>
    </div>

    <!-- Incluir Bootstrap 3 JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>

