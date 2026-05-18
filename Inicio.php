<?php include("conexion.php"); ?>
<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de inicio</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <?php include("navbar.php"); ?>
    
    <div class="text-center align-items-center p-3">
        <h2>Algunos de nuestros productos:</h2>
        <div id="carouselExample" class="carousel slide w-25 mx-auto">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="./Images/JerseyTigresLocal.jpg" class="d-block w-100 object-fit-cover" alt="">
                    <h5 class="text-black">Jersey de Tigres Local 2025</h5>
                </div>
                <div class="carousel-item">
                    <img src="./Images/JerseyRayadosLocal.jpg" class="d-block w-100 object-fit-cover" alt="">
                    <h5 class="text-black">Jersey de Rayados Local 2025</h5>
                </div>
                <div class="carousel-item">
                    <img src="./Images/JerseyChivasLocal.jpg" class="d-block w-100 object-fit-cover" alt="">
                    <h5 class="text-black">Jersey de Chivas Local 2025</h5>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="JS/Funciones.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>