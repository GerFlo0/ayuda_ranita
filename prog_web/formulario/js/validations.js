document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById('registroForm');
    const nombres = document.getElementById('nombres');
    const apellidos = document.getElementById('apellidos');
    const correo = document.getElementById('correo');
    const contrasena = document.querySelector('input[name="contrasena"]');
    const confirmarContrasena = document.querySelector('input[name="confirmar_contrasena"]');
    const errorMensaje = document.getElementById('errorMensaje');

    // Convertir automáticamente a mayúsculas
    nombres.addEventListener('input', () => {
        nombres.value = nombres.value.toUpperCase();
    });

    apellidos.addEventListener('input', () => {
        apellidos.value = apellidos.value.toUpperCase();
    });

    // Validación del correo y contraseñas
    form.addEventListener('submit', (e) => {
        errorMensaje.textContent = ""; // limpiar mensaje anterior

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(correo.value)) {
            e.preventDefault();
            errorMensaje.textContent = "Ingrese un correo válido.";
            return;
        }

        if (contrasena.value !== confirmarContrasena.value) {
            e.preventDefault();
            errorMensaje.textContent = "Las contraseñas no coinciden.";
            return;
        }

        if (contrasena.value.length < 6) {
            e.preventDefault();
            errorMensaje.textContent = "La contraseña debe tener al menos 6 caracteres.";
            return;
        }
    });
});
