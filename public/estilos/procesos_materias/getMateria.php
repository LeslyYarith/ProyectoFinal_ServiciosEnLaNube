<?php
require_once __DIR__ . '/../../../app/Models/Materia.php';

if (!isset($_GET["id"])) {
    die("ID faltante");
}

$est = new Materia();
$data = $est->obtenerPorId($_GET["id"]);

header("Content-Type: application/json");
echo json_encode($data);
