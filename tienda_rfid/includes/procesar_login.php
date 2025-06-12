<?php
include 'clases/conexion.php';
include 'clases/usuarios.php';

$db = new conexion();
$conn = $db->getConn();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['email'];
    $contrasena = $_POST['password'];

    $usuario = new Usuario($conn, "", "", "", "", "");
    $mensaje = $usuario->iniciarSesion($correo, $contrasena);

    echo $mensaje;
}
?>