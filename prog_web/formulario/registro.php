<?php
// Configuración de conexión a MySQL
$host = "localhost";
$port = "3306";  // Puerto por defecto de MySQL
$dbname = "mysql";
$user = "root";   // Usuario por defecto de MySQL en XAMPP
$password = "";   // Contraseña por defecto en XAMPP (en blanco)

// Verificar que todos los campos estén presentes
if (
    !isset($_POST['nombres'], $_POST['apellidos'], $_POST['correo'], $_POST['contrasena'],
    $_POST['confirmar_contrasena'], $_POST['terminos'])
) {
    die("Faltan campos obligatorios.");
}

// Sanitizar entradas
$nombres = strtoupper(trim(htmlspecialchars($_POST['nombres'])));
$apellidos = strtoupper(trim(htmlspecialchars($_POST['apellidos'])));
$correo = trim($_POST['correo']);
$contrasena = $_POST['contrasena'];
$confirmar_contrasena = $_POST['confirmar_contrasena'];

// Validar correo
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    die("Correo no válido.");
}

// Validar que las contraseñas coincidan
if ($contrasena !== $confirmar_contrasena) {
    die("Las contraseñas no coinciden.");
}

// Validar longitud mínima de la contraseña
if (strlen($contrasena) < 6) {
    die("La contraseña debe tener al menos 6 caracteres.");
}

// Hashear la contraseña
$hash = password_hash($contrasena, PASSWORD_DEFAULT);

// Conexión a MySQL
$conn = new mysqli($host, $user, $password, $dbname, $port);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Preparar la consulta para insertar datos de forma segura
$stmt = $conn->prepare("INSERT INTO usuarios (nombres, apellidos, correo, contrasena) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nombres, $apellidos, $correo, $hash);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo "Cuenta creada exitosamente.";
} else {
    echo "Error al registrar el usuario: " . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
