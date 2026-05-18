<?php
include("conexion.php");
$email = $_POST["email"];
$contrasena = $_POST["contrasena"];
$sql = "SELECT * FROM usuarios
        WHERE email='$email'
        AND contrasena='$contrasena'";
$resultado = $conn->query($sql);
if ($resultado->num_rows > 0) {
    header("Location: Inicio.html");
} else {
    echo "
    <script>
        alert('Correo o contraseña incorrectos');
        window.location='Iniciar_sesion.html';
    </script>
    ";
}
?>