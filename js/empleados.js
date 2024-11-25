// URL de la API
const apiUrl = 'https://tudominio/api/empleados';  // Cambia esta URL por la URL de tu API

// Función para cargar los datos de empleados
function cargarEmpleados() {
    axios.get(apiUrl)
        .then(response => {
            // Limpiar la tabla antes de mostrar los nuevos datos
            const tablaRegistros = document.getElementById('tablaRegistros').getElementsByTagName('tbody')[0];
            tablaRegistros.innerHTML = ''; // Limpiar tabla

            // Verificar si la respuesta contiene datos
            if (response.data && response.data.length > 0) {
                // Recorrer los empleados y agregar una fila en la tabla
                response.data.forEach(empleado => {
                    const row = tablaRegistros.insertRow();  // Insertar nueva fila

                    // Insertar celdas con los datos del empleado
                    row.insertCell(0).textContent = empleado.id;  // ID
                    row.insertCell(1).textContent = empleado.nombre;  // Nombre
                    row.insertCell(2).textContent = empleado.apellido;  // Apellido
                    row.insertCell(3).textContent = empleado.correo;  // Correo
                    row.insertCell(4).textContent = empleado.departamento;  // Departamento
                    row.insertCell(5).textContent = empleado.rol;  // Rol
                });
            } else {
                console.log('No se encontraron empleados.');
            }
        })
        .catch(error => {
            console.error('Error al cargar los datos de empleados:', error);
        });
}

// Llamar a la función para cargar los empleados al cargar la página
window.onload = cargarEmpleados;
