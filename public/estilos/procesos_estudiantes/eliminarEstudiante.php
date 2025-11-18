<?php
require_once __DIR__ . '/../../../app/Models/Estudiante.php';

if (!isset($_GET["id"])) {
    die("ID no recibido");
}

$est = new Estudiante();
$est->eliminar($_GET["id"]);

header("Location: /proyecto_final/Paginas/Estudiantes.php?deleted=1");
exit;
