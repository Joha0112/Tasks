<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_tarea = $_POST["id_tarea"];
    $tarea_editada = $_POST["tarea_editada"];
    
    $sql = "UPDATE tareas SET tareas='$tarea_editada' WHERE id='$id_tarea'";
    
    if (mysqli_query($conn, $sql)) {
        $response["success"] = true; // Indicar que la tarea se editó exitosamente
    } else {
        $response["success"] = false; // Indicar que hubo un error al editar la tarea
        $response["error"] = "Error al editar la tarea: " . mysqli_error($conn);
    }
    
    mysqli_close($conn);

    header("Location: tareas.php"); // Redirigir a tareas.php después de editar la tarea
    exit();
} else 
    // Aquí empieza el código HTML
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modificar Tarea</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css" rel="stylesheet">
        <link href="styles.css" rel="stylesheet">
    </head>
    <body>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <?php
                    if(isset($_GET['id'])) {
                        $id_tarea = $_GET['id'];
                        // Obtener la tarea con el ID proporcionado y mostrar el formulario de edición
                        $sql = "SELECT * FROM tareas WHERE id='$id_tarea'";
                        $resultado = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($resultado);

                        if ($row) {
                            echo "<form class='editarForm' data-id='" . $row["id"] . "' action='modificar_tarea.php' method='post'>";
                            echo "<input type='hidden' name='id_tarea' value='" . $row["id"] . "'>";
                            echo "<div class='mb-3'>";
                            echo "<label for='tarea' class='form-label'>Tarea:</label>";
                            echo "<textarea name='tarea_editada' class='form-control'>" . $row["tareas"] . "</textarea>";
                            echo "<button type='submit' class='btn btn-primary mt-3' id='accionTarea'>Modificar Tarea</button>";
                            echo "</div>";
                            echo "</form>";
                        } else {
                            echo "No se encontró la tarea con el ID proporcionado.";
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
    </html>
<?php } ?>



