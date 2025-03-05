<?php
// Incluir la conexión a la base de datos
include('conexion.php'); 

// Verificar si se recibe el ID de la hermandad
if (!isset($_GET['id'])) {
    die("Error: No se ha proporcionado un ID de hermandad.");
}

$idhermandad = intval($_GET['id']);

// Consultar los datos de la hermandad
$query = "SELECT nombre FROM hermandades WHERE id = $idhermandad";
$resultado = mysqli_query($conexion, $query);

if ($resultado && mysqli_num_rows($resultado) > 0) {
    $row = mysqli_fetch_assoc($resultado);
    $nombrehermandad = $row['nombre'];
} else {
    die("Error: Hermandad no encontrada.");
}

// Ruta de la imagen basada en el ID de la hermandad
$rutaimagen = "imagenes/$idhermandad.jpg";
if (!file_exists($rutaimagen)) {
    $rutaimagen = "imagenes/default.jpg";
}

// Procesar el formulario cuando se envían datos
$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recorrido = mysqli_real_escape_string($conexion, $_POST['recorrido']);
    $nazarenos = intval($_POST['nazarenos']);
    $banda = mysqli_real_escape_string($conexion, $_POST['banda']);

    // Insertar los datos en la base de datos
    $queryinsert = "INSERT INTO detalles_hermandades (hermandad_id, recorrido, nazarenos, banda) 
                    VALUES ('$idhermandad', '$recorrido', '$nazarenos', '$banda')";

    if (mysqli_query($conexion, $queryinsert)) {
        $mensaje = "Datos introducidos correctamente.";
    } else {
        $mensaje = "Error al guardar los detalles: " . mysqli_error($conexion);
    }
}

mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Hermandad</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="shadow bg-white rounded p-4 w-100" style="max-width: 900px;">
        <div class="row align-items-center">
            <!-- Imagen de la hermandad -->
            <div class="col-md-4 text-center">
                <img src="<?php echo $rutaimagen; ?>" alt="Imagen de la hermandad" class="img-fluid rounded">
            </div>

            <!-- Formulario de detalles -->
            <div class="col-md-8">
                <h2 class="fw-bold"><?php echo htmlspecialchars($nombrehermandad); ?></h2>

                <!-- Mensaje de éxito o error -->
                <?php if (!empty($mensaje)) { ?>
                    <div class="alert alert-success text-center"><?php echo $mensaje; ?></div>
                <?php } ?>

                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Recorrido:</label>
                        <textarea name="recorrido" class="form-control" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Número de Nazarenos:</label>
                        <input type="number" name="nazarenos" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Banda:</label>
                        <input type="text" name="banda" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Guardar Detalles</button>
                    <a href="index.php" class="btn btn-primary w-100 mt-2">Volver</a>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
