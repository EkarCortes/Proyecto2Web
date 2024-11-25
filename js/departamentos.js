let departamentoSeleccionado = null;  // Variable global para almacenar el departamento seleccionado para editar

// Función para cargar departamentos desde el servidor
function cargarDepartamentos() {
    axios.get('http://localhost/Proyecto2Web/controlador/departamentos.php?op=ObtenerTodos')
        .then(response => {
            const departamentos = response.data;
            const tabla = document.getElementById('tablaDepartamentos').getElementsByTagName('tbody')[0];
            tabla.innerHTML = '';  // Limpiar la tabla antes de llenarla

            departamentos.forEach(departamento => {
                const fila = tabla.insertRow();
                fila.setAttribute('data-id', departamento.id_departamento);  // Establecer el ID del departamento como atributo
                fila.innerHTML = `
                    <td>${departamento.id_departamento}</td>
                    <td>${departamento.nombre_departamento}</td>
                `;
                // Agregar un evento de clic a cada fila para seleccionarla
                fila.addEventListener('click', () => seleccionarFila(fila, departamento));
            });
        })
        .catch(error => console.error('Error al cargar los departamentos:', error));
}

// Función para seleccionar una fila
function seleccionarFila(fila, departamento) {
    // Desmarcar cualquier fila previamente seleccionada
    const filas = document.getElementById('tablaDepartamentos').getElementsByTagName('tr');
    for (let i = 0; i < filas.length; i++) {
        filas[i].classList.remove('seleccionado');
    }

    // Marcar la fila seleccionada
    fila.classList.add('seleccionado');

    // Guardar el departamento seleccionado
    departamentoSeleccionado = departamento;

    // Actualizar el campo de texto del modal de edición con el nombre del departamento seleccionado
    document.getElementById('nombreDepartamentoEditar').value = departamento.nombre_departamento;

    // Habilitar los botones de Editar y Eliminar
    document.getElementById('btnEditar').disabled = false;
    document.getElementById('btnEliminar').disabled = false;
}

// Función para agregar un nuevo departamento
function agregarDepartamento() {
    // Deshabilitar los botones de Editar y Eliminar
    document.getElementById('btnEditar').disabled = true;
    document.getElementById('btnEliminar').disabled = true;

    const nombreDepartamento = document.getElementById('nombreDepartamento').value;

    if (nombreDepartamento.trim() === '') {
        alert('Por favor ingresa un nombre para el departamento');
        return;
    }

    const data = { nombre_departamento: nombreDepartamento };

    // Llamada para agregar departamento
    axios.post('http://localhost/Proyecto2Web/controlador/departamentos.php?op=Insertar', data)
        .then(response => {
            alert('Departamento agregado correctamente');
            cargarDepartamentos();  // Recargar los departamentos
            limpiarCamposAgregar();
            const modal = bootstrap.Modal.getInstance(document.getElementById('modalAgregar'));
            modal.hide();
        })
        .catch(error => {
            console.error('Error al agregar el departamento:', error);
            alert('Error al agregar el departamento');
        });
}

// Función para actualizar un departamento
function actualizarDepartamento() {
    const nombreDepartamento = document.getElementById('nombreDepartamentoEditar').value;

    if (nombreDepartamento.trim() === '') {
        alert('Por favor ingresa un nombre para el departamento');
        return;
    }

    const data = {
        id_departamento: departamentoSeleccionado.id_departamento,
        nombre_departamento: nombreDepartamento
    };

    // Llamada para actualizar el departamento
    axios.post('http://localhost/Proyecto2Web/controlador/departamentos.php?op=Actualizar', data)
        .then(response => {
            alert('Departamento actualizado correctamente');
            cargarDepartamentos();  // Recargar los departamentos
            limpiarCamposEditar();
            const modal = bootstrap.Modal.getInstance(document.getElementById('modalEditar'));
            modal.hide();
        })
        .catch(error => {
            console.error('Error al actualizar el departamento:', error);
            alert('Error al actualizar el departamento');
        });
}

// Función para eliminar un departamento
function eliminarDepartamento() {
    if (!departamentoSeleccionado) {
        alert('Por favor selecciona un departamento para eliminar');
        return;
    }

    const confirmation = confirm(`¿Estás seguro que deseas eliminar el departamento "${departamentoSeleccionado.nombre_departamento}"?`);

    if (confirmation) {
        // Llamada para eliminar el departamento
        axios.post('http://localhost/Proyecto2Web/controlador/departamentos.php?op=Eliminar', { id_departamento: departamentoSeleccionado.id_departamento })
            .then(response => {
                alert('Departamento eliminado correctamente');
                cargarDepartamentos();  // Recargar los departamentos
                limpiarCamposEditar();
            })
            .catch(error => {
                console.error('Error al eliminar el departamento:', error);
                alert('Error al eliminar el departamento');
            });
    }
}

// Función para limpiar el formulario del modal de agregar
function limpiarCamposAgregar() {
    document.getElementById('nombreDepartamento').value = '';
}

// Función para limpiar el formulario del modal de editar
function limpiarCamposEditar() {
    document.getElementById('nombreDepartamentoEditar').value = '';
    departamentoSeleccionado = null;
    document.getElementById('btnEditar').disabled = true;
    document.getElementById('btnEliminar').disabled = true;
}

// Asignar eventos a los botones
document.addEventListener('DOMContentLoaded', () => {
    cargarDepartamentos();

    // Evento para el botón "Guardar" (Agregar)
    document.getElementById('btnGuardarDepartamento').addEventListener('click', agregarDepartamento);

    // Evento para el botón "Actualizar" (Editar)
   // document.getElementById('btnActualizarDepartamento').addEventListener('click', actualizarDepartamento);

    // Evento para el botón "Eliminar"
    document.getElementById('btnEliminar').addEventListener('click', eliminarDepartamento);
});

// Función para buscar por ID
function buscarRegistro() {
    const idBusqueda = document.getElementById('searchId').value.trim(); // Obtener el valor del campo de búsqueda
    const tabla = document.getElementById('tablaDepartamentos');
    const filas = tabla.getElementsByTagName('tr');  // Obtener todas las filas de la tabla

    // Recorrer las filas (empezar desde la fila 1 para saltar el encabezado)
    for (let i = 1; i < filas.length; i++) {
        const fila = filas[i];
        const idDepartamento = fila.getElementsByTagName('td')[0].textContent.trim();  // Obtener el ID de la primera columna

        // Mostrar solo las filas que coincidan con el ID ingresado
        if (idBusqueda === '' || idDepartamento.includes(idBusqueda)) {
            fila.style.display = '';  // Mostrar la fila
        } else {
            fila.style.display = 'none';  // Ocultar la fila
        }
    }
}
