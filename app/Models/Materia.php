<?php
require_once __DIR__ . '/Db.php';

class Materia {

    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function obtenerTodas() {
        $sql = "SELECT * FROM Materias ORDER BY Nombre";
        return $this->conn->query($sql);
    }
}
