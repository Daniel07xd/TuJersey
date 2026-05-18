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

    <div class="container mt-4">
        <h2>Historial de ventas</h2>
<?php
$sqlTotal = "SELECT SUM(total) AS total_ventas
             FROM ordenes
             WHERE estado IN ('pagado','enviado','entregado')";
$resTotal = $conn->query($sqlTotal);
$total = $resTotal->fetch_assoc();
?>
        <div class="alert">
            <h4>Total de ventas: $<?php echo number_format($total['total_ventas'] ?? 0, 2); ?></h4>
        </div>
        <table class="catalogo">
            <thead>
                <tr>
                    <th>ID Orden</th>
                    <th>Usuario</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Detalle</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $sql = "SELECT o.*, u.nombre
                    FROM ordenes o
                    INNER JOIN usuarios u ON o.id_usuario = u.id_usuario
                    WHERE o.estado IN ('pagado','enviado','entregado')
                    ORDER BY o.fecha DESC";
            $res = $conn->query($sql);
            while($o = $res->fetch_assoc()){
                echo "
                <tr>
                    <td>{$o['id_orden']}</td>
                    <td>{$o['nombre']}</td>
                    <td>\${$o['total']}</td>
                    <td>{$o['estado']}</td>
                    <td>{$o['fecha']}</td>
                    <td>
                        <a href='Orden_detalle.php?id={$o['id_orden']}' class='btn btn-primary btn-sm'>Ver detalle</a>
                    </td>
                </tr>
                ";
            }
            ?>
            </tbody>
        </table>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="JS/Funciones.js"></script>
</body>
</html>