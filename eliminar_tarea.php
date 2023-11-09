<?php
// Incluir el archivo de conexión a la base de datos
include("conexion.php");

$response = array(); // Crear un array para la respuesta

// Verificar si la solicitud es de tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si el parámetro 'id_tarea' está definido en la solicitud
    if (isset($_POST["id_tarea"])) {
        $id_tarea = $_POST["id_tarea"];

        // Preparar la consulta SQL para eliminar la tarea
        $sql = "DELETE FROM tareas WHERE id = $id_tarea";

        // Ejecutar la consulta y verificar si se eliminó la tarea
        if (mysqli_query($conn, $sql)) {
            $response["success"] = true; // Indicar que la tarea se eliminó exitosamente
        } else {
            $response["success"] = false; // Indicar que hubo un error al eliminar la tarea
            $response["error"] = "Error al eliminar la tarea: " . mysqli_error($conn);
        }

        // Cerrar la conexión a la base de datos
        mysqli_close($conn);
        
        // Redireccionar a tareas.php después de eliminar la tarea
        header("Location: tareas.php");
        exit();
    }
}

// Especificar que la respuesta es JSON
header('Content-Type: application/json');
// Devolver la respuesta como JSON
echo json_encode($response);
?>



