<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cantina</title>
    <link rel="stylesheet" href="/TFG-MAIN/TFG/CSS/miPerfil.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <!-- Jquery y datatables -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <?php
    include("../includes/header.php");
    include '../db/bd.inc.php';
    ?>
    <div class="container">
        <div class="profile-container">
            <div class="profile-image-container">
                <?php
                switch ($_SESSION['tipo']) {
                    case 'Alumno':
                        $user_icon = 'user_icon_a.png';
                        break;
                    case 'Profesor':
                        $user_icon = 'user_icon_p.png';
                        break;
                    case 'Trabajador':
                        $user_icon = 'user_icon_t.png';
                        break;
                    default:
                        $user_icon = 'user_icon.png';
                        break;
                }
                ?>
                <img src="/TFG-MAIN/TFG/IMAGES/<?php echo $user_icon; ?>" alt="Imagen de perfil" class="profile-image">
            </div>
            <div class="profile-details">
                <h2>Nombre: <?php echo $_SESSION['username']; ?></h2>
                <h2>Correo: <?php echo $_SESSION['correo']; ?></h2>
                <h2>Tipo de usuario: <?php echo $_SESSION['tipo']; ?></h2>
                <!-- Botón que abre el modal -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                    Eliminar cuenta
                </button>
                <button type="button" class="btn btn-warning editar" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?php echo $_SESSION['idUsuario']; ?>">
                    Editar cuenta
                </button>
                <a href="salir.php" class="btn btn-primary">
        Cerrar sesión
    </a>
<p>




















</p>
            </div>
        </div>

        <!-- Modal de confirmación de eliminación -->
        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar eliminación</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro de que quieres eliminar tu cuenta? Esta acción es irreversible.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <form action="eliminaUsuario.php" method="post">
                            <button type="submit" class="btn btn-danger">Eliminar cuenta</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Editar usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" data-bs-dismiss="modal">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm">
                            <input type="hidden" id="editId" name="id">
                            <div class="form-group">
                                <label for="editNombre">Nombre</label>
                                <input type="text" class="form-control" id="editNombre" name="nombre">
                            </div>
                            <div class="form-group">
                                <label for="editApellidos">Apellidos</label>
                                <input type="text" class="form-control" id="editApellidos" name="apellidos">
                            </div>
                            <div class="form-group">
                                <label for="editPassword">Contraseña</label>
                                <input type="password" class="form-control" id="editPassword" name="password">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="confirmEdit">Guardar cambios</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="foooter">
    <?php
    include("../includes/footer.php");
    ?>
    </div>
    <script>
   $(document).ready(function() {
    $('.editar').click(function() {
        var idUsuario = $(this).data('id');

        $.ajax({
            url: '../db/obtenerUsuario.php',
            type: 'POST',
            data: {
                id: idUsuario
            },
            success: function(response) {
                var usuario = JSON.parse(response);

                $('#editId').val(usuario.idUsuario);
                $('#editNombre').val(usuario.nombre);
                $('#editApellidos').val(usuario.apellidos);

                $('#editModal').modal('show');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });

    $('#confirmEdit').click(function() {
        var idUsuario = $('#editId').val();
        var nombre = $('#editNombre').val();
        var apellidos = $('#editApellidos').val();
        var password = $('#editPassword').val();

        $.ajax({
            url: '../db/editarUsuario.php',
            type: 'POST',
            data: {
                id: idUsuario,
                nombre: nombre,
                apellidos: apellidos,
                password: password
            },
            success: function(response) {
                alert("Los datos del usuario se han actualizado correctamente.");
                $('#editModal').modal('hide');
                location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                alert("Hubo un error al actualizar los datos del usuario. Por favor, inténtalo de nuevo.");
            }
        });
    });
});

    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>

</body>

</html>