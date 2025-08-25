<?php
session_start();
require_once("../../database/connection.php");
$db = new Database;
$con = $db->conectar();

$doc = $_SESSION['doc_user'];

$sql = $con->prepare("SELECT * FROM user INNER JOIN tip_use ON user.id_tipo_user = tip_use.id_tipo_user WHERE user.id_documento = $doc");

$sql->execute();
$fila = $sql->fetch();


?>

<?php
if (isset($_POST['cerrar'])) {
    session_destroy();
    header("Location: ../../index.php");
    exit();
}
?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Tienda Huellas Store</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2&family=Chewy&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="entero1">
    <!-- HEADER -->
    <header>
        <nav class="navbar custom-header">
            <div class="container-fluid">
                <h5>Bienvenido Señ@r <?php echo $fila['user']; ?> Tu Rol Es <?php echo $fila['tipo_user']; ?></h5>
                <form method="post">
                    <button type="submit" name="cerrar" class="btn btn-outline-dark">Cerrar Sesión</button>
                    <!-- <input type="submit" name="cerrar" value="Cerrar Sesión" class="cerrar"> -->
                </form>
            </div>
        </nav>
    </header>

    <section class="container con my-5">
        <div class="row justify-content-center contas1">

            <!-- Card 1 -->
            <div class="col-md-4 mb-4 d-flex justify-content-center">
                <a href="vender_arti.php" class="text-decoration-none text-dark w-100">
                    <div class="card custom text-center shadow-lg rounded-4 p-3 h-100">
                        <div class="card-body">
                            <i class="bi bi-cart-plus-fill text-white fs-1"></i>
                            <h4 class="mt-3 text-white">VENDER ARTICULOS</h4>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Card 2 -->
            <div class="col-md-4 mb-4 d-flex justify-content-center">
                <a href="registro_vendedor.php?doc=<?php echo $fila['id_documento']; ?>" class="text-decoration-none text-dark w-100">
                    <div class="card custom text-center shadow-lg rounded-4 p-3 h-100">
                        <div class="card-body">
                            <i class="bi bi-cart-check-fill text-white fs-1"></i>
                            <h4 class="mt-3 text-white">REGISTRO DE ARTICULOS</h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4 d-flex justify-content-center">
                <a href="registro_ventas.php?doc=<?php echo $fila['id_documento']; ?>" class="text-decoration-none text-dark w-100">
                    <div class="card custom text-center shadow-lg rounded-4 p-3 h-100">
                        <div class="card-body">
                            <i class="bi bi-cart-check-fill text-white fs-1"></i>
                            <h4 class="mt-3 text-white">REGISTRO DE VENTAS</h4>
                        </div>
                    </div>
                </a>
            </div>
            <button class="btn btn-outline-light btn-largo1" onclick="window.history.back()">
                <i class="bi bi-arrow-left"></i> Volver
            </button>
        </div>
    </section>


</body>

</html>