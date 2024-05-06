<?php
class ConexionDB {
    private $host = 'localhost';
    private $usuario = 'root';
    private $contrasena = '2015anastasio';
    private $db = 'hotelclean';
    private $conexion;

    /*private $host = 'b7kguxc7t3wfmly5xoha-mysql.services.clever-cloud.com';
    private $usuario = 'uezc4fthzdoy43rd';
    private $contrasena = 'BoKpSx1kznuwYvr12X7t';
    private $db = 'b7kguxc7t3wfmly5xoha';
    private $conexion;*/

    public function __construct() {
        $this->conexion = new mysqli($this->host, $this->usuario, $this->contrasena, $this->db);
        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }else{
            $this->conexion->set_charset("utf8");
        }
    }

    public function consultar($consulta) {
        $resultado = $this->conexion->query($consulta);
        return $resultado;
    }

    public function cerrarConexion() {
        $this->conexion->close();
    }
}
?>
