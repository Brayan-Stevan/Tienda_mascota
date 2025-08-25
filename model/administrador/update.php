<?php
session_start();
require_once("../../database/connection.php");
$db = new Database;
$con = $db->conectar();

$sql = $con->prepare("SELECT * FROM user, tip_use 
    WHERE user.id_tipo_user = tip_use.id_tipo_user AND user.id_documento = '" . $_GET['id'] . "'");
$sql->execute();
$usua = $sql->fetch();



?>

<?php

if (isset($_POST['update'])) {
    $doc = $_POST['doc'];
    $nom = $_POST['name'];
    $tele = $_POST['phone'];
    $emai = $_POST['email'];
    $pas = $_POST['pass'];
    $us = $_POST['user'];
    $idusu = $_POST['idusu'];
    $pass_actu = password_hash(password: $pas, algo: PASSWORD_DEFAULT, options: array("pass" => 12));
    $insertSQL = $con->prepare("UPDATE user SET nombre = '$nom', user = '$us', telefono = '$tele', email = '$emai',
        contrasena = '$pass_actu', id_tipo_user = '$idusu' WHERE id_documento = '" . $_GET['id'] . "'");
    $insertSQL->execute();
    $msg = "Actualización exitosa";

} elseif (isset($_POST['delete'])) {
    $insertSQL = $con->prepare("DELETE FROM user WHERE id_documento = '" . $_GET['id'] . "'");
    $insertSQL->execute();
    $msg = "Registro eliminado";
}


?>

<!DOCTYPE html>
<html lang="es">

<script>
    function centrarse(){
        iz=(screen.width-document.body.clientWidth) /2;
        de=(screen.height-document.body.clientHeight) /2;
        moveTo(iz,de);
    }
</script>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body onload="centrarse();" class="bg-light">

    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-lg p-4" style="max-width: 500px; width: 100%;">
            <h3 class="text-center mb-4">Editar Usuario</h3>

            <?php if (!empty($msg)): ?>
                <div class="alert alert-info text-center"><?php echo $msg; ?></div>
            <?php endif; ?>

            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Documento</label>
                    <input type="text" name="doc" class="form-control" value="<?php echo $usua['id_documento']; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $usua['nombre']; ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Teléfono</label>
                    <input type="text" name="phone" class="form-control" value="<?php echo $usua['telefono']; ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $usua['email']; ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <input type="password" name="pass" class="form-control" value="">
                </div>
                <div class="mb-3">
                    <label class="form-label">Usuario</label>
                    <input type="text" name="user" class="form-control" value="<?php echo $usua['user']; ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tipo de Usuario</label>
                    <select name="idusu" class="form-select">
                        <option value="<?php echo $usua['id_tipo_user']; ?>">
                            <?php echo $usua['tipo_user']; ?>
                        </option>
                        <?php
                        $control = $con->prepare("SELECT * FROM tip_use");
                        $control->execute();
                        while ($fila = $control->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='{$fila['id_tipo_user']}'>{$fila['tipo_user']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" name="update" class="btn btn-warning">Actualizar</button>
                    <button type="submit" name="delete" class="btn btn-danger">Eliminar</button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>