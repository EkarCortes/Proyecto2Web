

<?php

// Establece el tipo de contenido a JSON
header("Content-Type: application/json");

// Incluye los archivos necesarios para la conexión a la base de datos y la clase Departamento
require_once("../configuracion/conexion.php");
require_once("../modelos/Departamentos.php");

// Crea una instancia de la clase Departamento
$departamento = new Departamento();

// Obtiene los datos enviados en formato JSON
$body = json_decode(file_get_contents("php://input"), true);

// Define las operaciones basadas en el parámetro "op" de la URL
switch ($_GET["op"]) {

    // Obtiene todos los departamentos
    case "ObtenerTodos":
        // Llama al método para obtener todos los departamentos
        $datos = $departamento->obtener_departamentos();
        // Devuelve los datos en formato JSON
        echo json_encode($datos);
        break;

    // Obtiene un departamento por su ID
    case "ObtenerPorId":
        // Llama al método para obtener un departamento específico por ID
        $datos = $departamento->obtener_departamento_por_id($body["id_departamento"]);   
        // Devuelve los datos del departamento en formato JSON
        echo json_encode($datos);   
        break;

    // Inserta un nuevo departamento
    case "Insertar":
        // Llama al método para insertar un nuevo departamento
        $datos = $departamento->insertar_departamento($body["nombre_departamento"]);
        // Devuelve una respuesta indicando que la inserción fue correcta
        echo json_encode(["Correcto" => "Inserción Realizada"]);
        break;

    // Actualiza un departamento existente
    case "Actualizar":
        // Llama al método para actualizar un departamento existente
        $datos = $departamento->actualizar_departamento($body["id_departamento"], $body["nombre_departamento"], $body["descripcion"]);
        // Devuelve una respuesta indicando que la actualización fue correcta
        echo json_encode(["Correcto" => "Actualización Realizada"]);
        break;

    // Elimina un departamento
    case "Eliminar":
        // Llama al método para eliminar un departamento
        $datos = $departamento->eliminar_departamento($body["id_departamento"]);
        // Devuelve una respuesta indicando que la eliminación fue correcta
        echo json_encode(["Correcto" => "Eliminación Realizada"]);
        break;
}
?>
