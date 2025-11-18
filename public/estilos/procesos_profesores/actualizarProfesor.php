<?php
require_once __DIR__ . '/../../../app/Models/Profesor.php';

$id = $_POST["id"];

$prof = new Profesor();

$prof->actualizar(
    $id,
    $_POST["nombre"],
    $_POST["apellidos"],
    $_POST["especialidad"],
    $_POST["edad"],
    $_POST["cedula"],
    $_POST["telefono"],
    $_POST["email"]
);

header("Location: /proyecto_final/Paginas/Profesores.php?updated=1");
exit;
