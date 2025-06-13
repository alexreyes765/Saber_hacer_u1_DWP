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

    $ip = $_SERVER['REMOTE_ADDR'];
    $captcha = $_POST['g-recaptcha-response'];
    $secretKey = "6LdZBWArAAAAAPhKDdSgvr-qJiP-h0TqXmKSr8J8";

    $respuesta = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captcha&remoteip=$ip");

    $atributos = json_decode($respuesta, true);

    if(!$atributos['success']){
        die("Por favor completa el chaptcha");
    }

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
