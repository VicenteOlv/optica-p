<?php
require 'header.php';
?>
<!DOCTYPE html>
<html>
<body>
<style>
        table { width: 100%; border-collapse: collapse; }
        th, td { text-align: right; padding: 10px; border-bottom: 1px solid #ddd; }
    </style>
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
        $mysqli = new mysqli("localhost", $username, $password, $database);

        $query = "SELECT fecha, curp, observaciones, fecha_actualizado FROM historia_clinicas";
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
    
</body>
</html>
<?php
require 'footer.php';
?>