<?php
session_start();
 require_once("database/connection.php");
    $db = new Database;
    $con = $db ->conectar();

    if (!isset($_SESSION['documento'])) {
    echo '<script>alert("Acceso no autorizado.");</script>';
    echo '<script>window.location="cambiar_contra.php";</script>';
    exit();
    }

    $documento = $_SESSION['documento'];

    if (isset($_POST['registro'])) {
        $contrasena = $_POST["password1"];
        $confirmar_contrasena = $_POST["password2"];

        if (empty($contrasena)|| empty($confirmar_contrasena)){
            echo '<script>alert ("llena Los Campos");</script>';
        }

        elseif ($contrasena !== $confirmar_contrasena) {
            echo '<script>alert ("Las contraseñas no coinciden");</script>';
            echo '<script>window.location="nueva_contra.php";</script>';
            exit();
        }

        else {
            $pass_cifrado = password_hash($contrasena, PASSWORD_DEFAULT);

            $sql = $con->prepare("UPDATE user SET contrasena = ? WHERE id_documento = ?");
            $sql->execute([$pass_cifrado, $documento]);

            unset($_SESSION['documento']);
            echo '<script>alert("Contraseña actualizada con éxito.");</script>';
            echo '<script>window.location="index.php";</script>';


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
        <div class="form-card1 shadow-lg p-4">
            <div class="text-center mb-2">
                <img src="img/logo3.png" alt="logoform" id="logoform" class="img-fluid mb-3" style="max-width: 120px;">
                <h5 class="fw-bold">NUEVA CONTRASEÑA</h5>
                <p class="text-muted">Ingresa tu nueva contraseña</p>
            </div>

            <form name="form1" id="form1" method="POST" enctype="multipart/form-data">

                <div class="mb-3">
                    <label for="password" class="form-label fw-bold">Contraseña</label>
                    <input type="password" class="form-control conto" id="password1" name="password1" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-bold">Confirmar Contraseña</label>
                    <input type="password" class="form-control conto" id="password1" name="password2" required>
                </div>

                <div class="d-grid regis">
                    <input type="submit" class="btn btn-registro" value="VALIDAR" name="registro" style="font-size: 14px;">
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