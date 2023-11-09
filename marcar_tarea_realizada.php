<?php
// Incluir el archivo de conexión a la base de datos
include("conexion.php");

$response = array(); // Crear un array para la respuesta

// Verificar si la solicitud es de tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si el parámetro 'id' está definido en la solicitud
    if (isset($_GET["id"])) {
        $id_tarea = $_GET["id"];

        // Preparar la consulta SQL para marcar la tarea como realizada
        $sql = "UPDATE tareas SET realizada = 1 WHERE id='$id_tarea'";

        // Ejecutar la consulta y verificar si se actualizó la tarea
        if (mysqli_query($conn, $sql)) {
            $response["success"] = true; // Indicar que la tarea se marcó como realizada exitosamente
        } else {
            $response["success"] = false; // Indicar que hubo un error al marcar la tarea como realizada
            $response["error"] = "Error al marcar la tarea como realizada: " . mysqli_error($conn);
        }

        // Cerrar la conexión a la base de datos
        mysqli_close($conn);
    } else {
        $response["success"] = false; // Indicar que no se proporcionó el parámetro 'id'
        $response["error"] = "El parámetro 'id' no está definido en la solicitud";
    }
} else {
    $response["success"] = false; // Indicar que la solicitud no es de tipo POST
    $response["error"] = "La solicitud no es de tipo POST";
}

// Especificar que la respuesta es JSON
header('Content-Type: application/json');
// Devolver la respuesta como JSON
echo json_encode($response);
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marcar Tarea como Completada</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<!-- Contenido del cuerpo del documento... -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
        <form method="post" action="marcar_tarea_realizada.php" class="marcarTareaForm">

    <!-- El 'id' de la tarea se enviará como un campo oculto -->
    <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">

    <div class="mb-3">
        <label for="tarea" class="form-label">Tarea a completar:</label>
        <textarea class="form-control" id="tarea" name="tarea" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-success">Tarea Completada</button>
</form>
            <?php
            // ...
            ?>
        </div>
    </div>
</div>

</body>
</html>
