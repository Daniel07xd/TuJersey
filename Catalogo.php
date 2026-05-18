<?php include("conexion.php"); ?>
<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogo</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <?php include("navbar.php"); ?>

    <h1 class="p-3">Nuestro catálogo</h1>
    <input type="text" id="buscador" placeholder="Buscar..." class="m-3">
    <table class="catalogo">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Categoría</th>
                <th>Imágenes</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT productos.*, categorias.nombre AS categoria
                    FROM productos
                    LEFT JOIN categorias
                    ON productos.id_categoria = categorias.id_categoria
                    WHERE productos.activo = 1";
            $res = $conn->query($sql);
            if ($res->num_rows > 0) {
                while($f = $res->fetch_assoc()) {
                    echo "<tr>
                    <td>{$f['nombre']}</td>
                    <td>\${$f['precio']}</td>
                    <td>{$f['stock']}</td>
                    <td>{$f['categoria']}</td>
                    <td><img src='{$f['imagen']}'></td>
                    <td>
                        <form action='Agregar_carrito.php' method='POST'>
                            <input type='hidden' name='id_producto' value='{$f['id_producto']}'>
                            <input type='number' name='cantidad' value='0' min='1' max='{$f['stock']}' class='form-control' style='width:80px;'>
                            <button type='submit'
                                class='btn btn-dark'>
                                Agregar al carrito
                            </button>
                        </form>
                    </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No hay productos registrados</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="JS/Funciones.js"></script>
</body>

</html>