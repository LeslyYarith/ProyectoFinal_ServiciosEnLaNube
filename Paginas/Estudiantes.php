<?php 
$titulo_pagina = "Estudiantes";
include __DIR__ . "/../layout/header.inc.php";

require_once __DIR__ . "/../app/Models/Estudiante.php";

$estudianteModel = new Estudiante();
$lista = $estudianteModel->obtenerTodos();
?>

<link rel="stylesheet" href="/proyecto_final/public/estilos/modulos1_2_3.css">
<div id="alerta" class="alerta"></div>

<div class="estudiantes-container">

    <div class="top-bar">
        <h2 style="color: #e88e64;">Estudiantes Registrados</h2>
        <button class="btn-crear" onclick="abrirModalCrear()">Registrar</button>
    </div>

    <table class="table-lista">
        <thead>
            <tr>
                <th>Nombre completo</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>

        <tbody>
        <?php while($row = $lista->fetch_assoc()): ?>
            <tr onclick="verInfo(
                '<?= $row['Nombres'] ?>',
                '<?= $row['Apellidos'] ?>',
                '<?= $row['edad'] ?>',
                '<?= $row['No_documento'] ?>',
                '<?= $row['Celular'] ?>',
                '<?= $row['Email'] ?>'
            )">
                <td><?= $row['Nombres'] ?> <?= $row['Apellidos'] ?></td>

                <td>
                    <button class="btn-edit" onclick="editarEstudiante(event, <?= $row['ID'] ?>)">Editar✏️</button>
                </td>

                <td>
                    <button class="btn-delete" onclick="eliminarEstudiante(event, <?= $row['ID'] ?>)">Eliminar🗑️</button>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    <button id="btnVerMas" class="btn-vermas">Ver todos los registros</button>
</div>


<!-- MODAL FORM -->
<div class="modal-bg" id="modalForm">
    <div class="modal">
        <button class="btn-close" onclick="cerrarModal()">X</button>
        <h3 id="modal-title">Registrar estudiante</h3>

        <form id="formEstudiante" method="POST" action="/proyecto_final/public/estilos/procesos_estudiantes/guardarEstudiante.php">
            <input type="hidden" name="id" id="idEst">

            <input type="text" name="nombres" id="nombres" placeholder="Nombres" required>
            <input type="text" name="apellidos" id="apellidos" placeholder="Apellidos" required>
            <input type="number" name="edad" id="edad" placeholder="Edad" required>
            <input type="text" name="documento" id="documento" placeholder="Documento" required>
            <input type="text" name="celular" id="celular" placeholder="Celular" required>
            <input type="email" name="email" id="email" placeholder="Correo" required>

            <button class="btn-guardar" type="submit">Guardar</button>
        </form>
    </div>
</div>


<!-- MODAL INFO -->
<div class="modal-bg" id="modalInfo">
    <div class="modal">
        <button class="btn-close" onclick="cerrarModalInfo()">X</button>
        <h3>Información del estudiante</h3>

        <div class="info-list">
            <p id="info-nombre"></p>
            <p id="info-edad"></p>
            <p id="info-doc"></p>
            <p id="info-cel"></p>
            <p id="info-email"></p>
        </div>
    </div>
</div>

<!-- AQUÍ EL JS EXTERNO -->
<script src="/proyecto_final/public/estilos/js/estudiantes.js"></script>

<?php if (isset($_GET["updated"])): ?>
    <script>
        mostrarAlerta("✔ Estudiante actualizado correctamente");
        history.replaceState({}, document.title, window.location.pathname);
    </script>
<?php endif; ?>

<?php if (isset($_GET["created"])): ?>
    <script>
        mostrarAlerta("✔ Estudiante registrado correctamente");
        history.replaceState({}, document.title, window.location.pathname);
    </script>
<?php endif; ?>

<?php if (isset($_GET["errorCedula"])): ?>
    <script>
        mostrarAlerta("❗ La cédula ya existe en el sistema");
        history.replaceState({}, document.title, window.location.pathname);
    </script>
<?php endif; ?>

<?php include __DIR__ . "/../layout/footer.inc.php"; ?>
