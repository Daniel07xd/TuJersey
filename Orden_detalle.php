<?php
session_start();
include("conexion.php");

$id_orden = $_GET['id'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de orden</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body class="container mt-4">
    <h2>Detalle de la orden #<?php echo $id_orden; ?></h2>
    <table class="catalogo">
        <thead class="table-dark">
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
<?php
$sql = "SELECT od.*, p.nombre
        FROM orden_detalle od
        INNER JOIN productos p
        ON od.id_producto = p.id_producto
        WHERE od.id_orden = '$id_orden'";
$res = $conn->query($sql);
while($row = $res->fetch_assoc()){
    $subtotal = $row['cantidad'] * $row['precio_unitario'];
    echo "
    <tr>
        <td>{$row['nombre']}</td>
        <td>{$row['cantidad']}</td>
        <td>\${$row['precio_unitario']}</td>
        <td>\${$subtotal}</td>
    </tr>
    ";
}
?>
        </tbody>
    </table>
    <a href="Historial.php" class="btn btn-dark">Volver</a>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="JS/Funciones.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>