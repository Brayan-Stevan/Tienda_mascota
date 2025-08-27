<?php
session_start();
 require_once("../../database/connection.php");
    $db = new Database;
    $con = $db ->conectar();

    $doc = $_SESSION['doc_user'];

    $sql_user = $con->prepare("SELECT * FROM user INNER JOIN tip_use ON user.id_tipo_user = tip_use.id_tipo_user WHERE user.id_documento = ?");
    $sql_user->execute([$doc]);
    $fila = $sql_user->fetch(PDO::FETCH_ASSOC);

    $sql = $con->prepare("SELECT * FROM articulo INNER JOIN tip_art ON articulo.id_tipo_articulo = tip_art.id_tipo_articulo INNER JOIN user ON articulo.doc_vendedor = user.id_documento");
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
                            <th>ID_Articulo</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Descripcion</th>
                            <th>Imagen</th>
                            <th>Tipo De Articulo</th>
                            <th>Publicado</th>
                            <th>Actualizar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($articulos as $fila): ?>
                        <tr>
                            <td><?php echo $fila['id_articulo']; ?></td>
                            <td><?php echo $fila['nombre_art']; ?></td>
                            <td><?php echo "$" . number_format($fila['precio'], 0, ',', ','); ?></td>
                            <td><?php echo $fila['descripcion']; ?></td>
                            <td><?php echo $fila['imagen']; ?></td>
                            <td><?php echo $fila['tipo_articulo']; ?></td>
                            <td><?php echo $fila['user']; ?></td>
                            <td>
                                <a href="" 
                                    onclick="window.open
                                    ('update_art.php?id=<?php echo $fila['id_articulo']?>','','width=700,height=700, toolbar=No');
                                    void(null);"><button type="button" class="btn btn-outline-warning">Actualizar</button>
                                </a>
                            </td>
                            <td>
                                <a href="" 
                                    onclick="window.open
                                    ('update_art.php?id=<?php echo $fila['id_articulo']?>','','width=700,height=700, toolbar=No');
                                    void(null);"><button type="button" class="btn btn-outline-danger">Eliminar</button>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>