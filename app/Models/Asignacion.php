<?php
require_once __DIR__ . '/Db.php';

class Asignacion {

    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    /* ============================================================
       ASIGNAR MATERIA A ESTUDIANTE (EVITA DUPLICADOS)
    ============================================================ */
    public function asignarEstudianteMateria($id_estudiante, $id_materia) {

        // Verificar si ya existe
        $check = $this->conn->prepare("
            SELECT * FROM Estudiantes_Materias
            WHERE ID_estudiantes = ? AND ID_materia = ?
        ");
        $check->bind_param("ii", $id_estudiante, $id_materia);
        $check->execute();

        if ($check->get_result()->num_rows > 0) {
            return false;
        }

        // Insertar
        $stmt = $this->conn->prepare("
            INSERT INTO Estudiantes_Materias (ID_estudiantes, ID_materia)
            VALUES (?, ?)
        ");
        $stmt->bind_param("ii", $id_estudiante, $id_materia);

        return $stmt->execute();
    }

    /* ============================================================
       ASIGNAR MATERIA A PROFESOR (EVITA DUPLICADOS)
    ============================================================ */
    public function asignarProfesorMateria($id_profesor, $id_materia) {

        // Verificar duplicado
        $check = $this->conn->prepare("
            SELECT * FROM Profesores_Materias
            WHERE ID_Profesores = ? AND ID_Materia = ?
        ");
        $check->bind_param("ii", $id_profesor, $id_materia);
        $check->execute();

        if ($check->get_result()->num_rows > 0) {
            return false;
        }

        // Insertar
        $stmt = $this->conn->prepare("
            INSERT INTO Profesores_Materias (ID_Profesores, ID_Materia)
            VALUES (?, ?)
        ");
        $stmt->bind_param("ii", $id_profesor, $id_materia);

        return $stmt->execute();
    }

    /* ============================================================
       OBTENER LISTADO DE ESTUDIANTES + MATERIAS
    ============================================================ */
    public function obtenerMateriasEstudiantes() {
        $query = "
            SELECT 
                CONCAT(e.Nombres, ' ', e.Apellidos) AS estudiante,
                m.Nombre AS materia
            FROM Estudiantes_Materias em
            INNER JOIN estudiantes e ON em.ID_estudiantes = e.ID
            INNER JOIN materias m ON em.ID_materia = m.ID_Materia
            ORDER BY estudiante ASC
        ";
        return $this->conn->query($query);
    }

    /* ============================================================
       OBTENER LISTADO DE PROFESORES + MATERIAS
    ============================================================ */
    public function obtenerMateriasProfesores() {
        $query = "
            SELECT 
                CONCAT(p.Nombre, ' ', p.Apellidos) AS profesor,
                m.Nombre AS materia
            FROM Profesores_Materias pm
            INNER JOIN profesores p ON pm.ID_Profesores = p.ID_Profesor
            INNER JOIN materias m ON pm.ID_Materia = m.ID_Materia
            ORDER BY profesor ASC
        ";
        return $this->conn->query($query);
    }
}
