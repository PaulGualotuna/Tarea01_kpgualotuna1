<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Matemático</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Menú Matemático</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label for="opcion">Seleccione una opción:</label>
            <select class="form-control" id="opcion" name="opcion">
                <option value="1">1. Factorial</option>
                <option value="2">2. Primo</option>
                <option value="3">3. Serie Matemática</option>
                <option value="S">S. Salir</option>
            </select>
        </div>
        <div class="form-group">
            <label for="numero">Ingrese un número (0-10):</label>
            <input type="number" class="form-control" id="numero" name="numero" min="0" max="10" required>
        </div>
        <button type="submit" class="btn btn-primary">Calcular</button>
    </form>
</div>
<?php
// Funciones matemáticas
function calcularFactorial($num) {
    $factorial = 1;
    for ($i = 1; $i <= $num; $i++) $factorial *= $i;
    return $factorial;
}

function esPrimo($num) {
    if ($num <= 1) return false;
    for ($i = 2; $i <= sqrt($num); $i++) if ($num % $i == 0) return false;
    return true;
}

function calcularSerie($n) {
    $suma = 0;
    $signo = 1;
    for ($i = 1; $i <= $n; $i++) {
        $suma += $signo * (pow($i, 2) / calcularFactorial($i));
        $signo *= -1;
    }
    return $suma;
}

// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $opcion = $_POST['opcion'];

    if ($opcion == 'S') {
        echo "<div class='container mt-3'><h4>Programa terminado. ¡Hasta pronto!</h4></div>";
        exit; // Termina el programa
    }

    $numero = $_POST['numero'];
    if ($numero < 0 || $numero > 10) {
        echo "<div class='container mt-3 text-danger'>Número fuera del rango permitido (0-10).</div>";
    } else {
        echo "<div class='container mt-3'><h4>Resultado:</h4>";
        switch ($opcion) {
            case '1':
                echo "El factorial de $numero es " . calcularFactorial($numero);
                break;
            case '2':
                echo $numero . (esPrimo($numero) ? " es primo." : " no es primo.");
                break;
            case '3':
                echo "El resultado de la serie matemática es " . calcularSerie($numero);
                break;
            default:
                echo "Opción inválida.";
        }
        echo "</div>";
    }
}
?>
</body>
</html>
