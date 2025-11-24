<?php
include __DIR__ . "/../layout/header.inc.php";

require_once __DIR__ . '/../app/Models/Estudiante.php';
require_once __DIR__ . '/../app/Models/Materia.php';
require_once __DIR__ . '/../app/Models/Profesor.php';
require_once __DIR__ . '/../app/Models/controllers/AsignacionController.php';

$estudianteModel = new Estudiante();
$materiaModel = new Materia();
$profesorModel = new Profesor();

$estudiantes = $estudianteModel->obtenerTodos();
$materias = $materiaModel->obtenerTodas();
$profesores = $profesorModel->obtenerTodos();

$asigController = new AsignacionController();

/* ==========================================
   CAPTURA DE FORMULARIOS (CORRECCIÓN CLAVE)
========================================== */
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST["tipo"]) && $_POST["tipo"] === "estudiante") {
        $asigController->asignarEstudiante();
    }

    if (isset($_POST["tipo"]) && $_POST["tipo"] === "profesor") {
        $asigController->asignarProfesor();
    }
}

$materiasEstudiantes = $asigController->obtenerMateriasEstudiantes();
$materiasProfesores = $asigController->obtenerMateriasProfesores();
?>

<link rel="stylesheet" href="/proyecto_final/public/estilos/asignacion.css">

<div class="asignacion-container">
<div id="alerta" class="alerta"></div>
    <h2>Asignación</h2>

    <!-- FORMULARIO ESTUDIANTES -->
    <form method="POST" class="form-asignacion" action="Asignacion.php">
        <h3>Asignar Materia a Estudiante</h3>

        <input type="hidden" name="tipo" value="estudiante">

        <label>Estudiante:</label>
        <select name="id_estudiante" required>
            <option value="">Seleccionar...</option>
            <?php while($est = $estudiantes->fetch_assoc()): ?>
                <option value="<?= $est['ID']; ?>"><?= $est['Nombres'] . ' ' . $est['Apellidos']; ?></option>
            <?php endwhile; ?>
        </select>

        <label>Materia:</label>
        <select name="id_materia" required>
            <option value="">Seleccionar...</option>
            <?php while($mat = $materias->fetch_assoc()): ?>
                <option value="<?= $mat['ID_Materia']; ?>"><?= $mat['Nombre']; ?></option>
            <?php endwhile; ?>
        </select>

        <button type="submit">Asignar</button>
    </form>

    <!-- FORMULARIO PROFESORES -->
    <form method="POST" class="form-asignacion" action="Asignacion.php">
        <h3>Asignar Materia a Profesor</h3>

        <input type="hidden" name="tipo" value="profesor">

        <label>Profesor:</label>
        <select name="id_profesor" required>
            <option value="">Seleccionar...</option>
            <?php while($prof = $profesores->fetch_assoc()): ?>
                <option value="<?= $prof['ID_Profesor']; ?>"><?= $prof['Nombre'] . ' ' . $prof['Apellidos']; ?></option>
            <?php endwhile; ?>
        </select>

        <label>Materia:</label>
        <select name="id_materia" required>
            <option value="">Seleccionar...</option>
            <?php
            $materias2 = $materiaModel->obtenerTodas();
            while($mat = $materias2->fetch_assoc()):
            ?>
                <option value="<?= $mat['ID_Materia']; ?>"><?= $mat['Nombre']; ?></option>
            <?php endwhile; ?>
        </select>

        <button type="submit">Asignar</button>
    </form>

    <!-- LISTADO ESTUDIANTES -->
    <h3>Materias Asignadas a Estudiantes</h3>
    <table class="table-lista estudiantes">
        <tr>
            <th>Estudiante</th>
            <th>Materia</th>
        </tr>
        <?php while($row = $materiasEstudiantes->fetch_assoc()): ?>
            <tr onclick="verInfoAsignacion('<?= $row['estudiante'] ?>', '<?= $row['materia'] ?>')">
                <td><?= $row['estudiante']; ?></td>
                <td><?= $row['materia']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
    <button id="btnVerMasEst" class="btn-vermas">Ver todos los registros</button>
    <!-- LISTADO PROFESORES -->
    <h3 class="titulo-profesores">Materias Asignadas a Profesores</h3>
    <table class="table-lista profesores">
        <tr>
            <th>Profesor</th>
            <th>Materia</th>
        </tr>
        <?php while($row = $materiasProfesores->fetch_assoc()): ?>
            <tr onclick="verInfoAsignacion('<?= $row['profesor'] ?>', '<?= $row['materia'] ?>')">
                <td><?= $row['profesor']; ?></td>
                <td><?= $row['materia']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
    <button id="btnVerMasProf" class="btn-vermas">Ver todos los registros</button>
</div>

<div class="modal-bg" id="modalInfo">
    <div class="modal">
        <button class="btn-close" onclick="cerrarModalInfo()">X</button>
        <h3>Información</h3>

        <div class="info-list">
            <p id="info-nombre"></p>
            <p id="info-materia"></p>
        </div>
    </div>
</div>

<script src="/proyecto_final/public/estilos/js/asignacion.js"></script>

<?php if (isset($_GET["success"])): ?>
<script>
    mostrarAlerta("✔ Asignación realizada correctamente");
    history.replaceState({}, document.title, window.location.pathname);
</script>
<?php endif; ?>

<?php if (isset($_GET["error"]) && $_GET["error"] === "estudianteDuplicado"): ?>
<script>
    mostrarAlerta("❗ Este estudiante ya tiene esa materia asignada");
</script>
<?php endif; ?>

<?php if (isset($_GET["error"]) && $_GET["error"] === "profesorDuplicado"): ?>
<script>
    mostrarAlerta("❗ Este profesor ya tiene esa materia asignada");
</script>
<?php endif; ?>

<?php include __DIR__ . "/../layout/footer.inc.php"; ?>
