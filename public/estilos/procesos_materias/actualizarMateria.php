<?php
require_once __DIR__ . '/../../../app/Models/Materia.php';

$id = $_POST["id"];

$mat = new Materia();

$mat->actualizar(
    $id,
    $_POST["nombre"],
    $_POST["descripcion"],
    $_POST["creditos"]
);

header("Location: /proyecto_final/Paginas/Materias.php?updated=1");
exit;
