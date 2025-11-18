<?php
require_once __DIR__ . '/Db.php';

class Profesor {

    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function obtenerTodos() {
        $sql = "SELECT * FROM Profesores ORDER BY Nombre";
        return $this->conn->query($sql);
    }
}
