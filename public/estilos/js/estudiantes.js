// Abrir modal
function abrirModalCrear() {
    document.getElementById("modal-title").innerText = "Registrar estudiante";
    document.getElementById("idEst").value = "";
    document.getElementById("formEstudiante").reset();
    document.getElementById("modalForm").style.display = "flex";
}

// Cerrar
function cerrarModal() {
    document.getElementById("modalForm").style.display = "none";
}

// Ver info
function verInfo(nombre, apellido, edad, doc, cel, email) {
    document.getElementById("info-nombre").innerText = "Nombre: " + nombre + " " + apellido;
    document.getElementById("info-edad").innerText = "Edad: " + edad;
    document.getElementById("info-doc").innerText = "Documento: " + doc;
    document.getElementById("info-cel").innerText = "Celular: " + cel;
    document.getElementById("info-email").innerText = "Email: " + email;

    document.getElementById("modalInfo").style.display = "flex";
}

function cerrarModalInfo() {
    document.getElementById("modalInfo").style.display = "none";
}

// EDITAR
function editarEstudiante(event, id) {
    event.stopPropagation();

    fetch(`/proyecto_final/public/estilos/procesos_estudiantes/getEstudiante.php?id=${id}`)
        .then(res => res.json())
        .then(data => {
            document.getElementById("modal-title").innerText = "Editar estudiante";

            document.getElementById("idEst").value = data.ID;
            document.getElementById("nombres").value = data.Nombres;
            document.getElementById("apellidos").value = data.Apellidos;
            document.getElementById("edad").value = data.edad;
            document.getElementById("documento").value = data.No_documento;
            document.getElementById("celular").value = data.Celular;
            document.getElementById("email").value = data.Email;

            document.getElementById("modalForm").style.display = "flex";
        });
}

// ELIMINAR
function eliminarEstudiante(event, id) {
    event.stopPropagation();

    if (confirm("¿Eliminar estudiante?")) {
        window.location = `/proyecto_final/public/estilos/procesos_estudiantes/eliminarEstudiante.php?id=${id}`;
    }
}

// ALERTA
function mostrarAlerta(mensaje) {
    const alerta = document.getElementById("alerta");
    alerta.innerText = mensaje;
    alerta.classList.add("mostrar");

    setTimeout(() => {
        alerta.classList.remove("mostrar");
    }, 4000);
}

// SUBMIT AJAX
document.getElementById("formEstudiante").addEventListener("submit", function(event) {
    event.preventDefault();

    const formData = new FormData(this);

    fetch("/proyecto_final/public/estilos/procesos_estudiantes/guardarEstudiante.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {

        if (data.status === "error") {
            mostrarAlerta("❗ " + data.msg);
            return; // NO cerramos modal
        }

        if (data.status === "updated") {
            mostrarAlerta("✔ Estudiante actualizado correctamente");
        }

        if (data.status === "created") {
            mostrarAlerta("✔ Estudiante registrado correctamente");
        }

        setTimeout(() => {
            window.location.reload();
        }, 1200);
    });
});
