<?php
session_start();
 require_once("../../database/connection.php");
    $db = new Database;
    $con = $db ->conectar();

    $doc = $_SESSION['doc_user'];

    $sql = $con -> prepare("SELECT * FROM user INNER JOIN tip_use ON user.id_tipo_user = tip_use.id_tipo_user WHERE user.id_documento = $doc");

    $sql -> execute();
    $fila = $sql -> fetch();


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Bienvenido señ@r <?php echo $fila['nombre']; ?> <?php echo $fila['tipo_user']; ?></h1>
</body>

</html>