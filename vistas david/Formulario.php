<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Completo y Procesamiento PHP</title>
</head>
<body>

<form id="miFormulario" action="" method="post">
    <label for="nombre">Nombre:</label><br>
    <input type="text" id="nombre" name="nombre"><br>
    <label for="correo">Correo:</label><br>
    <input type="email" id="correo" name="correo"><br>
    <label for="telefono">Teléfono:</label><br>
    <input type="tel" id="telefono" name="telefono" pattern="[0-9]{10}" placeholder="1234567890"><br>
    <label for="celular">Celular:</label><br>
    <input type="tel" id="celular" name="celular" pattern="[0-9]{10}" placeholder="9876543210"><br>
    <label for="curp">CURP:</label><br>
    <input type="text" id="curp" name="curp" pattern="[A-Z]{4}\d{6}[HM]\d{2}(0[1-9]|1[012])(0[1-9]|[12][0-9]|3[01])\d{4}" title="Introduce una CURP válida" placeholder="AAAA00000HHMMDD0000"><br>
    <label for="fechaNacimiento">Fecha de Nacimiento:</label><br>
    <input type="date" id="fechaNacimiento" name="fechaNacimiento"><br>
    <label for="id_dirección">Edad:</label><br>
    <input type="number" id="edad" name="edad" min="18" max="120"><br>
    <label for="presionOcular">Presión Ocular:</label><br>
    <input type="number" id="presionOcular" name="presionOcular" placeholder="mmHg"><br>
    <label for="astigmatismo">Astigmatismo:</label><br>
    <input type="number" id="astigmatismo" name="astigmatismo" placeholder="grados"><br>
    <label for="miopia">Miopía:</label><br>
    <input type="number" id="miopia" name="miopia" placeholder="D (dióptras)"><br>
    <label for="hipermetropia">Hipermetropía:</label><br>
    <input type="number" id="hipermetropia" name="hipermetropia" placeholder="D (dióptras)"><br>
    <label for="glaucoma">Glaucoma:</label><br>
    <select id="glaucoma" name="glaucoma">
        <option value="no">No</option>
        <option value="si">Sí</option>
    </select><br>
    <input type="submit" value="Enviar">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $celular = $_POST['celular'];
    $curp = $_POST['curp'];
    $fechaNacimiento = $_POST['fechaNacimiento'];
    $direccion = $_POST['edad'];
    $presionOcular = $_POST['presionOcular'];
    $astigmatismo = $_POST['astigmatismo'];
    $miopia = $_POST['miopia'];
    $hipermetropia = $_POST['hipermetropia'];
    $glaucoma = $_POST['glaucoma'];

    // Aquí puedes procesar los datos del formulario, como enviar un correo electrónico
    echo "Datos recibidos:<br>";
    echo "Nombre - $nombre<br>";
    echo "Correo - $correo<br>";
    echo "Teléfono - $telefono<br>";
    echo "Celular - $celular<br>";
    echo "CURP - $curp<br>";
    echo "Fecha de Nacimiento - $fechaNacimiento<br>";
    echo "Edad - $edad<br>";
    echo "Presión Ocular - $presionOcular<br>";
    echo "Astigmatismo - $astigmatismo<br>";
    echo "Miopía - $miopia<br>";
    echo "Hipermetropía - $hipermetropia<br>";
    echo "Glaucoma - $glaucoma<br>";
} else {
    http_response_code(405); // Método no permitido
    echo json_encode(["error" => "Método no permitido"]);
}
?>

</body>
</html>
