<?php
include 'clases/conexion.php';
include 'clases/producto.php';

$db = new conexion();
$conn = $db->getConn();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $producto = $_POST['producto'];
    $precio = $_POST['precio'];
    $categoria = $_POST['categoria'];
    $descripcion = $_POST['descripcion'];

    $productos = new Producto($conn,$producto,$precio,$categoria,$descripcion);
    $mensaje = $productos->registrar();

    echo $mensaje;
}
?>