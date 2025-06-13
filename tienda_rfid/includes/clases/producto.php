<?php
class Producto{
    private $conn;
    private $nombre_producto;
    private $precio;
    private $categoria;
    private $descripcion;

    public function __construct($conn, $nombre_producto = null, $precio = null, $categoria = null, $descripcion = null)
    {
        $this->conn = $conn;
        $this->nombre_producto = $nombre_producto;
        $this->precio = $precio;
        $this->categoria = $categoria;
        $this->descripcion = $descripcion;
    }

    public function registrar()
    {

        if (
            empty($this->nombre_producto) || empty($this->precio) || empty($this->categoria) ||
            empty($this->descripcion)
        ) {
            return "Todos los campos son obligatorios.";
        }


        $sql = "INSERT INTO productos (producto, precio, categoria, descripcion)
                VALUES (:producto, :precio, :categoria, :descripcion)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':producto', $this->nombre_producto);
        $stmt->bindValue(':precio', $this->precio);
        $stmt->bindValue(':categoria', $this->categoria);
        $stmt->bindValue(':descripcion', $this->descripcion);

        if ($stmt->execute()) {
            return "✅ Registro exitoso.";
        } else {
            return "❌ Error al registrar el producto.";
        }
    }
}

/*PASAR A PRODUCTOS CREATE TABLE productos(
   id INT AUTO_INCREMENT PRIMARY KEY,
    producto VARCHAR(100),
    precio DECIMAL,
    categoria VARCHAR(50),
    descripcion TEXT);*/
?>

