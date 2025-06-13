<?php
class Usuario
{
    private $conn;
    private $nombre;
    private $apellido;
    private $celular;
    private $correo;
    private $contrasena;

    public function __construct($conn, $nombre = null, $apellido = null, $celular = null, $correo = null, $contrasena = null)
    {
        $this->conn = $conn;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->celular = $celular;
        $this->correo = $correo;
        $this->contrasena = $contrasena;
    }

    public function validarDatos()
    {
        if (!filter_var($this->correo, FILTER_VALIDATE_EMAIL)) {
            return "El correo no es válido.";
        }

        if (!preg_match('/^[0-9]{10}$/', $this->celular)) {
            return "El número de celular debe tener exactamente 10 dígitos.";
        }

        return true;
    }

    public function correoExistente()
    {
        $sql = "SELECT id FROM usuarios WHERE correo = :correo";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':correo', $this->correo);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public function registrar()
    {

        if (
            empty($this->nombre) || empty($this->apellido) || empty($this->celular) ||
            empty($this->correo) || empty($this->contrasena)
        ) {
            return "Todos los campos son obligatorios.";
        }

        $validacion = $this->validarDatos();
        if ($validacion !== true) {
            return $validacion;
        }

        if ($this->correoExistente()) {
            return "El correo ya está registrado.";
        }

        $hash = password_hash($this->contrasena, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (nombre, apellido, celular, correo, password)
                VALUES (:nombre, :apellido, :celular, :correo, :password)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':nombre', $this->nombre);
        $stmt->bindValue(':apellido', $this->apellido);
        $stmt->bindValue(':celular', $this->celular);
        $stmt->bindValue(':correo', $this->correo);
        $stmt->bindValue(':password', $hash);

        if ($stmt->execute()) {
            return "✅ Registro exitoso.";
        } else {
            return "❌ Error al registrar usuario.";
        }
    }

    public function iniciarSesion($correo, $contrasena)
    {

        if (empty($correo) && empty($contrasena)) {
            return "Por favor rellene los campos";
        }

        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            return "El correo no es válido.";
        }

        $sql = "SELECT * FROM usuarios WHERE correo = :correo";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':correo', $correo);
        $stmt->execute();

        if ($stmt->rowCount() === 1) {
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($contrasena, $usuario['password'])) {
                session_start();
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['nombre'] = $usuario['nombre'];
                return "✅ Bienvenido, " . $usuario['nombre'] . ".";
            } else {
                return "❌ Contraseña incorrecta.";
            }
        } else {
            return "❌ El usuario no existe.";
        }
    }
}