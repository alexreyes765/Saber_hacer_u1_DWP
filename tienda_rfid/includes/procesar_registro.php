<?php
include 'clases/conexion.php';
include 'clases/usuarios.php';

$db = new conexion();
$conn = $db->getConn();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $celular = $_POST['celular'];
    $correo = $_POST['email'];
    $pass = $_POST['password'];
    $conf_pass = $_POST['conf_password'];

    if ($pass !== $conf_pass) {
        die("Las contraseñas no coinciden.");
    }

    $usuario = new Usuario($conn, $nombre, $apellido, $celular, $correo, $pass);
    $mensaje = $usuario->registrar();
    $mensaje_url = urlencode($mensaje);
    header("Location: ../registro.php?mensaje=$mensaje_url");
    exit;
}

?>
