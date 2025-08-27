<?php
require_once("database/connection.php");
$db = new Database;
session_start();
$con = $db->conectar();


if (isset($_POST["inicio"])) {

    $email = $_POST["email"];
    $contra = $_POST["password"];

    $sql = $con->prepare("SELECT * FROM user WHERE email = ? ");
    $sql->execute([$email]);
    $fila = $sql->fetch();

    if ($fila && password_verify($contra, $fila['contrasena'])) {

        $_SESSION['id_user'] = $fila['id_documento'];
        $_SESSION['nombres'] = $fila['nombre'];
        $_SESSION['telefono'] = $fila['telefono'];
        $_SESSION['email'] = $fila['email'];
        $_SESSION['usuario'] = $fila['user'];
        $_SESSION['doc_user'] = $fila['id_documento'];
        $_SESSION['tipo'] = $fila['id_tipo_user'];


        if ($_SESSION['tipo'] == 1) {
            header("Location: model/usuario/index.php");
            exit();
        }

        if ($_SESSION['tipo'] == 2) {
            header("Location: model/administrador/index.php");
            exit();
        }

        if ($_SESSION['tipo'] == 3) {
            header("Location: model/vendedor/index.php");
            exit();
        }
    } else {
        echo '<script>alert("Usuario o contraseña incorrecto");</script>';
        echo '<script>window.location="index.php";</script>';
        exit();
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Tienda Huellas Store</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2&family=Chewy&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>

<body class="entero">
    <!-- HEADER -->
    <header>
        <nav class="navbar custom-header fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Huellas Store</a>
                <a class="registro" href="registro.php">Sign Up</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Huellas Store</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <form class="d-flex" role="search">
                                <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search" />
                            </form>
                            <br>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Iniciar Sesión
                                </a>
                                <div class="dropdown-menu p-4">
                                    <form method="POST" name="form1" id="form1">
                                        <div class="mb-3">
                                            <label for="exampleDropdownFormEmail2" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="exampleDropdownFormEmail2" placeholder="usuario@gmail.com" name="email">
                                        </div>

                                        <div class="mb-3">
                                            <label for="exampleDropdownFormPassword2" class="form-label">Contraseña</label>
                                            <input type="password" class="form-control" id="exampleDropdownFormPassword2" placeholder="Ingresa tu contraseña" name="password">
                                        </div>
                                        <br>
                                        <input type="submit" name="inicio" id="inicio" class="btn btn-registro w-100" value="Ingresar"></input>
                                        <div class="mb-3 recorda">
                                            <a href="cambiar_contra.php" class="recordar">Recordar Contraseña ?</a>
                                        </div>
                                    </form>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="registro_mascota.php">Registrar Mascota</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Sección
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Perros</a></li>
                                    <li><a class="dropdown-item" href="#">Gatos</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Todo</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!--  CAROUSEL -->
    <section class="carousel">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-interval="7000">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/foto9.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Bienvenidos A Huellas Store</h5>
                        <p>Todo lo que tu mascota necesita en un solo lugar</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="img/foto3.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Alimento Premium</h5>
                        <p>Nutrición de calidad para que tu mejor amigo crezca sano y fuerte</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="img/foto14.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Juguetes y Accesorios</h5>
                        <p>Diversión y comodidad para cada día de tu mascota</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <!-- PRODUCTOS -->
    <section id="productos" class="container1 py-15">
        <div class="container my-5">
            <h2 class="text-center mb-4">Nuestros Productos</h2>
            <div class="row row-cols-1 row-cols-md-3 g-4">

                <?php
                // Conexión
                require_once("database/connection.php");
                $db = new Database;
                $con = $db->conectar();

                // Traer todos los productos
                $sql = $con->prepare(" SELECT articulo.*, user.user FROM articulo INNER JOIN user ON articulo.doc_vendedor = user.id_documento");
                $sql->execute();
                $productos = $sql->fetchAll(PDO::FETCH_ASSOC);

                // Recorrer y mostrar cards
                foreach ($productos as $producto) {
                ?>
                    <div class="col">
                        <div class="card h-100 shadow-sm card-dog">
                            <img src="<?php echo $producto['imagen']; ?>" class="card-img-top" alt="<?php echo $producto['nombre_art']; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $producto['nombre_art']; ?></h5>
                                <h4><?php echo "$" . number_format($producto['precio'], 0, ',', ','); ?></h4>
                                <p class="card-text"><?php echo $producto['descripcion']; ?></p>
                                <p class="small text-muted">Publicado por <strong><?php echo $producto['user']; ?></strong></p>
                        
                                <a href="producto.php?id=<?php echo $producto['id_articulo']; ?>" class="btn btn-primary">Comprar</a>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>

            </div>
        </div>
    </section>

    <nav aria-label="Page navigation example" class="paginas">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>


    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p class="mb-0">&copy; 2025 Huellas Store. Todos los derechos reservados.</p>
    </footer>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>
</body>

</html>