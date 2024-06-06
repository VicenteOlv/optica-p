<?php require 'header.php';?>

<div class="container">
    <h1>Resumen del Historial Clínico</h1>

    <?php
    //poner la conexion de base de datos para poner los datos
    // Simulación de datos del historial clínico
    $historialClinico = [
        ['Nombre Paciente' => 'Juan Pérez', 'Fecha Consulta' => '01/06/2024', 'Diagnóstico' => 'Astigmatismo leve'],
        ['Nombre Paciente' => 'María Rodríguez', 'Fecha Consulta' => '02/06/2024', 'Diagnóstico' => 'Miopía moderada'],
        // Agrega más pacientes según sea necesario
    ];

    foreach ($historialClinico as $registro) {
        echo "<div class='historial-item'>";
        echo "<p><strong>{$registro['Nombre Paciente']}</strong></p>";
        echo "<p>Fecha de Consulta: {$registro['Fecha Consulta']}</p>";
        echo "<p>Diagnóstico: {$registro['Diagnóstico']}</p>";
        echo "</div>";
    }
   ?>
   <button id="btnDescargarPDF">Descargar Resumen como PDF</button>

   

</div>

<?php require 'footer.php';?>
