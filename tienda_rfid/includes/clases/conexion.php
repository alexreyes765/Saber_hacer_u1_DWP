<?php
class conexion
{
    private $host = "localhost";
    private $db = "itsdb";
    private $user = "root";
    private $password = "";
    private $conn;
    private $puerto = 3307;

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host={$this->host};port={$this->puerto};dbname={$this->db};charset=utf8", $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexion: " . $e->getMessage());
        }
    }

    public function getConn()
    {
        return $this->conn;
    }
}
