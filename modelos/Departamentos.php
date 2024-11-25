<?php
// Clase Departamento hereda de la clase Conectar
class Departamento extends Conectar {

    // Obtiene todos los departamentos
    public function obtener_departamentos() {
        // Establece la conexión a la base de datos
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();
        
        // Consulta SQL para obtener todos los departamentos
        $consulta_sql = "SELECT * FROM departamentos";   

        // Prepara la consulta SQL
        $consulta = $conexion->prepare($consulta_sql);
        $consulta->execute();

        // Retorna el resultado de la consulta como un array asociativo
        return $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);   
    }

    // Obtiene un departamento por su ID
    public function obtener_departamento_por_id($id_departamento) {
        // Establece la conexión a la base de datos
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();
        
        // Consulta SQL para obtener un departamento específico por su ID
        $consulta_sql = "SELECT * FROM departamentos WHERE id_departamento = ?";

        // Prepara la consulta SQL
        $consulta = $conexion->prepare($consulta_sql);
        $consulta->bindValue(1, $id_departamento);  // Asocia el valor del ID del departamento

        // Ejecuta la consulta
        $consulta->execute();

        // Retorna el resultado como un array asociativo
        return $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    // Inserta un nuevo departamento
    public function insertar_departamento($nombre_departamento) {
        // Establece la conexión a la base de datos
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();
        
        // Sentencia SQL para insertar un nuevo departamento
        $sentencia_sql = "INSERT INTO departamentos(nombre_departamento) VALUES (?)";

        // Prepara la sentencia SQL
        $sentencia = $conexion->prepare($sentencia_sql);
        $sentencia->bindValue(1, $nombre_departamento);// Asocia el nombre del departamento

        // Ejecuta la sentencia
        $sentencia->execute();

        // Retorna el resultado (aunque no es necesario para un insert, se puede omitir)
        return $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    // Actualiza un departamento existente
    public function actualizar_departamento($id_departamento, $nombre_departamento) {
        // Establece la conexión a la base de datos
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();
        
        // Sentencia SQL para actualizar un departamento existente
        $sentencia_sql = "UPDATE departamentos SET nombre_departamento = ? WHERE id_departamento = ?";

        // Prepara la sentencia SQL
        $sentencia = $conexion->prepare($sentencia_sql);
        $sentencia->bindValue(1, $nombre_departamento);  // Asocia el nombre del departamento
        $sentencia->bindValue(2, $id_departamento);  // Asocia el ID del departamento

        // Ejecuta la sentencia
        $sentencia->execute();

        // Retorna el resultado (aunque no es necesario para un update, se puede omitir)
        return $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    // Elimina un departamento
    public function eliminar_departamento($id_departamento) {
        // Establece la conexión a la base de datos
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();
        
        // Sentencia SQL para eliminar un departamento
        $sentencia_sql = "DELETE FROM departamentos WHERE id_departamento = ?";

        // Prepara la sentencia SQL
        $sentencia = $conexion->prepare($sentencia_sql);
        $sentencia->bindValue(1, $id_departamento);  // Asocia el ID del departamento

        // Ejecuta la sentencia
        $sentencia->execute();

        // Retorna el resultado (aunque no es necesario para un delete, se puede omitir)
        return $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
