<?php
session_start();
require_once("database/connection.php");
$db = new Database;
$con = $db->conectar();

if (isset($_POST['comprar'])) {
    // Obtener los datos del formulario
    $cantidad = $_POST['cantidad'];
    $usuario_id = $_POST['users'];  // El usuario seleccionado
    $articulo_id = $_GET['id'];  // El ID del artículo desde la URL

    // Validar campos vacíos
    if (empty($cantidad) || empty($usuario_id)) {
        echo '<script>alert("DATOS VACIOS, POR FAVOR DELIGENCIE");</script>';
        return;
    }

    // Obtener información del artículo
    $sql = $con->prepare("SELECT precio FROM articulo WHERE id_articulo = ?");
    $sql->execute([$articulo_id]);
    $producto = $sql->fetch(PDO::FETCH_ASSOC);

    if (!$producto) {
        echo '<script>alert("Producto no encontrado");</script>';
        return;
    }

    // Calcular el subtotal para este artículo
    $subtotal = $producto['precio'] * $cantidad;
    $fecha_venta = date('Y-m-d H:i:s');  // Obtener fecha y hora actuales

    // Insertar la venta en la tabla 'venta' (sin precio total, solo la fecha y usuario)
    $insertVentaSQL = $con->prepare("INSERT INTO venta (fecha_venta, id_documento) VALUES (?, ?)");
    $insertVentaSQL->execute([$fecha_venta, $usuario_id]);

    // Obtener el ID de la venta recién insertada
    $venta_id = $con->lastInsertId();

    // Insertar el detalle de la venta en la tabla 'detalle_venta_art'
    $insertDetalleSQL = $con->prepare("INSERT INTO detalle_venta_art (cantidad, sub_total, id_venta, id_articulo) VALUES (?, ?, ?, ?)");
    $insertDetalleSQL->execute([$cantidad, $subtotal, $venta_id, $articulo_id]);

    // Mensaje de éxito
    echo '<script>alert("Venta registrada exitosamente.");</script>';
    echo '<script>window.location="index.php";</script>';
}
?>