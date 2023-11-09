<?php
// Configuración para la conexión a la base de datos
$servername = "localhost";  // Cambia a la dirección de tu servidor si es diferente
$username = "root";         // Nombre de usuario de la base de datos
$password = "";             // Contraseña de la base de datos
$dbname = "tareas";         // Nombre de la base de datos

// Crear la conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    // En caso de error en la conexión, mostrar un mensaje y terminar el script
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}

