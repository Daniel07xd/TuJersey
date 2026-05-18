<?php
session_start();
include("conexion.php");
if(!isset($_SESSION['id_usuario'])){
    header("Location: Inicio.php");
    exit();
}
$id_item = $_POST['id_item'];
$sql = "DELETE FROM carrito_items
        WHERE id_item = '$id_item'";
if($conn->query($sql) === TRUE){
    echo "
    <script>
        alert('Producto eliminado del carrito');
        window.location='Carrito.php';
    </script>
    ";
} else {
    echo "
    <script>
        alert('Error al eliminar producto');
        window.location='Carrito.php';
    </script>
    ";
}
?>