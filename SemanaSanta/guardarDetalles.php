<?php
// Incluir la conexión a la base de datos
include('conexion.php');

// Verificar si se ha enviado el ID de la hermandad
$mensaje = "";
$hermandad_id = null;
$detalles = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['hermandad_id'])) {
        $hermandad_id = intval($_POST['hermandad_id']);
    }

    if ($hermandad_id) {
        // Consultar los datos de la hermandad
        $query = "SELECT nombre FROM hermandades WHERE id = $hermandad_id";
        $resultado = mysqli_query($conexion, $query);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            $row = mysqli_fetch_assoc($resultado);
            $nombrehermandad = $row['nombre'];

            // Ruta de la imagen basada en el ID de la hermandad
            $rutaimagen = "imagenes/$hermandad_id.jpg";
            if (!file_exists($rutaimagen)) {
                $rutaimagen = "imagenes/default.jpg";
            }

            // Consultar los detalles guardados para la hermandad
            $queryDetalles = "SELECT recorrido, nazarenos, banda FROM detalles_hermandades WHERE hermandad_id = $hermandad_id";
            $resultadoDetalles = mysqli_query($conexion, $queryDetalles);

            if ($resultadoDetalles && mysqli_num_rows($resultadoDetalles) > 0) {
                $detalles = mysqli_fetch_assoc($resultadoDetalles);
            } else {
                $mensaje = "No se han encontrado detalles guardados para esta hermandad.";
            }
        } else {
            $mensaje = "Hermandad no encontrada.";
        }
    } else {
        $mensaje = "Por favor, seleccione una hermandad.";
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
        <?php if (!$hermandad_id) { ?>
            <!-- Selección de Hermandad -->
            <h2 class="text-center">Selecciona una Hermandad</h2>

            <form method="POST" class="mb-4">
                <div class="mb-3">
                    <label class="form-label">Hermandad:</label>
                    <select name="hermandad_id" class="form-control" required>
                        <option value="">Selecciona una hermandad</option>
                        <?php
                        // Consultar todas las hermandades para mostrarlas en el formulario
                        include('conexion.php');
                        $query_hermandades = "SELECT id, nombre FROM hermandades";
                        $resultado_hermandades = mysqli_query($conexion, $query_hermandades);

                        while ($hermandad = mysqli_fetch_assoc($resultado_hermandades)) {
                            echo "<option value='" . $hermandad['id'] . "'>" . $hermandad['nombre'] . "</option>";
                        }
                        mysqli_close($conexion);
                        ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary w-100">Ver Detalles</button>
            </form>
        <?php } ?>

        <?php if ($hermandad_id) { ?>
            <!-- Mostrar los detalles de la hermandad seleccionada -->
            <div class="row align-items-center">
                <!-- Imagen de la hermandad -->
                <div class="col-md-4 text-center">
                    <img src="<?php echo $rutaimagen; ?>" alt="Imagen de la hermandad" class="img-fluid rounded" style="max-width: 150px;">
                </div>

                <!-- Mostrar los detalles guardados -->
                <div class="col-md-8">
                    <h2 class="fw-bold"><?php echo htmlspecialchars($nombrehermandad); ?></h2>

                    <!-- Mostrar mensaje de éxito o error -->
                    <?php if (!empty($mensaje)) { ?>
                        <div class="alert alert-info text-center"><?php echo $mensaje; ?></div>
                    <?php } ?>

                    <!-- Mostrar los detalles guardados -->
                    <?php if ($detalles) { ?>
                        <div class="mb-3">
                            <h5>Recorrido:</h5>
                            <p><?php echo htmlspecialchars($detalles['recorrido']); ?></p>
                        </div>

                        <div class="mb-3">
                            <h5>Número de Nazarenos:</h5>
                            <p><?php echo htmlspecialchars($detalles['nazarenos']); ?></p>
                        </div>

                        <div class="mb-3">
                            <h5>Banda:</h5>
                            <p><?php echo htmlspecialchars($detalles['banda']); ?></p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>

    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
