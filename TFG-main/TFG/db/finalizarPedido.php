<?php
include './bd.inc.php'; 

if ($_POST['action'] == 'finalizar') {
    $idPedido = $_POST['idPedido'];
    $horaRecogida = $_POST['horaRecogida'];
    finalizarPedidoConHora($idPedido,$horaRecogida);
} elseif ($_POST['action'] == 'noFinalizar') {
    $idPedido = $_POST['idPedido'];
    marcarComoNoFinalizado($idPedido);
}
?>
