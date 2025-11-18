<?php
header("Content-Type: application/json");

require_once __DIR__ . '/../../../app/Models/Estudiante.php';

$est = new Estudiante();

$id        = $_POST["id"];
$nombres   = $_POST["nombres"];
$apellidos = $_POST["apellidos"];
$edad      = $_POST["edad"];
$documento = $_POST["documento"];
$celular   = $_POST["celular"];
$email     = $_POST["email"];

// 1. CONSULTAR SI LA CÉDULA YA EXISTE
$cedulaExiste = $est->buscarPorCedula($documento);

// CÉDULA DUPLICADA → SOLO BLOQUEA AL CREAR
if (empty($id) && $cedulaExiste) {
    echo json_encode([
        "status" => "error",
        "msg" => "La cédula ya existe en el sistema"
    ]);
    exit;
}

// 2. EDITAR
if (!empty($id)) {
    $est->actualizar($id, $nombres, $apellidos, $edad, $documento, $celular, $email);

    echo json_encode([
        "status" => "updated",
        "msg" => "Estudiante actualizado correctamente"
    ]);
    exit;
}

// 3. CREAR
$est->crear($nombres, $apellidos, $edad, $documento, $celular, $email);

echo json_encode([
    "status" => "created",
    "msg" => "Estudiante registrado correctamente"
]);
exit;
