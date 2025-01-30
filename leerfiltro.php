<?php
// Incluir el archivo de conexión (si es necesario)
include('conexion.php');

// Verificar si se ha enviado el formulario por POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['nombre']) && !empty($_POST['nombre'])) // Paso la variable nombre y además especificio que no está vacío
    {
        $nombre = $_POST['nombre'];

        // Consultar los datos de la base de datos filtrados por nombre
        $query = "SELECT id, nombre, edad, curso, promociona FROM alumnos WHERE nombre LIKE '%$nombre%'"; // Selecciona todo o los campos  // Si con el select empiezo con comillas dobles la variable le pongo comillas simple y al revés. 
                                                                                                          // Si no imprime la variable.
                                                                                                          // que me interesen de la tabla alumno, pero puede que me interese filtrar por ese nombre. 
                                                                     // Preguntar mañana lo de las mayúsculas.                                     // Cuando pones Ana te sale Ana.
        $resultado = mysqli_query($conexion, $query); // Angela recomienda activar buscar por mayúsculas y minúsculas para tener más nota.
                                                                    // Se establece la consulta, ya que la variable query contiene la consulta y se almacena en $resultado.+

        // Verificar si la consulta fue exitosa
        if (!$resultado) {
            die("Error en la consulta: " . mysqli_error($conexion));
        }
        //Puedo poner lo que yo quiera, si la consulta no funciona, de momento dejamos mysqli.error

        // Mostrar los resultados en formato de tabla
        echo "<div class='container mt-4'>
                <h2>Resultados para: " . htmlspecialchars($nombre) . "</h2>
                <table class='table table-bordered table-striped'>
                    <thead class='thead-dark'>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Edad</th>
                            <th>Curso</th>
                            <th>Promociona</th>
                        </tr>
                    </thead>
                    <tbody>";

        // Recorrer cada fila de resultados y mostrarla
        while ($row = mysqli_fetch_assoc($resultado)) { // Con el mysqli_fetch_assoc coge las filas una por una y la va metiendo en la tabla o lo que haya. Si lo copiamos y pegamos el código de abajo no lo hace porque solo lo hace una vez, para hacerlo 2 veces tenemos que lanzar la variable $resultado y hacer otra vez la línea:  $resultado = mysqli_query($conexion, $query);
            echo "<tr>                                          
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['nombre'] . "</td>
                    <td>" . $row['edad'] . "</td>
                    <td>" . $row['curso'] . "</td>
                    <td>" . $row['promociona'] . "</td>
                </tr>";
        }

        echo "</tbody></table></div>";
    } else {
        echo "<div class='container mt-4'>
                <h2>No se proporcionó un nombre para la búsqueda</h2>
              </div>";
    }
} else {
    echo "<div class='container mt-4'>
            <h2>Acceso no permitido. El formulario debe enviarse mediante POST.</h2>
          </div>";
}

?>