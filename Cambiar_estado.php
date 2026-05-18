<?php
session_start();
include("conexion.php");
if(!isset($_SESSION['id_usuario']) || $_SESSION['rol'] != 'admin'){
    header("Location: Inicio.php");
    exit();
}
$id_orden = $_POST['id_orden'];
$estado = $_POST['estado'];
$sql = "UPDATE ordenes
        SET estado = '$estado'
        WHERE id_orden = '$id_orden'";
if($conn->query($sql)){
    echo "
    <script>
        alert('Estado actualizado correctamente');
        window.location='ordenes.php';
    </script>
    ";
} else {
    echo "
    <script>
        alert('Error al actualizar estado');
        window.location='ordenes.php';
    </script>
    ";
}
?>