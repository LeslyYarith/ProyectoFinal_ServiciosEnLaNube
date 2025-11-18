<?php
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

// Capturar acción del controlador
$asignar = new AsignacionController();
if ($_POST && isset($_POST['tipo']) && $_POST['tipo'] === 'estudiante') {
    $asignar->asignarEstudiante();
}
if ($_POST && isset($_POST['tipo']) && $_POST['tipo'] === 'profesor') {
    $asignar->asignarProfesor();
}

?>

<h2>Asignación</h2>

<?php if(isset($_GET["success"])): ?>
    <div style="padding:10px;background:#d4edda;color:#155724;border-radius:5px;">
        Asignación realizada correctamente.
    </div>
<?php endif; ?>

<!-- FORMULARIO: Asignar materia a estudiante -->
<form method="POST">
    <h3>Asignar materia a estudiante</h3>

    <input type="hidden" name="tipo" value="estudiante">

    <label>Estudiante:</label>
    <select name="id_estudiante" required>
        <?php while($est = $estudiantes->fetch_assoc()): ?>
            <option value="<?= $est['ID']; ?>">
                <?= $est['Nombres'] . ' ' . $est['Apellidos']; ?>
            </option>
        <?php endwhile; ?>
    </select>

    <label>Materia:</label>
    <select name="id_materia" required>
        <?php while($mat = $materias->fetch_assoc()): ?>
            <option value="<?= $mat['ID_Materia']; ?>">
                <?= $mat['Nombre']; ?>
            </option>
        <?php endwhile; ?>
    </select>

    <button type="submit">Asignar</button>
</form>

<!-- FORMULARIO: Asignar materia a profesor -->
<form method="POST">
    <h3>Asignar materia a profesor</h3>

    <input type="hidden" name="tipo" value="profesor">

    <label>Profesor:</label>
    <select name="id_profesor" required>
        <?php while($prof = $profesores->fetch_assoc()): ?>
            <option value="<?= $prof['ID_Profesor']; ?>">
                <?= $prof['Nombre'] . ' ' . $prof['Apellidos']; ?>
            </option>
        <?php endwhile; ?>
    </select>

    <label>Materia:</label>
    <select name="id_materia" required>
        <?php
        // Necesitamos resetear cursor de materias
        $materias = $materiaModel->obtenerTodas();
        while($mat = $materias->fetch_assoc()):
        ?>
            <option value="<?= $mat['ID_Materia']; ?>">
                <?= $mat['Nombre']; ?>
            </option>
        <?php endwhile; ?>
    </select>

    <button type="submit">Asignar</button>
</form>
