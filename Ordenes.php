<?php
session_start();
include("conexion.php");
if(!isset($_SESSION['id_usuario']) || $_SESSION['rol'] != 'admin'){
    header("Location: Inicio.php");
    exit();
}
$sql = "SELECT o.*, u.nombre
        FROM ordenes o
        INNER JOIN usuarios u ON o.id_usuario = u.id_usuario
        ORDER BY o.fecha DESC";
$res = $conn->query($sql);
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

    <h1>Gestión de órdenes</h1>
    <table class="catalogo">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Cambiar estado</th>
            </tr>
        </thead>
        <tbody>
        <?php while($o = $res->fetch_assoc()){ ?>
            <tr>
                <td><?php echo $o['id_orden']; ?></td>
                <td><?php echo $o['nombre']; ?></td>
                <td><?php echo $o['fecha']; ?></td>
                <td>$<?php echo $o['total']; ?></td>
                <td><?php echo $o['estado']; ?></td>
                <td>
                    <form action="Cambiar_estado.php" method="POST" class="d-flex gap-1">
                        <input type="hidden" name="id_orden" value="<?php echo $o['id_orden']; ?>">
                        <select name="estado" class="form-select form-select-sm" required>
                            <option value="pendiente">Pendiente</option>
                            <option value="pagado">Pagado</option>
                            <option value="enviado">Enviado</option>
                            <option value="entregado">Entregado</option>
                            <option value="cancelado">Cancelado</option>
                        </select>
                        <button class="btn btn-primary btn-sm">Actualizar</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="JS/Funciones.js"></script>
</body>
</html>