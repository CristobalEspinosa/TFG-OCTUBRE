<?php
include("../includes/header.php");
include '../db/bd.inc.php';
?>
<link rel="stylesheet" href="/TFG-MAIN/TFG/CSS/usuario.css">
<!-- Jquery y datatables -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<body>
    <h1 class="titulo">Todos los usuarios</h1>
    <h3><a href="/TFG-MAIN/TFG/InicioDeSesion/registroTrabajador.php" class="aIniciar">Registrar nuevo usuario</a></h3>
    <table id="usuarios" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th class='correo'>Correo</th>
                <th class='tipo'>Tipo</th>
                <th>Acciones</th> <!-- Nueva columna -->
            </tr>
        </thead>
        <tbody>
            <?php
            $usuarios = obtenerUsuarios();
            foreach ($usuarios as $usuario) {
                echo "<tr>";
                echo "<td>" . $usuario['idUsuario'] . "</td>";
                echo "<td>" . $usuario['nombre'] . "</td>";
                echo "<td>" . $usuario['apellidos'] . "</td>";
                echo "<td class='correo' data-id='" . $usuario['idUsuario'] . "'>" . $usuario['correo'] . "</td>";
                echo "<td class='tipo' data-id='" . $usuario['idUsuario'] . "'>" . $usuario['tipo'] . "</td>";
                echo "<td>";
                echo "<button class='editar'><i class='fas fa-pencil-alt'></i></button>"; 
                echo "<button class='eliminar' data-id='" . $usuario['idUsuario'] . "' data-toggle='modal' data-target='#confirmModal'><i class='fas fa-trash'></i></button>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Modal de eliminar -->
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmar eliminación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que quieres eliminar este usuario?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary" id="confirmDelete">Sí</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal de edición -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
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
                        <label for="editCorreo">Correo</label>
                        <input type="email" class="form-control" id="editCorreo" name="correo">
                    </div>
                    <div class="form-group">
                        <label for="editTipo">Tipo</label>
                        <input type="text" class="form-control" id="editTipo" name="tipo">
                    </div>
                    <div class="form-group">
                        <label for="editPassword">Contraseña</label>
                        <input type="password" class="form-control" id="editPassword" name="password">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="confirmEdit">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>


</body>


<script>
   $(document).ready(function() {
    $('#usuarios').DataTable({
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });

    var idUsuario;

    //eliminar 
    $('.eliminar').click(function() {
        idUsuario = $(this).data('id'); 
    });

    $('#confirmDelete').click(function() {
        $.ajax({
            url: '../db/procesaUsuarios.php', 
            type: 'POST',
            data: { id: idUsuario },
            success: function(response) {
                if(response == "1"){
                    alert("Hubo un error al borrar el usuario");
                    location.reload(); 
                }else{
                    location.reload();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
});

//editar
$('.editar').click(function() {
    idUsuario = $(this).closest('tr').find('td:first').text();
    var nombre = $(this).closest('tr').children('td:nth-child(2)').text(); 
    var apellidos = $(this).closest('tr').children('td:nth-child(3)').text(); 
    var correo = $(this).closest('tr').children('td:nth-child(4)').text(); 
    var tipo = $(this).closest('tr').children('td:nth-child(5)').text(); 

    $('#editId').val(idUsuario);
    $('#editNombre').val(nombre);
    $('#editApellidos').val(apellidos);
    $('#editCorreo').val(correo);
    $('#editTipo').val(tipo);

    $('#editModal').modal('show'); 
});

$('#confirmEdit').click(function() {
    $.ajax({
        url: '../db/procesaUsuarios.php', 
        type: 'POST',
        data: $('#editForm').serialize(),
        success: function(response) {
            if(response == "1"){
                location.reload(); 
            }else{
                location.reload();
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
});


</script>

<div class="foooter">
    <?php
    include("../includes/footer.php");
    ?>
    </div>

