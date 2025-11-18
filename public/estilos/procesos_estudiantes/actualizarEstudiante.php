<?php
require_once __DIR__ . '/../../../app/Models/Estudiante.php';

$id = $_POST["id"];

$est = new Estudiante();

$est->actualizar(
    $id,
    $_POST["nombres"],
    $_POST["apellidos"],
    $_POST["edad"],
    $_POST["documento"],
    $_POST["celular"],
    $_POST["email"]
);

header("Location: /proyecto_final/Paginas/Estudiantes.php?updated=1");
exit;
