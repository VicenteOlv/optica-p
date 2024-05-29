<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $edad = $_POST['edad']?? null;
    $presionOcular = $_POST['presionOcular']?? null;
    $astigmatismo = $_POST['astigmatismo']?? null;
    $miopia = $_POST['miopia']?? null;
    $hipermetropia = $_POST['hipermetropia']?? null;
    $glaucoma = $_POST['glaucoma']?? null;

    // Aquí puedes procesar los datos del formulario, como enviar un correo electrónico
    // Por ejemplo, imprimir los datos recibidos
    echo "Datos recibidos:<br>";
    echo "Nombre: $nombre<br>";
    echo "Correo: $correo<br>";
    if ($edad!== null) echo "Edad: $edad<br>";
    if ($presionOcular!== null) echo "Presión Ocular: $presionOcular mmHg<br>";
    if ($astigmatismo!== null) echo "Astigmatismo: $astigmatismo grados<br>";
    if ($miopia!== null) echo "Miopía: $miopia D<br>";
    if ($hipermetropia!== null) echo "Hipermetropía: $hipermetropia D<br>";
    if ($glaucoma!== null) echo "Glaucoma: $glaucoma<br>";

    // Aquí puedes continuar con el procesamiento de los datos, como enviar un correo electrónico,
    // almacenarlos en una base de datos, etc.
} else {
    http_response_code(405); // Método no permitido
    echo json_encode(["error" => "Método no permitido"]);
}
?>
