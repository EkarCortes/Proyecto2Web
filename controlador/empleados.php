<?php

// Establece el tipo de contenido a JSON
header("Content-Type: application/json");

// Incluye los archivos necesarios para la conexión a la base de datos y la clase Empleado
require_once("../configuracion/conexion.php");
require_once("../modelos/Empleados.php");

// Crea una instancia de la clase Empleado
$empleado = new Empleado();

// Obtiene los datos enviados en formato JSON
$body = json_decode(file_get_contents("php://input"), true);

// Define las operaciones basadas en el parámetro "op" de la URL
switch ($_GET["op"]) {

    // Obtiene todos los empleados
    case "ObtenerTodos":
        // Llama al método para obtener todos los empleados
        $datos = $empleado->obtener_empleados();
        // Devuelve los datos en formato JSON
        echo json_encode($datos);
        break;

    // Obtiene un empleado por su ID
    case "ObtenerPorId":
        // Llama al método para obtener un empleado específico por ID
        $datos = $empleado->obtener_empleado_por_id($body["id_empleado"]);   
        // Devuelve los datos del empleado en formato JSON
        echo json_encode($datos);   
        break;

    // Inserta un nuevo empleado
    case "Insertar":
        // Llama al método para insertar un nuevo empleado
        $datos = $empleado->insertar_empleado($body["nombre"], $body["apellido"], $body["correo"], $body["id_departamento"], $body["id_rol"]);
        // Devuelve una respuesta indicando que la inserción fue correcta
        echo json_encode(["Correcto" => "Inserción Realizada"]);
        break;

    // Actualiza un empleado existente
    case "Actualizar":
        // Llama al método para actualizar un empleado existente
        $datos = $empleado->actualizar_empleado($body["id_empleado"], $body["nombre"], $body["apellido"], $body["correo"], $body["id_departamento"], $body["id_rol"]);
        // Devuelve una respuesta indicando que la actualización fue correcta
        echo json_encode(["Correcto" => "Actualización Realizada"]);
        break;

    // Elimina un empleado
    case "Eliminar":
        // Llama al método para eliminar un empleado
        $datos = $empleado->eliminar_empleado($body["id_empleado"]);
        // Devuelve una respuesta indicando que la eliminación fue correcta
        echo json_encode(["Correcto" => "Eliminación Realizada"]);
        break;
}
?>
