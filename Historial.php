<?php
session_start();
include("conexion.php");
$id_usuario = $_SESSION['id_usuario'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de compras</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand fw-bold">Tu Jersey</a>
            <div>
                <ul class="navbar-nav">
                    <li class="nav-item fw-bold"><a class="nav-link" href="Inicio.php">Inicio</a></li>
                    <li class="nav-item fw-bold"><a class="nav-link" href="Catalogo.php">Catálogo</a></li>
                    <?php if(isset($_SESSION['id_usuario'])){ ?>
                    <li class="nav-item fw-bold"><a class="nav-link" href="Carrito.php">Carrito</a></li>
                    <li class="nav-item fw-bold"><a class="nav-link" href="Historial.php">Historial</a></li>
                    <li class="nav-item fw-bold"><a class="nav-link" href="Cerrar_sesion.php" id="cerrarSesion">Cerrar sesión</a></li>
                    <?php } else { ?>
                    <li class="nav-item fw-bold"><a class="nav-link" href="Iniciar_sesion.html">Iniciar sesión</a></li>
                    <?php } ?>
                    <li class="nav-item fw-bold"><a class="nav-link" href="">Sobre nosotros</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="p-3">Mis compras</h1>
        <table class="catalogo">
            <thead class="table-dark">
                <tr>
                    <th>ID Orden</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Detalle</th>
                </tr>
            </thead>
            <tbody>
<?php
$sql = "SELECT * 
        FROM ordenes 
        WHERE id_usuario = '$id_usuario'
        ORDER BY fecha DESC";
$res = $conn->query($sql);
while($row = $res->fetch_assoc()){
    echo "
    <tr>
        <td>{$row['id_orden']}</td>
        <td>{$row['fecha']}</td>
        <td>\${$row['total']}</td>
        <td>{$row['estado']}</td>
        <td>
            <a href='Orden_detalle.php?id={$row['id_orden']}'
               class='btn btn-primary btn-sm'>
               Ver
            </a>
        </td>
    </tr>
    ";
}
?>
            </tbody>
        </table>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="JS/Funciones.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>