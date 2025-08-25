<?php
session_start();
 require_once("../../database/connection.php");
    $db = new Database;
    $con = $db ->conectar();

    if (isset($_POST['articulo'])) {

        $nombre = $_POST['nombre_art'];
        $precio = $_POST['precio'];
        $descrip = $_POST['descrip'];
        $imagen = $_POST['image'];
        $tipo_articulo = $_POST['tipo_articulo'];
        $tipo_user = $_POST['tipo_user'];


        $sql = $con->prepare("SELECT * FROM articulo WHERE nombre_art = '$nombre' OR descripcion = '$descrip'");
        $sql -> execute();

        $fila = $sql ->  fetchAll(mode: PDO::FETCH_ASSOC);
        if ($fila) {
            echo '<script>alert ("El Nombre O La Descripcion Ya Existe");</script>';
            echo '<script>window.location="arti_insert.php."</script>';
        }

        else if ($nombre == "" || $precio == "" || $descrip == "" || $imagen == "" || $tipo_articulo == "" || $tipo_user == "" ) {
            echo '<script>alert("DATOS VACIOS, POR FAVOR DELIGENCIE");</script>';
            echo '<script>window.location="arti_insert.php"</script>';
        }

        else {

            $insertSQL = $con-> prepare("INSERT INTO articulo(nombre_art, precio, descripcion, imagen, id_tipo_articulo, id_documento)
            VALUES ('$nombre', '$precio', '$descrip', '$imagen', '$tipo_articulo', '$tipo_user')");
            $insertSQL -> execute();
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
    <link rel="stylesheet" href="../../css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2&family=Chewy&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="sign-up">

    <div class="container d-flex justify-content-center align-items-center py-5">
        <div class="form-card shadow-lg p-4">
            <div class="text-center mb-2">
                <h5 class="fw-bold">VENDER ARTICULO</h5>
                <p class="text-muted">Vende tu articulo para para crecer juntos</p>
            </div>

            <form name="form1" id="form1" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nombre_art" class="form-label fw-bold">Nombre</label>
                    <input type="text" class="form-control" id="nombre_art" name="nombre_art" required>
                </div>

                <div class="mb-3">
                    <label for="precio" class="form-label fw-bold">Precio</label>
                    <input type="number" class="form-control" id="precio" name="precio" required>
                </div>

                <div class="mb-3">
                    <label for="descrip" class="form-label fw-bold">Descripción</label>
                    <textarea class="form-control" id="descrip" name="descrip" rows="4" placeholder="Escribe la descripción..."></textarea>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label fw-bold">Imagen</label>
                    <input type="text" class="form-control" id="image" name="image" required>
                </div>
                
                <div class="mb-3">
                <label for="tipo_art" class="form-label fw-bold">Tipo De Articulo</label>
                <select name="tipo_articulo" id="tipo_articulo" class="form-select sol">
                    <option value="">Seleccione Tipo De Articulo</option>
                    <?php
                    $control = $con->prepare("SELECT * FROM tip_art WHERE id_tipo_articulo IN (1, 2, 3, 4)");
                    $control->execute();

                    while ($tp = $control->fetch(mode: PDO::FETCH_ASSOC)) {
                        echo '<option value="' . $tp['id_tipo_articulo'] . '">' . $tp['tipo_articulo'] . '</option>';
                    }

                    ?>
                </select>
                </div>

                <div class="mb-3">
                <label for="tipo_use" class="form-label fw-bold">Selecciona Usuario</label>
                <select name="tipo_user" id="tipo_user" class="form-select sol">
                    <option value="">Seleccione Usuario</option>
                    <?php
                        $control = $con->prepare("SELECT user.id_documento, user.user, tip_use.tipo_user FROM user INNER JOIN tip_use ON user.id_tipo_user = tip_use.id_tipo_user WHERE user.id_tipo_user = 3");
                        $control->execute();

                        while ($tp = $control->fetch(mode: PDO::FETCH_ASSOC)) {
                            echo '<option value="' . $tp['id_documento'] . '">' . $tp['user'] . '</option>';
                        }

                    ?>
                </select>
                </div>
                <div class="d-grid">
                    <input type="submit" class="btn btn-registro" value="REGISTRAR" name="articulo" style="font-size: 14px;">
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