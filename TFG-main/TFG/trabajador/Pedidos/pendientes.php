<link rel="stylesheet" href="/TFG-MAIN/TFG/CSS/pedidos.css">

<?php
include("../../includes/header.php");
include '../../db/bd.inc.php';

echo '<div class="contenedor">';

// Menú de navegación vertical
echo '<div class="menu-vertical">';
echo '<a href="/TFG-MAIN/TFG/trabajador/pedidos/pendientes.php" class="boxP">Pendientes</a>';
echo '<a href="/TFG-MAIN/TFG/trabajador/pedidos/proceso.php" class="boxEP">En Proceso</a>';
echo '<a href="/TFG-MAIN/TFG/trabajador/pedidos/terminados.php" class="boxT">Terminados</a>';
echo '<a href="/TFG-MAIN/TFG/trabajador/pedidos/pagados.php" class="boxPG">Pagados</a>';
echo '</div>';

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
echo "<h4 class='dentroCards'>Pendientes:</h4>";
$pedidos = obtenerIdsPedidoFinalizados();
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
    echo "<a href='?realizado2=$idPedido' class='botonR'>Realizar</a>";
    echo "<a href='?eliminar=$idPedido' class='botonE'>Eliminar</a>";
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