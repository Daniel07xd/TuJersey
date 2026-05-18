<?php
include("conexion.php");
session_start();
if(!isset($_SESSION['id_usuario']) || $_SESSION['rol'] != 'admin'){
    header("Location: Inicio.php");
    exit();
}
$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$stock = $_POST['stock'];
$id_categoria = $_POST['id_categoria'];
$imagen = $_POST['imagen'];
$sql = "INSERT INTO productos
        (nombre, precio, stock, id_categoria, imagen)
        VALUES
        ('$nombre', '$precio', '$stock', '$id_categoria', '$imagen')";
if($conn->query($sql)){
    echo "
    <script>
        alert('Producto agregado correctamente');
        window.location='Inventario.php';
    </script>
    ";
} else {
    echo "
    <script>
        alert('Error al agregar producto');
        window.location='Agregar_producto.php';
    </script>
    ";
}