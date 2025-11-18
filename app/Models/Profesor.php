<?php
require_once __DIR__ . '/Db.php';

class Profesor {

    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    /** Obtener todos los profesores */
    public function obtenerTodos() {
        return $this->conn->query("SELECT * FROM Profesores ORDER BY Nombre ASC");
    }

    /** Obtener profesor por ID */
    public function obtenerPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM Profesores WHERE ID_Profesor = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    /** Buscar profesor por cédula */
    public function buscarPorCedula($cedula) {
        $stmt = $this->conn->prepare("SELECT * FROM Profesores WHERE Cedula = ?");
        $stmt->bind_param("s", $cedula);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    /** Crear profesor */
    public function crear($nombre, $apellidos, $especialidad, $edad, $cedula, $telefono, $email) {

        $stmt = $this->conn->prepare(
            "INSERT INTO Profesores (Nombre, Apellidos, Especialidad, Edad, Cedula, Telefono, Email)
             VALUES (?, ?, ?, ?, ?, ?, ?)"
        );

        $stmt->bind_param("sssisss",
            $nombre,
            $apellidos,
            $especialidad,
            $edad,
            $cedula,
            $telefono,
            $email
        );

        return $stmt->execute();
    }

    /** Actualizar profesor */
    public function actualizar($id, $nombre, $apellidos, $especialidad, $edad, $cedula, $telefono, $email) {

        $stmt = $this->conn->prepare(
            "UPDATE Profesores
             SET Nombre=?, Apellidos=?, Especialidad=?, Edad=?, Cedula=?, Telefono=?, Email=?
             WHERE ID_Profesor = ?"
        );

        $stmt->bind_param("sssisssi",
            $nombre,
            $apellidos,
            $especialidad,
            $edad,
            $cedula,
            $telefono,
            $email,
            $id
        );

        return $stmt->execute();
    }

    /** Eliminar profesor */
    public function eliminar($id) {
        $stmt = $this->conn->prepare("DELETE FROM Profesores WHERE ID_Profesor = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}

