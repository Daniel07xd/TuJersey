<?php
include("conexion.php");
$nombre = $_POST['nombre'];
$apellido_paterno = $_POST['apellido_paterno'];
$apellido_materno = $_POST['apellido_materno'];
$email = $_POST['email'];
$contrasena = $_POST['contrasena'];
$verificar = "SELECT * FROM usuarios WHERE email = '$email'";
$resultado = $conn->query($verificar);
if ($resultado->num_rows > 0) {
    echo "
    <script>
        alert('Este correo ya está registrado');
        window.location='Registrar_cuenta.html';
    </script>
    ";
} else {
    $sql = "INSERT INTO usuarios
    (nombre, apellido_paterno, apellido_materno, email, contrasena)
    VALUES
    ('$nombre',
    '$apellido_paterno',
    '$apellido_materno',
    '$email',
    '$contrasena')";
    if($conn->query($sql) === TRUE){
        echo "
        <script>
            alert('Cuenta creada correctamente');
            window.location='Iniciar_sesion.html';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Error al registrar usuario');
            window.location='Registrar_cuenta.html';
        </script>
        ";
    }
}