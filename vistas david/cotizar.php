<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cotizador de Lentes</title>
</head>
<body>
    <h1>Cotizador de Lentes</h1>
    <form action="" method="post">
        <label for="armazon">Tipo de Armaño:</label>
        <select name="armazon" id="armazon">
            <option value="metal">Metal</option>
            <option value="plastico">Plástico</option>
        </select><br>

        <label for="graduacion">Graduación:</label>
        <input type="number" name="graduacion" id="graduacion" min="0"><br>

        <label for="tipoLente">Tipo de Lente:</label>
        <select name="tipoLente" id="tipoLente">
            <option value="cristal">Cristal</option>
            <option value="plastico">Plástico</option>
        </select><br>

        <button type="submit">Cotizar</button>
    </form>

    <?php
    // Definir precios base por tipo de armaño y material
    $preciosBase = [
        "metal" => [
            "cristal" => 100,
            "plastico" => 80
        ],
        "plastico" => [
            "cristal" => 90,
            "plastico" => 70
        ]
    ];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $armazon = $_POST['armazon'];
        $graduacion = $_POST['graduacion'];
        $tipoLente = $_POST['tipoLente'];

        // Calcular el precio base según el armaño y el tipo de lente
        $precioBase = $preciosBase[$armazon][$tipoLente];

        // Aplicar un incremento por cada grado de graduación (este valor es solo ilustrativo)
        $incrementoPorGrado = 5;
        $precioFinal = $precioBase + ($graduacion * $incrementoPorGrado);

        echo "<p>El precio final de tus lentes es: ${$precioFinal}€</p>";
    }
    ?>
</body>
</html>
