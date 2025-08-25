<?php
session_start();
 require_once("../../database/connection.php");
    $db = new Database;
    $con = $db ->conectar();

    $doc = $_SESSION['doc_user'];

    $sql_user = $con->prepare("SELECT * FROM user INNER JOIN tip_use ON user.id_tipo_user = tip_use.id_tipo_user WHERE user.id_documento = ?");
    $sql_user->execute([$doc]);
    $fila = $sql_user->fetch(PDO::FETCH_ASSOC);

    $sql = $con->prepare("SELECT * FROM user INNER JOIN tip_use ON user.id_tipo_user = tip_use.id_tipo_user");
    $sql->execute();
    $usuarios = $sql->fetchAll(PDO::FETCH_ASSOC);

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
                <a class="navbar-brand" href="#">Huellas Store</a>
            </div>
        </nav>
    </header>

    <div class="container">
        <div class="row">
            <div class="col">
                 
                <table class="table table-striped tablas table-hover table-sm table-striped">
                    <thead class="table-warning">
                        <tr>
                            <th>Documento</th>
                            <th>Nombre</th>
                            <th>Telefono</th>
                            <th>Email</th>
                            <th>Usuario</th>
                            <th>Tipo De Usuario</th>
                            <th>Actualizar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $fila): ?>
                        <tr>
                            <td><?php echo $fila['id_documento']; ?></td>
                            <td><?php echo $fila['nombre']; ?></td>
                            <td><?php echo $fila['telefono']; ?></td>
                            <td><?php echo $fila['email']; ?></td>
                            <td><?php echo $fila['user']; ?></td>
                            <td><?php echo $fila['tipo_user']; ?></td>
                            <td>
                                <a href="" 
                                    onclick="window.open
                                    ('update.php?id=<?php echo $fila['id_documento']?>','','width=700,height=700, toolbar=No');
                                    void(null);"><button type="button" class="btn btn-outline-warning">Actualizar</button>
                                </a>
                            </td>
                            <td>
                                <a href="" 
                                    onclick="window.open
                                    ('update.php?id=<?php echo $fila['id_documento']?>','','width=700,height=700, toolbar=No');
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
    <button class="btn btn-outline-secondary btn-back2" onclick="window.history.back()">
        <i class="bi bi-arrow-left"></i> Volver
    </button>
</body>
</html>