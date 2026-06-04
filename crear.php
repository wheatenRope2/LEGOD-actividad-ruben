<?php
    include "config.php";

    $sql = "SELECT theme_id, name FROM themes";
    $query = mysqli_query($conexion, $sql);
    $lista_temas = array();

    if ($query){
        while ($fila = mysqli_fetch_assoc($query)){
            $lista_temas[] = $fila;
            //var_dump($fila);
            //echo "<br>";
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Set - LEGOD</title>
    <link rel="stylesheet" href="./css/styles.css">
</head>
<body class="centrar-contenido">

    <div class="encabezado">
        <h1>LEG<span>O</span>D</h1>
    </div>

    <div class="menu-navegacion">
        <a href="index.html" class="btn-menu">Buscar</a>
        <a href="crear.php" class="btn-menu">Crear</a>
    </div>

    <div class="contenedor-busqueda">
        <div class="formulario">
            <h2>Añadir un nuevo Set</h2>
            
            <form action="guardar.php" method="POST">
                
                <label>Número de Set (set_num):</label>
                <input type="text" name="set_num" required>

                <label>Nombre del Set:</label>
                <input type="text" name="name" required>

                <label>Año de lanzamiento:</label>
                <input type="number" name="year" required>

                <label>Número de Piezas:</label>
                <input type="number" name="num_parts" required>

                <label>Tema del Set:</label>
                <select name="theme_id" required>
                    <option value="">Selecciona un tema...</option>
                    
                    <!-- PHP FOREACH --> 
                    <?php
                        if(count($lista_temas)>0){
                            foreach($lista_temas as $temas){
                                $id_tema = $temas["theme_id"];
                                echo "<option value = '$id_tema'> " .$temas ["name"]. "</option>";
                            }
                        }
                    ?>
                </select>
                
                <br><br>
                <input type="submit" value="Guardar Set">
            </form>
        </div>
    </div>

</body>
</html>