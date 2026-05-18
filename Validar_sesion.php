<?php
session_start();
include("conexion.php");
$email = $_POST["email"];
$contrasena = $_POST["contrasena"];
$sql = "SELECT * FROM usuarios
        WHERE email='$email'
        AND contrasena='$contrasena'";
$resultado = $conn->query($sql);
if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();
    $_SESSION['id_usuario'] = $usuario['id_usuario'];
    $_SESSION['nombre'] = $usuario['nombre'];
    $_SESSION['rol'] = $usuario['rol'];
    header("Location: Inicio.php");
} else {
    echo "
    <script>
        alert('Correo o contraseña incorrectos');
        window.location='Iniciar_sesion.html';
    </script>
    ";
}
?>