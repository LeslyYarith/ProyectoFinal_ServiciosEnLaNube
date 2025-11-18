<?php
require_once __DIR__ . '/Db.php';

class Materia {

    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    /* ===========================
       MÉTODOS CRUD MATERIAS
       =========================== */

    // Obtener todas las materias
    public function obtenerTodas() {
        return $this->conn->query("SELECT * FROM Materias ORDER BY Nombre ASC");
    }

    // Obtener una materia por ID
    public function obtenerPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM Materias WHERE ID_Materia = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Crear una nueva materia
    public function crear($nombre, $descripcion, $creditos) {
        $stmt = $this->conn->prepare(
            "INSERT INTO Materias (Nombre, descripcion, Creditos)
             VALUES (?, ?, ?)"
        );
        $stmt->bind_param("ssi", $nombre, $descripcion, $creditos);
        return $stmt->execute();
    }

    // Actualizar una materia
    public function actualizar($id, $nombre, $descripcion, $creditos) {
        $stmt = $this->conn->prepare(
            "UPDATE Materias SET
                Nombre = ?, 
                descripcion = ?, 
                Creditos = ?
             WHERE ID_Materia = ?"
        );
        $stmt->bind_param("ssii", $nombre, $descripcion, $creditos, $id);
        return $stmt->execute();
    }

    // Eliminar una materia
    public function eliminar($id) {
        $stmt = $this->conn->prepare("DELETE FROM Materias WHERE ID_Materia = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    public function buscarPorNombre($nombre) {
    $stmt = $this->conn->prepare("SELECT * FROM Materias WHERE Nombre = ?");
    $stmt->bind_param("s", $nombre);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

}

