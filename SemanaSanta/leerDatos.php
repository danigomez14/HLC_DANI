<?php
// Incluir la conexión a la base de datos
include('conexion.php'); 

// Verificar la conexión
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Obtener hermandades
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
    <title>Hermandades</title>
    <link rel="stylesheet" href="estilo.css"> 
    <style>
        .btn-guardar {
            position: absolute;
            top: 20px;
            left: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-guardar:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<!-- Botón para redirigir a guardarDetalles.php -->
<a href="guardarDetalles.php" class="btn-guardar">Ir a Guardar Detalles</a>

<h2>Listado de Hermandades</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Día de Salida</th>
    </tr>

    <?php
    while ($row = mysqli_fetch_assoc($resultado)) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td><a href='redirigir.php?id={$row['id']}' style='text-decoration: none; color: blue;'>{$row['nombre']}</a></td>
                <td>{$row['dia']}</td>
              </tr>";
    }
    ?>
</table>

<?php mysqli_close($conexion); ?>

</body>
</html>
