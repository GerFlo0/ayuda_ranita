<?php
$host = "localhost";
$port = "3306";
$dbname = "prog_web";
$user = "root";
$password = "";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    http_response_code(500);
    echo "Error de conexión: " . $conn->connect_error;
    exit;
}

if (isset($_POST['correo'])) {
    $correo = $_POST['correo'];

    $check = $conn->prepare("SELECT * FROM usuarios WHERE correo = ?");
    $check->bind_param("s", $correo);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        $stmt = $conn->prepare("DELETE FROM usuarios WHERE correo = ?");
        $stmt->bind_param("s", $correo);

        if ($stmt->execute()) {
            echo "Usuario eliminado correctamente.";
        } else {
            http_response_code(500);
            echo "Error al eliminar: " . $stmt->error;
        }

        $stmt->close();
    } else {
        http_response_code(404);
        echo "No se encontró ningún usuario con ese correo.";
    }

    $check->close();
} else {
    http_response_code(400);
    echo "Correo no proporcionado.";
}

$conn->close();
?>
