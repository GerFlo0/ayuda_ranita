<?php
$host = "localhost";
$port = "3306";
$dbname = "prog_web";
$user = "root";
$password = "";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $apellido_p = $_POST['apellido_p'];
    $apellido_m = $_POST['apellido_m'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $pais = $_POST['pais'];
    $ciudad = $_POST['ciudad'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    if (!empty($contrasena)) {
        $hash = password_hash($contrasena, PASSWORD_DEFAULT);
    } else {
        $hash = null;
    }

    if ($hash) {
        $stmt = $conn->prepare("UPDATE usuarios SET apellido_p = ?, apellido_m = ?, nombre = ?, telefono = ?, pais = ?, ciudad = ?, contrasena = ? WHERE correo = ?");
        $stmt->bind_param("ssssssss", $apellido_p, $apellido_m, $nombre, $telefono, $pais, $ciudad, $hash, $correo);
    } else {
        $stmt = $conn->prepare("UPDATE usuarios SET apellido_p = ?, apellido_m = ?, nombre = ?, telefono = ?, pais = ?, ciudad = ? WHERE correo = ?");
        $stmt->bind_param("sssssss", $apellido_p, $apellido_m, $nombre, $telefono, $pais, $ciudad, $correo);
    }

    if ($stmt->execute()) {
        echo "Datos actualizados correctamente";
    } else {
        echo "Error al actualizar los datos";
    }

    $stmt->close();
    $conn->close();
} elseif (isset($_GET['correo'])) {
    $correo = $_GET['correo'];

    $stmt = $conn->prepare("SELECT apellido_p, apellido_m, nombre, telefono, pais, ciudad, correo FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        echo json_encode($usuario);
    } else {
        echo "<script>alert('Usuario no encontrado');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
