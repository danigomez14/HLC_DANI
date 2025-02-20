<?php
// Incluir el archivo de conexión a la base de datos
include('conexion.php'); 

// Verificar si el ID de la hermandad fue pasado por URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID de hermandad no especificado.");
}

$id = intval($_GET['id']); // Convertir a entero para seguridad

// Obtener datos de la hermandad seleccionada
$query = "SELECT * FROM hermandades WHERE id = $id";
$resultado = mysqli_query($conexion, $query);

if (!$resultado || mysqli_num_rows($resultado) == 0) {
    die("Hermandad no encontrada.");
}

$hermandad = mysqli_fetch_assoc($resultado);

// Procesar el formulario si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recorrido = mysqli_real_escape_string($conexion, $_POST['recorrido']);
    $nazarenos = intval($_POST['nazarenos']);
    $banda = mysqli_real_escape_string($conexion, $_POST['banda']);

    // Insertar los datos en la tabla detalles_hermandades
    $insertQuery = "INSERT INTO detalles_hermandades (hermandad_id, recorrido, nazarenos, banda) 
                    VALUES ('$id', '$recorrido', '$nazarenos', '$banda')";

    if (mysqli_query($conexion, $insertQuery)) {
        echo "<p class='mensaje-exito'>Detalles añadidos correctamente.</p>";
    } else {
        echo "<p class='mensaje-error'>Error al añadir detalles: " . mysqli_error($conexion) . "</p>";
    }
}

// Obtener los detalles de la hermandad si existen
$detallesQuery = "SELECT * FROM detalles_hermandades WHERE hermandad_id = $id";
$detallesResultado = mysqli_query($conexion, $detallesQuery);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Hermandad</title>
    <link rel="stylesheet" href="redirigir.css"> <!-- Enlace al archivo CSS -->
</head>
<body>

<div class="container">
    <h2>Detalles de la Hermandad: <?php echo htmlspecialchars($hermandad['nombre']); ?></h2>

    <!-- Formulario para ingresar detalles -->
    <form method="post">
        <label for="recorrido">Recorrido:</label>
        <textarea name="recorrido" id="recorrido" required></textarea>

        <label for="nazarenos">Número de Nazarenos:</label>
        <input type="number" name="nazarenos" id="nazarenos" required>

        <label for="banda">Banda:</label>
        <input type="text" name="banda" id="banda" required>

        <button type="submit">Guardar Detalles</button>
    </form>

    <h3>Historial de Detalles Guardados</h3>
    <table>
        <tr>
            <th>Recorrido</th>
            <th>Nazarenos</th>
            <th>Banda</th>
        </tr>
        <?php
        while ($detalle = mysqli_fetch_assoc($detallesResultado)) {
            echo "<tr>
                    <td>{$detalle['recorrido']}</td>
                    <td>{$detalle['nazarenos']}</td>
                    <td>{$detalle['banda']}</td>
                  </tr>";
        }
        ?>
    </table>

    <a class="btn-volver" href="index.php">Volver al listado</a>
</div>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>

</body>
</html>
