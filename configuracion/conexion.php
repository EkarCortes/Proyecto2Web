<?php
class Conectar
{
    protected $conexion_bd;

    public function conectar_bd()
    {
        try {
            $host = "gestionempleados.mysql.database.azure.com";
            $dbname = "gestion_empleados";
            $username = "adminuser@gestionempleados";
            $password = "Admin123!";

            $this->conexion_bd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $this->conexion_bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $this->conexion_bd;
        } catch (PDOException $e) {
            die("Error en la base de datos: " . $e->getMessage());
        }
    }

    public function establecer_codificacion()
    {
        if ($this->conexion_bd) {
            return $this->conexion_bd->exec("SET NAMES 'utf8'");
        }
        return false;
    }
}
?>