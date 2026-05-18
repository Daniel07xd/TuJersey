<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">
        <a class="navbar-brand fw-bold">Tu Jersey</a>
        <div>
            <ul class="navbar-nav">
                <li class="nav-item fw-bold"><a class="nav-link" href="Inicio.php">Inicio</a></li>
                <?php if(isset($_SESSION['id_usuario']) && $_SESSION['rol'] == 'admin'){ ?>
                <li class="nav-item fw-bold"><a class="nav-link" href="Inventario.php">Inventario</a></li>
                <li class="nav-item fw-bold"><a class="nav-link" href="Ordenes.php">Órdenes</a></li>
                <li class="nav-item fw-bold"><a class="nav-link" href="Ventas.php">Ventas</a></li>
                <?php } ?>
                <?php if(!isset($_SESSION['id_usuario']) || $_SESSION['rol'] != 'admin'){ ?>
                <li class="nav-item fw-bold"><a class="nav-link" href="Catalogo.php">Catálogo</a></li>
                <?php } ?>
                <?php if(isset($_SESSION['id_usuario'])){ ?>
                <?php if($_SESSION['rol'] != 'admin'){ ?>
                <li class="nav-item fw-bold"><a class="nav-link" href="Carrito.php">Carrito</a></li>
                <li class="nav-item fw-bold"><a class="nav-link" href="Historial.php">Historial</a></li>
                <?php } ?>
                <li class="nav-item fw-bold"><a class="nav-link" href="Cerrar_sesion.php" id="cerrarSesion">Cerrar sesión</a></li>
                <?php } else { ?>
                <li class="nav-item fw-bold"><a class="nav-link" href="Iniciar_sesion.html">Iniciar sesión</a></li>
                <?php } ?>
                <li class="nav-item fw-bold"><a class="nav-link" href="Nosotros.php">Sobre nosotros</a></li>
            </ul>
        </div>
    </div>
</nav>