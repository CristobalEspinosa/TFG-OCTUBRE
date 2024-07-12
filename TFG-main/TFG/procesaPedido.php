<?php
require_once ("../TFG/db/bd.inc.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoge los datos del formulario
    $campos = ['tipo', 'tamano', 'principalMedio','principalEntero','extraBocadillo', 'bebida', 'cafe', 'refresco', 'pizza', 'empanadilla',
    'tostada','otros', 'bolsa', 'chicle','cantidad'];
    $cantidad = $_POST['cantidad'];
    $pedido = '';
    $valores = array();
    $precioPedido = 0; // Inicializa el total del pedido

    foreach ($campos as $campo) {
        $$campo = $_POST[$campo];
        if ($$campo != 'nada') { 
            $pedido .= ucfirst($campo) . ": " . $$campo . "\n"; 
            array_push($valores, $$campo);
        }
    }

    if ($tipo == 'bocadillos' && $extraBocadillo != 'nada') {
        $nombreProducto = $valores[count($valores) - 3];
    } else {
        $nombreProducto = $valores[count($valores) - 2];
    }
    echo "Pedido completo:    ";
    echo $pedido;
    echo "                      Producto final:   ";
    echo $nombreProducto;
}

$idUsuario = obtenerIdUsuario();
echo "        idUsuario:       ";
echo $idUsuario; 

// Verificar si existe un pedido activo en la sesión
if (!isset($_SESSION['idPedido'])) {
    // Si no existe un pedido activo, crear uno
    $fecha = date('Y-m-d'); 
    $hora = date('H:i:s');
    $idPedido = creaPedido($idUsuario, $fecha, $hora, $precioPedido);
    $_SESSION['idPedido'] = $idPedido;
}

$idArticulo = obtenerIdArticulo($nombreProducto);
echo "                      idArticulo:    ";
echo $idArticulo;

if ($tipo == 'bocadillos' && $extraBocadillo != 'nada') {
    $nombreProducto = $valores[count($valores) - 3];
    $extra = $extraBocadillo;
} else {
    $nombreProducto = $valores[count($valores) - 2];
    $extra = NULL; 
}

$precioArticulo = obtenerPrecioArticuloPorNombre($nombreProducto);
$precioLinea = $precioArticulo * $cantidad;

$precioPedido += $precioLinea;

insertaPedidoLinea($idArticulo, $cantidad, $_SESSION['idPedido'],$extra,$precioLinea);


$valores = array();

?>
