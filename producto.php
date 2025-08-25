<?php
session_start();
require_once("database/connection.php");
$db = new Database;
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="entero">
    <!-- HEADER -->
    <header>
        <nav class="navbar custom-header">
            <div class="container-fluid">
                <a class="navbar-brand" href="../../index.php">Huellas Store</a>

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
                                <a class="nav-link active" aria-current="page" href="#">Home</a>
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

    <div class="container py-5">
        <div class="row g-4">
            <?php

            require_once("database/connection.php");
            $db = new Database;
            $con = $db->conectar();


            $sql = $con->prepare("SELECT articulo.*, user.user FROM articulo INNER JOIN user ON articulo.id_documento = user.id_documento 
            WHERE articulo.id_articulo = '" . $_GET['id'] . "'");

            $sql->execute();
            $producto = $sql->fetch(PDO::FETCH_ASSOC);

            ?>

            <div class="col-md-6">
                <div class="col-10">
                    <img src="<?php echo $producto['imagen']; ?>" class="img-fluid border rounded shadow-sm" alt="producto">
                </div>
            </div>

            <div class="col-md-6 product">
                <h6 class="text-muted">Nuevo</h6>
                <h3><?php echo $producto['nombre_art']; ?></h3>
                <h2 class="text-secondary fw-bold"><?php echo "$" . number_format($producto['precio'], 0, ',', ','); ?></h2>

                <p class="text-success">Envío gratis a todo el país</p>
                <p class="text-black"><?php echo $producto['descripcion']; ?></p>

                <form action="procesar_venta.php?id=<?php echo $producto['id_articulo']; ?>" method="POST">
                    <div class="mb-3">
                        <label for="cantidad" class="form-label fw-bold">Cantidad</label>
                        <input type="number" name="cantidad" id="cantidad" class="form-control w-25" value="1" min="1" required>
                    </div>
                    <br>
                    <div class="mb-3">
                        <select name="users" id="users" class="form-select w-50" required>
                            <option value="">Seleccione Tu Usuario</option>
                            <?php
                            $control = $con->prepare("SELECT user.id_documento, user.user, tip_use.tipo_user FROM user INNER JOIN tip_use ON user.id_tipo_user = tip_use.id_tipo_user WHERE user.id_tipo_user = (1)");
                            $control->execute();

                            while ($tp = $control->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value="' . $tp['id_documento'] . '">' . $tp['user'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="d-flex card-shop gap-4">
                        <button type="submit" class="btn btn-primary" name="comprar">Comprar Ahora</button>
                    </div>
                </form>
                <br>

                <hr>
                <p class="small text-muted">Vendido por <strong><?php echo $producto['user']; ?></strong></p>
                <p class="small">Huellas Store | +500 ventas</p>
            </div>

        </div>
        <div class="mb-3 btn-pro">
        <button class="btn btn-outline-secondary" onclick="window.history.back()">
            <i class="bi bi-arrow-left"></i> Volver
        </button>
        </div>
    </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</body>

</html>