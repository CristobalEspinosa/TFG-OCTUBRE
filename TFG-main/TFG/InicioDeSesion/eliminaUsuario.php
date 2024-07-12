<?php
require_once ("../db/bd.inc.php");
session_start();
$idUsuario=obtenerIdUsuario();
eliminarUsuarioActual($idUsuario);
session_destroy();
header("Location: /TFG-main/TFG/index.php");
exit();
?>