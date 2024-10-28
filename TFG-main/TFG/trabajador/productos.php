<?php
include("../includes/header.php");
include '../db/bd.inc.php';
?>
<link rel="stylesheet" href="/TFG-MAIN/TFG/CSS/producto.css">
<!-- Jquery y datatables -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<body>
    <h1 class="titulo">Todos los productos</h1>
    <h3><a href="/TFG-MAIN/TFG/trabajador/registroProductos.php" class="aIniciar">Registrar nuevo producto</a></h3>
    <table id="productos" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th class='precio'>Precio</th>
                <th class='compra'>Precio Compra</th>
                <th class='stock'>Stock</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $productos = obtenerArticulos();
            foreach ($productos as $producto) {
                echo "<tr>";
                echo "<td>" . $producto['idArticulo'] . "</td>";
                echo "<td>" . $producto['articulo'] . "</td>";
                echo "<td class='precio' data-id='" . $producto['idArticulo'] . "'>" . $producto['pvp'] . "</td>";
                echo "<td class='compra' data-id='" . $producto['idArticulo'] . "'>" . $producto['precioCompra'] . "</td>";
                echo "<td class='stock' data-id='" . $producto['idArticulo'] . "'>" . $producto['stock'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Modal para actualizar el stock -->
    <div class="modal fade" id="stockModal" tabindex="-1" role="dialog" aria-labelledby="stockModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="stockModalLabel">Actualizar Stock</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="number" id="nuevoStock" class="form-control" placeholder="Introduce la nueva cantidad">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="actualizarStock">Actualizar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para actualizar el precio -->
    <div class="modal fade" id="precioModal" tabindex="-1" role="dialog" aria-labelledby="precioModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="precioModalLabel">Actualizar Precio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="number" id="nuevoPrecio" class="form-control" placeholder="Introduce el nuevo precio">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="actualizarPrecio">Actualizar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var idArticulo;

        $(document).ready(function() {
            $('#productos').DataTable({
                "destroy": true,
                "retrieve": true,
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

            $(document).on('click', '.stock', function() {
                idArticulo = $(this).data('id');
                $('#stockModal').modal('show');
            });

            $('#actualizarStock').click(function() {
                var nuevoStock = $('#nuevoStock').val();
                if (nuevoStock !== '') {
                    $.ajax({
                        url: '../db/procesaStock.php',
                        method: 'POST',
                        data: {
                            idArticulo: idArticulo,
                            nuevoStock: nuevoStock
                        },
                        success: function(response) {
                            $('#modalBody').text('Stock actualizado correctamente');
                            $('#myModal').modal('show');
                            location.reload();
                        },
                        error: function() {
                            $('#modalBody').text('Error al actualizar el stock');
                            $('#myModal').modal('show');
                        }
                    });
                }
            });

            $(document).on('click', '.precio', function() {
                idArticulo = $(this).data('id');
                $('#precioModal').modal('show');
            });

            $('#actualizarPrecio').click(function() {
                var nuevoPrecio = $('#nuevoPrecio').val();
                if (nuevoPrecio !== '') {
                    $.ajax({
                        url: '../db/procesaStock.php',
                        method: 'POST',
                        data: {
                            idArticulo: idArticulo,
                            nuevoPrecio: nuevoPrecio
                        },
                        success: function(response) {
                            $('#modalBody').text('Precio actualizado correctamente');
                            $('#myModal').modal('show');
                            location.reload();
                        },
                        error: function() {
                            $('#modalBody').text('Error al actualizar el precio');
                            $('#myModal').modal('show');
                        }
                    });
                }
            });
        });
    </script>

<?php
include("../includes/footer.php");
?>
