<?php
require_once __DIR__ . '/Db.php';

class Estudiante {

    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function obtenerTodos() {
        return $this->conn->query("SELECT * FROM Estudiantes ORDER BY Nombres ASC");
    }

    public function obtenerPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM Estudiantes WHERE ID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function buscarPorCedula($cedula) {
        $stmt = $this->conn->prepare("SELECT * FROM Estudiantes WHERE No_documento = ?");
        $stmt->bind_param("s", $cedula);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function crear($nombres, $apellidos, $edad, $documento, $celular, $email) {
        $stmt = $this->conn->prepare(
            "INSERT INTO Estudiantes (Nombres, Apellidos, edad, No_documento, Celular, Email)
             VALUES (?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("ssisss", $nombres, $apellidos, $edad, $documento, $celular, $email);
        return $stmt->execute();
    }

    public function actualizar($id, $nombres, $apellidos, $edad, $documento, $celular, $email) {
        $stmt = $this->conn->prepare(
            "UPDATE Estudiantes
             SET Nombres=?, Apellidos=?, edad=?, No_documento=?, Celular=?, Email=?
             WHERE ID = ?"
        );
        $stmt->bind_param("ssisssi", $nombres, $apellidos, $edad, $documento, $celular, $email, $id);
        return $stmt->execute();
    }

    public function eliminar($id) {
        $stmt = $this->conn->prepare("DELETE FROM Estudiantes WHERE ID = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
