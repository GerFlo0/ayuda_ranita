document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("form-baja");

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(form);

        fetch("../php/baja.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(mensaje => {
            alert(mensaje);
            form.reset();
        })
        .catch(error => {
            alert("Ocurrió un error al procesar la solicitud.");
            console.error(error);
        });
    });
});
