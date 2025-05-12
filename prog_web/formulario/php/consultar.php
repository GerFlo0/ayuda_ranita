<?php
$host = "localhost";
$port = "3306";
$dbname = "prog_web";
$user = "root";
$password = "";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Error de conexión: " . $conn->connect_error]);
    exit;
}

$sql = "SELECT apellido_p, apellido_m, nombre, telefono, pais, ciudad, correo FROM usuarios";
$result = $conn->query($sql);

$usuarios = [];

if ($result && $result->num_rows > 0) {
    while ($fila = $result->fetch_assoc()) {
        $usuarios[] = $fila;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($usuarios);
?>
