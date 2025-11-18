<?php 
$titulo_pagina = "Materias";
include __DIR__ . "/../layout/header.inc.php";

require_once __DIR__ . "/../app/Models/Materia.php";

$materiaModel = new Materia();
$lista = $materiaModel->obtenerTodas();
?>

<link rel="stylesheet" href="/proyecto_final/public/estilos/modulos1_2_3.css">
<div id="alerta" class="alerta"></div>

<div class="estudiantes-container">

    <div class="top-bar">
        <h2 style="color: #e88e64;">Materias Registradas</h2>
        <button class="btn-crear" onclick="abrirModalCrear()">Crear</button>
    </div>

    <table class="table-lista">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>

        <tbody>
        <?php while($row = $lista->fetch_assoc()): ?>
            <tr onclick="verInfo(
                '<?= $row['Nombre'] ?>',
                '<?= $row['descripcion'] ?>',
                '<?= $row['Creditos'] ?>'
            )">
                <td><?= $row['Nombre'] ?></td>

                <td>
                    <button class="btn-edit" onclick="editarMateria(event, <?= $row['ID_Materia'] ?>)">Editar</button>
                </td>

                <td>
                    <button class="btn-delete" onclick="eliminarMateria(event, <?= $row['ID_Materia'] ?>)">Eliminar</button>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

</div>


<!-- MODAL FORM -->
<div class="modal-bg" id="modalForm">
    <div class="modal">
        <button class="btn-close" onclick="cerrarModal()">X</button>
        <h3 id="modal-title">Registrar materia</h3>

        <form id="formMateria" method="POST" action="/proyecto_final/public/estilos/procesos_materias/guardarMateria.php">
            <input type="hidden" name="id" id="idMateria">

            <input type="text" name="nombre" id="nombre" placeholder="Nombre" required>
            <textarea name="descripcion" id="descripcion" placeholder="Descripción" required></textarea>
            <input type="number" name="creditos" id="creditos" placeholder="Créditos" required>

            <button class="btn-guardar" type="submit">Guardar</button>
        </form>
    </div>
</div>


<!-- MODAL INFO -->
<div class="modal-bg" id="modalInfo">
    <div class="modal">
        <button class="btn-close" onclick="cerrarModalInfo()">X</button>
        <h3>Información de la materia</h3>

        <div class="info-list">
            <p id="info-nombre"></p>
            <p id="info-descripcion"></p>
            <p id="info-creditos"></p>
        </div>
    </div>
</div>

<!-- JS -->
<script src="/proyecto_final/public/estilos/js/materias.js"></script>

<?php if (isset($_GET["updated"])): ?>
    <script>
        mostrarAlerta("✔ Materia actualizada correctamente");
        history.replaceState({}, document.title, window.location.pathname);
    </script>
<?php endif; ?>

<?php if (isset($_GET["created"])): ?>
    <script>
        mostrarAlerta("✔ Materia registrada correctamente");
        history.replaceState({}, document.title, window.location.pathname);
    </script>
<?php endif; ?>

<?php if (isset($_GET["errorNombre"])): ?>
    <script>
        mostrarAlerta("❗ El nombre de la materia ya existe");
        history.replaceState({}, document.title, window.location.pathname);
    </script>
<?php endif; ?>

<?php include __DIR__ . "/../layout/footer.inc.php"; ?>
