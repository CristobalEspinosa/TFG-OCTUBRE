<?php
session_start();
include './bd.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idUsuario = obtenerIdUsuario(); 

    
        $fecha = date('Y-m-d');
        $hora = date('H:i:s');
        $precioPedido = 0;

        $idPedido = creaPedido($idUsuario, $fecha, $hora, $precioPedido);
        $_SESSION['idPedido'] = $idPedido;

        echo json_encode(['success' => true, 'idPedido' => $idPedido]);
}
?>
