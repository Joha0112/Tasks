<?php 
// Incluir el archivo de conexión a la base de datos
include("conexion.php");

// Consultar todas las tareas
$tareas = "SELECT * FROM tareas";
$resultado = mysqli_query($conn, $tareas);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista De Tareas</title>
    <!-- Incluir estilos de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Incluir estilos de Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css" rel="stylesheet">
    <!-- Incluir script de Font Awesome -->
    <script src="https://kit.fontawesome.com/3cd461e88a.js" crossorigin="anonymous"></script>
    <!-- Incluir tu archivo de estilos personalizados -->
    <link href="styles.css" rel="stylesheet">
</head>
<body>
    <div class="text-center">
        <h1 style="color: blue;">Lista De Tareas</h1>
        <button type="button" class="btn btn-primary mb-2">Crear contenido del blog</button>
        <a href="crear_tarea.php" class="btn btn-success mb-2" id="agregarTarea">Agregar</a>
    </div>

    <div id="nuevaTareaForm" style="display: none;">
        <textarea id="nuevaTarea" class="form-control" placeholder="Escribe una nueva tarea"></textarea>
        <button type="button" class="btn btn-primary mt-2" id="crearTarea">Crear Tarea</button>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped tarea-table my-styled-table">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Tarea</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($row = mysqli_fetch_assoc($resultado)) {
                        echo "<tr>";
                        echo "<th scope='row'>" . $row["id"]. "</th>";
                        echo "<td class='tarea-column " . (isset($row["realizada"]) && $row["realizada"] ? "tachado" : "") . "'><i class='fas fa-plus'></i> " . $row["tareas"]. "</td>";
                        echo "<td>";
                        echo "<div class='btn-group' role='group'>";
                        echo "<form action='eliminar_tarea.php' method='post'>";
                        echo "<input type='hidden' name='id_tarea' value='" . $row["id"] . "'>";
                        echo "<a href='#' class='btn btn-danger btn-spacing eliminarTarea' data-id='" . $row["id"] . "'><i class='fas fa-times'></i></a>";
                        echo "</form>";
                        echo "<a href='modificar_tarea.php?id=" . $row["id"] . "' class='btn btn-warning btn-spacing editarTarea'><i class='fas fa-pencil-alt'></i></a>";
                        echo "<a href='marcar_tarea_realizada.php?id=" . $row["id"] . "' class='btn btn-info btn-spacing marcarRealizada' data-id='" . $row["id"] . "'><i class='fas fa-check'></i></a>";
                        echo "</div>";
                        echo "</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Incluir tus scripts -->
    <script src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>

