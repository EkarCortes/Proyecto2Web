// Variable global para almacenar el empleado seleccionado
let empleadoSeleccionado = null;

// Función para cargar los empleados desde el servidor
function cargarEmpleados() {
    axios.get('https://gestionempleadosapi.azurewebsites.net/controlador/empleados.php?op=ObtenerTodos')
        .then(response => {
            const empleados = response.data;
            const tabla = document.getElementById('tablaEmpleados').getElementsByTagName('tbody')[0];
            tabla.innerHTML = '';  

            empleados.forEach(empleado => {
                const fila = tabla.insertRow();
                fila.setAttribute('data-id', empleado.id_empleado);  
                fila.innerHTML = `
                    <td>${empleado.id_empleado}</td>
                    <td>${empleado.nombre}</td>
                    <td>${empleado.apellido}</td>
                    <td>${empleado.correo}</td>
                    <td>${empleado.departamento}</td>
                    <td>${empleado.rol}</td>
                `;
                // Agregar un evento de clic a cada fila para seleccionarla
                fila.addEventListener('click', () => seleccionarFila(fila, empleado));
            });
        })
        .catch(error => console.error('Error al cargar los empleados:', error));
}


// Función para seleccionar una fila
function seleccionarFila(fila, empleado) {
    // Desmarcar cualquier fila previamente seleccionada
    const filas = document.getElementById('tablaEmpleados').getElementsByTagName('tr');
    for (let i = 0; i < filas.length; i++) {
        filas[i].classList.remove('seleccionado');
    }

    // Marcar la fila seleccionada
    fila.classList.add('seleccionado');

    // Guardar el empleado seleccionado
    empleadoSeleccionado = empleado;

    // Asignar los valores a los campos del formulario
    document.getElementById('nombreEditar').value = empleado.nombre;
    document.getElementById('apellidoEditar').value = empleado.apellido;
    document.getElementById('correoEditar').value = empleado.correo;

    // Cargar roles y departamentos en los select y preseleccionar los actuales
    cargarDepartamentosYRolesEditar(empleado);

    // Habilitar los botones de Editar y Eliminar
    document.getElementById('btnEditar').disabled = false;
    document.getElementById('btnEliminar').disabled = false;
}


// Función para agregar un nuevo empleado
function agregarEmpleado() {
    const nombre = document.getElementById('nombre').value;
    const apellido = document.getElementById('apellido').value;
    const correo = document.getElementById('correo').value;
    const departamento = document.getElementById('idDepartamento').value;
    const rol = document.getElementById('idRol').value;

    if (nombre.trim() === '' || apellido.trim() === '' || correo.trim() === '' || departamento === '' || rol === '') {
        alert('Por favor complete todos los campos');
        return;
    }

    const data = { nombre, apellido, correo, departamento, rol };

    // Llamada para agregar el empleado
    axios.post('https://gestionempleadosapi.azurewebsites.net/controlador/empleados.php?op=Insertar', data)
        .then(response => {
            alert('Empleado agregado correctamente');
            cargarEmpleados();  
            limpiarCamposAgregar();
            const modal = bootstrap.Modal.getInstance(document.getElementById('modalAgregar'));
            modal.hide();
        })
        .catch(error => {
            console.error('Error al agregar el empleado:', error);
            alert('Error al agregar el empleado');
        });
}

// Función para editar un empleado
function EditarEmpleado() {
    if (!empleadoSeleccionado) {
        alert('Debe seleccionar un empleado antes de editar.');
        return;
    }

    const nombre = document.getElementById('nombreEditar').value;
    const apellido = document.getElementById('apellidoEditar').value;
    const correo = document.getElementById('correoEditar').value;
    const departamento = document.getElementById('departamentoEditar').value;
    const rol = document.getElementById('rolEditar').value;

    if (nombre.trim() === '' || apellido.trim() === '' || correo.trim() === '' || departamento === '' || rol === '') {
        alert('Por favor complete todos los campos');
        return;
    }

    const data = { 
        nombre, 
        apellido, 
        correo, 
        departamento, 
        rol, 
        id_empleado: empleadoSeleccionado.id_empleado 
    };

    axios.post('https://gestionempleadosapi.azurewebsites.net/controlador/empleados.php?op=Actualizar', data)
        .then(response => {
            alert('Empleado actualizado correctamente');
            cargarEmpleados();
            const modal = bootstrap.Modal.getInstance(document.getElementById('modalEditar'));
            modal.hide();
        })
        .catch(error => {
            console.error('Error al actualizar el empleado:', error);
            alert('Error al actualizar el empleado');
        });
}


// Función para limpiar los campos del modal de agregar
function limpiarCamposAgregar() {
    document.getElementById('nombre').value = '';
    document.getElementById('apellido').value = '';
    document.getElementById('correo').value = '';
    document.getElementById('idDepartamento').value = '';
    document.getElementById('idRol').value = '';
}

// Función para cargar departamentos y roles en los campos del modal de agregar
function cargarDepartamentosYRoles() {

    // Cargar departamentos
    axios.get('https://gestionempleadosapi.azurewebsites.net/controlador/departamentos.php?op=ObtenerTodos')
        .then(response => {
            const departamentos = response.data;
            const selectDepartamento = document.getElementById('idDepartamento');
            departamentos.forEach(departamento => {
                const option = document.createElement('option');
                option.value = departamento.nombre_departamento;
                option.textContent = departamento.nombre_departamento;
                selectDepartamento.appendChild(option);
            });
        })
        .catch(error => console.error('Error al cargar los departamentos:', error));

    // Cargar roles
    axios.get('https://gestionempleadosapi.azurewebsites.net/controlador/roles.php?op=ObtenerTodos')
        .then(response => {
            const roles = response.data;
            const selectRol = document.getElementById('idRol');
            roles.forEach(rol => {
                const option = document.createElement('option');
                option.value = rol.nombre_rol;
                option.textContent = rol.nombre_rol;
                selectRol.appendChild(option);
            });
        })
        .catch(error => console.error('Error al cargar los roles:', error));
}

// Función para eliminar un empleado
function eliminarEmpleado() {
    if (!empleadoSeleccionado) {
        alert('Por favor selecciona un empleado para eliminar');
        return;
    }

    const confirmation = confirm(`¿Estás seguro que deseas eliminar el empleado "${empleadoSeleccionado.nombre} ${empleadoSeleccionado.apellido}"?`);

    if (confirmation) {
        axios.post('https://gestionempleadosapi.azurewebsites.net/controlador/empleados.php?op=Eliminar', { id_empleado: empleadoSeleccionado.id_empleado })
            .then(response => {
                console.log('Empleado eliminado correctamente');
                cargarEmpleados();  
            }
            )
            .catch(error => {
                console.error('Error al eliminar el empleado:', error);
                console.log('Error al eliminar el empleado');
            }
            );
    }
}

// Función para cargar roles y departamentos en el formulario de edición
function cargarDepartamentosYRolesEditar(empleado) {
    // Limpiar opciones previas en los select
    const selectDepartamento = document.getElementById('departamentoEditar');
    const selectRol = document.getElementById('rolEditar');
    selectDepartamento.innerHTML = '<option value="">Seleccione un departamento</option>';
    selectRol.innerHTML = '<option value="">Seleccione un rol</option>';

    // Cargar departamentos
    axios.get('https://gestionempleadosapi.azurewebsites.net/controlador/departamentos.php?op=ObtenerTodos')
        .then(response => {
            const departamentos = response.data;
            departamentos.forEach(departamento => {
                const option = document.createElement('option');
                option.value = departamento.nombre_departamento;
                option.textContent = departamento.nombre_departamento;
                if (departamento.nombre_departamento === empleado.departamento.nombre_departamento) {
                    option.selected = true; // Seleccionar el departamento actual
                }
                selectDepartamento.appendChild(option);
            });
        })
        .catch(error => console.error('Error al cargar los departamentos:', error));

    // Cargar roles
    axios.get('https://gestionempleadosapi.azurewebsites.net/controlador/roles.php?op=ObtenerTodos')
        .then(response => {
            const roles = response.data;
            roles.forEach(rol => {
                const option = document.createElement('option');
                option.value = rol.nombre_rol;
                option.textContent = rol.nombre_rol;
                if (rol.nombre_rol === empleado.rol.nombre_rol) {
                    option.selected = true; // Seleccionar el rol actual
                }
                selectRol.appendChild(option);
            });
        })
        .catch(error => console.error('Error al cargar los roles:', error));
}
// Asignar eventos a los botones
document.addEventListener('DOMContentLoaded', () => {
    cargarEmpleados(); // Cargar los empleados al iniciar la página
    cargarDepartamentosYRoles(); // Cargar departamentos y roles al iniciar

    // Evento para el botón "Guardar" (Agregar empleado)
    document.getElementById('btnGuardar').addEventListener('click', agregarEmpleado);
    // Evento para el botón "Guardar" (Editar empleado)
    document.getElementById('btnActualizarEmpleado').addEventListener('click', EditarEmpleado);

    // Evento para el botón ELIMINAR
    document.getElementById('btnEliminar').addEventListener('click', eliminarEmpleado);
});

// Función para buscar empleados por ID
function buscarRegistro() {
    const idBusqueda = document.getElementById('searchId').value.trim();
    const tabla = document.getElementById('tablaEmpleados');
    const filas = tabla.getElementsByTagName('tr');

    for (let i = 1; i < filas.length; i++) {
        const fila = filas[i];
        const idEmpleado = fila.getElementsByTagName('td')[0].textContent.trim();

        if (idBusqueda === '' || idEmpleado.includes(idBusqueda)) {
            fila.style.display = '';
        } else {
            fila.style.display = 'none';
        }
    }
}
