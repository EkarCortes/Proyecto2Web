<?php
// Encabezados CORS
header("Access-Control-Allow-Origin: *");  // Permite solicitudes de cualquier origen (puedes especificar un dominio específico en lugar de "*")
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");  // Métodos HTTP permitidos
header("Access-Control-Allow-Headers: Content-Type");  // Encabezados permitidos

// Si la solicitud es una preflight (OPTIONS), responde y termina la ejecución.
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

// El resto de tu código PHP
?>

<?php

// Establece el tipo de contenido a JSON
header("Content-Type: application/json");

// Incluye los archivos necesarios para la conexión a la base de datos y la clase Rol
require_once("../configuracion/conexion.php");
require_once("../modelos/Roles.php");

// Crea una instancia de la clase Rol
$rol = new Rol();

// Obtiene los datos enviados en formato JSON
$body = json_decode(file_get_contents("php://input"), true);

// Define las operaciones basadas en el parámetro "op" de la URL
switch ($_GET["op"]) {

    // Obtiene todos los roles
    case "ObtenerTodos":
        // Llama al método para obtener todos los roles
        $datos = $rol->obtener_roles();
        // Devuelve los datos en formato JSON
        echo json_encode($datos);
        break;

    // Obtiene un rol por su ID
    case "ObtenerPorId":
        // Llama al método para obtener un rol específico por ID
        $datos = $rol->obtener_rol_por_id($body["id_rol"]);   
        // Devuelve los datos del rol en formato JSON
        echo json_encode($datos);   
        break;

    // Inserta un nuevo rol
    case "Insertar":
        // Llama al método para insertar un nuevo rol
        $datos = $rol->insertar_rol($body["nombre_rol"]);
        // Devuelve una respuesta indicando que la inserción fue correcta
        echo json_encode(["success" => true, "message" => "Inserción Realizada"]);
        break;
        
    // Actualiza un rol existente
    case "Actualizar":
        // Llama al método para actualizar un rol existente
        $datos = $rol->actualizar_rol($body["id_rol"], $body["nombre_rol"]);
        // Devuelve una respuesta indicando que la actualización fue correcta
        echo json_encode(["Correcto" => "Actualización Realizada"]);
        break;

    // Elimina un rol
    case "Eliminar":
        // Llama al método para eliminar un rol
        $datos = $rol->eliminar_rol($body["id_rol"]);
        // Devuelve una respuesta indicando que la eliminación fue correcta
        echo json_encode(["Correcto" => "Eliminación Realizada"]);
        break;
}
?>
