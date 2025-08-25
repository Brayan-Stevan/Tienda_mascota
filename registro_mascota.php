<?php
require_once("database/connection.php");
$db = new Database;
session_start();
$con = $db->conectar();

if (isset($_POST['mascota'])) {

    $nombre = $_POST['nombre_mas'];
    $fecha = $_POST['fecha'];
    $genero = $_POST['genero'];
    $tipo_raza = $_POST['tipo_raza'];
    $users = $_POST['users'];

    $sql = $con->prepare("SELECT * FROM mascota INNER JOIN user WHERE nombre_mas = '$nombre' OR user = '$users'");
    $sql->execute();

    $fila = $sql->fetchAll(mode: PDO::FETCH_ASSOC);
    if ($fila) {
        echo '<script>alert ("El Nombre O Usuario Ya Existe");</script>';
        echo '<script>window.location="registro_mascota.php."</script>';
    } else if ($nombre == "" || $fecha == "" || $genero == "" || $tipo_raza == "" || $users == "") {
        echo '<script>alert("DATOS VACIOS, POR FAVOR DELIGENCIE");</script>';
        echo '<script>window.location="registro_mascota.php"</script>';
    } else {

        $insertSQL = $con->prepare("INSERT INTO mascota(nombre_mas, fecha_naci, sexo, id_documento, id_raza)
            VALUES ('$nombre', '$fecha', '$genero', '$users', '$tipo_raza')");
        $insertSQL->execute();
        echo '<script>alert("Se Inserto El Registro Exitosamente");</script>';
        echo '<script> window.location="index.php" </script>';
    }
}


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2&family=Chewy&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="sign-up">

    <div class="container d-flex justify-content-center align-items-center py-5">
        <div class="form-card shadow-lg p-4">
            <div class="text-center mb-2">
                <img src="img/logo3.png" alt="logoform" id="logoform" class="img-fluid mb-3" style="max-width: 120px;">
                <h5 class="fw-bold">REGISTRA TU MASCOTA</h5>
                <p class="text-muted">Registra tu mascota para poder disfrutar todos los servicios</p>
            </div>

            <form name="form1" id="form1" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nombre" class="form-label fw-bold">Nombre</label>
                    <input type="text" class="form-control" id="nombre_mas" name="nombre_mas" required>
                </div>
                
                <div class="mb-3">
                    <label for="tipo_mas" class="form-label fw-bold">Tipo De Mascota</label>
                    <select name="tipo_mascota" id="tipo_mascota" class=" form-select sol">
                        <option value="">Seleccione Tipo De Mascota</option>
                        <?php
                        $control = $con->prepare("SELECT * FROM tip_mas WHERE id_tipo_mascota IN (1, 2)");
                        $control->execute();

                        while ($tp = $control->fetch(mode: PDO::FETCH_ASSOC)) {
                            echo '<option value="' . $tp['id_tipo_mascota'] . '">' . $tp['tipo_mascota'] . '</option>';
                        }

                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tipo_raz" class="form-label fw-bold">Raza</label>
                    <select name="tipo_raza" id="tipo_raza" class=" form-select sol">
                        <option value="">Seleccione Tipo De Raza</option>
                        <?php
                        $control = $con->prepare("SELECT * FROM raza WHERE id_tipo_mascota IN (1, 2)");
                        $control->execute();

                        while ($tp = $control->fetch(mode: PDO::FETCH_ASSOC)) {
                            echo '<option value="' . $tp['id_raza'] . '">' . $tp['razas'] . '</option>';
                        }

                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="fecha" class="form-label fw-bold">Fecha De Nacimiento</label>
                    <input type="date" class="form-control" id="fecha" name="fecha" required>
                </div>
                
                <div class="mb-3">
                    <label for="sexo"  class="form-label fw-bold">Sexo</label>
                    <select class="form-select sol" name="genero" id="genero" required>
                        <option value="">Seleccione Tipo De Sexo</option>
                        <option value="Macho">Macho</option>
                        <option value="Hembra">Hembra</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="users" class="form-label fw-bold">Seleccion de usuario</label>
                    <select name="users" id="users" class=" form-select sol">
                        <option value="">Seleccione Tu Usuario</option>
                        <?php
                        $control = $con->prepare("SELECT user.id_documento, user.user, tip_use.tipo_user FROM user INNER JOIN tip_use ON user.id_tipo_user = tip_use.id_tipo_user WHERE user.id_tipo_user = 1");
                        $control->execute();

                        while ($tp = $control->fetch(mode: PDO::FETCH_ASSOC)) {
                            echo '<option value="' . $tp['id_documento'] . '">' . $tp['user'] . '</option>';
                        }

                        ?>
                    </select>
                </div>
                <div class="d-grid">
                    <input type="submit" class="btn btn-registro" value="REGISTRAR" name="mascota" style="font-size: 14px;">
                </div>
            </form>
        </div>
    </div>
        <button class="btn btn-light btn-back1" onclick="window.history.back()">
            <i class="bi bi-arrow-left"></i>  Volver
        </button>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>