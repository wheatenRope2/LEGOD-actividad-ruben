<?php
// Archivo: buscar.php
include 'config.php';

$texto_buscado = "";
$lista_resultados = array();

if (isset($_GET['busqueda'])) {
    $texto_buscado = $_GET['busqueda'];
    
    $sql = "SELECT set_num, name, year, num_parts, theme_id
            FROM sets 
            WHERE name LIKE '%" . $texto_buscado . "%'";

    $resultado_query = mysqli_query($conexion, $sql);
    
    if ($resultado_query) {
        while ($fila = mysqli_fetch_assoc($resultado_query)) {
            $theme_id = $fila["theme_id"];
            
            $sql2 = "SELECT name FROM themes WHERE theme_id = $theme_id";
            $query2 = mysqli_query($conexion, $sql2);
            
            if ($query2) {
                $res = mysqli_fetch_assoc($query2);
                
                if ($res) {
                    $fila["theme_name"] = $res["name"];
                } else {
                    $fila["theme_name"] = "Sin tema";
                }
            }
            
            $lista_resultados[] = $fila;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultados de Búsqueda - LEGOD</title>
    <link rel="stylesheet" href="./css/styles.css">
</head>
<body>

    <div class="encabezado">
        <h2>LEGOD - Resultados</h2>
        <a href="index.html">Volver al inicio</a>
    </div>

    <div class="contenedor-resultados">
        <h3>Resultados para la palabra: <?php echo $texto_buscado; ?></h3>

        <?php
        if (count($lista_resultados) > 0) {
            foreach ($lista_resultados as $set_lego) {
                echo "<div class='tarjeta'>";
                echo "<h3>" . $set_lego['name'] . "</h3>";
                echo "<p><strong>Año de lanzamiento:</strong> " . $set_lego['year'] . "</p>";
                echo "<p><strong>Cantidad de piezas:</strong> " . $set_lego['num_parts'] . "</p>";
                
                if (isset($set_lego['theme_name'])) {
                    echo "<p><span class='etiqueta-tema'>Tema: " . $set_lego['theme_name'] . "</span></p>";
                }
                
                // CONTENEDOR DE ACCIONES (EDITAR Y ELIMINAR)
                echo "<div class='acciones-tarjeta'>";
                
                // Botón Editar (por método GET mediante un enlace)
                echo "<a href='actualiza.php?id_set=" . $set_lego['set_num'] . "' class='btn-editar'>Editar Set</a>";
                
                // Botón Eliminar (por método POST mediante un formulario)
                echo "<form action='elimina.php' method='POST' style='display:inline;'>";
                echo "<input type='hidden' name='set_a_eliminar' value='" . $set_lego['set_num'] . "'>";
                echo "<button type='submit' class='btn-eliminar'>Eliminar Set</button>";
                echo "</form>";
                
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<div class='tarjeta'>";
            echo "<p>No se encontraron sets con ese nombre.</p>";
            echo "</div>";
        }
        ?>
    </div>

</body>
</html>