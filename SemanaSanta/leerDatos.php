<?php
// Incluir el archivo de conexión
include('conexion.php'); 

// Verificar si la conexión está establecida
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Consulta para obtener los datos de las hermandades
$query = "SELECT id, nombre, dia FROM hermandades";
$resultado = mysqli_query($conexion, $query);

// Verificar si la consulta fue exitosa
if (!$resultado) {
    die("Error en la consulta SQL: " . mysqli_error($conexion));
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Hermandades</title>
    <link rel="stylesheet" href="estilo.css"> <!-- Enlace al archivo CSS -->
</head>
<body>

<h2>Listado de Hermandades</h2>
<table border="1">xa
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Día de Salida</th>
    </tr>

    <?php
    // Recorrer los resultados
    while ($row = mysqli_fetch_assoc($resultado)) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['nombre']}</td>
                <td>{$row['dia']}</td>
              </tr>";
    }
    ?>
</table>

<?php
// Cerrar la conexión
mysqli_close($conexion);
?>

</body>
</html>
