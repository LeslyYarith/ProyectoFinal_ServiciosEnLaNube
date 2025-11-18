<?php
require_once __DIR__ . '/../../../app/Models/Materia.php';

if (!isset($_GET["id"])) {
    die("ID no recibido");
}

$est = new Materia();
$est->eliminar($_GET["id"]);

header("Location: /proyecto_final/Paginas/Materias.php?deleted=1");
exit;
