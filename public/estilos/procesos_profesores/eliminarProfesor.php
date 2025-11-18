<?php
require_once __DIR__ . '/../../../app/Models/Profesor.php';

if (!isset($_GET["id"])) {
    die("ID no recibido");
}

$est = new Profesor();
$est->eliminar($_GET["id"]);

header("Location: /proyecto_final/Paginas/Profesores.php?deleted=1");
exit;
