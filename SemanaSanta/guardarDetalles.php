<?php
session_start();
include('conexion.php');

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$usuario = $_SESSION['usuario'];
$mensaje = "";
$hermandad_id = null;
$detalles = null;

// Si "consejo" elimina un comentario
if ($usuario === 'consejo' && isset($_POST['eliminar_comentario'])) {
    $comentario_id = intval($_POST['comentario_id']);
    $queryEliminar = "DELETE FROM comentarios WHERE id = $comentario_id AND usuario = 'consejo'";
    if (mysqli_query($conexion, $queryEliminar)) {
        $mensaje = "Comentario eliminado correctamente.";
    } else {
        $mensaje = "Hubo un error al eliminar el comentario.";
    }
}

// Si "consejo" envía un comentario
if ($usuario === 'consejo' && $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['comentario'])) {
    if (!empty($_POST['comentario']) && !empty($_POST['hermandad_id'])) {
        $hermandad_id = intval($_POST['hermandad_id']);
        $comentario = mysqli_real_escape_string($conexion, $_POST['comentario']);
        
        $queryComentario = "INSERT INTO comentarios (hermandad_id, usuario, comentario) VALUES ($hermandad_id, 'consejo', '$comentario')";
        mysqli_query($conexion, $queryComentario);
    }
}

// Si se selecciona una hermandad
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['hermandad_id'])) {
    $hermandad_id = intval($_POST['hermandad_id']);
    $query = "SELECT nombre FROM hermandades WHERE id = $hermandad_id";
    $resultado = mysqli_query($conexion, $query);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $row = mysqli_fetch_assoc($resultado);
        $nombrehermandad = $row['nombre'];
        
        // Imagen de la hermandad
        $rutaimagen = "imagenes/$hermandad_id.jpg";
        if (!file_exists($rutaimagen)) {
            $rutaimagen = "imagenes/default.jpg";
        }

        // Obtener detalles
        $queryDetalles = "SELECT recorrido, nazarenos, banda FROM detalles_hermandades WHERE hermandad_id = $hermandad_id";
        $resultadoDetalles = mysqli_query($conexion, $queryDetalles);
        if ($resultadoDetalles && mysqli_num_rows($resultadoDetalles) > 0) {
            $detalles = mysqli_fetch_assoc($resultadoDetalles);
        }
    }
}

// Obtener comentarios
$comentarios = [];
if ($hermandad_id) {
    $queryComentarios = "SELECT id, comentario, usuario FROM comentarios WHERE hermandad_id = $hermandad_id";
    $resultadoComentarios = mysqli_query($conexion, $queryComentarios);
    while ($comentario = mysqli_fetch_assoc($resultadoComentarios)) {
        $comentarios[] = $comentario;
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="guardarDetalles.css">
</head>
<body>

<div class="container mt-5">
    <div class="shadow bg-white rounded p-4">
        <?php if (!$hermandad_id) { ?>
            <h2 class="text-center">Selecciona una Hermandad</h2>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Hermandad:</label>
                    <select name="hermandad_id" class="form-control" required>
                        <option value="">Selecciona una hermandad</option>
                        <?php
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
            <div class="row align-items-center">
                <div class="col-md-4 text-center">
                    <img src="<?php echo $rutaimagen; ?>" alt="Imagen de la hermandad" class="img-fluid rounded" style="max-width: 150px;">
                </div>
                <div class="col-md-8">
                    <h2 class="fw-bold text-break"><?php echo htmlspecialchars($nombrehermandad); ?></h2>
                    <?php if (!empty($mensaje)) { ?>
                        <div class="alert alert-info text-center"><?php echo $mensaje; ?></div>
                    <?php } ?>

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

            <hr>

            <?php if ($usuario === 'consejo') { ?>
                <h4>Agregar Comentario</h4>
                <form method="POST">
                    <input type="hidden" name="hermandad_id" value="<?php echo $hermandad_id; ?>">
                    <div class="mb-3">
                        <textarea name="comentario" class="form-control" placeholder="Escribe tu comentario..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Enviar Comentario</button>
                </form>
            <?php } ?>

            <?php if (!empty($comentarios)) { ?>
                <hr>
                <h4>Comentarios</h4>
                <ul class="list-group">
                    <?php foreach ($comentarios as $comentario) { ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo htmlspecialchars($comentario['comentario']); ?>
                            <?php if ($usuario === 'admin') { ?>
                                <small class="text-muted">(<?php echo htmlspecialchars($comentario['usuario']); ?>)</small>
                            <?php } ?>
                            <?php if ($usuario === 'consejo' && $comentario['usuario'] === 'consejo') { ?>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="comentario_id" value="<?php echo $comentario['id']; ?>">
                                    <button type="submit" name="eliminar_comentario" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            <?php } ?>
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>
        <?php } ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
