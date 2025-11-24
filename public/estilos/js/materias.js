// ABRIR MODAL
function abrirModalCrear() {
    document.getElementById("modal-title").innerText = "Registrar materia";
    document.getElementById("idMateria").value = "";
    document.getElementById("formMateria").reset();
    document.getElementById("modalForm").style.display = "flex";
}

// CERRAR MODAL
function cerrarModal() {
    document.getElementById("modalForm").style.display = "none";
}

// VER INFO
function verInfo(nombre, descripcion, creditos) {
    document.getElementById("info-nombre").innerText = "Nombre: " + nombre;
    document.getElementById("info-descripcion").innerText = "Descripción: " + descripcion;
    document.getElementById("info-creditos").innerText = "Créditos: " + creditos;

    document.getElementById("modalInfo").style.display = "flex";
}

function cerrarModalInfo() {
    document.getElementById("modalInfo").style.display = "none";
}

// EDITAR
function editarMateria(event, id) {
    event.stopPropagation();

    fetch(`/proyecto_final/public/estilos/procesos_materias/getMateria.php?id=${id}`)
        .then(res => res.json())
        .then(data => {
            document.getElementById("modal-title").innerText = "Editar materia";

            document.getElementById("idMateria").value = data.ID_Materia;
            document.getElementById("nombre").value = data.Nombre;
            document.getElementById("descripcion").value = data.descripcion;
            document.getElementById("creditos").value = data.Creditos;

            document.getElementById("modalForm").style.display = "flex";
        });
}

// ELIMINAR
function eliminarMateria(event, id) {
    event.stopPropagation();

    if (confirm("¿Eliminar materia?")) {
        window.location = `/proyecto_final/public/estilos/procesos_materias/eliminarMateria.php?id=${id}`;
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
document.getElementById("formMateria").addEventListener("submit", function(event) {
    event.preventDefault();

    const formData = new FormData(this);

    fetch("/proyecto_final/public/estilos/procesos_materias/guardarMateria.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {

        if (data.status === "error") {
            mostrarAlerta("❗ " + data.msg);
            return;
        }

        if (data.status === "updated") {
            mostrarAlerta("✔ Materia actualizada correctamente");
        }

        if (data.status === "created") {
            mostrarAlerta("✔ Materia registrada correctamente");
        }

        setTimeout(() => {
            window.location.reload();
        }, 1200);
    });
});

// ================================
// MOSTRAR SOLO LOS PRIMEROS 5 REGISTROS
// ================================
document.addEventListener("DOMContentLoaded", function () {

    const filas = document.querySelectorAll(".table-lista tbody tr");
    const btn = document.getElementById("btnVerMas");
    if (!btn) return; // si no existe el botón, no ejecutar

    const limite = 5;
    let mostrandoTodo = false;

    // Ocultar todo menos los primeros 5
    filas.forEach((fila, index) => {
        if (index >= limite) {
            fila.style.display = "none";
        }
    });

    btn.addEventListener("click", () => {

        mostrandoTodo = !mostrandoTodo;

        filas.forEach((fila, index) => {
            if (mostrandoTodo) {
                fila.style.display = "table-row"; // Mostrar todas
            } else {
                fila.style.display = index < limite ? "table-row" : "none";
            }
        });

        // Cambiar texto del botón
        btn.textContent = mostrandoTodo
            ? "Mostrar menos registros"
            : "Ver todos los registros";
    });

});