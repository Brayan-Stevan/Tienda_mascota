<?php
session_start();
 require_once("database/connection.php");
    $db = new Database;
    $con = $db ->conectar();

    if (isset($_POST['registro'])) {
        
        $email = $_POST['email'];
        $documento = $_POST['documento'];

        if (empty($email)|| empty($documento)){
            echo '<script>alert ("llena Los Campos");</script>';
        }

        else {
            $sql = $con->prepare("SELECT * FROM user WHERE email = ? AND id_documento = ?");
            $sql->execute([$email, $documento]);
            $fila = $sql ->  fetchAll(mode: PDO::FETCH_ASSOC);

            if($fila) {
                $_SESSION['documento'] = $documento;
                header("location:nueva_contra.php");
                exit();
            }
            else{
                 echo '<script>alert ("Usuario o Documento Incorrecto");</script>';
            }

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
                <h5 class="fw-bold">RECUPERAR CONTRASEÑA</h5>
                <p class="text-muted">Ingresa tus datos para recuperar tu contraseña</p>
            </div>

            <form name="form1" id="form1" method="POST" enctype="multipart/form-data">

                 <div class="mb-3">
                    <label for="email" class="form-label fw-bold">Email</label>
                    <input type="email" class="form-control conto" id="email" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="documento" class="form-label fw-bold">Documento</label>
                    <input type="number" class="form-control conto" id="documento" name="documento" required>
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