<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Empleados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/gestion.css">
    <link rel="stylesheet" href="./css/sidebar.css">
    
</head>
<body>

  <button class="toggle-btn" id="toggleButton" style="right: 20px; left: auto;"><i class="bi bi-list"></i></button>


  <div class="sidebar" id="sidebar">
  <a href="index.php" class="sidebar-link">Inicio</a>
      <a href="gestion_empleados.php" class="sidebar-link">Gestión de Empleados</a>
      <a href="gestion_roles.php" class="sidebar-link active">Gestión de Roles</a>
      <a href="gestion_departamentos.php" class="sidebar-link">Gestión de Departamentos</a>
  </div>

 
  <div class="content" id="content">
<div class="container card p-3 mt-5">
    <h2 class="text-center">Gestión de Empleados</h2>

    <div class="my-4">
        <div class="row my-3">
            <div class="col-6">
                <div class="col-12">
                    <input type="text" id="searchId" class="form-control" placeholder="Buscar por ID"
                        onkeyup="buscarRegistro()" style="width: 300px; display: inline-block;">
                </div>
            </div>
            <div class="col-6 text-end">
                <button class="btn btn-primary" id="btnAgregar" data-bs-toggle="modal" data-bs-target="#modalAgregar">Agregar</button>
                <button type="button" class="btn btn-warning" id="btnEditar" data-bs-toggle="modal" data-bs-target="#modalEditar" disabled>Editar</button>
                <button type="button" class="btn btn-danger" id="btnEliminar" disabled>Eliminar</button>
            </div>
        </div>
       
    </div>


     <table id="tablaEmpleados" class=" card-shadow table table-striped table-hover">
        <thead class="thead-dark" style="background-color: #07305a;">
    
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo</th>
                <th>Departamento</th>
                <th>Rol</th>
            </tr>
        </thead>
        <tbody style="background-color: #dfdfdf;">
        </tbody>
    </table>
</div>


<div class="modal fade" id="modalAgregar" tabindex="-1" aria-labelledby="modalAgregarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAgregarLabel">Agregar Registro</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formRegistro">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="apellido" required>
                    </div>
                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo</label>
                        <input type="email" class="form-control" id="correo" required>
                    </div>
                    <div class="mb-3">
                        <label for="idDepartamento" class="form-label">Departamento</label>
                        <select class="form-control" id="idDepartamento" required>
                            <option value="">Seleccione un Departamento</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="idRol" class="form-label">Rol</label>
                        <select class="form-control" id="idRol" required>
                            <option value="">Seleccione un Rol</option>
                           
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btnGuardar">Guardar</button>
            </div>
        </div>
    </div>
  </div>


<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarLabel">Editar Empleado</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditarEmpleado">
                    <div class="mb-3">
                        <label for="nombreEditar" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombreEditar" required>
                    </div>
                    <div class="mb-3">
                        <label for="apellidoEditar" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="apellidoEditar" required>
                    </div>
                    <div class="mb-3">
                        <label for="correoEditar" class="form-label">Correo</label>
                        <input type="email" class="form-control" id="correoEditar" required>
                    </div>
                    <div class="mb-3">
                        <label for="departamentoEditar" class="form-label">Departamento</label>
                        <select class="form-control" id="departamentoEditar" required>
                            <option value="">Seleccione un Departamento</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="dolEditar" class="form-label">Rol</label>
                        <select class="form-control" id="rolEditar" required>
                            <option value="">Seleccione un Rol</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-warning" id="btnActualizarEmpleado">Actualizar</button>
            </div>
        </div>
    </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="./js/empleados.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="./js/sidebar.js"></script>
</body>
</html>
