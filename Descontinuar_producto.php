<?php
session_start();
include("conexion.php");
if(!isset($_SESSION['id_usuario']) || $_SESSION['rol'] != 'admin'){
    header("Location: Inicio.php");
    exit();
}
$id_producto = $_POST['id_producto'];
$sql = "UPDATE productos
        SET activo = 0
        WHERE id_producto = '$id_producto'";
if($conn->query($sql)){
    echo "
    <script>
        alert('Producto descontinuado correctamente');
        window.location='Inventario.php';
    </script>
    ";
} else {
    echo "
    <script>
        alert('Error al descontinuar producto');
        window.location='Inventario.php';
    </script>
    ";
}
?>