<?php
session_start();
include "conexion.inc.php";
$conexion=conectar();
$mesa=$_SESSION['mesa'];
$consulta="SELECT max(nlinea) from CUENTA where mesa=$mesa;";
$linea=$conexion->query($consulta)->fetchColumn();
$eliminar="DELETE FROM cuenta where nlinea=$linea;";
$conexion->query($eliminar);
header('Location:index.php');
?>
