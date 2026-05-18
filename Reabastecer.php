<?php
include("conexion.php");
session_start();
if(!isset($_SESSION['id_usuario'])){
    header("Location: Inicio.php");
    exit();
}
$id_usuario = $_SESSION['id_usuario'];
$id_producto = $_POST['id_producto'];
$cantidad = $_POST['cantidad'];
if($cantidad <= 0){
    echo "
    <script>
        alert('Cantidad inválida');
        window.location='Catalogo.php';
    </script>
    ";
    exit();
}
$sqlStock = "SELECT stock
             FROM productos
             WHERE id_producto = '$id_producto'";
$res = $conn->query($sqlStock);
if($res->num_rows > 0){
    $producto = $res->fetch_assoc();
    $nuevoStock = $producto['stock'] + $cantidad;
    $update = "UPDATE productos
               SET stock = '$nuevoStock'
               WHERE id_producto = '$id_producto'";
    if($conn->query($update)){
        echo "
        <script>
            alert('Producto reabastecido correctamente');
            window.location='Inventario.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Error al actualizar stock');
            window.location='Inventario.php';
        </script>
        ";
    }
}