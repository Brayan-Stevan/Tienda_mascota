<?php
session_start();
 require_once("../../database/connection.php");
    $db = new Database;
    $con = $db ->conectar();

    $sql = $con->prepare(" SELECT mascota.id_mascota, mascota.nombre_mas, mascota.fecha_naci, mascota.sexo, raza.id_raza, raza.razas, tip_mas.id_tipo_mascota, tip_mas.tipo_mascota FROM mascota
    INNER JOIN raza ON mascota.id_raza = raza.id_raza
    INNER JOIN tip_mas ON raza.id_tipo_mascota = tip_mas.id_tipo_mascota
    WHERE mascota.id_mascota = '".$_GET['id']."'");

    $sql->execute();
    $usua = $sql->fetch(PDO::FETCH_ASSOC);

?>

<?php

    if (isset($_POST['update']))
    {
        $id_masc = $_POST['id_mas'];
        $nom = $_POST['name_mas'];
        $fecha = $_POST['fech'];
        $sexo = $_POST['sex'];
        $tipo_raza = $_POST['tipo_raza'];
        $insertSQL = $con ->prepare ( "UPDATE mascota SET id_mascota = '$id_masc', nombre_mas = '$nom', fecha_naci = '$fecha', sexo = '$sexo',
        id_raza = '$tipo_raza' WHERE id_mascota = '".$_GET['id']."'");
        $insertSQL->execute();
        $msg = "Actualización exitosa";

        
    }

    elseif (isset($_POST['delete']))
    {
        $insertSQL = $con->prepare("DELETE FROM mascota WHERE id_mascota = '".$_GET['id']."'");
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
    <title>Actualizar Mascota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body onload="centrarse();" class="bg-light">

    <div class="container mt-6">
        
            <h2 class="text-center mb-4">Actualizar Mascota</h2>
            <?php if (!empty($msg)): ?>
                <div class="alert alert-info text-center"><?php echo $msg; ?></div>
            <?php endif; ?>

            <form autocomplete="off" name="frm_consulta" method="post">

                <div class="mb-3">
                    <label class="form-label">ID Mascota</label>
                    <input type="text" class="form-control" name="id_mas" 
                        value="<?php echo $usua['id_mascota']?>" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="name_mas" 
                        value="<?php echo $usua['nombre_mas']?>">
                </div>


                <div class="mb-3">
                    <label class="form-label">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" name="fech" 
                        value="<?php echo $usua['fecha_naci']?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Sexo</label>
                    <select class="form-select" name="sex">
                        <option value="Macho" <?php if($usua['sexo']=="Macho") echo "selected"; ?>>Macho</option>
                        <option value="Hembra" <?php if($usua['sexo']=="Hembra") echo "selected"; ?>>Hembra</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tipo de Raza</label>
                    <select class="form-select" name="tipo_raza">
                        <option value="<?php echo($usua['id_raza'])?>" selected>
                            <?php echo($usua['razas'])?>
                        </option>
                        <?php
                            $control = $con -> prepare ("SELECT * FROM raza");
                            $control -> execute();

                            while($fila = $control->fetch(PDO::FETCH_ASSOC))
                            {
                                echo "<option value='" . $fila['id_raza'] . "'>"
                                . $fila['razas'] . "</option>";
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
