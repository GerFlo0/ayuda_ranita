<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Cuenta</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="form-container">
        <h2>Crear Cuenta</h2>
        <form action="registro.php" method="POST">
            <label for="nombres">Nombre(s):</label>
            <input type="text" name="nombres" required>

            <label for="apellidos">Apellidos:</label>
            <input type="text" name="apellidos" required>

            <label for="correo">Correo:</label>
            <input type="email" name="correo" required>

            <label for="contrasena">Contraseña:</label>
            <input type="password" name="contrasena" required>

            <label for="confirmar_contrasena">Confirmar Contraseña:</label>
            <input type="password" name="confirmar_contrasena" required>

            <div class="checkbox-container">
                <input type="checkbox" name="terminos" value="1" required>
                <label for="terminos">Acepto los términos y condiciones</label>
            </div>

            <button type="submit">Registrarse</button>
        </form>
    </div>
    <script src="js/validations.js"></script>
</body>
</html>
