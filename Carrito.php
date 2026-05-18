<?php
session_start();
include("conexion.php");
if(!isset($_SESSION['id_usuario'])){
    header("Location: Inicio.php");
    exit();
}
$id_usuario = $_SESSION['id_usuario'];
$sql = "SELECT carrito_items.*,
        productos.nombre,
        productos.precio,
        productos.imagen
        FROM carrito_items
        INNER JOIN carritos
        ON carrito_items.id_carrito = carritos.id_carrito
        INNER JOIN productos
        ON carrito_items.id_producto = productos.id_producto
        WHERE carritos.id_usuario = '$id_usuario'
        AND carritos.estado = 'activo'";
$res = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <?php include("navbar.php"); ?>

    <div class="container mt-5">
        <h1 class="p-3">
            <?php
                if (isset($_SESSION['nombre'])) {
                    echo "Carrito de ".$_SESSION['nombre'];
                }
            ?>
        </h1>
        <table class="catalogo">
            <thead class="table-dark">
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Imagen</th>
                    <th>Subtotal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $total = 0;
            while($f = $res->fetch_assoc()){
                $subtotal = $f['precio'] * $f['cantidad'];
                $total += $subtotal;
                echo "
                <tr>
                    <td>{$f['nombre']}</td>
                    <td>\${$f['precio']}</td>
                    <td>{$f['cantidad']}</td>
                    <td>
                        <img src='{$f['imagen']}'
                        width='100'>
                    </td>
                    <td>\$$subtotal</td>
                    <td>
                        <form action='Eliminar_producto.php' method='POST'>
                            <input type='hidden' name='id_item' value='{$f['id_item']}'>
                            <button type='submit' class='btn btn-danger' onclick='return confirm(\"¿Eliminar producto del carrito?\")'>Eliminar </button>
                        </form>
                    </td>
                </tr>
                ";
            }
            ?>
            </tbody>
        </table>

        <h3 class="m-2">Total: $<?php echo $total; ?></h3>
        <form action="Comprar.php" method="POST">
            <button type="submit" class="btn btn-dark btn-lg mt-3">Comprar</button>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="JS/Funciones.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>