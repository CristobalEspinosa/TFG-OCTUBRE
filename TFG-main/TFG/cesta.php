<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/index.css">
    <link rel="stylesheet" href="./CSS/cesta.css">
    <title>Cantina</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
        $idPedido = obtenerUltimoPedidoNoPagado($idUsuario);
        $finalizadoPedido = obtenerFinalizadoPedido($idPedido);

        if ($idPedido) {
            $detallesPedido = obtenerPedido($idPedido);
            $estadoPedido = obtenerEstadoPedido($idPedido);
            if ($estadoPedido) {
                echo '<h3>Tu pedido ha sido realizado y está preparado para la entrega</h3>';
            } else {
                echo '<h3>Tu pedido está en proceso.</h3>';
            }
            echo "<div class='pedidoUsuario' id='pedido-$idPedido'>";
            echo "<div class='card'>";
            
            echo "<div class='pedido'>";
            echo "ID: ". $detallesPedido["idPedido"] ."<br>" . "Fecha: " . $detallesPedido["fecha"] . "<br>";
            echo "</div>";

            echo "<table class='table'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Artículo</th>";
            echo "<th>Cantidad</th>";
            echo "<th>Precio Unitario</th>";
            echo "<th>Total</th>";
            echo "<th>Acciones</th>";
            echo "</tr>";
            echo "</thead>";
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
                if (!$estadoPedido) {
                if (!$finalizadoPedido) {
                echo "<td>";
                echo "<button class='btn btn-outline-danger' onclick='eliminarLinea(" . $linea["idPedidoLinea"] . ")'><i class='fas fa-trash'></i></button>";
                echo "<button class='btn btn-outline-warning' onclick='modificarCantidad(" . $linea["idPedidoLinea"] . ", " . $linea["idArticulo"] . ")'><i class='fas fa-pencil-alt'></i></button>";
                echo "</td>";
                }
                echo "</tr>";
            }
        }

            echo "</tbody>";
            echo "</table>";

            echo "<div id='estado-$idPedido'></div>";
            echo "<div id='total-$idPedido'>Total: " . $detallesPedido["precioPedido"] . " €</div>";
             if ($finalizadoPedido) {
            echo "<div id='recogida-$idPedido'>Recogida:   " . $detallesPedido["horaRecogida"] . " </div>";
             }
            echo "</div>";
            if (!$estadoPedido) {
                if ($finalizadoPedido) {
                    echo '<center> <button type="button" class="finalizar btn btn-warning" data-id="'.$idPedido.'" onclick="finalizarPedido('.$idPedido.')">Seguir pidiendo</button> </center>';
                } else {
                    echo "Hora de recogida:   ";
                  echo '<select id="horaRecogida" name="horaRecogida">
    <option value="RECREO" selected>RECREO</option>
    <option value="1ªHORA">1ª HORA</option>
    <option value="2ªHORA">2ª HORA</option>
    <option value="3ªHORA">3ª HORA</option>
    <option value="4ªHORA">4ª HORA</option>
    <option value="5ªHORA">5ª HORA</option>
</select>';
                    echo '<center> <button type="button" class="finalizar btn btn-success" data-id="'.$idPedido.'" onclick="finalizarPedido('.$idPedido.')">Finalizar</button> </center>';
                }
            }

            echo "</div>";
        } else {
            echo '<h3>No tienes pedidos pendientes.</h3>';
        }
        echo '</div>';
    } else {
        echo '<div class="login-message">';
        echo '<h1 class="tituloReserva">Por favor inicie sesión para seguir</h1>';
        echo '<p class="pIniciar">Para poder hacer un pedido tienes que <a href="/TFG-main/TFG/InicioDeSesion/inicioSesion.php" class="aIniciar">iniciar sesión</a></p>';
        echo '</br>';
        echo '</br>';
        echo '</br>';
        echo '</br>';
        echo '</br>';
        echo '</br>';
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
        $.ajax({
            url: './db/finalizarPedido.php',
            type: 'post',
            data: {
                idPedido: idPedido,
                horaRecogida: horaRecogida, 
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
</script>

</html>