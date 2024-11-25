<?php
// Clase Empleado hereda de la clase Conectar
class Empleado extends Conectar {

    // Obtiene todos los empleados
    public function obtener_empleados() {
        // Establece la conexión a la base de datos
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();
        
        // Consulta SQL para obtener todos los empleados
        $consulta_sql = "SELECT * FROM empleados";  

        // Prepara la consulta SQL
        $consulta = $conexion->prepare($consulta_sql);
        $consulta->execute();

        // Retorna el resultado de la consulta como un array asociativo
        return $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);   
    }

    // Obtiene un empleado por su ID
    public function obtener_empleado_por_id($id_empleado) {
        // Establece la conexión a la base de datos
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();
        
        // Consulta SQL para obtener un empleado específico por su ID
        $consulta_sql = "SELECT * FROM empleados WHERE id_empleado = ?";
        
        // Prepara la consulta SQL
        $consulta = $conexion->prepare($consulta_sql);
        $consulta->bindValue(1, $id_empleado);  // Asocia el valor del ID del empleado

        // Ejecuta la consulta
        $consulta->execute();

        // Retorna el resultado como un array asociativo
        return $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    // Inserta un nuevo empleado
    public function insertar_empleado($nombre, $apellido, $correo, $id_departamento, $id_rol) {
        // Establece la conexión a la base de datos
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();
        
        // Sentencia SQL para insertar un nuevo empleado
        $sentencia_sql = "INSERT INTO empleados(nombre, apellido, correo, departamento, rol) VALUES (?, ?, ?, ?, ?)";

        // Prepara la sentencia SQL
        $sentencia = $conexion->prepare($sentencia_sql);
        $sentencia->bindValue(1, $nombre);  // Asocia el nombre del empleado
        $sentencia->bindValue(2, $apellido);  // Asocia el apellido del empleado
        $sentencia->bindValue(3, $correo);  // Asocia el correo del empleado
        $sentencia->bindValue(4, $id_departamento);  // Asocia el ID del departamento
        $sentencia->bindValue(5, $id_rol);  // Asocia el ID del rol

        // Ejecuta la sentencia
        $sentencia->execute();

        // Retorna el resultado (aunque no es necesario para un insert, se puede omitir)
        return $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    // Actualiza un empleado existente
    public function actualizar_empleado($id_empleado, $nombre, $apellido, $correo, $id_departamento, $id_rol) {
        // Establece la conexión a la base de datos
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();
        
        // Sentencia SQL para actualizar un empleado existente
        $sentencia_sql = "UPDATE empleados SET nombre = ?, apellido = ?, correo = ?, departamento = ?, rol = ? 
                          WHERE id_empleado = ?";

        // Prepara la sentencia SQL
        $sentencia = $conexion->prepare($sentencia_sql);
        $sentencia->bindValue(1, $nombre);  // Asocia el nombre del empleado
        $sentencia->bindValue(2, $apellido);  // Asocia el apellido del empleado
        $sentencia->bindValue(3, $correo);  // Asocia el correo del empleado
        $sentencia->bindValue(4, $id_departamento);  // Asocia el ID del departamento
        $sentencia->bindValue(5, $id_rol);  // Asocia el ID del rol
        $sentencia->bindValue(6, $id_empleado);  // Asocia el ID del empleado a actualizar

        // Ejecuta la sentencia
        $sentencia->execute();

        // Retorna el resultado (aunque no es necesario para un update, se puede omitir)
        return $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    // Elimina un empleado
    public function eliminar_empleado($id_empleado) {
        // Establece la conexión a la base de datos
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();
        
        // Sentencia SQL para eliminar un empleado
        $sentencia_sql = "DELETE FROM empleados WHERE id_empleado = ?";

        // Prepara la sentencia SQL
        $sentencia = $conexion->prepare($sentencia_sql);
        $sentencia->bindValue(1, $id_empleado);  // Asocia el ID del empleado

        // Ejecuta la sentencia
        $sentencia->execute();

        // Retorna el resultado (aunque no es necesario para un delete, se puede omitir)
        return $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
