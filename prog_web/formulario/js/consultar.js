document.addEventListener("DOMContentLoaded", () => {
    const contenedor = document.getElementById("tabla-usuarios");

    fetch("../php/consultar.php")
        .then(response => response.json())
        .then(data => {
            if (Array.isArray(data) && data.length > 0) {
                const tabla = document.createElement("table");
                tabla.classList.add("tabla-usuarios");

                const encabezado = tabla.insertRow();
                ["Apellido Paterno", "Apellido Materno", "Nombre", "Teléfono", "País", "Ciudad", "Correo"].forEach(texto => {
                    const th = document.createElement("th");
                    th.textContent = texto;
                    encabezado.appendChild(th);
                });

                data.forEach(usuario => {
                    const fila = tabla.insertRow();
                    Object.values(usuario).forEach(valor => {
                        const celda = fila.insertCell();
                        celda.textContent = valor;
                    });
                });

                contenedor.appendChild(tabla);
            } else {
                contenedor.innerHTML = "<p>No hay usuarios registrados.</p>";
            }
        })
        .catch(error => {
            contenedor.innerHTML = "<p>Error al consultar los usuarios.</p>";
            console.error(error);
        });
});
