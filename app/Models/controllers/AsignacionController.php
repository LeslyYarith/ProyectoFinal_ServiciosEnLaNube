<?php
require_once __DIR__ . '/../../Models/Asignacion.php';

class AsignacionController {

    public function asignarEstudiante() {

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $id_estudiante = $_POST["id_estudiante"];
        $id_materia = $_POST["id_materia"];

        $asig = new Asignacion();
        $resultado = $asig->asignarEstudianteMateria($id_estudiante, $id_materia);

        if ($resultado === false) {
            header("Location: Asignacion.php?error=estudianteDuplicado");
            exit;
        }

        header("Location: Asignacion.php?success=estudiante");
        exit;
    }
}

   public function asignarProfesor() {

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $id_profesor = $_POST["id_profesor"];
        $id_materia = $_POST["id_materia"];

        $asig = new Asignacion();
        $resultado = $asig->asignarProfesorMateria($id_profesor, $id_materia);

        if ($resultado === false) {
            header("Location: Asignacion.php?error=profesorDuplicado");
            exit;
        }

        header("Location: Asignacion.php?success=profesor");
        exit;
    }
}

    public function obtenerMateriasEstudiantes() {
        $asig = new Asignacion();
        return $asig->obtenerMateriasEstudiantes();
    }

    public function obtenerMateriasProfesores() {
        $asig = new Asignacion();
        return $asig->obtenerMateriasProfesores();
    }
}
