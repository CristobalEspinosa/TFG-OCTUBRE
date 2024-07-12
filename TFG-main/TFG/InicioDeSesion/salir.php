<?php
session_start();
$_SESSION = array();
unset($_SESSION['idPedido']);
session_destroy();
header("Location: /TFG-main/TFG/index.php");
?>