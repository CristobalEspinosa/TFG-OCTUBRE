<link rel="stylesheet" href="/TFG-MAIN/TFG/CSS/pedidos.css">
<?php
include("../../includes/header.php");
include '../../db/bd.inc.php';


// Comprobar si se ha hecho clic en los botones y actualizar el estado correspondiente
if (isset($_GET['realizado'])) {
    marcarComoRealizado($_GET['realizado']);
} elseif (isset($_GET['realizado2'])) {
    marcarComoSiendoRealizado($_GET['realizado2']);
} elseif (isset($_GET['no-realizado'])) {
    marcarComoNoRealizado($_GET['no-realizado']);
} elseif (isset($_GET['quitar-realizacion'])) {
    marcarComoSiendoNoRealizado($_GET['quitar-realizacion']);
} elseif (isset($_GET['pagado'])) {
    marcarComoPagado($_GET['pagado']);
} elseif (isset($_GET['no-pagado'])) {
    marcarComoNoPagado($_GET['no-pagado']);
} elseif (isset($_GET['eliminar'])) {
    eliminarPedido($_GET['eliminar']);
}

// Obtener todos los IDs de pedido
echo "<div class='contenedor-principal'>";
echo  "<div class='izquierda'>";
echo "<h4 class='dentroCards'>Siendo Realizados:</h4>";
$pedidos = obtenerIdsPedidosiendoRealizados();
foreach ($pedidos as $idPedido) {
    // Obtener los detalles del pedido
    $detallesPedido = obtenerPedido($idPedido);

    echo "<div class='allPedido' id='pedido-$idPedido'>";
    echo "<div class='card'>";
    echo "<div class='pedido' onclick='toggleDetalles($idPedido)'>";
    // Obtener el nombre del usuario
    $nombreUsuario = obtenerNombreUsuario($detallesPedido["idUsuario"]);
    echo "ID: " . $detallesPedido["idPedido"] . "<br>";
    echo "Usuario: " . $nombreUsuario . "<br>";
    echo "Fecha: " . $detallesPedido["fecha"] . "<br>";
    echo "</div>";

    echo "<div class='detalles' id='detalles-$idPedido' style='display:none;'>";
    // Verificar si el pedido está siendo realizado
    if ($detallesPedido['siendoRealizado'] == 1) {
        echo "<div class='siendoRealizado'>Pedido está siendo realizado</div>";
    }

    // Obtener las líneas de pedido
    $lineasPedido = obtenerLineasPedido($idPedido);
    foreach ($lineasPedido as $linea) {
        echo "<div class='linea linea-$idPedido'>";
        $nombreArticulo = obtenerNombreArticulo($linea["idArticulo"]);
        $precioArticulo = obtenerPrecioArticulo($linea["idArticulo"]);
        $precioTotal = $precioArticulo * $linea["cantidad"];
        echo "- " . $nombreArticulo;
        echo "   Cantidad: <span class='cantidad' style='color:#a8329b'>" . $linea["cantidad"] . "</span>";
        echo "   Precio: <span class='precio' style='color:#a8329b'>" . $precioTotal . "€</span><br>";
        echo "</div>";
    }
    //botones
    echo "<div class='botones'>";
    if ($detallesPedido['realizado'] == 1) {
        echo "<a href='?no-realizado=$idPedido' class='boton'>No Terminado</a>";
    } else {
        if ($detallesPedido['siendoRealizado'] == 1) {
            echo "<a href='?quitar-realizacion=$idPedido' class='boton'>Quitar Realización</a>";
            echo "<a href='?realizado=$idPedido' class='boton'>Terminado</a>";
        } else {
            echo "<a href='?realizado=$idPedido' class='boton'>Terminado</a>";
            echo "<a href='?realizado2=$idPedido' class='boton'>Realizar</a>";
        }
    }
    if ($detallesPedido['pagado'] == 1) {
        echo "<a href='?no-pagado=$idPedido' class='boton'>No Pagado</a>";
    } else {
        echo "<a href='?pagado=$idPedido' class='boton'>Pagado</a>";
    }
    echo "<a href='?eliminar=$idPedido' class='boton'>Eliminar</a>";
    echo "</div>";
    echo "<div id='estado-$idPedido'></div>";
    // Obtenemos el precio total del pedido desde el campo precioPedido
    echo "<div id='recogida-$idPedido'>Recogida: " . $detallesPedido["horaRecogida"] . "</div>";
    echo "<div id='total-$idPedido'>Total: " . $detallesPedido["precioPedido"] . "€</div>";
    if ($detallesPedido['realizado'] == 1) {
        echo "<div class='realizado'>Pedido Realizado</div>";
    }
    if ($detallesPedido['pagado'] == 1) {
        echo "<div class='pagado'>Pedido Pagado</div>";
    }
    echo "</div>"; // Cierre de detalles
    echo "</div>"; // Cierre de card
    echo "</div>"; // Cierre de allPedido
}
echo "</div>";
echo "</div>";



    include("../../includes/footer.php");
?>
<script>
function toggleDetalles(idPedido) {
    var detalles = document.getElementById('detalles-' + idPedido);
    if (detalles.style.display === 'none') {
        detalles.style.display = 'block';
    } else {
        detalles.style.display = 'none';
    }
}
</script>