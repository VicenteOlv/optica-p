<?php
ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
{
  header("Location: login.html");
}
else
{
require 'header.php';

if ($_SESSION['ventas']==1)
{
?>
<style>
    table { width: 100%; border-collapse: collapse; }
    th, td { text-align: right; padding: 10px; border-bottom: 1px solid #ddd; }

    .imprimir-btn {
        position: fixed;
        bottom: 20px;
        left: 20px;
    }

</style>
<div class="content-wrapper">        
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div style="display: flex; justify-content: center;">
                        <h1>Resumen del Historial Clínico</h1>
                    </div>
                    <table>
                        <tr>
                            <th>Fecha</th>
                            <th>CURP</th>
                            <th>Observaciones</th>
                            <th>Fecha Actualizado</th>
                        </tr>
                        <?php
                        $username = "root";
                        $password = "";
                        $database = "mydb";
                        $mysqli = new mysqli("localhost", $username, $password, $database, 3307);

                        // Obtener el parámetro 'curp' de la URL
                        $id_historia = isset($_GET['id_historia']) ? $mysqli->real_escape_string($_GET['id_historia']) : '';

                        // Modificar la consulta SQL para usar el parámetro 'curp'
                        $query = "SELECT fecha, curp, observaciones, fecha_actualizado FROM historia_clinicas WHERE id_historia = '$id_historia'";
                        if ($result = $mysqli->query($query)) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>". htmlspecialchars($row["fecha"]). "</td>";
                                echo "<td>". htmlspecialchars($row["curp"]). "</td>";
                                echo "<td>". htmlspecialchars($row["observaciones"]). "</td>";
                                echo "<td>". htmlspecialchars($row["fecha_actualizado"]). "</td>";
                                echo "</tr>";
                            }
                            $result->free();
                        } else {
                            echo "Error: No se pudo ejecutar la consulta.";
                        }
                        $mysqli->close();
                        ?>
                    </table>
                    <br><br>
                    <table>
                        <tr>
                            <th style="text-align: center;">Ojo</th>
                            <th style="text-align: center;">Esférico</th>
                            <th style="text-align: center;">Cilíndrico</th>
                            <th style="text-align: center;">Eje</th>
                            <th style="text-align: center;">Adición</th>
                            <th style="text-align: center;">Prisma</th>
                            <th style="text-align: center;">Altura</th>
                            <th style="text-align: center;">AV</th>
                        </tr>
                        <?php
                        $username = "root";
                        $password = "";
                        $database = "mydb";
                        $mysqli = new mysqli("localhost", $username, $password, $database, 3307);

                        // Obtener el parámetro 'id_historia' de la URL
                        $id_historia = isset($_GET['id_historia']) ? $mysqli->real_escape_string($_GET['id_historia']) : '';

                        // Consulta para obtener los datos del ojo izquierdo
                        $query_izq = "SELECT esferico_izq, cilindrico_izq, eje_izq, add_izq, prisma_izq, altura_oblea_izq, av_izq FROM ojo_izq WHERE id_historia = '$id_historia' LIMIT 1";
                        if ($result_izq = $mysqli->query($query_izq)) {
                            while ($row_izq = $result_izq->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td style='text-align: center;'>IZQ</td>";
                                echo "<td style='text-align: center;'>". htmlspecialchars($row_izq["esferico_izq"]). "</td>";
                                echo "<td style='text-align: center;'>". htmlspecialchars($row_izq["cilindrico_izq"]). "</td>";
                                echo "<td style='text-align: center;'>". htmlspecialchars($row_izq["eje_izq"]). "</td>";
                                echo "<td style='text-align: center;'>". htmlspecialchars($row_izq["add_izq"]). "</td>";
                                echo "<td style='text-align: center;'>". htmlspecialchars($row_izq["prisma_izq"]). "</td>";
                                echo "<td style='text-align: center;'>". htmlspecialchars($row_izq["altura_oblea_izq"]). "</td>";
                                echo "<td style='text-align: center;'>". htmlspecialchars($row_izq["av_izq"]). "</td>";
                                echo "</tr>";
                            }
                            $result_izq->free();
                        } else {
                            echo "Error: No se pudo ejecutar la consulta para el ojo izquierdo.";
                        }

                        // Consulta para obtener los datos del ojo derecho
                        $query_der = "SELECT esferico_der, cilindrico_der, eje_der, add_der, prisma_der, altura_oblea_der, av_der FROM ojo_der WHERE id_historia = '$id_historia' LIMIT 1";
                        if ($result_der = $mysqli->query($query_der)) {
                            while ($row_der = $result_der->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td style='text-align: center;'>DER</td>";
                                echo "<td style='text-align: center;'>". htmlspecialchars($row_der["esferico_der"]). "</td>";
                                echo "<td style='text-align: center;'>". htmlspecialchars($row_der["cilindrico_der"]). "</td>";
                                echo "<td style='text-align: center;'>". htmlspecialchars($row_der["eje_der"]). "</td>";
                                echo "<td style='text-align: center;'>". htmlspecialchars($row_der["add_der"]). "</td>";
                                echo "<td style='text-align: center;'>". htmlspecialchars($row_der["prisma_der"]). "</td>";
                                echo "<td style='text-align: center;'>". htmlspecialchars($row_der["altura_oblea_der"]). "</td>";
                                echo "<td style='text-align: center;'>". htmlspecialchars($row_der["av_der"]). "</td>";
                                echo "</tr>";
                            }
                            $result_der->free();
                        } else {
                            echo "Error: No se pudo ejecutar la consulta para el ojo derecho.";
                        }

                        $mysqli->close();
                        ?>
                    </table>
                    <div style="text-align: center; margin-top: 120px;">
                        <img src="../public/img/firma.png" alt="Oftalmólogo Arturo Tonatiuh Gódinez Trueba" style="width: 150px; height: auto;">
                        <p style="font-size: 18px; font-weight: bold; margin-top: 10px; margin-bottom: 50px;">Oftalmólogo Arturo Tonatiuh Gódinez Trueba</p>
                        <button class="btn btn-primary" onclick="window.print()">Imprimir</button>
                    </div>
<!-- Contenido HTML -->

                    
                </div> <!-- Cierre de div.box -->
            </div> <!-- Cierre de div.col-md-12 -->
        </div> <!-- Cierre de div.row -->
    </section> <!-- Cierre de section.content -->
</div> <!-- Cierre de div.content-wrapper -->

<?php
}
else
{
  require 'noacceso.php';
}

require 'footer.php';
?>

<?php 
}
ob_end_flush();
?>