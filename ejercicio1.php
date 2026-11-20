<?php

function obtenerIniciales($nombre) {
    $nombreLimpio = trim($nombre);
    if (strlen($nombreLimpio) < 3) {
        return "XXX";
    }
    $iniciales = substr($nombreLimpio, 0, 3);
    return strtoupper($iniciales);
}

function obtenerAnio($fecha) {
    $fechaLimpia = trim($fecha);
    if (strlen($fechaLimpia) >= 4) {
        return substr($fechaLimpia, 2, 2);
    }
    return "00";
}

function obtenerMesDia($fecha) {
    $fechaLimpia = trim($fecha);
    if (strlen($fechaLimpia) == 10) {
        $mes = substr($fechaLimpia, 5, 2);
        $dia = substr($fechaLimpia, 8, 2);
        return $mes . $dia;
    }
    return "0000";
}

function generarClave($nombre, $fecha) {
    $iniciales = obtenerIniciales($nombre);
    $anio = obtenerAnio($fecha);
    $mesDia = obtenerMesDia($fecha);
    
    return $iniciales . $anio . $mesDia;
}


$claveGenerada = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreEstudiante = $_POST["nombre"] ?? "";
    $fechaNacimiento = $_POST["fecha"] ?? "";
    $claveGenerada = generarClave($nombreEstudiante, $fechaNacimiento);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 1 - Generador de Claves</title>
</head>
<body>
    <h2>Generador de Claves de Identificación</h2>
    <form method="POST">
        <label>Nombre completo del estudiante:</label><br>
        <input type="text" name="nombre" placeholder="Ej. Carlos Alberto Pérez" required><br><br>

        <label>Fecha de nacimiento (AAAA-MM-DD):</label><br>
        <input type="date" name="fecha" required><br><br>

        <button type="submit">Generar Clave</button>
    </form>

    <?php if ($claveGenerada !== ""): ?>
        <h3>Clave generada: <?php echo htmlspecialchars($claveGenerada); ?></h3>
    <?php endif; ?>
</body>
</html>
