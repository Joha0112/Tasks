<?php
// Incluir el archivo de conexión a la base de datos
include("conexion.php");

// Verificar si la solicitud es de tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el contenido de la tarea desde el formulario
    $tarea = $_POST["tarea"];
    
    // Preparar la consulta SQL para insertar una nueva tarea
    $sql = "INSERT INTO tareas (tareas) VALUES ('$tarea')";
    
    // Ejecutar la consulta y verificar si se ha creado la tarea
    if (mysqli_query($conn, $sql)) {
        echo "Tarea creada exitosamente";
    } else {
        echo "Error al crear la tarea: " . mysqli_error($conn);
    }
    
    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
    
    // Redireccionar a tareas.php después de crear la tarea
    header("Location: tareas.php");
    exit();
} 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nueva Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/3cd461e88a.js" crossorigin="anonymous"></script>
    <link href="styles.css" rel="stylesheet">
</head>
<body>
    <!-- Contenido del cuerpo del documento... -->
    <div class="container mt-5">
    <!-- Crea un contenedor con un margen superior -->
    <div class="row justify-content-center">
        <!-- Crea una fila con contenido centrado -->
        <div class="col-md-6">
            <!-- Crea una columna de tamaño medio en dispositivos medianos y grandes -->
            <form id="nuevaTareaForm" method="post" action="crear_tarea.php">
                <!-- Crea un formulario con el método POST y la acción "crear_tarea.php" -->
                <div class="mb-3">
                    <!-- Crea un grupo de entrada con un margen en la parte inferior -->
                    <label for="nuevaTarea" class="form-label">Nueva Tarea:</label>
                    <!-- Agrega una etiqueta de formulario con el texto "Nueva Tarea:" -->
                    <textarea class="form-control" name="tarea" id="nuevaTarea" rows="3" placeholder="Escribe una nueva tarea"></textarea>
                    <!-- Crea un campo de texto multi-línea para la nueva tarea con un espacio de tres líneas y un marcador de posición -->
                </div>
                <button type="submit" class="btn btn-primary" id="crearTarea">Crear Tarea</button>
                <!-- Agrega un botón de envío del formulario con el texto "Crear Tarea" y un estilo de Bootstrap -->
            </form>
        </div>
    </div>
</div>
<!-- Incluir scripts necesarios -->
<script src="script.js"></script>
</body>
</html>