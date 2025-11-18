<?php
header("Content-Type: application/json");

require_once __DIR__ . '/../../../app/Models/Materia.php';

$mat = new Materia();

$id          = $_POST["id"];
$nombre      = $_POST["nombre"];
$descripcion = $_POST["descripcion"];
$creditos    = $_POST["creditos"];

// 1️ VALIDAR SI LA MATERIA YA EXISTE (solo al crear)
$materiaExiste = $mat->buscarPorNombre($nombre ?? '');

if (empty($id) && $materiaExiste) {
    echo json_encode([
        "status" => "error",
        "msg" => "⚠ Ya existe una materia con ese nombre"
    ]);
    exit;
}

// 2️ EDITAR
if (!empty($id)) {

    $mat->actualizar($id, $nombre, $descripcion, $creditos);

    echo json_encode([
        "status" => "updated",
        "msg" => "Materia actualizada correctamente"
    ]);
    exit;
}

// 3️ CREAR
$mat->crear($nombre, $descripcion, $creditos);

echo json_encode([
    "status" => "created",
    "msg" => "Materia registrada correctamente"
]);
exit;
