<?php
require_once __DIR__ . '/Db.php';

class Asignacion {

    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Asignar materia a estudiante
    public function asignarEstudianteMateria($id_estudiante, $id_materia) {
        $stmt = $this->conn->prepare(
            "INSERT INTO Estudiantes_Materias (ID_estudiantes, ID_materia)
             VALUES (?, ?)"
        );

        $stmt->bind_param("ii", $id_estudiante, $id_materia);
        return $stmt->execute();
    }

    // Asignar materia a profesor
    public function asignarProfesorMateria($id_profesor, $id_materia) {
        $stmt = $this->conn->prepare(
            "INSERT INTO Profesores_Materias (ID_Profesores, ID_Materia)
             VALUES (?, ?)"
        );

        $stmt->bind_param("ii", $id_profesor, $id_materia);
        return $stmt->execute();
    }
}
