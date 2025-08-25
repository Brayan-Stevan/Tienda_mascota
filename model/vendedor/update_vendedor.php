<?php
session_start();
 require_once("../../database/connection.php");
    $db = new Database;
    $con = $db ->conectar();

    $sql = $con -> prepare("SELECT * FROM articulo, tip_art 
    WHERE articulo.id_tipo_articulo = tip_art.id_tipo_articulo AND articulo.id_articulo = '".$_GET['id']."'");
    $sql -> execute();
    $usua = $sql -> fetch();

?>

<?php

    if (isset($_POST['update']))
    {
        $id_arti = $_POST['id_art'];
        $nomb = $_POST['name_art'];
        $precio = $_POST['prec'];
        $descripc = $_POST['desc'];
        $imag = $_POST['img'];
        $idusu = $_POST['idusu'];
        $insertSQL = $con ->prepare ( "UPDATE articulo SET id_articulo = '$id_arti', nombre_art = '$nomb', precio = '$precio', descripcion = '$descripc', imagen = '$imag',
        id_tipo_articulo = '$idusu' WHERE id_articulo = '".$_GET['id']."'");
        $insertSQL->execute();
        $msg = "Actualización exitosa";

        
    }

    elseif (isset($_POST['delete']))
    {
        $insertSQL = $con->prepare("DELETE FROM articulo WHERE id_articulo = '".$_GET['id']."'");
        $insertSQL->execute();
        $msg = "Registro eliminado";
    }


?>

<!DOCTYPE html>
<html lang="en">

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
    <title>Actualizar Articulo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body onload="centrarse();" class="bg-light">

    <div class="container mt-6">
        
            <h2 class="text-center mb-4">Actualizar Articulo</h2>
            <?php if (!empty($msg)): ?>
                <div class="alert alert-info text-center"><?php echo $msg; ?></div>
            <?php endif; ?>

            <form autocomplete="off" name="frm_consulta" method="post">

                <div class="mb-3">
                    <label class="form-label">ID Articulo</label>
                    <input type="number" class="form-control" name="id_art" 
                        value="<?php echo $usua['id_articulo']?>" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="name_art" 
                        value="<?php echo $usua['nombre_art']?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Precio</label>
                    <input type="number" class="form-control" name="prec" 
                        value="<?php echo $usua['precio']?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea class="form-control" name="desc" rows="3"><?php echo $usua['descripcion']?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Imagen</label>
                    <input type="text" class="form-control" name="img" 
                        value="<?php echo $usua['imagen']?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Tipo de Articulo</label>
                    <select class="form-select" name="idusu">
                        <option value="<?php echo($usua['id_tipo_articulo'])?>" selected>
                            <?php echo($usua['tipo_articulo'])?>
                        </option>
                        <?php
                            $control = $con -> prepare ("SELECT * FROM tip_art");
                            $control -> execute();

                            while($fila = $control->fetch(PDO::FETCH_ASSOC))
                            {
                                echo "<option value='" . $fila['id_tipo_articulo'] . "'>"
                                . $fila['tipo_articulo'] . "</option>";
                            }
                        ?>
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" name="update" class="btn btn-warning w-50 me-2">Actualizar</button>
                    <button type="submit" name="delete" class="btn btn-danger w-50 ms-2">Eliminar</button>
                </div>

            </form>
        
    </div>

</body>
</html>
