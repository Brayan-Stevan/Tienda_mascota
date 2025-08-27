<?php
session_start();
 require_once("../../database/connection.php");
    $db = new Database;
    $con = $db ->conectar();

    $doc = $_SESSION['doc_user'];

    $sql_user = $con->prepare("SELECT * FROM user INNER JOIN tip_use ON user.id_tipo_user = tip_use.id_tipo_user WHERE user.id_documento = ?");
    $sql_user->execute([$doc]);
    $fila = $sql_user->fetch(PDO::FETCH_ASSOC);

    $sql = $con->prepare(" SELECT mascota.id_mascota, mascota.nombre_mas, mascota.fecha_naci, mascota.sexo, raza.razas, tip_mas.tipo_mascota, user.user FROM mascota
    INNER JOIN raza ON mascota.id_raza = raza.id_raza
    INNER JOIN tip_mas ON raza.id_tipo_mascota = tip_mas.id_tipo_mascota
    INNER JOIN user ON mascota.id_documento = user.id_documento");

    $sql->execute();
    $mascotas = $sql->fetchAll(PDO::FETCH_ASSOC);


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
                            <th>ID_Mascota</th>
                            <th>Nombre</th>
                            <th>Fecha De Nacimiento</th>
                            <th>Sexo</th>
                            <th>Raza</th>
                            <th>Tipo De Mascota</th>
                            <th>Usuario</th>
                            <th>Actualizar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($mascotas as $fila): ?>
                        <tr>
                            <td><?php echo $fila['id_mascota']; ?></td>
                            <td><?php echo $fila['nombre_mas']; ?></td>
                            <td><?php echo $fila['fecha_naci']; ?></td>
                            <td><?php echo $fila['sexo']; ?></td>
                            <td><?php echo $fila['razas']; ?></td>
                            <td><?php echo $fila['tipo_mascota']; ?></td>
                            <td><?php echo $fila['user']; ?></td>
                            <td>
                                <a href="" 
                                    onclick="window.open
                                    ('update_mas.php?id=<?php echo $fila['id_mascota']?>','','width=700,height=700, toolbar=No');
                                    void(null);"><button type="button" class="btn btn-outline-warning">Actualizar</button>
                                </a>
                            </td>
                            <td>
                                <a href="" 
                                    onclick="window.open
                                    ('update_mas.php?id=<?php echo $fila['id_mascota']?>','','width=700,height=700, toolbar=No');
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