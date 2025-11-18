<?php 
$titulo_pagina = "Profesores";
include __DIR__ . "/../layout/header.inc.php";

require_once __DIR__ . "/../app/Models/Profesor.php";

$profModel = new Profesor();
$lista = $profModel->obtenerTodos();
?>

<link rel="stylesheet" href="/proyecto_final/public/estilos/estudiantes.css">
<div id="alerta-prof" class="alerta"></div>

<div class="estudiantes-container">

    <div class="top-bar">
        <h2 style="color: #e88e64;">Profesores Registrados</h2>
        <button class="btn-crear" onclick="abrirModalCrearProfesor()">Crear</button>
    </div>

    <table class="table-lista">
        <thead>
            <tr>
                <th>Nombre completo</th>
                <th>Especialidad</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>

        <tbody>
        <?php while($row = $lista->fetch_assoc()): ?>
            <tr onclick="verInfoProfesor(
                '<?= $row['Nombre'] ?>',
                '<?= $row['Apellidos'] ?>',
                '<?= $row['Especialidad'] ?>',
                '<?= $row['Edad'] ?>',
                '<?= $row['Cedula'] ?>',
                '<?= $row['Telefono'] ?>',
                '<?= $row['Email'] ?>'
            )">
                <td><?= $row['Nombre'] ?> <?= $row['Apellidos'] ?></td>
                <td><?= $row['Especialidad'] ?></td>

                <td>
                    <button class="btn-edit" onclick="editarProfesor(event, <?= $row['ID_Profesor'] ?>)">Editar</button>
                </td>

                <td>
                    <button class="btn-delete" onclick="eliminarProfesor(event, <?= $row['ID_Profesor'] ?>)">Eliminar</button>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

</div>

<!-- MODAL FORM -->
<div class="modal-bg" id="modalFormProfesor">
    <div class="modal">
        <button class="btn-close" onclick="cerrarModalProfesor()">X</button>
        <h3 id="modal-title">Registrar profesor</h3>

        <form id="formProfesor">
            <input type="hidden" name="idProfesor" id="idProfesor">

            <input type="text" name="nombre" id="nombre" placeholder="Nombre" required>
            <input type="text" name="apellidos" id="apellidos" placeholder="Apellidos" required>
            <input type="text" name="especialidad" id="especialidad" placeholder="Especialidad" required>
            <input type="number" name="edad" id="edad" placeholder="Edad" required>
            <input type="text" name="cedula" id="cedula" placeholder="Cédula" required>
            <input type="text" name="telefono" id="telefono" placeholder="Teléfono" required>
            <input type="email" name="email" id="email" placeholder="Correo" required>

            <button class="btn-guardar" type="submit">Guardar</button>
        </form>
    </div>
</div>

<!-- MODAL INFO -->
<div class="modal-bg" id="modalInfoProfesor">
    <div class="modal">
        <button class="btn-close" onclick="cerrarModalInfoProfesor()">X</button>
        <h3>Información del profesor</h3>

        <div class="info-list">
            <p id="info-nombre-prof"></p>
            <p id="info-especialidad-prof"></p>
            <p id="info-edad-prof"></p>
            <p id="info-cedula-prof"></p>
            <p id="info-telefono-prof"></p>
            <p id="info-email-prof"></p>
        </div>
    </div>
</div>

<!-- JS -->
<script src="/proyecto_final/public/estilos/js/profesores.js"></script>

<?php if (isset($_GET["updated"])): ?>
    <script>
        mostrarAlertaProfesor("✔ Profesor actualizado correctamente");
        history.replaceState({}, document.title, window.location.pathname);
    </script>
<?php endif; ?>

<?php if (isset($_GET["created"])): ?>
    <script>
        mostrarAlertaProfesor("✔ Profesor registrado correctamente");
        history.replaceState({}, document.title, window.location.pathname);
    </script>
<?php endif; ?>

<?php if (isset($_GET["errorCedula"])): ?>
    <script>
        mostrarAlertaProfesor("❗ La cédula ya existe en el sistema");
        history.replaceState({}, document.title, window.location.pathname);
    </script>
<?php endif; ?>

<?php include __DIR__ . "/../layout/footer.inc.php"; ?>
