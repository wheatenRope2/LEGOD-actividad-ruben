<?php
include 'config.php';
$clase_mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['set_a_eliminar'])){
    $id_set = $_POST["set_a_eliminar"];

    $sql = "DELETE FROM sets WHERE set_num = '$id_set'";   
    $query = mysqli_query($conexion, $sql);
    if ($query){
        $mensaje = "La eliminación fue correcta";
        $clase_mensaje = "mensaje-exito";
    }
    else{
        $mensaje = "La eliminación no fue correcta";
        $clase_mensaje = "mensaje-error";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Set - LEGOD</title>
    <link rel="stylesheet" href="./css/styles.css">
</head>
<body>

    <div class="encabezado">
        <h2>LEGOD - Eliminar</h2>
        <a href="index.html">Volver al inicio</a>
    </div>

    <!-- PHP --> 
    <div class="mensaje <?php echo $clase_mensaje  ?>">
        <h3>Resultado de la operación:</h3>
        <!-- PHP --> 
        <p><?php echo $mensaje  ?></p>
        <br>
        <a href="index.html" style="color: #000; font-weight:bold;">Volver a los resultados de búsqueda</a>
    </div>

</body>
</html>