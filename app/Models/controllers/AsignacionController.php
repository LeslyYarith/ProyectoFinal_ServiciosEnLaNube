<?php
require_once __DIR__ . '/../../Models/Asignacion.php';

class AsignacionController {

    public function asignarEstudiante() {

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id_estudiante = $_POST["id_estudiante"];
            $id_materia = $_POST["id_materia"];

            $asig = new Asignacion();
            $asig->asignarEstudianteMateria($id_estudiante, $id_materia);

            header("Location: /public/Paginas/Asignacion.php?success=1");
            exit;
        }
    }

    public function asignarProfesor() {

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id_profesor = $_POST["id_profesor"];
            $id_materia = $_POST["id_materia"];

            $asig = new Asignacion();
            $asig->asignarProfesorMateria($id_profesor, $id_materia);

            header("Location: /public/Paginas/Asignacion.php?success=1");
            exit;
        }
    }
}
