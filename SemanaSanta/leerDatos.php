<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

include('conexion.php');

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Verificar si se envió el formulario para eliminar detalles
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminar_detalles_id'])) {
    $id_eliminar = intval($_POST['eliminar_detalles_id']);
    $queryEliminar = "DELETE FROM detalles_hermandades WHERE hermandad_id = $id_eliminar";

    if (mysqli_query($conexion, $queryEliminar)) {
        $mensaje = "Detalles eliminados correctamente.";
    } else {
        $mensaje = "Error al eliminar los detalles: " . mysqli_error($conexion);
    }
}

// Obtener hermandades
$query = "SELECT id, nombre, dia FROM hermandades";
$resultado = mysqli_query($conexion, $query);

if (!$resultado) {
    die("Error en la consulta SQL: " . mysqli_error($conexion));
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hermandades</title>
    <!-- Enlace al archivo de estilos CSS -->
    <link rel="stylesheet" href="leerDatos.css"> 
</head>
<body>

<div class="container">
    <h2>Listado de Hermandades</h2>

    <a href="guardarDetalles.php" class="btn btn-guardar">Ir a Guardar Detalles</a>
    <a href="logout.php" class="btn btn-logout">Cerrar Sesión</a>

    <?php if (isset($mensaje)) { ?>
        <div class="alert alert-info text-center"><?php echo $mensaje; ?></div>
    <?php } ?>

    <table border="0">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Día de Salida</th>
            <th>Acciones</th>
        </tr>

        <?php
        while ($row = mysqli_fetch_assoc($resultado)) {
            $hermandad_id = $row['id'];
            $queryDetalles = "SELECT * FROM detalles_hermandades WHERE hermandad_id = $hermandad_id";
            $resultDetalles = mysqli_query($conexion, $queryDetalles);
            
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td><a href='redirigir.php?id={$row['id']}'>{$row['nombre']}</a></td>
                    <td>{$row['dia']}</td>
                    <td>
                        <!-- Botón de Editar -->
                        <a href='editarHdad.php?id={$row['id']}' class='btn btn-editar'>Editar</a>
                        
                        <!-- Botón de Eliminar -->
                        <form method='POST' action='' style='display:inline-block;'>
                            <input type='hidden' name='eliminar_detalles_id' value='{$row['id']}'>
                            <button type='submit' class='btn btn-danger' onclick='return confirm(\"¿Estás seguro de que deseas eliminar los detalles de esta hermandad?\")'>Eliminar Detalles</button>
                        </form>
                    </td>
                  </tr>";
        }
        ?>
    </table>
</div>

<?php mysqli_close($conexion); ?>

</body>
</html>
