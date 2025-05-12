document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("registro-form");

    const nombre = form.nombre;
    const apellidoP = form.apellido_p;
    const apellidoM = form.apellido_m;
    const telefono = form.telefono;
    const pais = form.pais;
    const ciudad = form.ciudad;
    const correo = form.correo;
    const contrasena = form.contrasena;
    const confirmarContrasena = form.confirmar_contrasena;
    const terminos = form.terminos;

    const errorDiv = document.getElementById("error-mensaje");

    function mostrarError(mensaje) {
        errorDiv.textContent = mensaje;
        errorDiv.style.display = "block";
        setTimeout(() => {
            errorDiv.style.display = "none";
        }, 4000);
    }

    [nombre, apellidoP, apellidoM].forEach(field => {
        field.addEventListener("input", () => {
            field.value = field.value.toUpperCase();
        });
    });

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        if (
            !nombre.value.trim() || !apellidoP.value.trim() || !apellidoM.value.trim() ||
            !telefono.value.trim() || !pais.value.trim() || !ciudad.value.trim() || !correo.value.trim() ||
            !contrasena.value.trim() || !confirmarContrasena.value.trim()
        ) {
            mostrarError("Por favor completa todos los campos.");
            return;
        }

        const correoRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!correoRegex.test(correo.value)) {
            mostrarError("Ingresa un correo electrónico válido.");
            return;
        }

        if (contrasena.value !== confirmarContrasena.value) {
            mostrarError("Las contraseñas no coinciden.");
            return;
        }

        if (contrasena.value.length < 6) {
            mostrarError("La contraseña debe tener al menos 6 caracteres.");
            return;
        }

        if (!terminos.checked) {
            mostrarError("Debes aceptar los términos y condiciones.");
            return;
        }

        const formData = new FormData(form);

        fetch("../php/registro.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data); // Muestra mensaje de éxito o error
            if (data.includes("exitosamente")) {
                form.reset(); // Limpia el formulario solo si fue exitoso
            }
        })
        .catch(error => {
            mostrarError("Error en el envío. Intenta más tarde.");
            console.error(error);
        });
    });
});
