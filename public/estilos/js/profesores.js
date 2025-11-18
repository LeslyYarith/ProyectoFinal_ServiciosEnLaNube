// ABRIR MODAL PARA CREAR
function abrirModalCrearProfesor() {
    document.getElementById("modal-title").innerText = "Registrar profesor";
    document.getElementById("idProfesor").value = "";
    document.getElementById("formProfesor").reset();
    document.getElementById("modalFormProfesor").style.display = "flex";
}

// CERRAR MODAL
function cerrarModalProfesor() {
    document.getElementById("modalFormProfesor").style.display = "none";
}

// MOSTRAR INFO EN MODAL
function verInfoProfesor(nombre, apellido, especialidad, edad, cedula, telefono, email) {
    document.getElementById("info-nombre-prof").innerText = "Nombre: " + nombre + " " + apellido;
    document.getElementById("info-especialidad-prof").innerText = "Especialidad: " + especialidad;
    document.getElementById("info-edad-prof").innerText = "Edad: " + edad;
    document.getElementById("info-cedula-prof").innerText = "Cédula: " + cedula;
    document.getElementById("info-telefono-prof").innerText = "Teléfono: " + telefono;
    document.getElementById("info-email-prof").innerText = "Email: " + email;

    document.getElementById("modalInfoProfesor").style.display = "flex";
}

function cerrarModalInfoProfesor() {
    document.getElementById("modalInfoProfesor").style.display = "none";
}

// EDITAR PROFESOR
function editarProfesor(event, id) {
    event.stopPropagation();

    fetch(`/proyecto_final/public/estilos/procesos_profesores/getProfesor.php?id=${id}`)
        .then(res => res.json())
        .then(data => {

            document.getElementById("modal-title").innerText = "Editar profesor";

            document.getElementById("idProfesor").value = data.ID_Profesor;
            document.getElementById("nombre").value = data.Nombre;
            document.getElementById("apellidos").value = data.Apellidos;
            document.getElementById("especialidad").value = data.Especialidad;
            document.getElementById("edad").value = data.Edad;
            document.getElementById("cedula").value = data.Cedula;
            document.getElementById("telefono").value = data.Telefono;
            document.getElementById("email").value = data.Email;

            document.getElementById("modalFormProfesor").style.display = "flex";
        });

}

// ELIMINAR PROFESOR
function eliminarProfesor(event, id) {
    event.stopPropagation();

    if (confirm("¿Eliminar profesor?")) {
        window.location = `/proyecto_final/public/estilos/procesos_profesores/eliminarProfesor.php?id=${id}`;
    }
}

// ALERTA
function mostrarAlertaProfesor(mensaje) {
    const alerta = document.getElementById("alerta-prof");
    alerta.innerText = mensaje;
    alerta.classList.add("mostrar");

    setTimeout(() => {
        alerta.classList.remove("mostrar");
    }, 4000);
}

// SUBMIT AJAX (CREAR / ACTUALIZAR PROFESOR)
document.getElementById("formProfesor").addEventListener("submit", function (event) {
    event.preventDefault();

    const formData = new FormData(this);

    fetch("/proyecto_final/public/estilos/procesos_profesores/guardarProfesor.php", {
        method: "POST",
        body: formData
    })
        .then(res => res.json())
        .then(data => {

            if (data.status === "error") {
                mostrarAlertaProfesor("❗ " + data.msg);
                return;
            }

            if (data.status === "updated") {
                mostrarAlertaProfesor("✔ Profesor actualizado correctamente");
            }

            if (data.status === "created") {
                mostrarAlertaProfesor("✔ Profesor registrado correctamente");
            }

            setTimeout(() => {
                window.location.reload();
            }, 1200);
        });
});
