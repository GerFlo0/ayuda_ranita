<?php

header("Content-Type: text/plain");

if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST['apellido_p']) && !empty($_POST['correo'])) {
    $host = "localhost";
    $port = "3306"; 
    $dbname = "prog_web";
    $user = "root";
    $password = "";

    $conn = new mysqli($host, $user, $password, $dbname);

    if ($conn->connect_error) {
        echo "Error de conexión: " . $conn->connect_error;
        exit;
    }

    $apellido_p = $_POST['apellido_p'];
    $apellido_m = $_POST['apellido_m'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $pais = $_POST['pais'];
    $ciudad = $_POST['ciudad'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    $hash = password_hash($contrasena, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO usuarios (apellido_p, apellido_m, nombre, telefono, pais, ciudad, correo, contrasena) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $apellido_p, $apellido_m, $nombre, $telefono, $pais, $ciudad, $correo, $hash);

    if ($stmt->execute()) {
        echo "Usuario registrado exitosamente.";
    } else {
        echo "Error al registrar: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Datos incompletos o método incorrecto.";
}
?>
