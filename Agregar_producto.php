<?php
include("conexion.php");
session_start();
if(!isset($_SESSION['id_usuario']) || $_SESSION['rol'] != 'admin'){
    header("Location: Inicio.php");
    exit();
}
$sqlCategorias = "SELECT * FROM categorias";
$resCategorias = $conn->query($sqlCategorias);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Agregar producto</h1>
        <form action="Guardar_producto.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Precio</label>
                <input type="number" step="0.01" name="precio" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Stock</label>
                <input type="number" name="stock" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Categoría</label>
                <select name="id_categoria" class="form-select" required>
                    <option value="">Selecciona una categoría</option>
                    <?php
                    while($cat = $resCategorias->fetch_assoc()){
                        echo "
                        <option value='{$cat['id_categoria']}'>
                            {$cat['nombre']}
                        </option>
                        ";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Ruta de imagen</label>
                <input type="text" name="imagen" class="form-control" placeholder="Images/producto.jpg">
            </div>
            <button type="submit" class="btn btn-primary">Guardar producto</button>
        </form>
    </div>
</body>
</html>