<?php
require_once("database/connection.php");
$db = new Database;
session_start();
$con = $db->conectar();

if (isset($_POST['registro'])) {

    $documento = $_POST['documento'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    $tipo_user = $_POST['tipo_user'];

    $sql = $con->prepare("SELECT * FROM user WHERE id_documento = '$documento' OR telefono = '$telefono' OR email = '$email' OR user = '$usuario'");
    $sql->execute();
    $fila = $sql->fetchAll(mode: PDO::FETCH_ASSOC);

    if ($fila) {
        echo '<script>alert ("El usuario, documento, telefono o email ya existe");</script>';
        echo '<script>window.location="registro.php"</script>';
    } else if ($documento == "" || $nombre == "" || $telefono == "" || $email == "" || $usuario == "" || $password == "" || $tipo_user == "") {
        echo '<script>alert("DATOS VACIOS, POR FAVOR DELIGENCIE");</script>';
        echo '<script>window.location="registro.php"</script>';
    } else {
        $pass_cifrado = password_hash($password, PASSWORD_DEFAULT, array("pass" => 12));

        $insertSQL = $con->prepare("INSERT INTO user(id_documento, nombre, telefono, email, user, contrasena, id_tipo_user)
            VALUES ('$documento', '$nombre', '$telefono', '$email', '$usuario', '$pass_cifrado', '$tipo_user')");
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
        <div class="form-card2 shadow-lg p-4 w-100" style="max-width: 900px;">
            <div class="text-center mb-4">
                <img src="img/logo3.png" alt="logoform" id="logoform" class="img-fluid mb-3" style="max-width: 120px;">
                <h5 class="fw-bold">CREA TU CUENTA</h5>
                <p class="text-muted">Crea tu cuenta para navegar por nuestra página</p>
            </div>

            <form name="form1" id="form1" method="POST" enctype="multipart/form-data">
                <div class="row g-5">
                    <!-- Bloque 1 -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="documento" class="form-label fw-bold">Documento</label>
                            <input type="number" class="form-control con" id="documento" name="documento" required>
                        </div>

                        <div class="mb-3">
                            <label for="nombre" class="form-label fw-bold">Nombre</label>
                            <input type="text" class="form-control con" id="nombre" name="nombre" required>
                        </div>

                        <div class="mb-3">
                            <label for="telefono" class="form-label fw-bold">Teléfono</label>
                            <input type="number" class="form-control con" id="telefono" name="telefono" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control con" id="email" name="email" required>
                        </div>
                    </div>

                    <!-- Bloque 2 -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="usuario" class="form-label fw-bold">Usuario</label>
                            <input type="text" class="form-control con" id="usuario" name="usuario" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">Contraseña</label>
                            <input type="password" class="form-control con" id="password" name="password" required>
                        </div>

                        <div class="mb-3">
                            <label for="tipo_user" class="form-label fw-bold">Tipo de Usuario</label>
                            <select name="tipo_user" id="tipo_user" class="form-select con" required>
                                <option value="">Seleccione Tipo Usuario</option>
                                <?php
                                $control = $con->prepare("SELECT * FROM tip_use WHERE id_tipo_user IN (1, 3)");
                                $control->execute();

                                while ($tp = $control->fetch(PDO::FETCH_ASSOC)) {
                                    echo '<option value="' . $tp['id_tipo_user'] . '">' . $tp['tipo_user'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Botón en fila completa -->
                <div class="d-grid mt-3">
                    <input type="submit" class="btn btn-registro" value="REGISTRAR" name="registro" style="font-size: 14px;">
                </div>
            </form>
        </div>
    </div>

        <button class="btn btn-light btn-back" onclick="window.history.back()">
            <i class="bi bi-arrow-left"></i>  Volver
        </button>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>