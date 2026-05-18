<?php include("conexion.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand fw-bold">Tu Jersey</a>
            <div>
                <ul class="navbar-nav">
                    <li class="nav-item fw-bold"><a class="nav-link" href="Inicio.html">Inicio</a></li>
                    <li class="nav-item fw-bold"><a class="nav-link" href="">Catálogo</a></li>
                    <li class="nav-item fw-bold"><a class="nav-link" href="">Carrito</a></li>
                    <li class="nav-item fw-bold"><a class="nav-link" href="Iniciar_sesion.html">Iniciar sesión</a></li>
                    <li class="nav-item fw-bold"><a class="nav-link" href="">Sobre nosotros</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <h1 class="p-3">Nuestro catálogo</h1>
    <input type="text" id="buscador" placeholder="Buscar...">
    <table class="catalogo">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Categoría</th>
                <th>Imágenes</th>
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
                    echo "<tr>
                    <td>{$f['nombre']}</td>
                    <td>\${$f['precio']}</td>
                    <td>{$f['stock']}</td>
                    <td>{$f['categoria']}</td>
                    <td><img src='{$f['imagen']}'></td>
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