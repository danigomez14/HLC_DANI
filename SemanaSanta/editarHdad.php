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

// Consultar los detalles de la hermandad
$queryDetalles = "SELECT * FROM detalles_hermandades WHERE hermandad_id = $idhermandad";
$resultadoDetalles = mysqli_query($conexion, $queryDetalles);

if ($resultadoDetalles && mysqli_num_rows($resultadoDetalles) > 0) {
    $detalles = mysqli_fetch_assoc($resultadoDetalles);
    $recorrido = $detalles['recorrido'];
    $nazarenos = $detalles['nazarenos'];
    $banda = $detalles['banda'];
    $dia_salida = $detalles['dia_salida'];
} else {
    // Si no hay detalles previamente guardados, inicializa las variables vacías
    $recorrido = '';
    $nazarenos = '';
    $banda = '';
    $dia_salida = '';
}

// Procesar el formulario cuando se envían datos
$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recorrido = mysqli_real_escape_string($conexion, $_POST['recorrido']);
    $nazarenos = intval($_POST['nazarenos']);
    $banda = mysqli_real_escape_string($conexion, $_POST['banda']);
    $dia_salida = mysqli_real_escape_string($conexion, $_POST['dia_salida']); // Campo día de salida (varchar)

    // Actualizar los detalles en la base de datos
    $queryUpdate = "UPDATE detalles_hermandades SET recorrido = '$recorrido', nazarenos = '$nazarenos', banda = '$banda', dia_salida = '$dia_salida' WHERE hermandad_id = $idhermandad";

    if (mysqli_query($conexion, $queryUpdate)) {
        $mensaje = "Datos actualizados correctamente.";
    } else {
        $mensaje = "Error al actualizar los detalles: " . mysqli_error($conexion);
    }
}

mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Detalles de la Hermandad</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f0f0f0;"> <!-- Fondo suave y neutro -->

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg border-light rounded p-4">
                <div class="row align-items-center">
                    <!-- Imagen de la hermandad -->
                    <div class="col-12 text-center mb-4">
                        <img src="imagenes/<?php echo $idhermandad; ?>.jpg" alt="Imagen de la hermandad" class="img-fluid rounded" style="max-width: 200px; height: 200px; object-fit: cover;">
                    </div>

                    <!-- Formulario de edición de detalles -->
                    <div class="col-12">
                        <h3 class="fw-bold text-center text-dark mb-3"><?php echo htmlspecialchars($nombrehermandad); ?></h3>

                        <!-- Mensaje de éxito o error -->
                        <?php if (!empty($mensaje)) { ?>
                            <div class="alert alert-success text-center"><?php echo $mensaje; ?></div>
                        <?php } ?>

                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">Recorrido:</label>
                                <textarea name="recorrido" class="form-control" rows="4" required><?php echo htmlspecialchars($recorrido); ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Número de Nazarenos:</label>
                                <input type="number" name="nazarenos" class="form-control" value="<?php echo htmlspecialchars($nazarenos); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Banda:</label>
                                <input type="text" name="banda" class="form-control" value="<?php echo htmlspecialchars($banda); ?>" required>
                            </div>

                            <!-- Campo para el día de salida -->
                            <div class="mb-3">
                                <label class="form-label">Día de Salida:</label>
                                <input type="text" name="dia_salida" class="form-control" value="<?php echo htmlspecialchars($dia_salida); ?>" required>
                            </div>

                            <button type="submit" class="btn btn-success w-100 mt-3">Guardar Cambios</button>
                            <a href="leerDatos.php" class="btn btn-secondary w-100 mt-2">Volver</a> <!-- Volver a leerDatos.php -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
