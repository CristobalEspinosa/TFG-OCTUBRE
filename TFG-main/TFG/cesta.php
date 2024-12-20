<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/index.css">
    <link rel="stylesheet" href="./CSS/cesta.css">
    <title>Cantina-Cesta</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<?php
include("./includes/header.php");
include './db/bd.inc.php';
?>

<body>
    <?php
    if (isset($_SESSION['hola'])) {
        echo '<h1 class="titulo">Mi Cesta:</h1>';
        echo '<div class="cesta">';
        $idUsuario = obtenerIdUsuario();
        $pedidosNoPagados = obtenerPedidosNoPagados($idUsuario);

        if ($pedidosNoPagados) {
            foreach ($pedidosNoPagados as $pedido) {
                $idPedido = $pedido['idPedido'];
                $estadoPedido = obtenerEstadoPedido($idPedido);
                $finalizadoPedido = obtenerFinalizadoPedido($idPedido);
                
                if ($estadoPedido) {
                    echo '<h3>Tu pedido ha sido realizado y está preparado para la entrega</h3>';
                } else {
                    echo '<h3>Tu pedido está en proceso.</h3>';
                }

                echo "<div class='pedidoUsuario' id='pedido-$idPedido'>";
                echo "<div class='card'>";

                // Información del pedido
                echo "<div class='pedido'>";
                echo "ID: " . $pedido["idPedido"] . "<br>" . "Fecha: " . $pedido["fecha"] . "<br>";
                echo "</div>";

                echo "<table class='table'>";
                echo "<thead><tr><th>Artículo</th><th>Cantidad</th><th>Precio Unitario</th><th>Total</th><th>Acciones</th></tr></thead>";
                echo "<tbody>";

                $lineasPedido = obtenerLineasPedido($idPedido);
                foreach ($lineasPedido as $linea) {
                    $nombreArticulo = obtenerNombreArticulo($linea["idArticulo"]);
                    $precioArticulo = obtenerPrecioArticulo($linea["idArticulo"]);
                    $precioTotal = $precioArticulo * $linea["cantidad"];

                    echo "<tr>";
                    echo "<td>" . $nombreArticulo . "</td>";
                    echo "<td>" . $linea["cantidad"] . "</td>";
                    echo "<td>" . $precioArticulo . "€</td>";
                    echo "<td>" . $precioTotal . "€</td>";
                    echo "<td>";
                    if (!$estadoPedido && !$finalizadoPedido) {
                        echo "<button class='btn btn-outline-danger' onclick='eliminarLinea(" . $linea["idPedidoLinea"] . ")'><i class='fas fa-trash'></i></button>";
                        echo "<button class='btn btn-outline-warning' onclick='modificarCantidad(" . $linea["idPedidoLinea"] . ", " . $linea["idArticulo"] . ")'><i class='fas fa-pencil-alt'></i></button>";
                    }
                    echo "</td></tr>";
                }

                echo "</tbody></table>";

                // Total y detalles de recogida
                echo "<div id='total-$idPedido'>Total: " . $pedido["precioPedido"] . " €</div>";
                if ($finalizadoPedido) {
                    echo "<div id='recogida-$idPedido'>Día: " . $pedido["fechaRecogida"] . "</div>";
                    echo "<div id='recogida-$idPedido'>Hora: " . $pedido["horaRecogida"] . "</div>";
                }

                // Botón de finalizar y selectores de recogida
                if (!$estadoPedido) {
                    if ($finalizadoPedido) {
                        echo '<center><button type="button" class="finalizar btn btn-warning" data-id="'.$idPedido.'" onclick="finalizarPedido('.$idPedido.')">Seguir pidiendo</button></center>';
                    } else {
                        echo "<label>Hora de recogida:</label>";
                        echo '<select id="horaRecogida" name="horaRecogida">
                                <option value="RECREO" selected>RECREO</option>
                                <option value="1ªHORA">1ª HORA</option>
                                <option value="2ªHORA">2ª HORA</option>
                                <option value="3ªHORA">3ª HORA</option>
                                <option value="4ªHORA">4ª HORA</option>
                                <option value="5ªHORA">5ª HORA</option>
                              </select>';
                        echo "<br><label>Día de recogida:</label>";
                        echo '<select id="fechaRecogida" name="fechaRecogida">
                                <option value="HOY" selected>Hoy</option>
                                <option value="MAÑANA">Mañana</option>
                              </select>';
                        echo '<center><button type="button" class="finalizar btn btn-success" data-id="'.$idPedido.'" onclick="finalizarPedido('.$idPedido.')">Finalizar</button>';
                        echo '<button type="button" class="btn btn-danger" onclick="eliminarPedido('.$idPedido.')">Eliminar</button></center>';
                    }
                }

                echo "</div></div>";
            }
        } else {
            echo '<h3>No tienes pedidos pendientes.</h3>';
        }
        echo '<div class="d-flex justify-content-center mt-4">';
        echo '<button class="btn btn-primary btn-lg shadow-sm rounded-pill" onclick="crearNuevoPedido()">';
        echo '<i class="bi bi-plus-circle"></i> Crear nuevo pedido';
        echo '</button>';
        echo '</div>';
        echo '</div>';
    } else {
        echo '<div class="login-message">';
        echo '<h1 class="tituloReserva">Por favor inicie sesión para seguir</h1>';
        echo '<p class="pIniciar">Para poder hacer un pedido tienes que <a href="/TFG-main/TFG/InicioDeSesion/inicioSesion.php" class="aIniciar">iniciar sesión</a></p>';
        echo '</div>';
    }
    ?>
</body>
<?php
include("./includes/footer.php")
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    // Marcar pedido como finalizado
    $(".finalizar.btn-success").click(function() {
        var idPedido = $(this).data('id');
        var horaRecogida = $('#horaRecogida').val();
        var fechaRecogida = $('#fechaRecogida').val(); // Obtener valor del select

        // Procesar la fecha según el valor seleccionado en el select
        var fechaHoy = new Date();
        var fechaRecogidaFormateada;

        if (fechaRecogida === 'HOY') {
            // Formatear la fecha de hoy
            var diaHoy = fechaHoy.getDate().toString().padStart(2, '0');
            var mesHoy = (fechaHoy.getMonth() + 1).toString().padStart(2, '0');
            var anioHoy = fechaHoy.getFullYear();
            fechaRecogidaFormateada = anioHoy + '-' + mesHoy + '-' + diaHoy;
        } else if (fechaRecogida === 'MAÑANA') {
            // Calcular la fecha de mañana
            fechaHoy.setDate(fechaHoy.getDate() + 1);
            var diaManana = fechaHoy.getDate().toString().padStart(2, '0');
            var mesManana = (fechaHoy.getMonth() + 1).toString().padStart(2, '0');
            var anioManana = fechaHoy.getFullYear();
            fechaRecogidaFormateada = anioManana + '-' + mesManana + '-' + diaManana;
        }

        // Realizar la llamada AJAX
        $.ajax({
            url: './db/finalizarPedido.php',
            type: 'post',
            data: {
                idPedido: idPedido,
                horaRecogida: horaRecogida,
                fechaRecogida: fechaRecogidaFormateada, // Enviar la fecha formateada
                action: 'finalizar'
            },
            success: function(response) {
                alert("Pedido Finalizado");
                location.reload();
            }
        });
    });

    // Marcar pedido como no finalizado
    $(".finalizar.btn-warning").click(function() {
        var idPedido = $(this).data('id'); 
        $.ajax({
            url: './db/finalizarPedido.php',
            type: 'post',
            data: {
                idPedido: idPedido,
                action: 'noFinalizar'
            },
            success: function(response) {
                alert("Ya puedes seguir añadiendo o modificando tu cesta");
                location.reload();
            }
        });
    });
});
    function eliminarLinea(idPedidoLinea) {
        $.ajax({
            url: './db/bd.inc.php',
            type: 'post',
            data: {
                'action': 'eliminarLinea',
                'idPedidoLinea': idPedidoLinea
            },
            success: function(response) {
                location.reload();
            }
        });
    }

    function modificarCantidad(idPedidoLinea, idArticulo) {
        var nuevaCantidad = prompt("Introduce la nueva cantidad:");
        if (nuevaCantidad) {
            $.ajax({
                url: './db/bd.inc.php',
                type: 'post',
                data: {
                    'action': 'modificarCantidad',
                    'idPedidoLinea': idPedidoLinea,
                    'nuevaCantidad': nuevaCantidad,
                    'idArticulo': idArticulo
                },
                success: function(response) {
                    location.reload();
                }
            });
        }
    }

    function crearNuevoPedido() {
    fetch('./db/creaPedido.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({})
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Pedido creado exitosamente");
            // Aquí puedes actualizar la página o redirigir al usuario
            window.location.reload(); // Recargar la página para ver el nuevo pedido
        } else {
            alert("Hubo un error al crear el pedido.");
        }
    })
    .catch(error => console.error('Error:', error));
}
function eliminarPedido(idPedido) {
    if (confirm("¿Estás seguro de que deseas eliminar este pedido?")) {
        $.ajax({
            url: './db/bd.inc.php',
            type: 'post',
            data: {
                'action': 'eliminarPedido',
                'idPedido': idPedido
            },
            success: function(response) {
                alert("Pedido eliminado correctamente.");
                location.reload();
            }
        });
    }
}
</script>

</html>