let rolSeleccionado = null;  // Variable global para almacenar el rol seleccionado para editar

// Función para cargar roles desde el servidor
function cargarRoles() {
    axios.get('https://gestionempleadosapi.azurewebsites.net/controlador/roles.php?op=ObtenerTodos')
        .then(response => {
            const roles = response.data;
            const tabla = document.getElementById('tablaRoles').getElementsByTagName('tbody')[0];
            tabla.innerHTML = '';  // Limpiar la tabla antes de llenarla

            roles.forEach(rol => {
                const fila = tabla.insertRow();
                fila.setAttribute('data-id', rol.id_rol);  // Establecer el ID del rol como atributo
                fila.innerHTML = `
                    <td>${rol.id_rol}</td>
                    <td>${rol.nombre_rol}</td>
                `;
                // Agregar un evento de clic a cada fila para seleccionarla
                fila.addEventListener('click', () => seleccionarFila(fila, rol));
            });
        })
        .catch(error => console.error('Error al cargar los roles:', error));
}
// Función para seleccionar una fila
function seleccionarFila(fila, rol) {
    
    // Desmarcar cualquier fila previamente seleccionada
    const filas = document.getElementById('tablaRoles').getElementsByTagName('tr');
    for (let i = 0; i < filas.length; i++) {
        filas[i].classList.remove('seleccionado');
    }

    // Marcar la fila seleccionada
    fila.classList.add('seleccionado');

    // Guardar el rol seleccionado
    rolSeleccionado = rol;

    // Actualizar el campo de texto del modal de edición con el nombre del rol seleccionado
    document.getElementById('nombreRolEditar').value = rol.nombre_rol;

    // Habilitar los botones de Editar y Eliminar
    document.getElementById('btnEditar').disabled = false;
    document.getElementById('btnEliminar').disabled = false;
}

// Función para agregar un nuevo rol
function agregarRol() {
    // Deshabilitar los botones de Editar y Eliminar
    document.getElementById('btnEditar').disabled = true;
    document.getElementById('btnEliminar').disabled = true;

    const nombreRol = document.getElementById('nombreRolAgregar').value;

    if (nombreRol.trim() === '') {
        alert('Por favor ingresa un nombre para el rol');
        return;
    }

    const data = { nombre_rol: nombreRol };

    // Llamada para agregar rol
    axios.post('https://gestionempleadosapi.azurewebsites.net/controlador/roles.php?op=Insertar', data)
        .then(response => {
            alert('Rol agregado correctamente');
            cargarRoles();  // Recargar los roles
            limpiarCamposAgregar();
            const modal = bootstrap.Modal.getInstance(document.getElementById('modalAgregar'));
            modal.hide();
        })
        .catch(error => {
            console.error('Error al agregar el rol:', error);
            alert('Error al agregar el rol');
        });
}

// Función para actualizar un rol
function actualizarRol() {
    const nombreRol = document.getElementById('nombreRolEditar').value;

    if (nombreRol.trim() === '') {
        alert('Por favor ingresa un nombre para el rol');
        return;
    }

    const data = {
        id_rol: rolSeleccionado.id_rol,
        nombre_rol: nombreRol
    };
   

    // Llamada para actualizar el rol
    axios.post('https://gestionempleadosapi.azurewebsites.net/controlador/roles.php?op=Actualizar', data)
        .then(response => {
            alert('Rol actualizado correctamente');
            cargarRoles();  // Recargar los roles
            limpiarCamposEditar();
            const modal = bootstrap.Modal.getInstance(document.getElementById('modalEditar'));
            modal.hide();
        })
        .catch(error => {
            console.error('Error al actualizar el rol:', error);
            alert('Error al actualizar el rol');
        });
}

// Función para eliminar un rol
function eliminarRol() {
    if (!rolSeleccionado) {
        alert('Por favor selecciona un rol para eliminar');
        return;
    }

    const confirmation = confirm(`¿Estás seguro que deseas eliminar el rol "${rolSeleccionado.nombre_rol}"?`);

    if (confirmation) {
        // Llamada para eliminar el rol
        axios.post('https://gestionempleadosapi.azurewebsites.net/controlador/roles.php?op=Eliminar', { id_rol: rolSeleccionado.id_rol })
            .then(response => {
                alert('Rol eliminado correctamente');
                cargarRoles();  // Recargar los roles
                limpiarCamposEditar();
            })
            .catch(error => {
                console.error('Error al eliminar el rol:', error);
                alert('Error al eliminar el rol');
            });
    }
}

// Función para limpiar el formulario del modal de agregar
function limpiarCamposAgregar() {
    document.getElementById('nombreRolAgregar').value = '';
}

// Función para limpiar el formulario del modal de editar
function limpiarCamposEditar() {
    document.getElementById('nombreRolEditar').value = '';
    rolSeleccionado = null;
    document.getElementById('btnEditar').disabled = true;
    document.getElementById('btnEliminar').disabled = true;
}

// Asignar eventos a los botones
document.addEventListener('DOMContentLoaded', () => {
    cargarRoles();

    // Evento para el botón "Guardar" (Agregar)
    document.getElementById('btnGuardarRol').addEventListener('click', agregarRol);

    // Evento para el botón "Actualizar" (Editar)
    document.getElementById('btnActualizarRol').addEventListener('click', actualizarRol);

    // Evento para el botón "Eliminar"
    document.getElementById('btnEliminar').addEventListener('click', eliminarRol);
});

// Función para buscar por ID
function buscarRegistro() {
    const idBusqueda = document.getElementById('searchId').value.trim(); // Obtener el valor del campo de búsqueda
    const tabla = document.getElementById('tablaRoles');
    const filas = tabla.getElementsByTagName('tr');  // Obtener todas las filas de la tabla

    // Recorrer las filas (empezar desde la fila 1 para saltar el encabezado)
    for (let i = 1; i < filas.length; i++) {
        const fila = filas[i];
        const idRol = fila.getElementsByTagName('td')[0].textContent.trim();  // Obtener el ID de la primera columna

        // Mostrar solo las filas que coincidan con el ID ingresado
        if (idBusqueda === '' || idRol.includes(idBusqueda)) {
            fila.style.display = '';  // Mostrar la fila
        } else {
            fila.style.display = 'none';  // Ocultar la fila
        }
    }
}
