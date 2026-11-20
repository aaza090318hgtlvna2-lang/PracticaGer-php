<?php

function convertirMinusculas($texto) {
    $acentos = ['Á', 'É', 'Í', 'Ó', 'Ú', 'á', 'é', 'í', 'ó', 'ú', 'Ñ', 'ñ'];
    $sinAcentos = ['a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u', 'n', 'n'];
    $textoNormalizado = str_replace($acentos, $sinAcentos, $texto);
    
    return strtolower($textoNormalizado);
}

function limpiarNombre($nombre) {
    $nombreSinExtremos = trim($nombre);
    $nombreSinEspacios = str_replace(" ", "", $nombreSinExtremos);
    
    return convertirMinusculas($nombreSinEspacios);
}

function obtenerInstitucion($institucion) {
    $instLimpia = trim($institucion);
    if (strlen($instLimpia) >= 2) {
        $primerasDos = substr($instLimpia, 0, 2);
        return convertirMinusculas($primerasDos);
    }
    return "xx";
}

function obtenerAnio($anioIngreso) {
    $anioLimpio = trim((string)$anioIngreso);
    if (strlen($anioLimpio) >= 2) {
        return substr($anioLimpio, -2);
    }
    return "00";
}

function generarUsuario($nombre, $institucion, $anioIngreso) {
    $parteNombre = limpiarNombre($nombre);
    $parteInstitucion = obtenerInstitucion($institucion);
    $parteAnio = obtenerAnio($anioIngreso);
    
    return $parteNombre . $parteInstitucion . $parteAnio;
}


$usuarioGenerado = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreCompleto = $_POST["nombre"] ?? "";
    $institucion = $_POST["institucion"] ?? "";
    $anioIngreso = $_POST["anio"] ?? "";
    $usuarioGenerado = generarUsuario($nombreCompleto, $institucion, $anioIngreso);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 2 - Generador de Usuarios</title>
</head>
<body>
    <h2>Generador de Nombres de Usuario</h2>
    <form method="POST">
        <label>Nombre completo:</label><br>
        <input type="text" name="nombre" placeholder="Ej. María Fernanda López" required><br><br>

        <label>Institución educativa:</label><br>
        <input type="text" name="institucion" placeholder="Ej. CBTIS" required><br><br>

        <label>Año de ingreso:</label><br>
        <input type="number" name="anio" placeholder="Ej. 2026" required><br><br>

        <button type="submit">Generar Usuario</button>
    </form>

    <?php if ($usuarioGenerado !== ""): ?>
        <h3>Nombre de usuario generado: <?php echo htmlspecialchars($usuarioGenerado); ?></h3>
    <?php endif; ?>
</body>
</html>
