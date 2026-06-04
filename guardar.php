<?php
    include 'config.php';

    $mensaje = "";
    $clase_mensaje = "";
    var_dump($_POST);
    if($_SERVER["REQUEST_METHOD"] == 'POST'){
        $set_num = $_POST["set_num"];
        $name = $_POST["name"];
        $year = $_POST["year"];
        $num_parts = $_POST["num_parts"];
        $theme_id = $_POST["theme_id"];

        $sql = "INSERT INTO sets (set_num, name, year, theme_id, num_parts)
            VALUES ('$set_num', '$name', $year, $theme_id, $num_parts)";
        $query = mysqli_query($conexion, $sql);
        if($query){
            $mensaje = "FUE UN EXITO";
            $clase_mensaje = "mensaje-exito";
        }
        else{
            $mensaje = "OCURRIO UN ERROR";
            $clase_mensaje = "mensaje-error";
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Guardar Set - LEGOD</title>
    <link rel="stylesheet" href="./css/styles.css">
</head>
<body>

    <div class="encabezado">
        <h1>LEG<span>O</span>D</h1>
    </div>

    <div class="menu-navegacion">
        <a href="index.html" class="btn-menu">Buscar</a>
        <a href="crear.php" class="btn-menu">Crear</a>
        
    </div>

    <!-- PHP --> 
    <div class="mensaje <?php echo $clase_mensaje ?>">
        <h3>Resultado de la inserción:</h3>
        <!-- PHP --> 
        <p><?php echo $mensaje ?></p>
        <br>
        <a href="crear.php" style="color: #000; font-weight:bold;">Añadir otro set</a> | 
        <a href="index.html" style="color: #000; font-weight:bold;">Ir al buscador</a>
    </div>

</body>
</html>