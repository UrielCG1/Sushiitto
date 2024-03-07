<?php

$servername = "localhost:3307";
$username = "root";
$password = "password";
$dbname = "sucursales";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Recupera la consulta de búsqueda desde la solicitud POST
$searchText = $_POST['query'];

// Realiza la búsqueda en la base de datos (reemplaza 'Restaurantes' con el nombre real de tu tabla)
$sql = "SELECT * FROM Restaurantes WHERE Nombre LIKE '%$searchText%' OR Direccion LIKE '%$searchText%' OR Horarios LIKE '%$searchText%' OR Telefono LIKE '%$searchText%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Construye una lista no ordenada con los resultados
    echo "<ul>";
    while($row = $result->fetch_assoc()) {
        echo "<li>Nombre: " . $row["Nombre"]. " - Dirección: " . $row["Direccion"]. " - Horarios: " . $row["Horarios"]. " - Teléfono: " . $row["Telefono"]. "</li>";
    }
    echo "</ul>";
} else {
    // Muestra el mensaje de error si no se encontraron resultados
    echo "No se encontraron resultados";
}

$conn->close();
?>