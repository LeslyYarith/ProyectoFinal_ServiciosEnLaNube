<?php
header("Content-Type: application/json");

require_once __DIR__ . '/../../../app/Models/Profesor.php';

$prof = new Profesor();

$id           = $_POST["idProfesor"] ?? null;
$nombre       = $_POST["nombre"];
$apellidos    = $_POST["apellidos"];
$especialidad = $_POST["especialidad"];
$edad         = $_POST["edad"];
$cedula       = $_POST["cedula"];
$telefono     = $_POST["telefono"];
$email        = $_POST["email"];

// 1. CONSULTAR SI LA CÉDULA YA EXISTE
$cedulaExiste = $prof->buscarPorCedula($cedula);

// CÉDULA DUPLICADA → SOLO BLOQUEA AL CREAR
if (empty($id) && $cedulaExiste) {
    echo json_encode([
        "status" => "error",
        "msg" => "La cédula ya está registrada en otro profesor"
    ]);
    exit;
}

// 2. EDITAR PROFESOR
if (!empty($id)) {
    $prof->actualizar($id, $nombre, $apellidos, $especialidad, $edad, $cedula, $telefono, $email);

    echo json_encode([
        "status" => "updated",
        "msg" => "Profesor actualizado correctamente"
    ]);
    exit;
}

// 3. CREAR PROFESOR
$prof->crear($nombre, $apellidos, $especialidad, $edad, $cedula, $telefono, $email);

echo json_encode([
    "status" => "created",
    "msg" => "Profesor registrado correctamente"
]);
exit;
