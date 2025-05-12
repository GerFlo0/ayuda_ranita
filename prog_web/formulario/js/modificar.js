document.addEventListener("DOMContentLoaded", function () {
    const formBuscar = document.getElementById("form-buscar");
    const formModificar = document.getElementById("form-modificar");

    // Evento para buscar usuario por correo
    formBuscar.addEventListener("submit", function (e) {
        e.preventDefault();

        const correo = document.getElementById("correo").value;

        fetch(`../php/modificar.php?correo=${encodeURIComponent(correo)}`)
            .then(response => response.json())
            .then(data => {
                if (data) {
                    document.getElementById("apellido_p").value = data.apellido_p;
                    document.getElementById("apellido_m").value = data.apellido_m;
                    document.getElementById("nombre").value = data.nombre;
                    document.getElementById("telefono").value = data.telefono;
                    document.getElementById("pais").value = data.pais;
                    document.getElementById("ciudad").value = data.ciudad;
                    document.getElementById("correo-modificar").value = data.correo;

                    formBuscar.style.display = "none";
                    formModificar.style.display = "block";
                } else {
                    alert("Usuario no encontrado.");
                }
            })
            .catch(error => {
                alert("Hubo un error al cargar los datos.");
                console.error(error);
            });
    });

    // Evento para confirmar modificaciones
    formModificar.addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(formModificar);

        fetch("../php/modificar.php", {
            method: "POST",
            body: formData
        })
            .then(res => res.text())
            .then(data => {
                alert(data);

                // Reiniciar y regresar al formulario de búsqueda
                formModificar.reset();
                formBuscar.reset();
                formModificar.style.display = "none";
                formBuscar.style.display = "block";
            })
            .catch(err => {
                console.error(err);
                alert("Ocurrió un error al confirmar los cambios.");
            });
    });
});
