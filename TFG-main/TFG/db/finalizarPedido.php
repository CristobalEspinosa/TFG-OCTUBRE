<?php
include './bd.inc.php'; 

if ($_POST['action'] == 'finalizar') {
    $idPedido = $_POST['idPedido'];
    $horaRecogida = $_POST['horaRecogida'];
    $fechaRecogida = $_POST['fechaRecogida'];
    finalizarPedidoConHoraFecha($idPedido,$horaRecogida,$fechaRecogida);
} elseif ($_POST['action'] == 'noFinalizar') {
    $idPedido = $_POST['idPedido'];
    marcarComoNoFinalizado($idPedido);
}
?>
