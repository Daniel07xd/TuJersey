<?php
session_start();
include("conexion.php");
if(!isset($_SESSION['id_usuario']) || $_SESSION['rol'] != 'admin'){
    header("Location: Inicio.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <?php include("navbar.php"); ?>

    <h1 class="p-3">Inventario disponible</h1>
    <div class="m-3">
        <a href="Agregar_producto.php" class="btn btn-primary">Agregar nuevo producto</a>
    </div>
    <input type="text" id="buscador" placeholder="Buscar..." class="m-3">
    <table class="catalogo">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Categoría</th>
                <th>Imágenes</th>
                <th>Reabastecer</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT productos.*, categorias.nombre AS categoria
                    FROM productos
                    LEFT JOIN categorias
                    ON productos.id_categoria = categorias.id_categoria";
            $res = $conn->query($sql);
            if ($res->num_rows > 0) {
                while($f = $res->fetch_assoc()) {
                    $estado = $f['activo'] ? 'Activo' : 'Descontinuado';
                    if($f['activo'] == 1){
                        $botonAccion = "
                            <form action='Descontinuar_producto.php' method='POST' style='display:inline;'>
                                <input type='hidden' name='id_producto' value='{$f['id_producto']}'>
                                <button class='btn btn-danger btn-sm' type='submit'>Descontinuar</button>
                            </form>";
                    } else {
                        $botonAccion = "
                            <form action='Reactivar_producto.php' method='POST' style='display:inline;'>
                                <input type='hidden' name='id_producto' value='{$f['id_producto']}'>
                                <button class='btn btn-success btn-sm' type='submit'>Reactivar</button>
                            </form>";
                    }
                    echo "<tr>
                    <td>{$f['nombre']}</td>
                    <td>\${$f['precio']}</td>
                    <td>{$f['stock']}</td>
                    <td>{$f['categoria']}</td>
                    <td><img src='{$f['imagen']}'></td>
                    <td>
                        <form action='Reabastecer.php' method='POST'>
                            <input type='hidden' name='id_producto' value='{$f['id_producto']}'>
                            <input type='number' name='cantidad' value='0' min='1' class='form-control' style='width:80px;'>
                            <button type='submit' class='btn btn-dark'>Agregar</button>
                        </form>
                    </td>
                    <td>{$estado}</td>
                    <td>{$botonAccion}</td>
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