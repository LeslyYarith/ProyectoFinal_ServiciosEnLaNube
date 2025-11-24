function verInfoAsignacion(nombre, materia) {
    document.getElementById("info-nombre").innerText = "Nombre: " + nombre;
    document.getElementById("info-materia").innerText = "Materia: " + materia;

    document.getElementById("modalInfo").style.display = "flex";
}

function cerrarModalInfo() {
    document.getElementById("modalInfo").style.display = "none";
}

// ===============================
//  Mostrar sólo 5 registros (ESTUDIANTES)
// ===============================
document.addEventListener("DOMContentLoaded", function () {

    const filasEst = document.querySelectorAll(".table-lista.estudiantes tbody tr");
    const btnEst = document.getElementById("btnVerMasEst");

    const limite = 5;
    let mostrarTodoEst = false;

    // Ocultar los que pasan de 5
    filasEst.forEach((fila, index) => {
        if (index >= limite) fila.style.display = "none";
    });

    btnEst.addEventListener("click", () => {

        mostrarTodoEst = !mostrarTodoEst;

        filasEst.forEach((fila, index) => {
            fila.style.display = mostrarTodoEst ? "table-row" : (index < limite ? "table-row" : "none");
        });

        btnEst.textContent = mostrarTodoEst ? "Mostrar menos registros" : "Ver todos los registros";
    });


    // ===============================
    //  Mostrar sólo 5 registros (PROFESORES)
    // ===============================

    const filasProf = document.querySelectorAll(".table-lista.profesores tbody tr");
    const btnProf = document.getElementById("btnVerMasProf");

    let mostrarTodoProf = false;

    filasProf.forEach((fila, index) => {
        if (index >= limite) fila.style.display = "none";
    });

    btnProf.addEventListener("click", () => {

        mostrarTodoProf = !mostrarTodoProf;

        filasProf.forEach((fila, index) => {
            fila.style.display = mostrarTodoProf ? "table-row" : (index < limite ? "table-row" : "none");
        });

        btnProf.textContent = mostrarTodoProf ? "Mostrar menos registros" : "Ver todos los registros";
    });

});

function mostrarAlerta(mensaje) {
    const alerta = document.getElementById("alerta");
    alerta.innerText = mensaje;
    alerta.classList.add("mostrar");

    setTimeout(() => {
        alerta.classList.remove("mostrar");
    }, 4000);
}

