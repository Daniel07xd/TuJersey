<?php
session_start();
include("conexion.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nosotros</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>    
    <?php include 'navbar.php'; ?>

    <main class="container py-5">
        <header class="text-center mb-5">
            <h2>Sobre Nosotros</h2>
            <p class="intro">
                Detrás de TuJersey hay cuatro estudiantes de la <strong>Facultad de Ingeniería Mecánica y Eléctrica (FIME)</strong>.  
                Más allá de solo vender Jerseys, nuestro objetivo fue aplicar todo lo que hemos aprendido sobre arquitectura de sistemas y gestión documental en un entorno real. 
                Quisimos construir una plataforma sólida y fácil de usar. ¡Gracias por echarle un ojo a nuestro trabajo final!
            </p>
        </header>

        <section class="equipo-grid">
            <article class="tarjeta-integrante">
                <div class="perfil-icono">👤</div>
                <h3>Daniel Isaí de Haro Rodríguez</h3>
                <hr>
                <p class="contacto">isai.deharor.@uanl.edu.mx</p>
            </article>

            <article class="tarjeta-integrante">
                <div class="perfil-icono">👤</div>
                <h3>Jesús Alberto Cabrera García</h3>
                <hr>
                <p class="contacto">albertogarcab29@gmail.com</p>
            </article>

            <article class="tarjeta-integrante">
                <div class="perfil-icono">👤</div>
                <h3>Héctor Abiud Garza Torres</h3>
                <hr>
                <p class="contacto">hectorabiudgarzatorres@gmail.com</p>
            </article>

            <article class="tarjeta-integrante">
                <div class="perfil-icono">👤</div>
                <h3>Daeed Jair García Álvarez</h3>
                <hr>
                <p class="contacto">Daeedgar@gmail.com</p>
            </article>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>