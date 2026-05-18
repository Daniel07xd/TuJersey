<?php
session_start();
include("conexion.php");
if(!isset($_SESSION['id_usuario'])){
    header("Location: Inicio.php");
    exit();
}
$id_usuario = $_SESSION['id_usuario'];
$sqlCarrito = "SELECT *
               FROM carritos
               WHERE id_usuario = '$id_usuario'
               AND estado = 'activo'";
$resCarrito = $conn->query($sqlCarrito);
if($resCarrito->num_rows == 0){
    echo "
    <script>
        alert('No tienes un carrito activo');
        window.location='Carrito.php';
    </script>
    ";
    exit();
}
$carrito = $resCarrito->fetch_assoc();
$id_carrito = $carrito['id_carrito'];
$sqlItems = "SELECT *
             FROM carrito_items
             WHERE id_carrito = '$id_carrito'";
$resItems = $conn->query($sqlItems);
if($resItems->num_rows == 0){
    echo "
    <script>
        alert('Tu carrito está vacío');
        window.location='Carrito.php';
    </script>
    ";
    exit();
}
$sqlOrden = "INSERT INTO ordenes(id_usuario, estado)
             VALUES('$id_usuario', 'pendiente')";
$conn->query($sqlOrden);
$id_orden = $conn->insert_id;
while($item = $resItems->fetch_assoc()){
    $id_producto = $item['id_producto'];
    $cantidad = $item['cantidad'];
    $sqlDetalle = "INSERT INTO orden_detalle
                   (id_orden, id_producto, cantidad)
                   VALUES
                   ('$id_orden', '$id_producto', '$cantidad')";
    $conn->query($sqlDetalle);
}
$eliminar = "DELETE FROM carrito_items
             WHERE id_carrito = '$id_carrito'";
$conn->query($eliminar);
echo "
<script>
    alert('Compra realizada correctamente');
    window.location='Catalogo.php';
</script>
";
?>