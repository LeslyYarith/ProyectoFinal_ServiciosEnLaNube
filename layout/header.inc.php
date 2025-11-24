<?php include __DIR__ . '/conf.php'; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($titulo_pagina ?? "E d u - C o n t r o l", ENT_QUOTES, 'UTF-8') ?></title>

    <!-- RECORDAR QUE /PUBLIC SOLO SE QUEDA EN XAMMP, 
     PARA EL VPS SE QUITA ESO, ESTO PAR EL PROYECTO Y EVITAR PROBLEMAS-->
    <link rel="stylesheet" href="/proyecto_final/public/estilos/style.css">
    <link rel="stylesheet" href="/proyecto_final/public/estilos/cards.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="icon" type="image/png" href="/proyecto_final/public/estilos/img/logo-removebg-preview.png">

    <?php if (!empty($css_extra)): ?>
        <link rel="stylesheet" href="<?= htmlspecialchars($css_extra) ?>">
    <?php endif; ?>

</head>

<body>

    <!-- Encabezado principal -->
    <header>

        <div class="logo-title">
            <img src="/proyecto_final/public/estilos/img/logo.jpg" alt="Logo" class="logo-img">
            <h1>E d u - C o n t r o l</h1>
        </div>

        <nav>
            <!-- RECORDAR QUE /PUBLIC SOLO SE QUEDA EN XAMMP, 
     PARA EL VPS SE QUITA ESO, ESTO PAR EL PROYECTO Y EVITAR PROBLEMAS-->
            <a href="/proyecto_final/index.php">I N I C I O</a>
        </nav>
    </header>

    <!-- Contenido dinámico -->
    <main>
        <div class="clear">
            <h2><?= $h2 ?? "" ?></h2>
        </div>
