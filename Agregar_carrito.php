<?php
include("conexion.php");
session_start();
if(!isset($_SESSION['id_usuario'])){
    echo "
    <script>
        alert('Debes iniciar sesión para agregar productos al carrito');
        window.location='Inicio.php';
    </script>
    ";
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
$sqlProducto = "SELECT stock, activo
                FROM productos
                WHERE id_producto = '$id_producto'";
$resProducto = $conn->query($sqlProducto);
if($resProducto->num_rows == 0){
    echo "
    <script>
        alert('Producto no encontrado');
        window.location='Catalogo.php';
    </script>
    ";
    exit();
}
$producto = $resProducto->fetch_assoc();
if($producto['activo'] == 0){
    echo "
    <script>
        alert('Este producto está descontinuado');
        window.location='Catalogo.php';
    </script>
    ";
    exit();
}
if($cantidad > $producto['stock']){
    echo "
    <script>
        alert('No hay suficiente stock disponible');
        window.location='Catalogo.php';
    </script>
    ";
    exit();
}
$sqlCarrito = "SELECT *
               FROM carritos
               WHERE id_usuario = '$id_usuario'
               AND estado = 'activo'";
$resCarrito = $conn->query($sqlCarrito);
if($resCarrito->num_rows == 0){
    $crearCarrito = "INSERT INTO carritos(id_usuario, estado)
                     VALUES('$id_usuario', 'activo')";
    $conn->query($crearCarrito);
    $id_carrito = $conn->insert_id;
} else {
    $carrito = $resCarrito->fetch_assoc();
    $id_carrito = $carrito['id_carrito'];
}
$sqlValidar = "SELECT *
               FROM carrito_items
               WHERE id_carrito = '$id_carrito'
               AND id_producto = '$id_producto'";
$resValidar = $conn->query($sqlValidar);
if($resValidar->num_rows > 0){
    $item = $resValidar->fetch_assoc();
    $nuevaCantidad = $item['cantidad'] + $cantidad;
    if($nuevaCantidad > $producto['stock']){
        echo "
        <script>
            alert('La cantidad total supera el stock disponible');
            window.location='Catalogo.php';
        </script>
        ";
        exit();
    }
    $update = "UPDATE carrito_items
               SET cantidad = '$nuevaCantidad'
               WHERE id_carrito = '$id_carrito'
               AND id_producto = '$id_producto'";
    $conn->query($update);
} else {
    $insert = "INSERT INTO carrito_items
               (id_carrito, id_producto, cantidad)
               VALUES
               ('$id_carrito', '$id_producto', '$cantidad')";
    $conn->query($insert);
}
echo "
<script>
    alert('Producto agregado al carrito');
    window.location='Catalogo.php';
</script>
";
?>