<?php
session_start();
require_once("database/connection.php");
$db = new Database;
$con = $db->conectar();

if (isset($_POST['comprar'])) {
   
    $cantidad = $_POST['cantidad'];
    $usuario_id = $_POST['users'];  
    $articulo_id = $_GET['id'];  

    
    if (empty($cantidad) || empty($usuario_id)) {
        echo '<script>alert("DATOS VACIOS, POR FAVOR DELIGENCIE");</script>';
        return;
    }

    
    $sql = $con->prepare("SELECT precio FROM articulo WHERE id_articulo = ?");
    $sql->execute([$articulo_id]);
    $producto = $sql->fetch(PDO::FETCH_ASSOC);

    if (!$producto) {
        echo '<script>alert("Producto no encontrado");</script>';
        return;
    }

    
    $subtotal = $producto['precio'] * $cantidad;
    $fecha_venta = date('Y-m-d H:i:s');  

    
    $insertVentaSQL = $con->prepare("INSERT INTO venta (fecha_venta, doc_cliente) VALUES (?, ?)");
    $insertVentaSQL->execute([$fecha_venta, $usuario_id]);

    
    $venta_id = $con->lastInsertId();

    $insertDetalleSQL = $con->prepare("INSERT INTO detalle_venta_art (cantidad, sub_total, id_venta, id_articulo) VALUES (?, ?, ?, ?)");
    $insertDetalleSQL->execute([$cantidad, $subtotal, $venta_id, $articulo_id]);

    echo '<script>alert("Venta registrada exitosamente.");</script>';
    echo '<script>window.location="index.php";</script>';
}
?>