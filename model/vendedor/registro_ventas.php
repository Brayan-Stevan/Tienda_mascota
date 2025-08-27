<?php
session_start();
 require_once("../../database/connection.php");
    $db = new Database;
    $con = $db ->conectar();

    $doc = $_SESSION['doc_user'];

    $sql_user = $con->prepare("SELECT * FROM user INNER JOIN tip_use ON user.id_tipo_user = tip_use.id_tipo_user WHERE user.id_documento = ?");
    $sql_user->execute([$doc]);
    $fila = $sql_user->fetch(PDO::FETCH_ASSOC);

    $sql = $con->prepare(" SELECT venta.id_venta, venta.fecha_venta, user.user AS user, detalle_venta_art.id_detalle, detalle_venta_art.cantidad, articulo.precio, articulo.nombre_art, detalle_venta_art.sub_total, articulo.id_articulo FROM detalle_venta_art
    INNER JOIN venta ON detalle_venta_art.id_venta = venta.id_venta
    INNER JOIN articulo ON detalle_venta_art.id_articulo = articulo.id_articulo
    INNER JOIN user ON venta.doc_cliente = user.id_documento
    WHERE articulo.doc_vendedor = '" . $_GET['doc'] . "'");

    $sql->execute();
    $articulos = $sql->fetchAll(PDO::FETCH_ASSOC);
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

<body>
    <body class="entero">
    <!-- HEADER -->
    <header>
        <nav class="navbar custom-header">
            <div class="container-fluid">
                <a class="navbar-brand" href="../../index.php">Huellas Store</a>
                <button name="cerrar" class="btn btn-outline-dark" onclick="window.history.back()"><strong>Volver</strong></button>
            </div>
        </nav>
    </header>

    <div class="container">
        <div class="row">
            <div class="col">
                 
                <table class="table table-striped tablas table-hover table-sm table-striped">
                    <thead class="table-warning">
                        <tr>
                            <th>Cliente</th>
                            <th>Fecha De Venta</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($articulos as $fila): ?>
                        <tr>
                            <td><strong><?php echo $fila['user']; ?></strong></td>
                            <td><?php echo $fila['fecha_venta']; ?></td>
                            <td><?php echo $fila['nombre_art']; ?></td>
                            <td><?php echo $fila['cantidad']; ?></td>
                            <td><?php echo "$" . number_format($fila['precio'], 0, ',', ','); ?></td>
                            <td><?php echo "$" . number_format($fila['sub_total'], 0, ',', ','); ?></td>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>