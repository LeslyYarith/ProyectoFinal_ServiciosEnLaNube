<?php 
include __DIR__ . "/layout/header.inc.php";
$titulo_pagina = "Inicio";
?>

<div class="titulo-modulo">
    <h2>Bienvenido - Seleciona un Modulo:</h2>
</div>

<!-- 🔹 Contenedor de los 4 recuadros -->
<div class="cards-container">

   <div class="card-box" style="--bg-img: url('/proyecto_final/public/estilos/img/estudiantes.jpg');">
        <h3>Módulo de Estudiantes</h3>
        <p>• Crear estudiantes. <br>
           • Listar estudiantes. <br>
           • Eliminar estudiante. </p>
        <button onclick="location.href='/proyecto_final/Paginas/Estudiantes.php'">Ingresar</button>
    </div>

    <div class="card-box" style="--bg-img: url('/proyecto_final/public/estilos/img/profesores.jpg');">
        <h3>Módulo de Profesores</h3>
        <p>• Registrar profesores.<br> 
           • Listar profesores.<br> 
           • Eliminar profesores. </p>
       <button onclick="location.href='/proyecto_final/Paginas/Profesores.php'">Ingresar</button>
    </div>

    <div class="card-box" style="--bg-img: url('/proyecto_final/public/estilos/img/materias.jpg');">
        <h3>Módulo de Materias</h3>
        <p>• Crear materias.<br> 
           • Listar materias. <br>
           • Editarlas/eliminarlas.</p>
        <button onclick="location.href='/proyecto_final/Paginas/Materias.php'">Ingresar</button>
    </div>

    <div class="card-box" style="--bg-img: url('/proyecto_final/public/estilos/img/asignacion.jpg');">
        <h3>Asignación</h3>
        <p>• Asignar materias a estudiantes. <br>
           • Asignar materias a profesores. <br>
           • Mostrar materias asignadas a cada usuario. </p>
       <button onclick="location.href='/proyecto_final/Paginas/Asignacion.php'">Ingresar</button>
    </div>

</div>

<?php
include __DIR__ . "/layout/footer.inc.php";
?>
